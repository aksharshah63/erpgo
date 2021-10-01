<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use App\Utility;
use App\Milestone;
use Carbon\Carbon;
use App\ActivityLog;
use App\ProjectTask;
use App\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($view = 'grid')
    {
        if(\Auth::user()->can('Manage Projects'))
        {
            return view('projects.index', compact('view'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('Create Project'))
        {
            return view('projects.create');
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
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
        if(\Auth::user()->can('Create Project'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                'project_name' => 'required',
                            ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $project = new Project();
            $project->project_name = $request->project_name;
            $project->start_date = date("Y-m-d H:i:s", strtotime($request->start_date));
            $project->end_date = date("Y-m-d H:i:s", strtotime($request->end_date));
            if($request->hasFile('project_image'))
            {
                $imageName = time() . '.' . $request->project_image->extension();
                $request->file('project_image')->storeAs('projects', $imageName);
                $project->project_image      = 'projects/'.$imageName;
            }
            
            $project->budget = !empty($request->budget) ? $request->budget : 0;
            $project->description = $request->description;
            $project->status = $request->status;
            $project->tags = $request->tag;
            $project->created_by = \Auth::user()->creatorId();
            $project->save();
            ProjectUser::create(
                [
                    'project_id' => $project->id,
                    'user_id' => Auth::user()->id,
                ]
            );
            return redirect()->route('projects.index')->with('success', __('Project Add Successfully'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poject  $poject
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        if(\Auth::user()->can('View Project'))
        {
            $usr           = Auth::user();
            $user_projects = $usr->projects->pluck('id')->toArray();
            if(in_array($project->id, $user_projects))
            {
                $project_data = [];
                // Task Count
                $project_task         = $project->tasks->count();
                $project_done_task    = $project->tasks->where('is_complete', '=', 1)->count();
                $project_data['task'] = [
                    'total' => number_format($project_task),
                    'done' => number_format($project_done_task),
                    'percentage' => Utility::getPercentage($project_done_task, $project_task),
                ];
                // end Task Count

                // Expense
                $expAmt = 0;
                foreach($project->expense as $expense)
                {
                    $expAmt += $expense->amount;
                }
                $project_data['expense'] = [
                    'allocated' => $project->budget,
                    'total' => $expAmt,
                    'percentage' => Utility::getPercentage($expAmt, $project->budget),
                ];
                // end expense


                // Users Assigned
                // $total_users                   = User::where('created_by', '=', $usr->id)->count();
                $total_users                   = $usr->project_user->where('user_id', '=', $usr->id)->count();
                //$project_user                  = $project->users()->where('user_id', '!=', $usr->id)->count();
                $project_data['user_assigned'] = [
                    'total' => number_format($total_users) . '/' . number_format($total_users),
                    'percentage' => Utility::getPercentage($total_users, $total_users),
                ];
                // end users assigned

                // Day left
                $total_day                = Carbon::parse($project->start_date)->diffInDays(Carbon::parse($project->end_date));
                $remaining_day            = Carbon::parse($project->start_date)->diffInDays(now());
                $project_data['day_left'] = [
                    'day' => number_format($remaining_day) . '/' . number_format($total_day),
                    'percentage' => Utility::getPercentage($remaining_day, $total_day),
                ];
                // end Day left

                // Open Task
                    $remaining_task = ProjectTask::where('project_id', '=', $project->id)->where('is_complete', '=', 0)->whereRaw("find_in_set('" . $usr->id . "',assign_to)")->count();
                    $total_task     = ProjectTask::where('project_id', '=', $project->id)->whereRaw("find_in_set('" . $usr->id . "',assign_to)")->count();
                $project_data['open_task'] = [
                    'tasks' => number_format($remaining_task) . '/' . number_format($total_task),
                    'percentage' => Utility::getPercentage($remaining_task, $total_task),
                ];
                // end open task

                // Milestone
                $total_milestone           = $project->milestones()->count();
                $complete_milestone        = $project->milestones()->where('status', 'LIKE', 'complete')->count();
                $project_data['milestone'] = [
                    'total' => number_format($complete_milestone) . '/' . number_format($total_milestone),
                    'percentage' => Utility::getPercentage($complete_milestone, $total_milestone),
                ];
                // End Milestone

                // Time spent
                // if($usr->checkProject($project->id) == 'Owner')
                // {
                //     $times = $project->timesheets->pluck('time')->toArray();
                // }
                // else
                // {
                    $times = $project->timesheets()->where('created_by', '=', $usr->id)->pluck('time')->toArray();
                // }
                $totaltime                  = str_replace(':', '.', Utility::timeToHr($times));
                //$estimatedtime              = $project->estimated_hrs != '' ? $project->estimated_hrs : '0';
                $project_data['time_spent'] = [
                    'total' => number_format($totaltime) . '/' . number_format($totaltime),
                    'percentage' => Utility::getPercentage(number_format($totaltime), $totaltime),
                ];
                // end time spent

                // Allocated Hours
                $hrs                                = Project::projectHrs($project->id);
                $project_data['task_allocated_hrs'] = [
                    'hrs' => number_format($hrs['allocated']) . '/' . number_format($hrs['allocated']),
                    'percentage' => Utility::getPercentage($hrs['allocated'], $hrs['allocated']),
                ];
                // end allocated hours

                // Chart
                $seven_days      = Utility::getLastSevenDays();
                $chart_task      = [];
                $chart_timesheet = [];
                $cnt             = 0;
                $cnt1            = 0;

                foreach(array_keys($seven_days) as $k => $date)
                {
                    // if($usr->checkProject($project->id) == 'Owner')
                    // {
                    //     $task_cnt     = $project->tasks()->where('is_complete', '=', 1)->where('marked_at', 'LIKE', $date)->count();
                    //     $arrTimesheet = $project->timesheets()->where('date', 'LIKE', $date)->pluck('time')->toArray();
                    // }
                    // else
                    // {
                        $task_cnt     = $project->tasks()->where('is_complete', '=', 1)->whereRaw("find_in_set('" . $usr->id . "',assign_to)")->where('marked_at', 'LIKE', $date)->count();
                        $arrTimesheet = $project->timesheets()->where('created_by', '=', $usr->id)->where('date', 'LIKE', $date)->pluck('time')->toArray();
                    // }

                    // Task Chart Count
                    $cnt += $task_cnt;

                    // Timesheet Chart Count
                    $timesheet_cnt = str_replace(':', '.', Utility::timeToHr($arrTimesheet));
                    $cn[]          = $timesheet_cnt;
                    $cnt1          += number_format($timesheet_cnt, 2);

                    $chart_task[]      = $task_cnt;
                    $chart_timesheet[] = number_format($timesheet_cnt, 2);
                }

                $project_data['task_chart']      = [
                    'chart' => $chart_task,
                    'total' => $cnt,
                ];
                $project_data['timesheet_chart'] = [
                    'chart' => $chart_timesheet,
                    'total' => $cnt1,
                ];

                // end chart


                return view('projects.view',compact('project','project_data'));
            }
            else
            {
                return redirect()->back()->with('errors', __('Permission Denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poject  $poject
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        if(\Auth::user()->can('Edit Project'))
        {
            return view('projects.edit',compact('project'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poject  $poject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        if(\Auth::user()->can('Edit Project'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                'project_name' => 'required',
                            ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $project = Project::find($project->id);
            $project->project_name = $request->project_name;
            $project->start_date = date("Y-m-d H:i:s", strtotime($request->start_date));
            $project->end_date = date("Y-m-d H:i:s", strtotime($request->end_date));
            if($request->hasFile('project_image'))
            {
                Utility::checkFileExistsnDelete([$project->project_image]);
                $imageName = time() . '.' . $request->project_image->extension();
                $request->file('project_image')->storeAs('projects', $imageName);
                $project->project_image      = 'projects/'.$imageName;
            }
            $project->budget = $request->budget;
            $project->description = $request->description;
            $project->status = $request->status;
            $project->tags = $request->tag;
            $project->save();
            return redirect()->route('projects.index')->with('success', __('Project Updated Successfully'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poject  $poject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if(\Auth::user()->can('Delete Project'))
        {
            if(!empty($project->image))
            {
                Utility::checkFileExistsnDelete([$project->project_image]);
            }
            $project->delete();
            return redirect()->back()->with('success', __('Project Successfully Deleted.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function inviteMemberView(Request $request, $project_id)
    {
        $usr          = Auth::user();
        $project      = Project::find($project_id);
        $user_project = $project->users->pluck('id')->toArray();

        $user_contact = User::where('created_by', \Auth::user()->creatorId())->whereNOTIn('id', $user_project)->pluck('id')->toArray();
        $arrUser      = array_unique($user_contact);
        $users        = User::whereIn('id', $arrUser)->get();

        return view('projects.invite', compact('project_id', 'users'));
    }

    public function inviteProjectUserMember(Request $request)
    {
        $authuser = Auth::user();

        // Make entry in project_user tbl
        ProjectUser::create(
            [
                'project_id' => $request->project_id,
                'user_id' => $request->user_id,
                'invited_by' => $authuser->id,
            ]
        );

        // Make entry in activity_log tbl
        ActivityLog::create(
            [
                'user_id' => $authuser->id,
                'project_id' => $request->project_id,
                'log_type' => 'Invite User',
                'remark' => json_encode(['title' => $authuser->name]),
            ]
        );

        return json_encode(
            [
                'code' => 200,
                'status' => 'Success',
                'success' => __('User invited successfully.'),
            ]
        );
    }

    public function loadUser(Request $request)
    {
        if($request->ajax())
        {
            $project    = Project::find($request->project_id);
            $returnHTML = view('projects.users', compact('project'))->render();

            return response()->json(
                [
                    'success' => true,
                    'html' => $returnHTML,
                ]
            );
        }
    }

    public function milestone($project_id)
    {
        if(\Auth::user()->can('Create Milestone'))
        {
            $project = Project::find($project_id);

            return view('projects.milestone', compact('project'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function milestoneStore(Request $request, $project_id)
    {
        if(\Auth::user()->can('Create Milestone'))
        {
            $project   = Project::find($project_id);
            $validator = Validator::make(
                $request->all(), [
                                   'title' => 'required',
                                   'status' => 'required',
                               ]
            );

            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }

            $milestone              = new Milestone();
            $milestone->project_id  = $project->id;
            $milestone->title       = $request->title;
            $milestone->status      = $request->status;
            $milestone->description = $request->description;
            $milestone->save();

            ActivityLog::create(
                [
                    'user_id' => \Auth::user()->id,
                    'project_id' => $project->id,
                    'log_type' => 'Create Milestone',
                    'remark' => json_encode(['title' => $milestone->title]),
                ]
            );

            return redirect()->back()->with('success', __('Milestone successfully created.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function milestoneEdit($id)
    {
        if(\Auth::user()->can('Edit Milestone'))
        {
            $milestone = Milestone::find($id);

            return view('projects.milestoneEdit', compact('milestone'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function milestoneUpdate($id, Request $request)
    {
        if(\Auth::user()->can('Edit Milestone'))
        {
            $validator = Validator::make(
                $request->all(), [
                                'title' => 'required',
                                'status' => 'required',
                            ]
            );

            if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }

            $milestone              = Milestone::find($id);
            $milestone->title       = $request->title;
            $milestone->status      = $request->status;
            $milestone->description = $request->description;
            $milestone->save();

            return redirect()->back()->with('success', __('Milestone updated successfully.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function milestoneDestroy($id)
    {
        if(\Auth::user()->can('Delete Milestone'))
        {
            $milestone = Milestone::find($id);
            $milestone->delete();

            return redirect()->back()->with('success', __('Milestone successfully deleted.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function milestoneShow($id)
    {
        if(\Auth::user()->can('View Milestone'))
        {
            $milestone = Milestone::find($id);

            return view('projects.milestoneShow', compact('milestone'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function filterProjectView(Request $request)
    {
        if(\Auth::user()->can('Manage Projects'))
        {
            $usr           = Auth::user();
            $user_projects = $usr->projects()->pluck('project_id', 'project_id')->toArray();

            if($request->ajax() && $request->has('view') && $request->has('sort'))
            {
                $sort     = explode('-', $request->sort);
                $projects = Project::whereIn('id', array_keys($user_projects))->orderBy($sort[0], $sort[1]);
                
                if(!empty($request->keyword))
                {
                    $projects->where('project_name', 'LIKE', $request->keyword . '%')->orWhereRaw('FIND_IN_SET("' . $request->keyword . '",tags)');
                }
                if(!empty($request->status))
                {
                    $projects->whereIn('status', $request->status);
                }
                $projects   = $projects->get();
                $returnHTML = view('projects.' . $request->view, compact('projects', 'user_projects'))->render();

                return response()->json(
                    [
                        'success' => true,
                        'html' => $returnHTML,
                    ]
                );
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    // Project Gantt Chart
    public function gantt($projectID, $duration = 'Week')
    {
        if(\Auth::user()->can('View Grant Chart'))
        {
            $project = Project::find($projectID);
            $tasks   = [];

            if($project)
            {
                $tasksobj = $project->tasks;

                foreach($tasksobj as $task)
                {
                    $tmp                 = [];
                    $tmp['id']           = 'task_' . $task->id;
                    $tmp['name']         = $task->name;
                    $tmp['start']        = $task->start_date;
                    $tmp['end']          = $task->end_date;
                    $tmp['custom_class'] = (empty($task->priority_color) ? '#ecf0f1' : $task->priority_color);
                    $tmp['progress']     = str_replace('%', '', $task->taskProgress()['percentage']);
                    $tmp['extra']        = [
                        'priority' => ucfirst(__($task->priority)),
                        'comments' => count($task->comments),
                        'duration' => Utility::getDateFormated($task->start_date) . ' - ' . Utility::getDateFormated($task->end_date),
                    ];
                    $tasks[]             = $tmp;
                }
            }

            return view('projects.gantt', compact('project', 'tasks', 'duration'));
        }
        
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function ganttPost($projectID, Request $request)
    {
        $project = Project::find($projectID);

        if($project)
        {
            if(\Auth::user()->can('View Task'))
            {
                $id               = trim($request->task_id, 'task_');
                $task             = ProjectTask::find($id);
                $task->start_date = $request->start;
                $task->end_date   = $request->end;
                $task->save();

                return response()->json(
                    [
                        'is_success' => true,
                        'message' => __("Time Updated"),
                    ], 200
                );
            }
            else
           {
                return response()->json(
                    [
                        'is_success' => false,
                        'message' => __("You can't change Date!"),
                    ], 400
                );
            }
        }
        else
        {
            return response()->json(
                [
                    'is_success' => false,
                    'message' => __("Something is wrong."),
                ], 400
            );
        }
    }

}
