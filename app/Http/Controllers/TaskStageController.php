<?php

namespace App\Http\Controllers;

use App\Utility;
use App\TaskStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Task Stages'))
        {
            $task_stages = TaskStage::where('created_by', '=', \Auth::user()->creatorId())->orderBy('order','asc')->get();
            return view('task_stage.index',compact('task_stages'));
        }
        
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
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
        if(\Auth::user()->can('Create Task Stage'))
        {
            $rules = [
                'stages' => 'required|present|array',
            ];

            $attributes = [];

            if($request->stages)
            {
                foreach($request->stages as $key => $val)
                {
                    $rules['stages.' . $key . '.name']      = 'required|max:255';
                    $attributes['stages.' . $key . '.name'] = __('Stage Name');
                }
            }

            $validator = Validator::make($request->all(), $rules, [], $attributes);
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $arrStages = TaskStage::orderBy('order')->pluck('name', 'id')->all();
            $order=0;
            
            foreach($request->stages as $key => $stage)
            {
                $obj = new TaskStage();
                if(isset($stage['id']) && !empty($stage['id']))
                {
                    $obj = TaskStage::find($stage['id']);
                    unset($arrStages[$obj->id]);
                }
                $obj->name       = $stage['name'];
                $obj->order      = $order++;
                $obj->created_by = \Auth::user()->creatorId();
                $obj->save();
            }

            if($arrStages)
            {
                foreach($arrStages as $id => $name)
                {
                    TaskStage::find($id)->delete();
                }
            }
            return redirect()->route('task_stages.index')->with('success', __('Task Stage Add Successfully'));
        }
        
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaskStage  $taskStage
     * @return \Illuminate\Http\Response
     */
    public function show(TaskStage $taskStage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaskStage  $taskStage
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskStage $taskStage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaskStage  $taskStage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskStage $taskStage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaskStage  $taskStage
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskStage $taskStage)
    {
        if(\Auth::user()->can('Delete Task Stage'))
        {
            $taskStage->delete();
            return redirect()->back()->with('success', __('Task Stage Successfully Deleted.'));
        }
        
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }
}
