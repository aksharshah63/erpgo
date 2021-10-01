<?php

namespace App\Http\Controllers;

use App\Utility;
use App\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Designations'))
        {
            $designations = Designation::where('created_by', '=', \Auth::user()->creatorId())->get();
            $designationList=Designation::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('id')->toArray();

            $user = \DB::table('user_details')
             ->select(\DB::raw('count(*) as total, designation'))
             ->whereIn('designation',$designationList)
             ->groupBy('designation')
             ->get()->pluck('total','designation')->toArray();

            return view('hr.designation.index',compact('user','designations'));
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
        if(\Auth::user()->can('Create Designation'))
        {
            return view('hr.designation.create');
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
        if(\Auth::user()->can('Create Designation'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'title' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $designation = new Designation();
            $designation->title = $request->title;
            $designation->description = $request->description;
            $designation->created_by = \Auth::user()->creatorId();
            $designation->save();
            return redirect()->route('designations.index')->with('success', __('Designation Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        if(\Auth::user()->can('View Designation'))
        {
            return view('hr.designation.view_employee',compact('designation'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        if(\Auth::user()->can('Edit Designation'))
        {
            if($designation->created_by==\Auth::user()->creatorId())
            {
                return view('hr.designation.edit',compact('designation'));
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
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        if(\Auth::user()->can('Edit Designation'))
        {
            if($designation->created_by==\Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'title' => 'required',
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $designation = Designation::find($designation->id);
                $designation->title = $request->title;
                $designation->description = $request->description;
                $designation->save();
                return redirect()->route('designations.index')->with('success', __('Designation Updated Successfully!'));
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
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        if(\Auth::user()->can('Delete Designation'))
        {
            if($designation->created_by==\Auth::user()->creatorId())
            {
                $designation->delete();
                return redirect()->route('designations.index')->with('success', __('Designation Successfully Deleted.'));
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
