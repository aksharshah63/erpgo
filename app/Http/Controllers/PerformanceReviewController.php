<?php

namespace App\Http\Controllers;

use App\User;
use App\Utility;
use App\PerformanceReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanceReviewController extends Controller
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
            return view('hr.employee.performance_review.create',compact('id','userList'));
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
                                   'review_date' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $performancereview = new PerformanceReview();
            $performancereview->review_date = date("Y-m-d H:i:s", strtotime($request->review_date));
            $performancereview->reporting_to = $request->reporting_to;
            $performancereview->job_knowledge  = $request->job_knowledge;
            $performancereview->work_quality = $request->work_quality;
            $performancereview->attendence_punctuality = $request->attendence_punctuality;
            $performancereview->communication_listening = $request->communication_listening;
            $performancereview->dependability = $request->dependability;
            $performancereview->user_id = $request->id;
            $performancereview->created_by = \Auth::user()->creatorId();
            $performancereview->save();
            return redirect()->back()->with('success', __('Performance Review Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PerformanceReview  $performanceReview
     * @return \Illuminate\Http\Response
     */
    public function show(PerformanceReview $performanceReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerformanceReview  $performanceReview
     * @return \Illuminate\Http\Response
     */
    public function edit(PerformanceReview $performanceReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerformanceReview  $performanceReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PerformanceReview $performanceReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PerformanceReview  $performanceReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerformanceReview $performanceReview)
    {
        if(\Auth::user()->can('View Employee'))
        {
            if($performanceReview->created_by == \Auth::user()->creatorId())
            {
                $performanceReview->delete();
                return redirect()->back()->with('success', __('Performance Review Successfully Deleted.'));
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
