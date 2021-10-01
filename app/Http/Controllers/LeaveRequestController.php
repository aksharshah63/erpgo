<?php

namespace App\Http\Controllers;

use App\User;
use App\Policy;
use App\Utility;
use App\Employee;
use App\ManageLeave;
use App\LeaveRequest;
use App\LeaveEntitlement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Leave Requests'))
        {
            $leave_requests = LeaveRequest::where('created_by', '=', \Auth::user()->creatorId())->get();
            $pendingstatues = LeaveRequest::where('created_by', '=', \Auth::user()->creatorId())->where('status','Pending')->get()->count();
            $approvestatues = LeaveRequest::where('created_by', '=', \Auth::user()->creatorId())->where('status','Approve')->get()->count();
            $rejectstatues = LeaveRequest::where('created_by', '=', \Auth::user()->creatorId())->where('status','Reject')->get()->count();
            return view('hr.leave_management.leave_request.index',compact('pendingstatues','approvestatues','rejectstatues','leave_requests'));
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
        if(\Auth::user()->can('Create Leave Request'))
        {
            $userList      = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $userList->prepend(__('Please Select'),0);
            return view('hr.leave_management.leave_request.create',compact('userList'));
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
        if(\Auth::user()->can('Create Leave Request'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'user' => 'required|not_in:0',
                                   'from' => 'required',
                                   'to' => 'required',
                                   'reason' => 'required'
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }

            $from = date("Y-m-d H:i:s", strtotime($request->from)); 
            $to = date("Y-m-d H:i:s", strtotime($request->to)); 
            $datetime1 = new \DateTime($from);
            $datetime2 = new \DateTime($to);
            $interval = $datetime1->diff($datetime2);
            $day = $interval->format('%a')+1;

            $days = $datetime1->diff($datetime2, true)->days;

            $sundays = intval($days / 7) + ($datetime1->format('N') + $days % 7 >= 7);

            $available_days = $day - $sundays;

            $leaverequest = new LeaveRequest();
            $leaverequest->user_id  =$request->user;
            $leaverequest->from = date("Y-m-d H:i:s", strtotime($request->from));
            $leaverequest->to = date("Y-m-d H:i:s", strtotime($request->to));
            $leaverequest->reason = $request->reason;
            $leaverequest->created_by = \Auth::user()->creatorId();
            $leaverequest->status = 'Pending';
            $leaverequest->save();

            return redirect()->back()->with('success', __('Leave Request Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeaveRequest  $leaveRequest
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaveRequest  $leaveRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeaveRequest  $leaveRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaveRequest  $leaveRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveRequest $leaveRequest)
    {
        //
    }

    public function get_employee(Request $request)
    {
        $user = User::find($request->id);
        if(!empty($user))
        {
            $dept_id = $user->userdetail->department;
            $get_policy = Policy::where('created_by', '=', \Auth::user()->creatorId())->where('department',$dept_id)->get();

            if(!empty($dept_id))
            {
                $arrPolicy = [];
                foreach($get_policy as $policy)
                {
                    $days = ManageLeave::where('policy_id',$policy->id)->where('department_id','=',$dept_id)->where('employee_id','=',$employee->id)->first();

                    $arrPolicy[$policy->id] = ['name'=>$policy->policy_name,'days'=>$days->available_days];
                }
            }

            if(empty($arrPolicy))
            {
                return response()->json([
                    'is_success' => false,
                ]);
            }

            return response()->json([
                'is_success' => true,
                'data' => $arrPolicy
            ]);
        }
        else
        {
            return response()->json([
                'is_success' => false,
            ]);
        }
    } 
    
    public function approve_leave(Request $request)
    {
        if(\Auth::user()->can('Edit Leave Request'))
        {
            $getleavetype = LeaveRequest::where('created_by', '=', \Auth::user()->creatorId())->where('user_id',$request->id)->where('status','Pending')->first();
            $available_days = Utility::diffDate($getleavetype->from,$getleavetype->to,true);

            $leaverequest = LeaveRequest::where('created_by', '=', \Auth::user()->creatorId())->where('user_id',$request->id)->where('status','Pending')->first();
            $leaverequest->status = 'Approve';
            $leaverequest->save();
            return response()->json([
                        'is_success' => true,
                        'msg' => __('Leave Approved Successfully.!')
            ]);
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function reject_leave(Request $request)
    {
        if(\Auth::user()->can('Edit Leave Request'))
        {
            $leaverequest = LeaveRequest::where('created_by', '=', \Auth::user()->creatorId())->where('user_id',$request->id)->where('status','Pending')->first();
            $leaverequest->status = 'Reject';
            $leaverequest->save();
            return response()->json([
                        'is_success' => true,
                        'msg' => __('Leave Rejected Successfully.!')
            ]);
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }
}
