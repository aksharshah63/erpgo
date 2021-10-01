<?php

namespace App\Http\Controllers;

use App\Note;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
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
            return view('crm.note.create',compact('type','id'));
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
                                   'note' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $note = new Note();
            $note->note = $request->note;
            $note->module_type = $request->type;
            $note->module_id = $request->id;
            $note->created_by = \Auth::user()->creatorId();
            $note->save();
            return redirect()->back()->with('success', __('Note Add Successfully!'));
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
    public function edit(Note $note)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            if($note->created_by== \Auth::user()->creatorId())
            {
                return view('crm.note.edit', compact('note'));
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
    public function update(Request $request, Note $note)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            if($note->created_by== \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'note' => 'required',
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $note = Note::find($note->id);
                $note->note = $request->note;
                $note->save();
                return redirect()->back()->with('success', __('Note Updated Successfully!'));
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
    public function destroy(Note $note)
    {
        if(\Auth::user()->can('View Contact') || \Auth::user()->can('View Company'))
        {
            if($note->created_by== \Auth::user()->creatorId())
            {
                $note->delete();
                return redirect()->back()->with('success', __('Note Successfully Deleted.'));
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
