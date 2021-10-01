<?php

namespace App\Http\Controllers;

use App\Tag;
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
use App\ContactDetail;
use App\ContactCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Contacts'))
        {
            $contacts = Contact::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('crm.contacts.index',compact('contacts'));
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
        if(\Auth::user()->can('Create Contact'))
        {
            $users=User::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name','id')->toArray();
            return view('crm.contacts.create',compact('users'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Contact'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'email' => 'required|unique:contacts',
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
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->created_by = \Auth::user()->creatorId();
            $contact->save();
    
            $contactdetail = new ContactDetail();
            $contactdetail->contact_id = $contact->id;
            $contactdetail->phone_no = $request->phone_no; 
            $contactdetail->life_stage = $request->life_stage;
            $contactdetail->contact_owner = $request->contact_owner;
            if($request->dob != null)
            {
                $contactdetail->date_of_birth = date("Y-m-d H:i:s", strtotime($request->dob)); 
            }
            $contactdetail->age = $request->age; 
            $contactdetail->mobile_no = $request->mobile;
            $contactdetail->website = $request->website; 
            $contactdetail->fax_no = $request->fax_number;     
            $contactdetail->address1 = $request->address1; 
            $contactdetail->address2 = $request->address2;  
            $contactdetail->city = $request->city;
            $contactdetail->country = $request->country;  
            $contactdetail->state = $request->province_state; 
            $contactdetail->zip_code = $request->post_code; 
            $contactdetail->assign_group = $assigngroup;
            $contactdetail->contact_source = $request->contact_source;
            $contactdetail->others = $request->others;
            $contactdetail->notes = $request->notes;
            $contactdetail->facebook = $request->facebook;
            $contactdetail->twitter = $request->twitter;
            $contactdetail->google_plus = $request->google_plus;
            $contactdetail->linkedin = $request->linkedin;
            $contactdetail->save();
    
            return redirect()->route('contacts.index')->with('success', __('Contact Add Successfully'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Contact $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        if(\Auth::user()->can('View Contact'))
        {
            $company_ids = ContactCompany::where('created_by', '=', \Auth::user()->creatorId())->where('contact_id','=',$contact->id)->get()->pluck('company_id')->toArray();
            $companies = Company::where('created_by', '=', \Auth::user()->creatorId())->whereNotIn('id',$company_ids)->pluck('name','id');
            $companies->prepend(__('Please Select'),0);
            $emails = Email::where('created_by', '=', \Auth::user()->creatorId())->where('module_type','LIKE','contact')->get();
            $logactivities = LogActivity::where('created_by', '=', \Auth::user()->creatorId())->where('module_type','LIKE','contact')->get();
            $notes = Note::where('created_by', '=', \Auth::user()->creatorId())->where('module_type','LIKE','contact')->get();
            $schesules = Schedule::where('created_by', '=', \Auth::user()->creatorId())->where('module_type','LIKE','contact')->get();
            $tasks = Task::where('created_by', '=', \Auth::user()->creatorId())->where('module_type','LIKE','contact')->get();
            return view('crm.contacts.view', compact('contact','companies','emails','logactivities','notes','schesules','tasks'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Contact $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        if(\Auth::user()->can('Edit Contact'))
        {
            if($contact->created_by==\Auth::user()->creatorId())
            {
                $users = User::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name','id')->toArray();
                return view('crm.contacts.edit', compact('contact','users'));
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Contact $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        if(\Auth::user()->can('Edit Contact'))
        {
            if($contact->created_by==\Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'name' => 'required',
                                    'email' => 'required|unique:contacts,email,'.$contact->id.'',
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
                $contact = Contact::find($contact->id);
                $contact->name = $request->name;
                $contact->email = $request->email;
                $contact->save();
                $contactdetail = ContactDetail::where('contact_id',$contact->id)->first();
                $contactdetail->contact_id = $contact->id;
                $contactdetail->phone_no = $request->phone_no; 
                $contactdetail->life_stage = $request->life_stage;
                $contactdetail->contact_owner = $request->contact_owner;
                if($request->dob != null)
                {
                    $contactdetail->date_of_birth = date("Y-m-d H:i:s", strtotime($request->dob)); 
                }
                $contactdetail->age = $request->age; 
                $contactdetail->mobile_no = $request->mobile;
                $contactdetail->website = $request->website; 
                $contactdetail->fax_no = $request->fax_number;     
                $contactdetail->address1 = $request->address1; 
                $contactdetail->address2 = $request->address2;  
                $contactdetail->city = $request->city;
                $contactdetail->country = $request->country;  
                $contactdetail->state = $request->province_state; 
                $contactdetail->zip_code = $request->post_code; 
                $contactdetail->assign_group = $assigngroup;
                $contactdetail->contact_source = $request->contact_source;
                $contactdetail->others = $request->others;
                $contactdetail->notes = $request->notes;
                $contactdetail->facebook = $request->facebook;
                $contactdetail->twitter = $request->twitter;
                $contactdetail->google_plus = $request->google_plus;
                $contactdetail->linkedin = $request->linkedin;
                $contactdetail->save();
                return redirect()->route('contacts.index')->with('success', __('Contact Successfully Updated.'));
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
     * @param \App\Contact $contact
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        if(\Auth::user()->can('Delete Contact'))
        {
            if($contact->created_by==\Auth::user()->creatorId())
            {
                if(!empty($contact->contactdetail->image))
                {
                    Utility::checkFileExistsnDelete([$contact->contactdetail->image]);
                }
                $contact->delete();
                ContactDetail::where('contact_id',$contact->id)->delete();
                    
                return redirect()->route('contacts.index')->with('success', __('Contact Successfully Deleted.'));
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
        $contactdetail = ContactDetail::where('contact_id',$id)->first();
        $contactgroup = implode(",", (array) $request->contact_group);
        $contactdetail->assign_group = $contactgroup;
        $contactdetail->save();
        return redirect()->back()->with('success', __('Contact Group Successfully Updated.'));
    }

    public function add_company(Request $request, $id)
    {
        ContactCompany::create([
            'contact_id' => $id,
            'company_id' => $request->company,
            'created_by' => \Auth::user()->creatorId()
        ]);
        return redirect()->back()->with('success', __('Company Added Successfully.'));
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
        $contactdetail = ContactDetail::where('contact_id',$request->id)->first();
        if($request->hasFile('image'))
        {
            Utility::checkFileExistsnDelete([$contactdetail->image]);
            $imageName = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('contacts', $imageName);
            $contactdetail->image='contacts/' . $imageName;
        }
        $contactdetail->save();
        return redirect()->back()->with('success', __('Image Successfully Updated.'));
    }

    public function addtag(Request $request)
    {
        Tag::updateOrCreate(
            ['module_type' => $request->type, 'module_id' => $request->id, 'created_by' => \Auth::user()->creatorId()],
            ['text' => $request->tag]
        );
        
        return redirect()->back()->with('success', __('Tag Successfully Added.'));
    }
}
