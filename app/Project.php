<?php

namespace App;

use App\User;
use App\Utility;
use App\TaskFile;
use App\TaskStage;
use Carbon\Carbon;
use App\ProjectTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable=[
        'project_name',
        'start_date',
        'end_date',
        'project_image',
        'budget',
        'description',
        'status',
        'tags',
        'created_by'
    ];

    public static $project_status=[
        'on_hold' => 'On Hold',
        'in_progress' => 'In Progress',
        'complete' => 'Complete',
        'canceled' => 'Canceled'
    ];

    public static $status_color = [
        'on_hold' => 'warning',
        'in_progress' => 'info',
        'complete' => 'success',
        'canceled' => 'danger',
    ];

    public function milestones()
    {
        return $this->hasMany('App\Milestone', 'project_id', 'id');
    }

    protected $appends = ['img_image'];

    // Make new attribute for directly get image
    public function getImgImageAttribute()
    {
        if(\Storage::exists($this->project_image) && !empty($this->project_image))
        {
            return $this->attributes['img_image'] = 'src=' . asset(\Storage::url($this->project_image));
        }
        else
        {
            return $this->attributes['img_image'] = 'avatar=' . $this->project_name;
        }
    }

    public static function projectHrs($project_id, $task_id = '')
    {
        $project = Project::find($project_id);
        $tasks   = ProjectTask::where('project_id', '=', $project_id)->get();
        $taskHrs = 0;

        foreach($tasks as $task)
        {
            $taskHrs += $task->estimated_hrs;
        }

        return [
            // 'total' => $project->estimated_hrs,
            'allocated' => $taskHrs,
        ];
    }

    public function project_progress()
    {
        $percentage = 0;
        $last_task      = TaskStage::orderBy('order', 'DESC')->first();
        $total_task     = $this->tasks->count();
        $completed_task = $this->tasks()->where('stage_id', '=', $last_task->id)->where('is_complete', '=', 1)->count();

        if($total_task > 0)
        {
            $percentage = intval(($completed_task / $total_task) * 100);
        }

        $color = Utility::getProgressColor($percentage);

        return [
            'color' => $color,
            'percentage' => $percentage . '%',
        ];
    }

    public function tasks()
    {
        return $this->hasMany('App\ProjectTask', 'project_id', 'id')->orderBy('id', 'desc');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'project_users', 'project_id', 'user_id');
    }

    public function projectAttachments()
    {
        $usr = Auth::user();
        $tasks = $this->tasks->pluck('id');
        return TaskFile::whereIn('task_id', $tasks)->get();
    }

    public function activities()
    {
        $usr = Auth::user();
        //if($usr->checkProject($this->id) == 'Owner')
        //{
            $activity = $this->hasMany('App\ActivityLog', 'project_id', 'id')->orderBy('id', 'desc');
       // }
        // else
        // {
        //     // get users assigned task in this project
        //     $usr_task = $this->tasks()->whereRaw("find_in_set('" . $usr->id . "',assign_to)")->pluck('id')->toArray();

        //     $activity = $this->hasMany('App\ActivityLog', 'project_id', 'id')->whereIn('task_id', $usr_task)->orderBy('id', 'desc');
        // }

        return $activity;
    }

    public function expense()
    {
        return $this->hasMany('App\Expense', 'project_id', 'id')->orderBy('id', 'desc');
    }

    // Return timesheet html in table format
    public static function getProjectAssignedTimesheetHTML($projects_timesheet = null, $timesheets = [], $days = [], $project_id = null)
    {
        //$permissions = (!empty($project_id)) ? Auth::user()->getPermission($project_id) : '';

        $i              = $k = 0;
        $allProjects    = false;
        $timesheetArray = $totaltaskdatetimes = [];

        // if($seeAsOwner)
        // {
        //     if($project_id == '0')
        //     {
        //         $allProjects = true;
        //         foreach($timesheets as $project_id => $timesheet)
        //         {
        //             $project = Project::find($project_id);
        //             if($project)
        //             {
        //                 $timesheetArray[$k]['project_id']   = $project->id;
        //                 $timesheetArray[$k]['project_name'] = $project->name;
        //                 foreach($timesheet as $task_id => $tasktimesheet)
        //                 {
        //                     $task = ProjectTask::find($task_id);
        //                     if($task)
        //                     {
        //                         $timesheetArray[$k]['taskArray'][$i]['task_id']   = $task->id;
        //                         $timesheetArray[$k]['taskArray'][$i]['task_name'] = $task->name;
        //                         $new_projects_timesheet                           = clone $projects_timesheet;
        //                         $users                                            = $new_projects_timesheet->where('task_id', $task->id)->groupBy('created_by')->pluck('created_by')->toArray();
        //                         foreach($users as $count => $user_id)
        //                         {
        //                             $times = [];
        //                             for($j = 0; $j < 7; $j++)
        //                             {
        //                                 $date                                                                         = $days['datePeriod'][$j]->format('Y-m-d');
        //                                 $filtered_array                                                               = array_filter(
        //                                     $tasktimesheet, function ($val) use ($user_id, $date){
        //                                     return ($val['created_by'] == $user_id and $val['date'] == $date);
        //                                 }
        //                                 );
        //                                 $key                                                                          = array_keys($filtered_array);
        //                                 $user                                                                         = User::find($user_id);
        //                                 $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['user_id']          = $user != null ? $user->id : '';
        //                                 $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['user_name']        = $user != null ? $user->name : '';
        //                                 $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['date'] = $date;
        //                                 if(!empty($key) && count($key) > 0)
        //                                 {
        //                                     $time                                                                         = Carbon::parse($tasktimesheet[$key[0]]['time'])->format('H:i');
        //                                     $times[]                                                                      = $time;
        //                                     $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['time'] = $time;
        //                                     $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['type'] = 'edit';
        //                                     $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['url']  = route(
        //                                         'timesheet.edit', [
        //                                                             $project_id,
        //                                                             $tasktimesheet[$key[0]]['id'],
        //                                                         ]
        //                                     );
        //                                 }
        //                                 else
        //                                 {
        //                                     $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['time'] = '00:00';
        //                                     $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['type'] = 'create';
        //                                     $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['url']  = route('timesheet.create', $project_id);
        //                                 }
        //                             }
        //                             $calculatedtasktime                                                    = Utility::calculateTimesheetHours($times);
        //                             $totaltaskdatetimes[]                                                  = $calculatedtasktime;
        //                             $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['totaltime'] = $calculatedtasktime;
        //                         }
        //                     }
        //                     $i++;
        //                 }
        //             }
        //             $k++;
        //         }
        //     }
        //     else
        //     {
        //         foreach($timesheets as $task_id => $timesheet)
        //         {
        //             $task = ProjectTask::find($task_id);
        //             if($task)
        //             {
        //                 $timesheetArray[$i]['task_id']   = $task->id;
        //                 $timesheetArray[$i]['task_name'] = $task->name;
        //                 $new_projects_timesheet          = clone $projects_timesheet;
        //                 $users                           = $new_projects_timesheet->where('task_id', $task->id)->groupBy('created_by')->pluck('created_by')->toArray();
        //                 foreach($users as $count => $user_id)
        //                 {
        //                     $times = [];
        //                     for($j = 0; $j < 7; $j++)
        //                     {
        //                         $date                                                        = $days['datePeriod'][$j]->format('Y-m-d');
        //                         $filtered_array                                              = array_filter(
        //                             $timesheet, function ($val) use ($user_id, $date){
        //                             return ($val['created_by'] == $user_id and $val['date'] == $date);
        //                         }
        //                         );
        //                         $key                                                         = array_keys($filtered_array);
        //                         $user                                                        = User::find($user_id);
        //                         $timesheetArray[$i]['dateArray'][$count]['user_id']          = $user != null ? $user->id : '';
        //                         $timesheetArray[$i]['dateArray'][$count]['user_name']        = $user != null ? $user->name : '';
        //                         $timesheetArray[$i]['dateArray'][$count]['week'][$j]['date'] = $date;
        //                         if(!empty($key) && count($key) > 0)
        //                         {
        //                             $time                                                        = Carbon::parse($timesheet[$key[0]]['time'])->format('H:i');
        //                             $times[]                                                     = $time;
        //                             $timesheetArray[$i]['dateArray'][$count]['week'][$j]['time'] = $time;
        //                             $timesheetArray[$i]['dateArray'][$count]['week'][$j]['type'] = 'edit';
        //                             $timesheetArray[$i]['dateArray'][$count]['week'][$j]['url']  = route(
        //                                 'timesheet.edit', [
        //                                                     $project_id,
        //                                                     $timesheet[$key[0]]['id'],
        //                                                 ]
        //                             );
        //                         }
        //                         else
        //                         {
        //                             $timesheetArray[$i]['dateArray'][$count]['week'][$j]['time'] = '00:00';
        //                             $timesheetArray[$i]['dateArray'][$count]['week'][$j]['type'] = 'create';
        //                             $timesheetArray[$i]['dateArray'][$count]['week'][$j]['url']  = route('timesheet.create', $project_id);
        //                         }
        //                     }
        //                     $calculatedtasktime                                   = Utility::calculateTimesheetHours($times);
        //                     $totaltaskdatetimes[]                                 = $calculatedtasktime;
        //                     $timesheetArray[$i]['dateArray'][$count]['totaltime'] = $calculatedtasktime;
        //                 }
        //             }
        //             $i++;
        //         }
        //     }
        // }
        // else
        // {
            if($project_id == '0')
            {
                $allProjects = true;
                foreach($timesheets as $project_id => $timesheet)
                {
                    $project = Project::find($project_id);
                    if($project)
                    {
                        $timesheetArray[$k]['project_id']   = $project->id;
                        $timesheetArray[$k]['project_name'] = $project->project_name;
                        foreach($timesheet as $task_id => $tasktimesheet)
                        {
                            $task = ProjectTask::find($task_id);
                            if($task)
                            {
                                $timesheetArray[$k]['taskArray'][$i]['task_id']   = $task->id;
                                $timesheetArray[$k]['taskArray'][$i]['task_name'] = $task->name;
                                $new_projects_timesheet                           = clone $projects_timesheet;
                                $users                                            = $new_projects_timesheet->where('task_id', $task->id)->groupBy('created_by')->pluck('created_by')->toArray();
                                foreach($users as $count => $user_id)
                                {
                                    $times = [];
                                    for($j = 0; $j < 7; $j++)
                                    {
                                        $date                                                                         = $days['datePeriod'][$j]->format('Y-m-d');
                                        $filtered_array                                                               = array_filter(
                                            $tasktimesheet, function ($val) use ($user_id, $date){
                                            return ($val['created_by'] == $user_id and $val['date'] == $date);
                                        }
                                        );
                                        $key                                                                          = array_keys($filtered_array);
                                        $user                                                                         = User::find($user_id);
                                        $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['user_id']          = $user != null ? $user->id : '';
                                        $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['user_name']        = $user != null ? $user->name : '';
                                        $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['date'] = $date;
                                        if(!empty($key) && count($key) > 0)
                                        {
                                            $time                                                                         = Carbon::parse($tasktimesheet[$key[0]]['time'])->format('H:i');
                                            $times[]                                                                      = $time;
                                            $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['time'] = $time;
                                            $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['type'] = 'edit';
                                            $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['url']  = route(
                                                'timesheet.edit', [
                                                                    $project_id,
                                                                    $tasktimesheet[$key[0]]['id'],
                                                                ]
                                            );
                                        }
                                        else
                                        {
                                            $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['time'] = '00:00';
                                            $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['type'] = 'create';
                                            $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['week'][$j]['url']  = route('timesheet.create', $project_id);
                                        }
                                    }
                                    $calculatedtasktime                                                    = Utility::calculateTimesheetHours($times);
                                    $totaltaskdatetimes[]                                                  = $calculatedtasktime;
                                    $timesheetArray[$k]['taskArray'][$i]['dateArray'][$count]['totaltime'] = $calculatedtasktime;
                                }
                            }
                            $i++;
                        }
                    }
                    $k++;
                }
            }
            else
            {
                foreach($timesheets as $task_id => $timesheet)
                {
                    $times = [];
                    $task  = ProjectTask::find($task_id);
                    if($task)
                    {
                        $timesheetArray[$i]['task_id']   = $task->id;
                        $timesheetArray[$i]['task_name'] = $task->name;
                        for($j = 0; $j < 7; $j++)
                        {
                            $date                                        = $days['datePeriod'][$j]->format('Y-m-d');
                            $key                                         = array_search($date, array_column($timesheet, 'date'));
                            $timesheetArray[$i]['dateArray'][$j]['date'] = $date;
                            if($key !== false)
                            {
                                $time                                        = Carbon::parse($timesheet[$key]['time'])->format('H:i');
                                $times[]                                     = $time;
                                $timesheetArray[$i]['dateArray'][$j]['time'] = $time;
                                $timesheetArray[$i]['dateArray'][$j]['type'] = 'edit';
                                $timesheetArray[$i]['dateArray'][$j]['url']  = route(
                                    'timesheet.edit', [
                                                        $project_id,
                                                        $timesheet[$key]['id'],
                                                    ]
                                );
                            }
                            else
                            {
                                $timesheetArray[$i]['dateArray'][$j]['time'] = '00:00';
                                $timesheetArray[$i]['dateArray'][$j]['type'] = 'create';
                                $timesheetArray[$i]['dateArray'][$j]['url']  = route('timesheet.create', $project_id);
                            }
                        }
                        $calculatedtasktime              = Utility::calculateTimesheetHours($times);
                        $totaltaskdatetimes[]            = $calculatedtasktime;
                        $timesheetArray[$i]['totaltime'] = $calculatedtasktime;
                    }
                    $i++;
                }
            }
        //}

        $calculatedtotaltaskdatetime = Utility::calculateTimesheetHours($totaltaskdatetimes);

        foreach($days['datePeriod'] as $key => $date)
        {
            $dateperioddate                  = $date->format('Y-m-d');
            $new_projects_timesheet          = clone $projects_timesheet;
            $totalDateTimes[$dateperioddate] = Utility::calculateTimesheetHours($new_projects_timesheet->where('date', $dateperioddate)->pluck('time')->toArray());
        }
        $returnHTML = view('projects.timesheets.week', compact('timesheetArray', 'totalDateTimes', 'calculatedtotaltaskdatetime', 'days', 'allProjects'))->render();

        return $returnHTML;
    }

    // Get Mileston desc wise
    public function tasksections()
    {
        return $this->hasMany('App\Milestone', 'project_id', 'id')->orderBy('id', 'desc');
    }

    public static function getAssignedProjectTasks($project_id = null, $stage_id = null, $filterdata = [])
    {
        $authuser = \Auth::user();
        $project  = Project::find($project_id);
        $tasks    = new ProjectTask();

        if($project)
        {
            //$currentpermission = $project->users()->where('user_id', $authuser->id)->first();
            // if($currentpermission == 'member')
            //if($currentpermission == 'user' || $currentpermission == 'client')
            //{
                $task_ids = $authuser->tasks()->pluck('id')->toArray();
                $tasks    = $tasks->whereIn('id', $task_ids);
            //}
            $tasks = $tasks->where('project_id', '=', $project_id);
        }
        else
        {
            $task_ids = $authuser->tasks()->pluck('id')->toArray();
            $tasks    = $tasks->whereIn('id', $task_ids);
        }
        if($stage_id)
        {
            $tasks = $tasks->where('stage_id', '=', $stage_id);
        }

        return $tasks;
    }

    // Get Project based it's Timesheet
    public function timesheets()
    {
        return $this->hasMany('App\Timesheet', 'project_id', 'id')->orderBy('id', 'desc');
    }

    // For Delete project and it's based sub record
    public static function deleteProject($project_id)
    {
        $taskstatus = $projectstatus = false;

        $project = Project::find($project_id);

        if($project)
        {
            Utility::checkFileExistsnDelete([$project->image]);

            $project->milestones()->delete();

            $project->activities()->delete();

            $project->timesheets()->delete();

            $project->users()->detach();

            //$project->taskstages()->delete();

            $task_ids = ProjectTask::where('project_id', $project->id)->pluck('id')->toArray();

            if(!empty($task_ids) && count($task_ids) > 0)
            {
                $taskstatus = ProjectTask::deleteTask($task_ids);
            }

            $projectstatus = $project->delete();
        }

        echo json_encode($projectstatus);
    }

}
