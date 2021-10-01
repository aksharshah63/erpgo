<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Utility;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
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
    public function create($type,$id)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            $contacts = Contact::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name','name')->toArray();
            return view('crm.schedule.create',compact('type','id','contacts'));
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
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'title' => 'required',
                                   'start_date' => 'required',
                                   'end_date' => 'required',
                                   'note' => 'required',
                                   'agent_or_manager' => 'required|not_in:0',
                                   'schedule_type' => 'required|not_in:0'
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $schedule = new Schedule();
            $schedule->title = $request->title;
            $schedule->all_day = (isset($request->all_day)) ? 1 : 0;
            $schedule->start_date = date("Y-m-d H:i:s", strtotime($request->start_date)); 
            $schedule->end_date = date("Y-m-d H:i:s", strtotime($request->end_date)); 
            $schedule->start_time = $request->start_time;
            $schedule->end_time = $request->end_time;
            $schedule->note = $request->note;
            $schedule->agent_or_manager = $request->agent_or_manager;
            $schedule->schedule_type = $request->schedule_type;
            $schedule->all_notification = (isset($request->all_notification)) ? 1 : 0;
            $schedule->email = $request->email;
            $schedule->module_type = $request->type;
            $schedule->module_id = $request->id;
            $schedule->created_by = \Auth::user()->creatorId();
            $schedule->save();
            
            if(!empty($request->email)){
                $details = [
                    'title' => $request->title,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'note' => $request->note,
                    'agent_or_manager' => $request->agent_or_manager,
                    'schedule_type'=> $request->schedule_type,
                ];
                \Mail::to($request->email)->send(new \App\Mail\ScheduleMail($details));
            }
            return redirect()->back()->with('success', __('Schedule Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
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
    public function edit(Schedule $Schedule)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            if($Schedule->created_by == \Auth::user()->creatorId())
            {
                return view('crm.schedule.edit', compact('Schedule'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $Schedule)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            if($Schedule->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'title' => 'required',
                                    'start_date' => 'required',
                                    'end_date' => 'required',
                                    'note' => 'required',
                                    'agent_or_manager' => 'required|not_in:0',
                                    'schedule_type' => 'required|not_in:0'
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $schedule = Schedule::find($Schedule->id);
                $schedule->title = $request->title;
                $schedule->all_day = (isset($request->all_day)) ? 1 : 0;
                $schedule->start_date = date("Y-m-d H:i:s", strtotime($request->start_date)); 
                $schedule->end_date = date("Y-m-d H:i:s", strtotime($request->end_date)); 
                $schedule->start_time = $request->start_time;
                $schedule->end_time = $request->end_time;
                $schedule->note = $request->note;
                $schedule->agent_or_manager = $request->agent_or_manager;
                $schedule->schedule_type = $request->schedule_type;
                $schedule->all_notification = (isset($request->all_notification)) ? 1 : 0;
                $schedule->email = $request->email;
                $schedule->save();
                return redirect()->back()->with('success', __('Schedule Updated Successfully!'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $Schedule)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            if($Schedule->created_by == \Auth::user()->creatorId())
            {
                $Schedule->delete();
                return redirect()->back()->with('success', __('Schedule Successfully Deleted.'));
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
