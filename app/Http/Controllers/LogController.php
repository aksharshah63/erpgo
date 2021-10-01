<?php

namespace App\Http\Controllers;

use App\Utility;
use App\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
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
            return view('crm.log.create',compact('type','id'));
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
                                   'select_type' =>'required|not_in:0',
                                   'start_date' => 'required',
                                   'time' => 'required',
                                   'note' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $logactivity = new LogActivity();
            $logactivity->type = $request->select_type;
            $logactivity->start_date = date("Y-m-d H:i:s", strtotime($request->start_date)); 
            $logactivity->time = $request->time;
            $logactivity->note = $request->note;
            $logactivity->module_type = $request->type;
            $logactivity->module_id = $request->id;
            $logactivity->created_by = \Auth::user()->creatorId();
            $logactivity->save();
            return redirect()->back()->with('success', __('Log Activity Add Successfully!'));
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
    public function edit(LogActivity $LogActivity)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            if($LogActivity->created_by== \Auth::user()->creatorId())
            {
                return view('crm.log.edit', compact('LogActivity'));
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
    public function update(Request $request, LogActivity $LogActivity)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            if($LogActivity->created_by== \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'select_type' =>'required|not_in:0',
                                    'start_date' => 'required',
                                    'time' => 'required',
                                    'note' => 'required',
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $logactivity = LogActivity::find($LogActivity->id);
                $logactivity->type = $request->select_type;
                $logactivity->start_date = date("Y-m-d H:i:s", strtotime(request('start_date'))); 
                $logactivity->time = $request->time;
                $logactivity->note = $request->note;
                $logactivity->save();
                return redirect()->back()->with('success', __('Log Activity Updated Successfully!'));
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
    public function destroy(LogActivity $LogActivity)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            if($LogActivity->created_by== \Auth::user()->creatorId())
            {
                $LogActivity->delete();
                return redirect()->back()->with('success', __('Log Activity Successfully Deleted.'));
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
