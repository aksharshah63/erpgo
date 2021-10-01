<?php

namespace App\Http\Controllers;

use App\User;
use App\Utility;
use App\PerformanceGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanceGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(\Auth::user()->can('View Employee'))
        {
            $userList      = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $userList->prepend(__('Please Select'),0);
            return view('hr.employee.performance_goal.create',compact('id','userList'));
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
        if(\Auth::user()->can('View Employee'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'set_date' => 'required',
                                   'completion_date' => 'required'
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $performancegoal = new PerformanceGoal();
            $performancegoal->set_date = date("Y-m-d H:i:s", strtotime($request->set_date));
            $performancegoal->completion_date = date("Y-m-d H:i:s", strtotime($request->completion_date));
            $performancegoal->supervisor = $request->supervisor;
            $performancegoal->goal_description  = $request->goal_description;
            $performancegoal->employee_assessment  = $request->employee_assessment;
            $performancegoal->supervisor_assessment  = $request->supervisor_assessment;
            $performancegoal->user_id = $request->id;
            $performancegoal->created_by = \Auth::user()->creatorId();
            $performancegoal->save();
            return redirect()->back()->with('success', __('Performance Goal Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PerformanceGoal  $performanceGoal
     * @return \Illuminate\Http\Response
     */
    public function show(PerformanceGoal $performanceGoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerformanceGoal  $performanceGoal
     * @return \Illuminate\Http\Response
     */
    public function edit(PerformanceGoal $performanceGoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerformanceGoal  $performanceGoal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PerformanceGoal $performanceGoal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PerformanceGoal  $performanceGoal
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerformanceGoal $performanceGoal)
    {
        if(\Auth::user()->can('View Employee'))
        {
            if($performanceGoal->created_by == \Auth::user()->creatorId())
            {
                $performanceGoal->delete();
                return redirect()->back()->with('success', __('Performance Goal Successfully Deleted.'));
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
}
