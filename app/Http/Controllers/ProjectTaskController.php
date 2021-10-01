<?php

namespace App\Http\Controllers;

use App\Project;
use App\Utility;
use App\TaskFile;
use App\TaskStage;
use App\ActivityLog;
use App\ProjectTask;
use App\TaskComment;
use App\TaskChecklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectTaskController extends Controller
{
    public function index($project_id)
    {
        $usr = \Auth::user();
        if(\Auth::user()->can('Manage Tasks'))
        {
            $project = Project::find($project_id);
            $stages  = TaskStage::orderBy('order')->get();

            foreach($stages as &$status)
            {
                $stageClass[] = 'task-list-' . $status->id;
                $task         = ProjectTask::where('project_id', '=', $project_id);

                // check project is shared or owner
                // if($usr->checkProject($project_id) == 'Shared')
                // {
                //     $task->whereRaw("find_in_set('" . $usr->id . "',assign_to)");
                // }
                //end

                $task->orderBy('order');
                $status['tasks'] = $task->where('stage_id', '=', $status->id)->get();
            }

            return view('project_task.index', compact('stages', 'stageClass', 'project'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function create($project_id, $stage_id)
    {
        if(\Auth::user()->can('Create Task'))
        {
            $project = Project::find($project_id);
            $hrs     = Project::projectHrs($project_id);

            return view('project_task.create', compact('project_id', 'stage_id', 'project', 'hrs'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function store(Request $request, $project_id, $stage_id)
    {
        if(\Auth::user()->can('Create Task'))
        {
            $validator = Validator::make(
                $request->all(), [
                                'name' => 'required',
                                'estimated_hrs' => 'required',
                                'priority' => 'required',
                            ]
            );

            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }

            $usr        = Auth::user();
            $project    = Project::find($project_id);
            $last_stage = $project->first()->id;

            $post               = $request->all();
            $post['project_id'] = $project->id;
            $post['stage_id']   = $stage_id;
            $post['created_by'] = $usr->id;
            $post['start_date']=date("Y-m-d H:i:s", strtotime($request->start_date));
            $post['end_date']=date("Y-m-d H:i:s", strtotime($request->end_date));
            if($stage_id == $last_stage)
            {
            // $post['is_complete'] = 1;
                $post['marked_at']   = date('Y-m-d');
            }
            $task = ProjectTask::create($post);

            //Make entry in activity log
            ActivityLog::create(
                [
                    'user_id' => $usr->id,
                    'project_id' => $project_id,
                    'task_id' => $task->id,
                    'log_type' => 'Create Task',
                    'remark' => json_encode(['title' => $task->name]),
                ]
            );
            return redirect()->back()->with('success', __('Task added successfully.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function show($project_id, $task_id)
    {
        if(\Auth::user()->can('View Task'))
        {
            $allow_progress = Project::find($project_id)->task_progress;
            $task           = ProjectTask::find($task_id);

            return view('project_task.view', compact('task', 'allow_progress'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function edit($project_id, $task_id)
    {
        if(\Auth::user()->can('Edit Task'))
        {
            $project = Project::find($project_id);
            $task    = ProjectTask::find($task_id);
            $hrs     = Project::projectHrs($project_id);

            return view('project_task.edit', compact('project', 'task', 'hrs'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function update(Request $request, $project_id, $task_id)
    {
        if(\Auth::user()->can('Edit Task'))
        {
            $validator = Validator::make(
                $request->all(), [
                                'name' => 'required',
                                'estimated_hrs' => 'required',
                                'priority' => 'required',
                            ]
            );

            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }

            $post = $request->all();
            $task = ProjectTask::find($task_id);
            $task->update($post);

            return redirect()->back()->with('success', __('Task Updated successfully.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function destroy($project_id, $task_id)
    {
        if(\Auth::user()->can('Delete Task'))
        {
            ProjectTask::deleteTask([$task_id]);

            echo json_encode(['task_id' => $task_id]);
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function getStageTasks(Request $request, $stage_id)
    {
        if(\Auth::user()->can('View Task'))
        {
            $count = ProjectTask::where('stage_id', $stage_id)->count();
            echo json_encode($count);
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function changeCom($projectID, $taskId)
    {
        if(\Auth::user()->can('View Task'))
        {
            $project = Project::find($projectID);
            $task    = ProjectTask::find($taskId);

            if($task->is_complete == 0)
            {
                $last_stage        = TaskStage::orderBy('order', 'DESC')->first();
                $task->is_complete = 1;
                $task->marked_at   = date('Y-m-d');
                $task->stage_id    = $last_stage->id;
            }
            else
            {
                $first_stage       = TaskStage::orderBy('order', 'ASC')->first();
                $task->is_complete = 0;
                $task->marked_at   = NULL;
                $task->stage_id    = $first_stage->id;
            }

            $task->save();

            return [
                'com' => $task->is_complete,
                'task' => $task->id,
                'stage' => $task->stage_id,
            ];
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function changeFav($projectID, $taskId)
    {
        if(\Auth::user()->can('View Task'))
        {
            $task = ProjectTask::find($taskId);
            if($task->is_favourite == 0)
            {
                $task->is_favourite = 1;
            }
            else
            {
                $task->is_favourite = 0;
            }

            $task->save();

            return [
                'fav' => $task->is_favourite,
            ];
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function changeProg(Request $request, $projectID, $taskId)
    {
        if(\Auth::user()->can('View Task'))
        {
            $task           = ProjectTask::find($taskId);
            $task->progress = $request->progress;
            $task->save();

            return ['task_id' => $taskId];
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function checklistStore(Request $request, $projectID, $taskID)
    {
        if(\Auth::user()->can('View Task'))
        {
            $request->validate(
                ['name' => 'required']
            );

            $post               = [];
            $post['name']       = $request->name;
            $post['task_id']    = $taskID;
            $post['user_type']  = 'User';
            $post['created_by'] = \Auth::user()->id;
            $post['status']     = 0;

            $checkList            = TaskChecklist::create($post);
            $user                 = $checkList->user;
            $checkList->updateUrl = route(
                'checklist.update', [
                                    $projectID,
                                    $checkList->id,
                                ]
            );
            $checkList->deleteUrl = route(
                'checklist.destroy', [
                                    $projectID,
                                    $checkList->id,
                                ]
            );

            return $checkList->toJson();
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function checklistUpdate($projectID, $checklistID)
    {
        if(\Auth::user()->can('View Task'))
        {
            $checkList = TaskChecklist::find($checklistID);
            if($checkList->status == 0)
            {
                $checkList->status = 1;
            }
            else
            {
                $checkList->status = 0;
            }
            $checkList->save();

            return $checkList->toJson();
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }    
    }

    public function checklistDestroy($projectID, $checklistID)
    {
        if(\Auth::user()->can('View Task'))
        {
            $checkList = TaskChecklist::find($checklistID);
            $checkList->delete();

            return "true";
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }    
    }

    public function commentStoreFile(Request $request, $projectID, $taskID)
    {
        if(\Auth::user()->can('View Task'))
        {
            $request->validate(
                ['file' => 'required|mimes:jpeg,jpg,png,gif,svg,pdf,txt,doc,docx,zip,rar|max:20480']
            );
            $fileName = $taskID . time() . "_" . $request->file->getClientOriginalName();
            $request->file->storeAs('tasks', $fileName);
            $post['task_id']     = $taskID;
            $post['file']        = $fileName;
            $post['name']        = $request->file->getClientOriginalName();
            $post['extension']   = $request->file->getClientOriginalExtension();
            $post['file_size']   = round(($request->file->getSize() / 1024) / 1024, 2) . ' MB';
            $post['created_by']  = \Auth::user()->id;
            $post['user_type']   = 'User';
            $TaskFile            = TaskFile::create($post);
            $user                = $TaskFile->user;
            $TaskFile->deleteUrl = '';
            $TaskFile->deleteUrl = route(
                'comment.destroy.file', [
                                        $projectID,
                                        $taskID,
                                        $TaskFile->id,
                                    ]
            );

            return $TaskFile->toJson();
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }    
    }

    public function commentDestroyFile(Request $request, $projectID, $taskID, $fileID)
    {
        if(\Auth::user()->can('View Task'))
        {
            $commentFile = TaskFile::find($fileID);
            $path        = storage_path('tasks/' . $commentFile->file);
            if(file_exists($path))
            {
                \File::delete($path);
            }
            $commentFile->delete();

            return "true";
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }    
    }

    public function commentDestroy(Request $request, $projectID, $taskID, $commentID)
    {
        if(\Auth::user()->can('View Task'))
        {
            $comment = TaskComment::find($commentID);
            $comment->delete();

            return "true";
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }    
    }

    public function commentStore(Request $request, $projectID, $taskID)
    {
        if(\Auth::user()->can('View Task'))
        {
            $post               = [];
            $post['task_id']    = $taskID;
            $post['comment']    = $request->comment;
            $post['created_by'] = \Auth::user()->id;
            $post['user_type']  = 'User';

            $comment = TaskComment::create($post);
            $user    = $comment->user;
            $user_detail    = $comment->userdetail;

            $comment->deleteUrl = route(
                'comment.destroy', [
                                    $projectID,
                                    $taskID,
                                    $comment->id,
                                ]
            );

            return $comment->toJson();
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }    
    }

    public function updateTaskPriorityColor(Request $request)
    {
        if(\Auth::user()->can('View Task'))
        {
            $task_id = $request->input('task_id');
            $color   = $request->input('color');

            $task = ProjectTask::find($task_id);

            if($task && $color)
            {
                $task->priority_color = $color;
                $task->save();
            }
            echo json_encode(true);
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }    
    }

    public function taskOrderUpdate(Request $request, $project_id)
    {
        if(\Auth::user()->can('View Task'))
        {
            $user    = \Auth::user();
            $project = Project::find($project_id);

            // Save data as per order
            if(isset($request->sort))
            {
                foreach($request->sort as $index => $taskID)
                {
                    if(!empty($taskID))
                    {
                        echo $index . "-" . $taskID;
                        $task        = ProjectTask::find($taskID);
                        $task->order = $index;
                        $task->save();
                    }
                }
            }

            // Update Task Stage
            if($request->new_stage != $request->old_stage)
            {
                $new_stage  = TaskStage::find($request->new_stage);
                $old_stage  = TaskStage::find($request->old_stage);
                $last_stage = $project->first()->id;

                $task           = ProjectTask::find($request->id);
                $task->stage_id = $request->new_stage;
                if($request->new_stage == $last_stage)
                {
                    $task->is_complete = 1;
                    $task->marked_at   = date('Y-m-d');
                }
                else
                {
                    $task->is_complete = 0;
                    $task->marked_at   = NULL;
                }
                $task->save();

                // Make Entry in activity log
                ActivityLog::create(
                    [
                        'user_id' => $user->id,
                        'project_id' => $project_id,
                        'task_id' => $request->id,
                        'log_type' => 'Move Task',
                        'remark' => json_encode(
                            [
                                'title' => $task->name,
                                'old_stage' => $old_stage->name,
                                'new_stage' => $new_stage->name,
                            ]
                        ),
                    ]
                );

                return $task->toJson();
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }   
    }

    public function taskGet($task_id)
    {
        if(\Auth::user()->can('View Task'))
        {
            $task        = ProjectTask::find($task_id);

            $html = '';
            $html .= '<div class="card-body"><div class="row align-items-center mb-2">';
            $html .= '<div class="col-6">';
            $html .= '<span class="badge badge-pill badge-xs badge-' . ProjectTask::$priority_color[$task->priority] . '">' . ProjectTask::$priority[$task->priority] . '</span>';
            $html .= '</div>';
            $html .= '<div class="col-6 text-right">';
            if(str_replace('%', '', $task->taskProgress()['percentage']) > 0)
            {
                $html .= '<span class="text-sm">' . $task->taskProgress()['percentage'] . '</span>';
            }
            if(\Auth::user()->can('View Task') || \Auth::user()->can('Edit Task') || \Auth::user()->can('Delete Task'))
            {
                $html .= '<div class="dropdown action-item">
                                                            <a href="#" class="action-item" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">';
                if(\Auth::user()->can('View Task'))
                {
                    $html .= '<a href="#" data-url="' . route(
                            'projects.tasks.show', [
                                                    $task->project_id,
                                                    $task->id,
                                                ]
                        ) . '" data-ajax-popup-right="true" class="dropdown-item">' . __('View') . '</a>';
                }
                if(\Auth::user()->can('Edit Task'))
                {
                    $html .= '<a href="#" data-url="' . route(
                            "projects.tasks.edit", [
                                                    $task->project_id,
                                                    $task->id,
                                                ]
                        ) . '" data-ajax-popup="true" data-size="lg" data-title="' . __("Edit ") . $task->name . '" class="dropdown-item">' . __('Edit') . '</a>';
                }
                if(\Auth::user()->can('Delete Task'))
                {
                    $html .= '<a href="#" class="dropdown-item del_task" data-url="' . route(
                            'projects.tasks.destroy', [
                                                        $task->project_id,
                                                        $task->id,
                                                    ]
                        ) . '">' . __('Delete') . '</a>';
                }
                $html .= '                                 </div>
                                                        </div>
                                                    </div>';
                $html .= '</div>';
            }
            $html .= '<a class="h6" href="#" data-url="' . route(
                    "projects.tasks.show", [
                                            $task->project_id,
                                            $task->id,
                                        ]
                ) . '" data-ajax-popup-right="true">' . $task->name . '</a>';
            $html .= '<div class="row align-items-center">';
            $html .= '<div class="col-12">';
            $html .= '<div class="actions d-inline-block">';
            if(count($task->taskFiles) > 0)
            {
                $html .= '<div class="action-item mr-2"><i class="fas fa-paperclip mr-2"></i>' . count($task->taskFiles) . '</div>';
            }
            if(count($task->comments) > 0)
            {
                $html .= '<div class="action-item mr-2"><i class="fas fa-comment-alt mr-2"></i>' . count($task->comments) . '</div>';
            }
            if($task->checklist->count() > 0)
            {
                $html .= '<div class="action-item mr-2"><i class="fas fa-tasks mr-2"></i>' . $task->countTaskChecklist() . '</div>';
            }
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="col-5">';
            if(!empty($task->end_date) && $task->end_date != '0000-00-00')
            {
                $clr  = (strtotime($task->end_date) < time()) ? 'text-danger' : '';
                $html .= '<small class="' . $clr . '">' . date("d M Y", strtotime($task->end_date)) . '</small>';
            }
            $html .= '</div>';
            $html .= '<div class="col-7 text-right">';

            if($users = $task->users())
            {
                $html .= '<div class="avatar-group">';
                foreach($users as $key => $user)
                {
                    if($key < 3)
                    {
                        $html .= ' <a href="#" class="avatar rounded-circle avatar-sm">';
                        $html .= '<img ' . $user->userdetail->img_image . ' title="' . $user->name . '">';
                        $html .= '</a>';
                    }
                }

                if(count($users) > 3)
                {
                    $html .= '<a href="#" class="avatar rounded-circle avatar-sm"><img avatar="';
                    $html .= count($users) - 3;
                    $html .= '"></a>';
                }
                $html .= '</div>';
            }
            $html .= '</div></div></div>';

            print_r($html);
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }   
    }

    public function getDefaultTaskInfo(Request $request, $task_id)
    {
        if(\Auth::user()->can('View Task'))
        {
            $response = [];
            $task     = ProjectTask::find($task_id);
            if($task)
            {
                $response['task_name']     = $task->name;
                $response['task_due_date'] = $task->due_date;
            }

            return json_encode($response);
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }   
    }
}
