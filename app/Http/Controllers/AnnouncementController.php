<?php

namespace App\Http\Controllers;

use App\User;
use App\Utility;
use App\Department;
use App\Designation;
use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Announcements'))
        {
            $announcements = Announcement::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('hr.announcement.index',compact('announcements'));
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
        if(\Auth::user()->can('Create Announcement'))
        {
            $users      = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $users->prepend(__('Please Select'),0);
            $departments = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
            $departments->prepend(__('Please Select'),0);
            $designations = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
            $designations->prepend(__('Please Select'),0);
            return view('hr.announcement.create',compact('users','departments','designations'));
        }
        else
        {
            return response()->json(['errors' => __('Permission denied.')], 401);
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
        if(\Auth::user()->can('Create Announcement'))
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
            $announcement = new Announcement();
            $announcement->title = $request->title;
            $announcement->description = $request->description;
            $announcement->send_announcement_to = $request->send_announcement_to;
            if(!empty($announcement->send_announcement_to))
            {
                if($announcement->send_announcement_to=='selected_user')
                {
                    $selected_user = $request->select_users;
                    $announcement->select_users  = !empty($selected_user)?implode(',', $selected_user) : 0;
                    $announcement->by_department=0;
                    $announcement->by_designation=0;
                }
                else if($announcement->send_announcement_to=='by_department')
                {
                    $by_department = $request->by_department;
                    $announcement->by_department = !empty($by_department) ? implode(',', $by_department) : 0;
                    $announcement->select_users=0;
                    $announcement->by_designation=0;
                }
                else 
                {
                    $by_designation = $request->by_designation;
                    $announcement->by_designation = !empty($by_designation) ? implode(',', $by_designation) : 0;
                    $announcement->select_users=0;
                    $announcement->by_department=0;
                }
            }
            $announcement->created_by = \Auth::user()->creatorId();
            $announcement->save();
            return redirect()->back()->with('success', __('Announcement Add Successfully!'));
        }
        else
        {
            return response()->json(['errors' => __('Permission denied.')], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        return view('hr.announcement.view',compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        if(\Auth::user()->can('Edit Announcement'))
        {
            if($announcement->created_by == \Auth::user()->creatorId())
            {
                $users      = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $users->prepend(__('Please Select'),0);
                $departments = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
                $departments->prepend(__('Please Select'),0);
                $designations = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
                $designations->prepend(__('Please Select'),0);
                return view('hr.announcement.edit',compact('users','departments','designations','announcement'));
            }
            else
            {
                return response()->json(['errors' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['errors' => __('Permission denied.')], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        if(\Auth::user()->can('Edit Announcement'))
        {
            if($announcement->created_by == \Auth::user()->creatorId())
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
                $announcement = Announcement::find($announcement->id);
                $announcement->title = $request->title;
                $announcement->description = $request->description;
                $announcement->send_announcement_to = $request->send_announcement_to;
                if(!empty($announcement->send_announcement_to))
                {
                    if($announcement->send_announcement_to=='selected_user')
                    {
                        $selected_user = $request->select_users;
                        $announcement->select_users  = !empty($selected_user)?implode(',', $selected_user) : 0;
                        $announcement->by_department=0;
                        $announcement->by_designation=0;
                    }
                    else if($announcement->send_announcement_to=='by_department')
                    {
                        $by_department = $request->by_department;
                        $announcement->by_department = !empty($by_department) ? implode(',', $by_department) : 0;
                        $announcement->select_users=0;
                        $announcement->by_designation=0;
                    }
                    else 
                    {
                        $by_designation = $request->by_designation;
                        $announcement->by_designation = !empty($by_designation) ? implode(',', $by_designation) : 0;
                        $announcement->select_users=0;
                        $announcement->by_department=0;
                    }
                }
                $announcement->save();
                return redirect()->back()->with('success', __('Announcement Updated Successfully!'));
            }
            else
            {
                return response()->json(['errors' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['errors' => __('Permission denied.')], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        if(\Auth::user()->can('Delete Announcement'))
        {
            if($announcement->created_by == \Auth::user()->creatorId())
            {
                $announcement->delete();
                return redirect()->back()->with('success', __('Announcement Successfully Deleted.'));
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
