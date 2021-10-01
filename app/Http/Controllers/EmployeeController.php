<?php

namespace App\Http\Controllers;

use App\Note;
use App\User;
use App\Policy;
use App\Holiday;
use App\Utility;
use App\Employee;
use App\Department;
use App\Designation;
use App\Announcement;
use App\LeaveRequest;
use App\EmployeeDetail;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('hr.employee.index');
        } catch (\Exception $e) {
           return response()->json(['errors' => __('Permission Denied')],401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $user = Auth::user();
            $employeeList = Auth::user()->employees;

            $employeeList = $employeeList->map(function($employee) {
                $employee['full_name'] = $employee['first_name'] . ' ' .$employee['last_name'];
                return $employee;
            })->pluck('full_name','id');
            $employeeList->prepend(__('Please Select'),0);
            $departments = Auth::user()->departments->pluck('title','id');
            $departments->prepend(__('Please Select'),0);
            $designations = Auth::user()->designations->pluck('title','id');
            $designations->prepend(__('Please Select'),0);
            $roles        = Role::where('created_by', '=', $user->creatorId())->get();
            return view('hr.employee.create',compact('departments','designations','employeeList','roles'));
        } catch (\Exception $e) {
           return response()->json(['errors' => __('Permission Denied')],401);
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
        try {
            $validator = \Validator::make(
                $request->all(), [
                                   'first_name' => 'required',
                                   'last_name' => 'required',
                                   'email' => 'required|unique:employees',
                                   'employee_type' => 'required|not_in:0',
                                   'employee_status' => 'required|not_in:0',
                                   'date_of_hire' => 'required',
                                   'role' => 'required|not_in:0',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
    
            $id = Auth::id();
            $employee = new Employee();
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->employee_id = $this->employeeNumber();
            $employee->email = $request->email;
            $employee->employee_type = $request->employee_type;
            $employee->employee_status = $request->employee_status;
            if($request->date_of_hire != null)
            {
                $employee->date_of_hire = date("Y-m-d H:i:s", strtotime($request->date_of_hire)); 
            }
            $employee->created_by = $id;
            $role = Role::findById($request->role);
            
            $employee->save();
            $employee->assignRole($role);
         
            $employeedetail = new EmployeeDetail();
            $employeedetail->employee_id = $employee->id;
            $employeedetail->department = $request->department; 
            $employeedetail->designation = $request->designation;
            $employeedetail->location = $request->location;
            $employeedetail->reporting_to = $request->reporting_to; 
            $employeedetail->source_of_hire = $request->source_of_hire;
            $employeedetail->pay_rate = $request->pay_rate; 
            $employeedetail->pay_type = $request->pay_type;     
            $employeedetail->father_name = $request->father_name; 
            $employeedetail->mother_name = $request->mother_name;  
            $employeedetail->mobile = $request->mobile;
            $employeedetail->phone = $request->phone;
            if($request->date_of_birth != null)
            {
                $employeedetail->date_of_birth = date("Y-m-d H:i:s", strtotime($request->date_of_birth)); 
            }  
            $employeedetail->nationality = $request->nationality; 
            $employeedetail->gender = $request->gender; 
            $employeedetail->marital_status = $request->marital_status;
            $employeedetail->hobbies = $request->hobbies;
            $employeedetail->website = $request->website;
            $employeedetail->address1 = $request->address1;
            $employeedetail->address2 = $request->address2;
            $employeedetail->city = $request->city;
            $employeedetail->country = $request->country;
            $employeedetail->state = $request->state;
            $employeedetail->zip_code = $request->zip_code;
            $employeedetail->biography = $request->biography;
            $employeedetail->save();
    
            return redirect()->route('employees.index')->with('success', __('Employee Add Successfully!'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('errors', __('Permission Denied.'),401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        try {
            $policies = Policy::whereIn('id',explode(",",$employee->employeedetail->policy_id))->get();
            $getleavehistories = LeaveRequest::where('employee_id','=',$employee->id)->where('status','LIKE','Approve')->get();
            return view('hr.employee.view',compact('employee','getleavehistories','policies'));
        } catch (\Exception $e) {
           return response()->json(['errors' => __('Permission Denied')],401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        try {
            $departments = Auth::user()->departments->pluck('title','id');
            $departments->prepend(__('Please Select'),0);
            $designations = Auth::user()->designations->pluck('title','id');
            $designations->prepend(__('Please Select'),0);
            $employeeList = Auth::user()->employees;

            $employeeList = $employeeList->map(function($employee) {
                $employee['full_name'] = $employee['first_name'] . ' ' .$employee['last_name'];
                return $employee;
            })->pluck('full_name','id');
            $employeeList->prepend(__('Please Select'),0);
            return view('hr.employee.edit',compact('departments','designations','employee','employeeList'));
        } catch (\Exception $e) {
           return response()->json(['errors' => __('Permission Denied')],401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        try {
            $validator = \Validator::make(
                $request->all(), [
                                   'first_name' => 'required',
                                   'last_name' => 'required',
                                   'email' => 'required|unique:employees,email,'.$employee->id.'',
                                   'employee_type' => 'required|not_in:0',
                                   'employee_status' => 'required|not_in:0',
                                   'date_of_hire' => 'required'
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $id = Auth::id();
            $employee = Employee::find($employee->id);
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->employee_type = $request->employee_type;
            $employee->employee_status = $request->employee_status;
            if($request->date_of_hire != null)
            {
                $employee->date_of_hire = date("Y-m-d H:i:s", strtotime($request->date_of_hire)); 
            }
            $employee->created_by = $id;
            $employee->save();

            $employeedetail = EmployeeDetail::where('employee_id',$employee->id)->first();

            if($employeedetail->department != $request->department){
                $employeedetail->policy_id = null;
            }

            $employeedetail->employee_id = $employee->id;
            $employeedetail->department = $request->department; 
            $employeedetail->designation = $request->designation;
            $employeedetail->location = $request->location;
            $employeedetail->reporting_to = $request->reporting_to; 
            $employeedetail->source_of_hire = $request->source_of_hire;
            $employeedetail->pay_rate = $request->pay_rate; 
            $employeedetail->pay_type = $request->pay_type;     
            $employeedetail->father_name = $request->father_name; 
            $employeedetail->mother_name = $request->mother_name;  
            $employeedetail->mobile = $request->mobile;
            $employeedetail->phone = $request->phone;
            if($request->date_of_birth != null)
            {
                $employeedetail->date_of_birth = date("Y-m-d H:i:s", strtotime($request->date_of_birth)); 
            }  
            $employeedetail->nationality = $request->nationality; 
            $employeedetail->gender = $request->gender; 
            $employeedetail->marital_status = $request->marital_status;
            $employeedetail->hobbies = $request->hobbies;
            $employeedetail->website = $request->website;
            $employeedetail->address1 = $request->address1;
            $employeedetail->address2 = $request->address2;
            $employeedetail->city = $request->city;
            $employeedetail->country = $request->country;
            $employeedetail->state = $request->state;
            $employeedetail->zip_code = $request->zip_code;
            $employeedetail->biography = $request->biography;
            $employeedetail->save();

            return redirect()->route('employees.index')->with('success', __('Employee Successfully Updated.'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', __('Permission Denied.'),401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            EmployeeDetail::where('employee_id',$employee->id)->delete();
            return redirect()->route('employees.index')->with('success', __('Employee Successfully Deleted.'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', __('Permission Denied.'),401);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $validator = \Validator::make(
                $request->all(), [
                                    'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $employeedetail = EmployeeDetail::where('employee_id',$request->id)->first();
            if($request->hasFile('image'))
            {
                Utility::checkFileExistsnDelete([$employeedetail->image]);
                $imageName = time() . '.' . $request->image->extension();
                $employeedetail->image      = $request->file('image')->storeAs('employees', $imageName);
            }
            $employeedetail->save();
            return redirect()->back()->with('success', __('Image Successfully Updated.'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', __('Permission Denied.'),401);
        }
    }

    public function dashboard()
    {
        try {
            $userlist =User::where('created_by', \Auth::user()->creatorId())->get()->count();
            $departmentlist = Department::where('created_by', \Auth::user()->creatorId())->get()->count();
            $designationlist = Designation::where('created_by', \Auth::user()->creatorId())->get()->count();
            $announcements = Announcement::where('created_by', \Auth::user()->creatorId())->orderBy('title', 'desc')->take(5)->get();

            $holidays = Holiday::where('created_by', \Auth::user()->creatorId())->get();
            if(count($holidays) > 0)
            {
                foreach($holidays as $holiday){
                    $arschedules = [];
                    if((!empty($holiday->start_date) && $holiday->start_date != '0000-00-00') || (!empty($holiday->end_date) && $holiday->end_date != '0000-00-00'))
                    {
                        $arschedules['id']    = $holiday->id;
                        $arschedules['title'] = $holiday->holiday_name;
                        $arschedules['start'] = $holiday->start_date;
                        $arschedules['end'] = date('Y-m-d H:i:s', strtotime($holiday->end_date . ' +1 day'));
                        $arschedules['color'] = '#FF5354';
                        $arschedules['allDay']      = !0;
                        //$arschedules['url']         = url('employees/'.$employee->id);
                    $arrschedules[] = $arschedules;
                    }
                }
                return view('hr.dashboard',compact('userlist','departmentlist','designationlist','announcements','arrschedules'));
            }
            else
            {
                $arrschedules='';
            }
            return view('hr.dashboard',compact('userlist','departmentlist','designationlist','announcements','arrschedules'));
        } catch (\Exception $e) {
           return response()->json(['errors' => __('Permission Denied')],401);
        }
    }

    function employeeNumber()
    {
        $latest = Employee::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->employee_id + 1;
    }

    public function create_policy($id,$dept_id)
    {
        $policies = Policy::where('created_by',Auth::user()->id)->where('department',$dept_id)->pluck('policy_name','id')->toArray();
        return view('hr.employee.policy.create',compact('policies','id'));
    }

    public function store_policy(Request $request)
    {
        $employeedetail = EmployeeDetail::where('employee_id',$request->id)->first();
        $employeedetail->policy_id = implode(',', $request->policy);
        $employeedetail->save();
        return redirect()->back()->with('success', __('Policy Add Successfully.'));
    }

    public function remove_policy($id,$emp_id)
    {
        $policies  = EmployeeDetail::where('employee_id',$emp_id)->first();
        $policies_array = explode(",",$policies->policy_id);
        if (($key = array_search($id, $policies_array)) !== false) {
            unset($policies_array[$key]);
        }
        $policies->policy_id = implode(',',$policies_array);
        $policies->save();

        return redirect()->back()->with('success', __('Policy Delete Successfully.'));
    }

    public function view_policy($id)
    {
        $policy = Policy::where('id',$id)->first();
        return view('hr.employee.policy.view',compact('policy'));
    }
}
