<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $fillable =[
        'type',
        'start_date',
        'time',
        'note',
        'module_type',
        'module_id',
        'created_by'
    ];

    public static $type=[
        'log_a_call' => 'Log A Call',
        'log_a_email' => 'Log A Email',
        'log_a_sms' => 'Log A SMS',
        'log_a_meeting' => 'Log A Meeting'
    ];
}