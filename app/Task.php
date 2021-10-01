<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable= [
        'title',
        'agent_or_manager',
        'date',
        'time',
        'description',
        'module_type',
        'module_id',
        'created_by'
    ];
}
