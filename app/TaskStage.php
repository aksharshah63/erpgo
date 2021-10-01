<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStage extends Model
{
    protected $fillable=[
        'name',
        'order',
        'created_by'
    ];
}
