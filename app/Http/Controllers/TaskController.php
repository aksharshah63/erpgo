<?php

namespace App\Http\Controllers;

use App\Task;
use App\Contact;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
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
            return view('crm.task.create',compact('type','id','contacts'));
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
                                   'date' => 'required',
                                   'time' => 'required',
                                   'description' => 'required',
                                   'agent_or_manager' => 'required|not_in:0',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $task = new Task();
            $task->title = $request->title;
            $task->agent_or_manager = $request->agent_or_manager;
            $task->date = date("Y-m-d H:i:s", strtotime($request->date));
            $task->time = $request->time;
            $task->description = $request->description;
            $task->module_type = $request->type;
            $task->module_id = $request->id;
            $task->created_by =\Auth::user()->creatorId();
            $task->save();
            
            return redirect()->back()->with('success', __('Task Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            if($task->created_by ==\Auth::user()->creatorId())
            {
                return view('crm.task.edit', compact('task'));
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
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            if($task->created_by ==\Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'title' => 'required',
                                    'date' => 'required',
                                    'time' => 'required',
                                    'description' => 'required',
                                    'agent_or_manager' => 'required|not_in:0',
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $task = Task::find($task->id);
                $task->title = $request->title;
                $task->agent_or_manager = $request->agent_or_manager;
                $task->date = date("Y-m-d H:i:s", strtotime($request->date));
                $task->time = $request->time;
                $task->description = $request->description;
                $task->save();
                
                return redirect()->back()->with('success', __('Task Updated Successfully!'));
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
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            if($task->created_by ==\Auth::user()->creatorId())
            {
                $task->delete();
                return redirect()->back()->with('success', __('Task Successfully Deleted.'));
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
