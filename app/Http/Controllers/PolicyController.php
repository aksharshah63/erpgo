<?php

namespace App\Http\Controllers;

use App\Policy;
use App\Utility;
use App\Department;
use App\EmployeeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Policies'))
        {
            $policies = Policy::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('hr.leave_management.policies.index',compact('policies'));
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
        if(\Auth::user()->can('Create Policy'))
        {
            $departmentList = Department::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('title','id');
            $departmentList->prepend(__('Please Select'),0);
            return view('hr.leave_management.policies.create',compact('departmentList'));
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
        if(\Auth::user()->can('Create Policy'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'policy_name' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $policy = new Policy();
            $policy->policy_name = $request->policy_name;
            $policy->department = $request->department;
            $policy->description = $request->description;
            $policy->created_by = \Auth::user()->creatorId();
            $policy->save();

            return redirect()->back()->with('success', __('Policy Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit(Policy $policy)
    {
        if(\Auth::user()->can('Edit Policy'))
        {
            if($policy->created_by = \Auth::user()->creatorId())
            {
                $departmentList = Department::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('title','id');
                $departmentList->prepend(__('Please Select'),0);
                return view('hr.leave_management.policies.edit',compact('departmentList','policy'));
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
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policy $policy)
    {
        if(\Auth::user()->can('Edit Policy'))
        {
            if($policy->created_by = \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'policy_name' => 'required'
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $policy = Policy::find($policy->id);
                $policy->policy_name = $request->policy_name;
                $policy->department = $request->department;
                $policy->description = $request->description;
                $policy->save();

                return redirect()->back()->with('success', __('Policy Updated Successfully!'));
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
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policy $policy)
    {
        if(\Auth::user()->can('Delete Policy'))
        {
            if($policy->created_by = \Auth::user()->creatorId())
            {
                $policy->delete();
                return redirect()->back()->with('success', __('Policy Successfully Deleted.'));
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
