<?php

namespace App\Http\Controllers;

use App\Utility;
use App\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
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
            return view('hr.employee.education.create',compact('id'));
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
                                   'school_name' => 'required',
                                   'degree' => 'required',
                                   'field_of_study' => 'required',
                                   'year_of_completion' => 'required'
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $education = new Education();
            $education->school_name = $request->school_name;
            $education->degree = $request->degree;
            $education->field_of_study  = $request->field_of_study;
            $education->year_of_completion = $request->year_of_completion;
            $education->description = $request->description;
            $education->user_id = $request->id;
            $education->created_by = \Auth::user()->creatorId();
            $education->save();
            return redirect()->back()->with('success', __('Education Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $education)
    {
        if(\Auth::user()->can('View Employee'))
        {
            if($education->created_by==\Auth::user()->creatorId())
            {
                return view('hr.employee.education.edit',compact('education'));
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
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Education $education)
    {
        if(\Auth::user()->can('View Employee'))
        {
            if($education->created_by==\Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'school_name' => 'required',
                                    'degree' => 'required',
                                    'field_of_study' => 'required',
                                    'year_of_completion' => 'required'
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $education = Education::find($education->id);
                $education->school_name = $request->school_name;
                $education->degree = $request->degree;
                $education->field_of_study  = $request->field_of_study;
                $education->year_of_completion = $request->year_of_completion;
                $education->description = $request->description;
                $education->save();
                return redirect()->back()->with('success', __('Education Updated Successfully!'));
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
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        if(\Auth::user()->can('View Employee'))
        {
            if($education->created_by==\Auth::user()->creatorId())
            {
                $education->delete();
                return redirect()->back()->with('success', __('Education Successfully Deleted.'));
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
