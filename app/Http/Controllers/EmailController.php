<?php

namespace App\Http\Controllers;

use App\Email;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
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
            return view('crm.email.create',compact('type','id'));
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
                                   'email' => 'required',
                                   'subject' => 'required',
                                   'description' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $email = new Email();
            $email->email = $request->email;
            $email->subject = $request->subject;
            $email->description = $request->description;
            $email->module_type = $request->type;
            $email->module_id = $request->id;
            $email->created_by = \Auth::user()->creatorId();
            $email->save();
            if(!empty($request->email) && !empty($request->subject) && !empty($request->description)){
                $details = [
                    'email' => $request->email,
                    'subject' => $request->subject,
                    'description' => $request->description,
                ];
                \Mail::to($request->email)->send(new \App\Mail\EmailActivity($details));
            }
            return redirect()->back()->with('success', __('Email Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        { 
            return view('crm.email.view',compact('email'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        { 
            if($email->created_by==\Auth::user()->creatorId())
            {
                $email->delete();
                return redirect()->back()->with('success', __('Email Successfully Deleted.'));
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
