<?php

namespace App\Http\Controllers;

use App\User;
use DateTime;
use App\Policy;
use App\Utility;
use App\Employee;
use App\Department;
use App\UserDetail;
use App\LeaveRequest;
use App\EmployeeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrReportController extends Controller
{
    public function hr_gender_profile()
    {
        if(\Auth::user()->can('View HR Gender Profile Report'))
        {
            $user = \DB::table('user_details')
                ->select(\DB::raw('count(*) as total, gender'))
                ->groupBy('gender')
                ->get()->pluck('total','gender')->toArray();

            $male = UserDetail::where('gender','male')->count();
            $female = UserDetail::where('gender','female')->count();
            $other = UserDetail::where('gender','other')->count();
            $tot = $male+$female+$other;

            $gender=[
                'male' => $male,
                'female' => $female,
                'other' => $other,
                'total' => $tot
            ];

            $departments= \DB::table('user_details')
                    ->join('departments','departments.id','=','user_details.department')
                    ->SELECT('departments.title',\DB::raw("COUNT(CASE WHEN Gender='male' THEN 1  END) As Male"),
                                        \DB::raw("COUNT(CASE WHEN Gender='female' THEN 1  END) As Female"),
                                        \DB::raw("COUNT(CASE WHEN Gender='other' THEN 1  END) As Other"),
                                        \DB::raw("COUNT(*) as Total"))
                                        ->groupBy('department')
                                        ->get();
                                        
            return view('hr.reports.gender_profile',compact('user','gender','departments'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function hr_head_count()
    {
        if(\Auth::user()->can('View HR Head Count Report'))
        {
            $months=[];
            $userList      = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('created_by')->toArray();
            for ($m=1; $m<=12; $m++) {
                $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
                $months[] = $month;
            }
                $arrResponse = [];
                $arrMonth = [];
                for ($m=1; $m<=12; $m++) {
                    $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
                        $userdetail = User::whereIn('created_by',$userList)
                        ->whereMonth('date_of_hire', $m)
                        ->whereYear('date_of_hire', date('Y'))->count();
            
                        $arrMonth[] = $userdetail;
                }
                $arrResponse[] = [
                    'label' => 'Headcount by Month',
                    'backgroundColor' => Utility::random_color_part(),
                    'data'=> $arrMonth,
                ];

                $userdetails = User::whereIn('created_by',$userList)
                        ->whereMonth('date_of_hire',  date('m'))
                        ->whereYear('date_of_hire', date('Y'))->get();

            return view('hr.reports.head_count',compact('arrResponse','months','userdetails'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function hr_age_profile()
    {
        if(\Auth::user()->can('View HR Age Profile Report'))
        {
            $arrResponse=[];
            $departmentLists = Department::where('created_by',\Auth::user()->creatorId())->orderBy('id','desc')->get();
            foreach($departmentLists as $departmentList)
            {
                $arrAge['Under 18 year']=0;
                $arrAge['18 to 25 year']=0;
                $arrAge['26 to 35 year']=0;
                $arrAge['36 to 45 year']=0;
                $arrAge['46 to 55 year']=0;
                $arrAge['56 to 65 year']=0;
                $arrAge['65+ year']=0;

                $userLists = $departmentList->user_details;
                foreach($userLists as $userList)
                {
                    $dob = $userList->date_of_birth;
                    $from = new DateTime($dob);
                    $to   = new DateTime('today');
                    $age =  $from->diff($to)->y;
                    if($age < 18)
                    {
                        $arrAge['Under 18 year'] = $arrAge['Under 18 year'] + 1;
                    }
                    elseif($age>=18 && $age<=25)
                    {
                        $arrAge['18 to 25 year'] = $arrAge['18 to 25 year'] + 1;
                    }
                    elseif($age>=26 && $age<=35)
                    {
                        $arrAge['26 to 35 year'] = $arrAge['26 to 35 year'] + 1;
                    }
                    elseif($age>=36 && $age<=45)
                    {
                        $arrAge['36 to 45 year'] = $arrAge['36 to 45 year'] + 1;
                    }
                    elseif($age>=46 && $age<=55)
                    {
                        $arrAge['46 to 55 year'] = $arrAge['46 to 55 year'] + 1;
                    }
                    elseif($age>=56 && $age<=65)
                    {
                        $arrAge['56 to 65 year'] = $arrAge['56 to 65 year'] + 1;
                    }
                    else
                    {
                        $arrAge['65+ year'] = $arrAge['65+ year'] + 1;
                    }
                }

                $arrResponse[$departmentList->title] = $arrAge;
            }

            $arrChart = [];
            $arrChart['labels'] = array_keys($arrResponse);
            $arrChart['data'] = [];

            foreach($arrResponse as $v)
            {
                foreach($v as $ageName => $ageVal)
                {
                    $arr = [];
                    $arr['label'] = $ageName;
                    $arr['backgroundColor'] = Utility::random_color_part();
                    $arr['data'] = array_column($arrResponse,$ageName);

                    $arrChart['data'][] = $arr;
                }
                break;
            }
            return view('hr.reports.age_profile',compact('arrChart','arrResponse'));  
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function hr_leave_report(Request $request)
    {
        if(\Auth::user()->can('View HR Leave Report'))
        {   
            $leaves        = [];
            $totalApproved = $totalReject = $totalPending = 0;
            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
            $department->prepend('All', '');
            $filterYear['department']    = __('All');
            $filterYear['type']          = __('Monthly');
            $filterYear['dateYearRange'] = date('M-Y');
            $users                   = User::where('created_by', \Auth::user()->creatorId())->get();

            if(!empty($request->department))
            {
                $dept = Department::find($request->department);
                $users=$dept->user_details;
                $filterYear['department'] = $dept->title;
            }
            else
            {
                $dept = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id')->toArray();
                $users = UserDetail::whereIn('department',array_keys($dept))->get();
                $filterYear['department'] = '';
            }
            foreach($users as $user)
            {
                    $empData = $user->user;
                    $employeeLeave     =[];
                    $employeeLeave['id']          = $empData->id;
                    $employeeLeave['user_id'] = $empData->user_id;
                    $employeeLeave['user']    = $empData->name;
                    $approved = LeaveRequest::where('created_by', \Auth::user()->creatorId())->where('user_id', $empData->id)->where('status', 'Approve');
                    $reject   = LeaveRequest::where('created_by', \Auth::user()->creatorId())->where('user_id', $empData->id)->where('status', 'Reject');
                    $pending  = LeaveRequest::where('created_by', \Auth::user()->creatorId())->where('user_id', $empData->id)->where('status', 'Pending');
                    if($request->type == 'monthly' && !empty($request->month))
                    {
                        $month = date('m', strtotime($request->month));
                        $year  = date('Y', strtotime($request->month));
                        $approved->whereMonth('from', $month)->whereYear('from', $year);
                        $reject->whereMonth('from', $month)->whereYear('from', $year);
                        $pending->whereMonth('from', $month)->whereYear('from', $year);
                        $filterYear['dateYearRange'] = date('M-Y', strtotime($request->month));
                        $filterYear['type']          = __('Monthly');
                    }
                    elseif(!isset($request->type))
                    {
                        $month     = date('m');
                        $year      = date('Y');
                        $monthYear = date('Y-m');
                        $approved->whereMonth('from', $month)->whereYear('from', $year);
                        $reject->whereMonth('from', $month)->whereYear('from', $year);
                        $pending->whereMonth('from', $month)->whereYear('from', $year);
                        $filterYear['dateYearRange'] = date('M-Y', strtotime($monthYear));
                        $filterYear['type']          = __('Monthly');
                    }
                    if($request->type == 'yearly' && !empty($request->year))
                    {
                        $approved->whereYear('from', $request->year);
                        $reject->whereYear('from', $request->year);
                        $pending->whereYear('from', $request->year);
                        $filterYear['dateYearRange'] = $request->year;
                        $filterYear['type']          = __('Yearly');
                    }
                    $approved = $approved->count();
                    $reject   = $reject->count();
                    $pending  = $pending->count();
                    $totalApproved += $approved;
                    $totalReject   += $reject;
                    $totalPending  += $pending;
                    $employeeLeave['approved'] = $approved;
                    $employeeLeave['reject']   = $reject;
                    $employeeLeave['pending']  = $pending;
                    $leaves[] = $employeeLeave;
            }
            $starting_year = date('Y', strtotime('-5 year'));
            $ending_year   = date('Y', strtotime('+5 year'));
            $filterYear['starting_year'] = $starting_year;
            $filterYear['ending_year']   = $ending_year;
            $filter['totalApproved'] = $totalApproved;
            $filter['totalReject']   = $totalReject;
            $filter['totalPending']  = $totalPending;

            return view('hr.reports.leave_report', compact('department', 'leaves', 'filterYear', 'filter'));        
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function userLeave(Request $request, $user_id, $status, $type, $month, $year)
    {
        $leaveTypes = Policy::where('created_by', \Auth::user()->creatorId())->get();
        $leaves     = [];
        foreach($leaveTypes as $leaveType)
        {
            $leave        = new LeaveRequest();
            $leave->title = $leaveType->policy_name;
            $totalLeave   = LeaveRequest::where('created_by', \Auth::user()->creatorId())->where('user_id', $user_id)->where('status', $status);
            if($type == 'yearly')
            {
                $totalLeave->whereYear('from', $year);
            }
            else
            {
                $m = date('m', strtotime($month));
                $y = date('Y', strtotime($month));
                $totalLeave->whereMonth('from', $m)->whereYear('from', $y);
            }
            $totalLeave = $totalLeave->count();
            $leave->total = $totalLeave;
            $leaves[]     = $leave;
        }
        $leaveData = LeaveRequest::where('created_by', \Auth::user()->creatorId())->where('user_id', $user_id)->where('status', $status);
        if($type == 'yearly')
        {
            $leaveData->whereYear('from', $year);
        }
        else
        {
            $m = date('m', strtotime($month));
            $y = date('Y', strtotime($month));
            $leaveData->whereMonth('from', $m)->whereYear('from', $y);
        }
        $leaveData = $leaveData->get();
        return view('hr.reports.show_leave', compact('leaves', 'leaveData'));
    }
   
}
