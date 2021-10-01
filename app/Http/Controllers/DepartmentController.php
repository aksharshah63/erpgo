<?php

namespace App\Http\Controllers;

use App\User;
use App\Utility;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Departments'))
        {
            $departments = Department::where('created_by', '=', \Auth::user()->creatorId())->get();
            $departmentList=Department::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('id')->toArray();

            $user = \DB::table('user_details')
             ->select(\DB::raw('count(*) as total, department'))
             ->whereIn('department',$departmentList)
             ->groupBy('department')
             ->get()->pluck('total','department')->toArray();
             
            return view('hr.department.index',compact('user','departments'));
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
        if(\Auth::user()->can('Create Department'))
        {
            $departmentids = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('title', 'id');
            $departmentids->prepend(__('Please Select'),0);
            $userList      = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $userList->prepend(__('Please Select'),0);
            return view('hr.department.create',compact('departmentids','userList'));
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
        if(\Auth::user()->can('Create Department'))
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
            $department = new Department();
            $department->title = $request->title;
            $department->description = $request->description;
            $department->department_leads = $request->department_leads;
            $department->parent_department = $request->parent_department;
            $department->created_by =\Auth::user()->creatorId();
            $department->save();
            return redirect()->route('departments.index')->with('success', __('Department Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        if(\Auth::user()->can('View Department'))
        {
            return view('hr.department.view_employee',compact('department'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        if(\Auth::user()->can('Edit Department'))
        {
            if($department->created_by==\Auth::user()->creatorId())
            {
                $userList      = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $userList->prepend(__('Please Select'),0);
                
                $departmentids = Department::where('created_by', \Auth::user()->creatorId())->where('id','!=',$department->id)->get()->pluck("title","id");
                $departmentids->prepend(__('Please Select'),0);       
                return view('hr.department.edit',compact('department', 'departmentids', 'userList'));
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
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        if(\Auth::user()->can('Edit Department'))
        {
            if($department->created_by==\Auth::user()->creatorId())
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
                $department = Department::find($department->id);
                $department->title = $request->title;
                $department->description = $request->description;
                $department->department_leads = $request->department_leads;
                $department->parent_department = $request->parent_department;
                $department->save();
                return redirect()->route('departments.index')->with('success', __('Department Updated Successfully!'));
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
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        if(\Auth::user()->can('Delete Department'))
        {
            if($department->created_by==\Auth::user()->creatorId())
            {
                $department->delete();
                return redirect()->route('departments.index')->with('success', __('Department Successfully Deleted.'));
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
