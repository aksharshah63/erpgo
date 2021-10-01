<?php

namespace App\Http\Controllers;

use App\User;
use App\Employee;
use Carbon\Carbon;
use App\Department;
use App\ManageLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalenderLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = '')
    {
        if(\Auth::user()->can('View HR Leave Calender'))
        {
            $departmentList = Department::where('created_by',\Auth::user()->creatorId())->get()->pluck('title','id');
            $departmentList->prepend(__('Please Select Department'),0);
            if(empty($id) && $id==0){
                $users = User::join('leave_requests','leave_requests.user_id','=','users.id')
                                    // ->join('policies','policies.id','=','leave_requests.leave_type')
                                    ->where('users.created_by',\Auth::user()->creatorId())
                                    ->whereIn('leave_requests.status',['Approve','Pending','Reject'])
                                    ->select('users.id','users.name','leave_requests.from','leave_requests.to','leave_requests.status')
                                    ->get();
                $arrschedules = [];
                foreach($users as $user){
                    $arschedules = [];
                    if((!empty($user->from) && $user->from != '0000-00-00') && (!empty($user->to) && $user->to != '0000-00-00'))
                    {
                        $arschedules['id']    = $user->id;
                        $arschedules['title'] = $user->name;
                        $arschedules['start'] = $user->from;
                        $arschedules['end'] = date('Y-m-d H:i:s', strtotime($user->to . ' +1 day'));
                        if($user->status=='Pending'){
                            $arschedules['color'] = '#0ddaff';
                        }
                        elseif($user->status=='Approve')
                        {
                            $arschedules['color'] = '#51cb97';
                        }
                        else
                        {
                            $arschedules['color'] = '#fc2e00';
                        }
                        
                        $arschedules['allDay']      = !0;
                        $arschedules['url']         = url('users/'.$user->id);
                    $arrschedules[] = $arschedules;
                    }
                }
            }

            else{
                $users = User::join('leave_requests','leave_requests.user_id','=','users.id')
                            ->join('user_details','user_details.user_id','=','users.id')
                            ->where('users.created_by',\Auth::user()->creatorId())
                            ->where('user_details.department',$id)
                            ->whereIn('leave_requests.status',['Approve','Pending','Reject'])
                            ->select('users.id','users.name','leave_requests.from','leave_requests.to','leave_requests.status')
                            ->get();
                            $arrschedules = [];
                foreach($users as $user){
                    $arschedules = [];
                    if((!empty($user->from) && $user->from != '0000-00-00') && (!empty($user->to) && $user->to != '0000-00-00'))
                    {
                        $arschedules['id']    = $user->id;
                        $arschedules['title'] = $user->name;
                        $arschedules['start'] = $user->from;
                        $arschedules['end'] = date('Y-m-d H:i:s', strtotime($user->to . ' +1 day'));
                        if($user->status=='Pending'){
                            $arschedules['color'] = '#0ddaff';
                        }
                        elseif($user->status=='Approve')
                        {
                            $arschedules['color'] = '#51cb97';
                        }
                        else
                        {
                            $arschedules['color'] = '#fc2e00';
                        }
                        $arschedules['allDay']      = !0;
                        $arschedules['url']         = url('users/'.$user->id);
                    $arrschedules[] = $arschedules;
                    }
                }
            }
            
            return view('hr.leave_management.calender.index',compact('arrschedules','departmentList','id'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
