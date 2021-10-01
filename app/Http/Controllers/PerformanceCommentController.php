<?php

namespace App\Http\Controllers;

use App\User;
use App\Utility;
use App\PerformanceComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanceCommentController extends Controller
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
            $userList      = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $userList->prepend(__('Please Select'),0);
            return view('hr.employee.performance_comment.create',compact('id','userList'));
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
                                   'reference_date' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $performancecomment = new PerformanceComment();
            $performancecomment->reference_date = date("Y-m-d H:i:s", strtotime($request->reference_date));
            $performancecomment->reviwer = $request->reviwer;
            $performancecomment->comments  = $request->comments;
            $performancecomment->user_id = $request->id;
            $performancecomment->created_by = \Auth::user()->creatorId();
            $performancecomment->save();
            return redirect()->back()->with('success', __('Performance Comment Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PerformanceComment  $performanceComment
     * @return \Illuminate\Http\Response
     */
    public function show(PerformanceComment $performanceComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerformanceComment  $performanceComment
     * @return \Illuminate\Http\Response
     */
    public function edit(PerformanceComment $performanceComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerformanceComment  $performanceComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PerformanceComment $performanceComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PerformanceComment  $performanceComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerformanceComment $performanceComment)
    {
        if(\Auth::user()->can('View Employee'))
        {
            if($performanceComment->created_by == \Auth::user()->creatorId())
            {
                $performanceComment->delete();
                return redirect()->back()->with('success', __('Performance Comment Successfully Deleted.'));
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
