<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable= [
        'title',
        'all_day',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'note',
        'agent_or_manager',
        'schedule_type',
        'all_notification',
        'email',
        'module_type',
        'module_id',
        'created_by'
    ];

    public static $schedule_type=[
        'meeting' => 'Meeting',
        'call' => 'Call',
    ];
}
