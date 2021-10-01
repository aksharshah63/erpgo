<?php

namespace App\Http\Controllers;

use App\Utility;
use App\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkExperienceController extends Controller
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
            return view('hr.employee.work_experience.create',compact('id'));
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
                                   'previous_company' => 'required',
                                   'job_title' => 'required',
                                   'from' => 'required',
                                   'to' => 'required',
                                   'job_description' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $workexperience = new WorkExperience();
            $workexperience->previous_company = $request->previous_company;
            $workexperience->job_title = $request->job_title;
            $workexperience->from  = date("Y-m-d H:i:s", strtotime($request->from));
            $workexperience->to = date("Y-m-d H:i:s", strtotime($request->to));
            $workexperience->job_description = $request->job_description;
            $workexperience->user_id = $request->id;
            $workexperience->created_by = \Auth::user()->creatorId();
            $workexperience->save();
            return redirect()->back()->with('success', __('Work Experience Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkExperience  $workExperience
     * @return \Illuminate\Http\Response
     */
    public function show(WorkExperience $workExperience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkExperience  $workExperience
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkExperience $workExperience)
    {
        if(\Auth::user()->can('View Employee'))
        {
            if($workExperience->created_by==\Auth::user()->creatorId())
            {
                return view('hr.employee.work_experience.edit',compact('workExperience'));
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
     * @param  \App\WorkExperience  $workExperience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkExperience $workExperience)
    {
        if(\Auth::user()->can('View Employee'))
        {
            if($workExperience->created_by==\Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'previous_company' => 'required',
                                    'job_title' => 'required',
                                    'from' => 'required',
                                    'to' => 'required',
                                    'job_description' => 'required',
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $workexperience = WorkExperience::find($workExperience->id);
                $workexperience->previous_company = $request->previous_company;
                $workexperience->job_title = $request->job_title;
                $workexperience->from  = date("Y-m-d H:i:s", strtotime($request->from));
                $workexperience->to = date("Y-m-d H:i:s", strtotime($request->to));
                $workexperience->job_description = $request->job_description;
                $workexperience->save();
                return redirect()->back()->with('success', __('Work Experience Updated Successfully!'));
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
     * @param  \App\WorkExperience  $workExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkExperience $workExperience)
    {
        if(\Auth::user()->can('View Employee'))
        {
            if($workExperience->created_by==\Auth::user()->creatorId())
            {
                $workExperience->delete();
                return redirect()->back()->with('success', __('Work Experience Deleted Successfully.'));
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
