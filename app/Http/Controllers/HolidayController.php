<?php

namespace App\Http\Controllers;

use App\Holiday;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Holidays'))
        {
            $holidays = Holiday::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('hr.leave_management.holiday.index',compact('holidays'));
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
        if(\Auth::user()->can('Create Holiday'))
        {
            return view('hr.leave_management.holiday.create');
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
        if(\Auth::user()->can('Create Holiday'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'holiday_name' => 'required',
                                   'start_date' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $holiday = new Holiday();
            $holiday->holiday_name = $request->holiday_name;
            $holiday->start_date = date("Y-m-d H:i:s", strtotime($request->start_date)); 
            $holiday->range = (isset($request->range)) ? 1 : 0;

            if(!empty($request->end_date))
            {
                if(strtotime($request->start_date) >= strtotime($request->end_date))
                {
                    return redirect()->back()->with('errors', __('Please Select Future Date'),400);
                }
                $holiday->end_date = date("Y-m-d H:i:s", strtotime($request->end_date)); 
                $datetime1 = new \DateTime($holiday->start_date);
                $datetime2 = new \DateTime($holiday->end_date);
                $interval = $datetime1->diff($datetime2);
                $holiday->days = $interval->format('%a');
            }
            else
            {
                $holiday->days = 1;
            }
            $holiday->description = $request->description;
            $holiday->created_by = \Auth::user()->creatorId();
            $holiday->save();
            return redirect()->back()->with('success', __('Holiday Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        if(\Auth::user()->can('Edit Holiday'))
        {
            if($holiday->created_by==\Auth::user()->creatorId())
            {
                return view('hr.leave_management.holiday.edit',compact('holiday'));
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
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        if(\Auth::user()->can('Edit Holiday'))
        {
            if($holiday->created_by==\Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'holiday_name' => 'required',
                                    'start_date' => 'required',
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $holiday = Holiday::find($holiday->id);
                $holiday->holiday_name = $request->holiday_name;
                $holiday->start_date = date("Y-m-d H:i:s", strtotime($request->start_date)); 
                $holiday->range = (isset($request->range)) ? 1 : 0;
                
                if($request->range==true)
                {
                    if(strtotime($request->start_date) >= strtotime($request->end_date))
                    {
                        return redirect()->back()->with('errors', __('Please Select Future Date'),400);
                    }
                    $holiday->end_date = date("Y-m-d H:i:s", strtotime($request->end_date)); 
                    $datetime1 = new \DateTime($holiday->start_date);
                    $datetime2 = new \DateTime($holiday->end_date);
                    $interval = $datetime1->diff($datetime2);
                    $holiday->days = $interval->format('%a');
                }
                else if($request->range==false)
                {
                    $holiday->end_date = date("Y-m-d H:i:s", strtotime($request->start_date)); 
                    $holiday->days = 1;
                }
                $holiday->description = $request->description;
                $holiday->save();
                return redirect()->back()->with('success', __('Holiday Updated Successfully!'));
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
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        if(\Auth::user()->can('Delete Holiday'))
        {
            if($holiday->created_by==\Auth::user()->creatorId())
            {
                $holiday->delete();
                return redirect()->back()->with('success', __('Holiday Successfully Deleted.'));
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
