<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $fillable = 
    [
        'previous_company',
        'job_tile',
        'from',
        'to',
        'job_description',
        'user_id',
        'created_by'
    ];
    protected $table="work_experience";
}
