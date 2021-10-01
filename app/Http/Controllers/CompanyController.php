<?php

namespace App\Http\Controllers;

use App\Note;
use App\Task;
use App\User;
use App\Email;
use App\Company;
use App\Contact;
use App\Utility;
use App\Schedule;
use App\LogActivity;
use App\ContactGroup;
use App\CompanyDetail;
use App\ContactCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Companies'))
        {
            $companies = Company::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('crm.company.index',compact('companies'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('Create Company'))
        {
            $users=User::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name','id')->toArray();
            $contactgroups = ContactGroup::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('crm.company.create',compact('users','contactgroups'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Company'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'email' => 'required|unique:companies',
                                   'life_stage' => 'required|not_in:0',
                                   'contact_owner' => 'required|not_in:0'
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
    
            $id = Auth::id();
            $assigngroup = implode(",", (array) $request->assign_group);
            $company = new Company();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->created_by = \Auth::user()->creatorId();
            $company->save();
    
            $companydetail = new CompanyDetail();
            $companydetail->company_id = $company->id;
            $companydetail->phone_no = $request->phone_no; 
            $companydetail->life_stage = $request->life_stage;
            $companydetail->contact_owner = $request->contact_owner;
            $companydetail->mobile_no = $request->mobile;
            $companydetail->website = $request->website; 
            $companydetail->fax_no = $request->fax_number;     
            $companydetail->address1 = $request->address1; 
            $companydetail->address2 = $request->address2;  
            $companydetail->city = $request->city;
            $companydetail->country = $request->country;  
            $companydetail->state = $request->province_state; 
            $companydetail->zip_code = $request->post_code; 
            $companydetail->assign_group = $assigngroup;
            $companydetail->contact_source = $request->contact_source;
            $companydetail->others = $request->others;
            $companydetail->notes = $request->notes;
            $companydetail->facebook = $request->facebook;
            $companydetail->twitter = $request->twitter;
            $companydetail->google_plus = $request->google_plus;
            $companydetail->linkedin = $request->linkedin;
            $companydetail->save();
    
            return redirect()->route('companies.index')->with('success', __('Company Add Successfully'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        if(\Auth::user()->can('View Company'))
        {
            $contact_ids = ContactCompany::where('created_by', '=', \Auth::user()->creatorId())->where('company_id','=',$company->id)->get()->pluck('contact_id')->toArray();
            $contacts = Contact::where('created_by', '=', \Auth::user()->creatorId())->whereNotIn('id',$contact_ids)->pluck('name','id');
            $contacts->prepend(__('Please Select'),0);
            $emails = Email::where('created_by', '=', \Auth::user()->creatorId())->where('module_type','LIKE','company')->get();
            $logactivities = LogActivity::where('created_by', '=', \Auth::user()->creatorId())->where('module_type','LIKE','company')->get();
            $notes = Note::where('created_by', '=', \Auth::user()->creatorId())->where('module_type','LIKE','company')->get();
            $schedules = Schedule::where('created_by', '=', \Auth::user()->creatorId())->where('module_type','LIKE','company')->get();
            $tasks = Task::where('created_by', '=', \Auth::user()->creatorId())->where('module_type','LIKE','company')->get();
            return view('crm.company.view', compact('company','contacts','emails','logactivities','notes','schedules','tasks'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        if(\Auth::user()->can('Edit Company'))
        {
            if($company->created_by==\Auth::user()->creatorId())
            {
                $users = User::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name','id')->toArray();
                return view('crm.company.edit', compact('company','users'));
            }
            else
            {
                return redirect()->back()->with('errors', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        if(\Auth::user()->can('Edit Company'))
        {
            if($company->created_by==\Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'name' => 'required',
                                    'email' => 'required|unique:companies,email,'.$company->id.'',
                                    'life_stage' => 'required|not_in:0',
                                    'contact_owner' => 'required|not_in:0'
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $id = Auth::id();
                $assigngroup = implode(",", (array) $request->assign_group);
                $company = Company::find($company->id);
                $company->name = $request->name;
                $company->email = $request->email;
                $company->save();
                $companydetail = CompanyDetail::where('company_id',$company->id)->first();
                $companydetail->company_id = $company->id;
                $companydetail->phone_no = $request->phone_no; 
                $companydetail->life_stage = $request->life_stage;
                $companydetail->contact_owner = $request->contact_owner;
                $companydetail->mobile_no = $request->mobile;
                $companydetail->website = $request->website; 
                $companydetail->fax_no = $request->fax_number;     
                $companydetail->address1 = $request->address1; 
                $companydetail->address2 = $request->address2;  
                $companydetail->city = $request->city;
                $companydetail->country = $request->country;  
                $companydetail->state = $request->province_state; 
                $companydetail->zip_code = $request->post_code; 
                $companydetail->assign_group = $assigngroup;
                $companydetail->contact_source = $request->contact_source;
                $companydetail->others = $request->others;
                $companydetail->notes = $request->notes;
                $companydetail->facebook = $request->facebook;
                $companydetail->twitter = $request->twitter;
                $companydetail->google_plus = $request->google_plus;
                $companydetail->linkedin = $request->linkedin;
                $companydetail->save();
                return redirect()->route('companies.index')->with('success', __('Company Successfully Updated.'));
            }
            else
            {
                return redirect()->back()->with('errors', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if(\Auth::user()->can('Delete Company'))
        {
            if($company->created_by==\Auth::user()->creatorId())
            {
                if(!empty($company->companydetail->image))
                {
                    Utility::checkFileExistsnDelete([$company->companydetail->image]);
                }
                $company->delete();
                CompanyDetail::where('company_id',$company->id)->delete();
                return redirect()->route('companies.index')->with('success', __('Company Successfully Deleted.'));
            }
            else
            {
                return redirect()->back()->with('errors', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function save_contact_group(Request $request, $id)
    {
        $companydetail = CompanyDetail::where('company_id',$id)->first();
        $contactgroup = implode(",", (array) $request->contact_group);
        $companydetail->assign_group = $contactgroup;
        $companydetail->save();
        return redirect()->back()->with('success', __('Contact Group Successfully Updated.'));
    }

    public function add_contact(Request $request, $id)
    {
        ContactCompany::create([
            'contact_id' => $request->contact,
            'company_id' => $id,
            'created_by' => \Auth::user()->creatorId()
        ]);
        return redirect()->back()->with('success', __('Contact Added Successfully.'));
    }

    public function updateProfile(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), [
                                'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
                            ]
        );
        if($validator->fails())
        {
            return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
        }
        $companydetail = CompanyDetail::where('company_id',$request->id)->first();
        if($request->hasFile('image'))
        {
            Utility::checkFileExistsnDelete([$companydetail->image]);
            $imageName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('company', $imageName);
            $companydetail->image = 'company/' . $imageName;
        }
        $companydetail->save();
        return redirect()->back()->with('success', __('Image Successfully Updated.'));
    }
}
