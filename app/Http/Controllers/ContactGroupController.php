<?php

namespace App\Http\Controllers;

use App\Utility;
use App\ContactGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Contact Groups'))
        {
            $contact_groups = ContactGroup::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('crm.contact_group.index',compact('contact_groups'));
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
        if(\Auth::user()->can('Create Contact Group'))
        {
            return view('crm.contact_group.create');
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
        if(\Auth::user()->can('Create Contact Group'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $contactgroup = new ContactGroup();
            $contactgroup->name = $request->name;
            $contactgroup->description = $request->description;
            $contactgroup->private = $request->private;
            $contactgroup->created_by = \Auth::user()->creatorId();
            $contactgroup->save();
            return redirect()->route('contact_groups.index')->with('success', __('Contact Group Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactGroup  $contactGroup
     * @return \Illuminate\Http\Response
     */
    public function show(ContactGroup $contactGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactGroup  $contactGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactGroup $contactGroup)
    {
        if(\Auth::user()->can('Edit Contact Group'))
        {
            if($contactGroup->created_by==\Auth::user()->creatorId())
            {
                return view('crm.contact_group.edit', compact('contactGroup'));
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
     * @param  \App\ContactGroup  $contactGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactGroup $contactGroup)
    {
        if(\Auth::user()->can('Edit Contact Group'))
        {
            if($contactGroup->created_by==\Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'name' => 'required',
                                ]
                );

                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }

                $contactgroup = ContactGroup::find($contactGroup->id);
                $contactgroup->name = $request->name;
                $contactgroup->description = $request->description;
                $contactgroup->private = $request->private;
                $contactgroup->save();
                return redirect()->route('contact_groups.index')->with('success', __('Contact Group Successfully Updated.'));
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
     * @param  \App\ContactGroup  $contactGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactGroup $contactGroup)
    {
        if(\Auth::user()->can('Delete Contact Group'))
        {
            if($contactGroup->created_by==\Auth::user()->creatorId())
            {
                $contactGroup->delete();
                return redirect()->route('contact_groups.index')->with('success', __('Contact Group Successfully Deleted.'));
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
