<?php

namespace App\Http\Controllers;

use App\Note;
use App\User;
use App\Policy;
use App\Utility;
use App\Education;
use App\Department;
use App\UserDetail;
use App\Designation;
use App\LeaveRequest;
use App\WorkExperience;
use App\PerformanceGoal;
use App\PerformanceReview;
use App\PerformanceComment;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Employees'))
        {
            $users = User::where('created_by',\Auth::user()->creatorId())->get();
            return view('hr.employee.index',compact('users'));
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
        if(\Auth::user()->can('Create Employee'))
        {
            $userList      = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $userList->prepend(__('Please Select'),0);
            $departments = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
            $departments->prepend(__('Please Select'),0);
            $designations = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
            $designations->prepend(__('Please Select'),0);
            $roles        = Role::where('created_by', '=',  \Auth::user()->creatorId())->get();
            return view('hr.employee.create',compact('departments','designations','userList','roles'));
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
        if(\Auth::user()->can('Create Employee'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'email' => 'required|unique:users',
                                   'password' => 'required',
                                   'user_type' => 'required|not_in:0',
                                   'user_status' => 'required|not_in:0',
                                   'date_of_hire' => 'required',
                                   'role' => 'required|not_in:0',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
    
            $id = Auth::id();
            $role = Role::findById($request->role);

            $user = new User();
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->user_id = $this->userNumber();
            $user->email = $request->email;
            $user->user_type = $request->user_type;
            $user->user_status = $request->user_status;
            $user->type = $role->name;
            if($request->date_of_hire != null)
            {
                $user->date_of_hire = date("Y-m-d H:i:s", strtotime($request->date_of_hire)); 
            }
            $user->created_by = \Auth::user()->creatorId();
            $user->save();

            $user->assignRole($role);
         
            $userdetail = new UserDetail();
            $userdetail->user_id = $user->id;
            $userdetail->department = $request->department; 
            $userdetail->designation = $request->designation;
            $userdetail->location = $request->location;
            $userdetail->reporting_to = $request->reporting_to; 
            $userdetail->source_of_hire = $request->source_of_hire;
            $userdetail->pay_rate = $request->pay_rate; 
            $userdetail->pay_type = $request->pay_type;     
            $userdetail->father_name = $request->father_name; 
            $userdetail->mother_name = $request->mother_name;  
            $userdetail->mobile = $request->mobile;
            $userdetail->phone = $request->phone;
            if($request->date_of_birth != null)
            {
                $userdetail->date_of_birth = date("Y-m-d H:i:s", strtotime($request->date_of_birth)); 
            }  
            $userdetail->nationality = $request->nationality; 
            $userdetail->gender = $request->gender; 
            $userdetail->marital_status = $request->marital_status;
            $userdetail->hobbies = $request->hobbies;
            $userdetail->website = $request->website;
            $userdetail->address1 = $request->address1;
            $userdetail->address2 = $request->address2;
            $userdetail->city = $request->city;
            $userdetail->country = $request->country;
            $userdetail->state = $request->state;
            $userdetail->zip_code = $request->zip_code;
            $userdetail->biography = $request->biography;
            $userdetail->save();
    
            return redirect()->route('users.index')->with('success', __('User Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(\Auth::user()->can('View Employee'))
        {
            $policies = Policy::where('created_by', '=',  \Auth::user()->creatorId())->whereIn('id',explode(",",$user->userdetail->policy_id))->get();
            $getleavehistories = LeaveRequest::where('created_by', '=',  \Auth::user()->creatorId())->where('user_id','=',$user->id)->where('status','LIKE','Approve')->get();
            $educations = Education::where('created_by', '=', \Auth::user()->creatorId())->get();
            $notes = Note::where('created_by', '=', \Auth::user()->creatorId())->where('module_type','LIKE','user')->get();
            $performance_comments = PerformanceComment::where('created_by', '=', \Auth::user()->creatorId())->get();
            $performance_goals = PerformanceGoal::where('created_by', '=', \Auth::user()->creatorId())->get();
            $performance_reviews = PerformanceReview::where('created_by', '=', \Auth::user()->creatorId())->get();
            $work_experiences = WorkExperience::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('hr.employee.view',compact('user','getleavehistories','policies','educations','notes','performance_comments','performance_goals','performance_reviews','work_experiences'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(\Auth::user()->can('Edit Employee'))
        {
            $departments = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
            $departments->prepend(__('Please Select'),0);
            $designations = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
            $designations->prepend(__('Please Select'),0);
            $userList      = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $userList->prepend(__('Please Select'),0);
            $user = User::where('id', '=', $user->id)->where('created_by', '=', Auth::user()->creatorId())->first();

            if($user)
            {
                $roles    = Role::where('created_by', '=', $user->creatorId())->get();
                $userRole = $user->roles->first();

                if($userRole)
                {
                    $userRole = $userRole->id;
                }
                else
                {
                    $userRole = '';
                }
                return view('hr.employee.edit',compact('departments','designations','user','userList','roles', 'userRole',));
            }
            else
            {
                return response()->json(['errors' => __('Invalid User.')], 401);
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(\Auth::user()->can('Edit Employee'))
        {
            $user = User::where('id', '=', $user->id)->where('created_by', '=', Auth::user()->creatorId())->first();
            if($user)
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'name' => 'required',
                                    'email' => 'required|unique:users,email,'.$user->id.'',
                                    // 'password' => 'required',
                                    'user_type' => 'required|not_in:0',
                                    'user_status' => 'required|not_in:0',
                                    'date_of_hire' => 'required',
                                    'role' => 'required|not_in:0',
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $role = Role::findById($request->role);
                $id = Auth::id();
                $user = User::find($user->id);
                $user->name = $request->name;
                $user->password = Hash::make($request->password);
                $user->email = $request->email;
                $user->user_type = $request->user_type;
                $user->user_status = $request->user_status;
                $user->type = $role->name;
                if($request->date_of_hire != null)
                {
                    $user->date_of_hire = date("Y-m-d H:i:s", strtotime($request->date_of_hire)); 
                }
                $user->save();
                $roles[] = $request->role;
                $user->roles()->sync($roles);

                $userdetail = UserDetail::where('user_id',$user->id)->first();

                if($userdetail->department != $request->department){
                    $userdetail->policy_id = null;
                }

                $userdetail->user_id = $user->id;
                $userdetail->department = $request->department; 
                $userdetail->designation = $request->designation;
                $userdetail->location = $request->location;
                $userdetail->reporting_to = $request->reporting_to; 
                $userdetail->source_of_hire = $request->source_of_hire;
                $userdetail->pay_rate = $request->pay_rate; 
                $userdetail->pay_type = $request->pay_type;     
                $userdetail->father_name = $request->father_name; 
                $userdetail->mother_name = $request->mother_name;  
                $userdetail->mobile = $request->mobile;
                $userdetail->phone = $request->phone;
                if($request->date_of_birth != null)
                {
                    $userdetail->date_of_birth = date("Y-m-d H:i:s", strtotime($request->date_of_birth)); 
                }  
                $userdetail->nationality = $request->nationality; 
                $userdetail->gender = $request->gender; 
                $userdetail->marital_status = $request->marital_status;
                $userdetail->hobbies = $request->hobbies;
                $userdetail->website = $request->website;
                $userdetail->address1 = $request->address1;
                $userdetail->address2 = $request->address2;
                $userdetail->city = $request->city;
                $userdetail->country = $request->country;
                $userdetail->state = $request->state;
                $userdetail->zip_code = $request->zip_code;
                $userdetail->biography = $request->biography;
                $userdetail->save();

                return redirect()->route('users.index')->with('success', __('User Successfully Updated.'));
            }
            else
            {
                return redirect()->back()->with('errors', __('Invalid User.'));
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(\Auth::user()->can('Delete Employee'))
        {
            if($user->created_by == \Auth::user()->creatorId())
            {
                if(!empty($user->userdetail->image))
                {
                    Utility::checkFileExistsnDelete([$user->userdetail->image]);
                }
                $user->delete();
                UserDetail::where('user_id',$user->id)->delete();
                return redirect()->route('users.index')->with('success', __('User Successfully Deleted.'));
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
            $userdetail = UserDetail::where('user_id',$request->id)->first();
            if($request->hasFile('image'))
            {
                Utility::checkFileExistsnDelete([$userdetail->image]);
                $imageName = time() . '.' . $request->image->extension();
                $request->file('image')->storeAs('users', $imageName);
                $userdetail->image ='users/' . $imageName;
            }
            $userdetail->save();
            return redirect()->back()->with('success', __('Image Successfully Updated.'));
        
    }

    function userNumber()
    {
        $latest = User::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->user_id + 1;
    }

    public function create_policy($id,$dept_id)
    {
        $policies = Policy::where('created_by',\Auth::user()->creatorId())->where('department',$dept_id)->pluck('policy_name','id')->toArray();
        return view('hr.employee.policy.create',compact('policies','id'));
    }

    public function store_policy(Request $request)
    {
        $userdetail = UserDetail::where('user_id',$request->id)->first();
        $userdetail->policy_id = implode(',', $request->policy);
        $userdetail->save();
        return redirect()->back()->with('success', __('Policy Add Successfully.'));
    }

    public function remove_policy($id,$user_id)
    {
        $policies  = UserDetail::where('user_id',$user_id)->first();
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
        $policy = Policy::where('created_by',\Auth::user()->creatorId())->where('id',$id)->first();
        return view('hr.employee.policy.view',compact('policy'));
    }

    public function profile()
    {
        $userDetail              = \Auth::user();
        return view('hr.employee.profile', compact('userDetail'));
    }

    public function editprofile(Request $request)
    {
        $userDetail = \Auth::user();
        $user       = UserDetail::where('user_id',$userDetail['id'])->first();
        $validator = \Validator::make(
            $request->all(), [
                        'name' => 'required|max:120',
                        'email' => 'required|email|unique:users,email,' . $userDetail['id'],
                    ]
        );
        if($validator->fails())
        {
            return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
        }

        if($request->hasFile('profile'))
        {
            if($user->image!='avatar.png')
            {
                Utility::checkFileExistsnDelete([$user->image]);
            }
            
            $imageName = time() . '.' . $request->profile->extension();
            $request->file('profile')->storeAs('users', $imageName);
            $user->image      = 'users/'.$imageName;
        }
        $user->save();
        // if(!empty($request->profile))
        // {
        //     $user->image = $imageName;
        // }
        $userDetail->name    = $request['name'];
        $userDetail->email   = $request['email'];
        $userDetail->save();

        return redirect()->back()->with(
            'success', 'Profile successfully updated.'
        );
    }

    public function updatePassword(Request $request)
    {
        if(Auth::Check())
        {
            $request->validate(
                [
                    'current_password' => 'required',
                    'new_password' => 'required|min:6',
                    'confirm_password' => 'required|same:new_password',
                ]
            );
            $objUser          = Auth::user();
            $request_data     = $request->All();
            $current_password = $objUser->password;
            if(Hash::check($request_data['current_password'], $current_password))
            {
                $user_id            = Auth::User()->id;
                $obj_user           = User::find($user_id);
                $obj_user->password = Hash::make($request_data['new_password']);;
                $obj_user->save();

                return redirect()->back()->with('success', __('Password updated successfully.'));
            }
            else
            {
                return redirect()->back()->with('errors', __('Please enter correct current password.'));
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Something is wrong.'));
        }

    }

}
