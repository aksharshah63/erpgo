<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceGoal extends Model
{
    protected $fillable=
    [
        'user_id',
        'set_date',
        'completion_date',
        'goal_description',
        'employee_assessment',
        'supervisor',
        'supervisor_assessment',
        'created_by'
    ];

    public function user()
    {
        return $this->hasOne('App\User','id','supervisor');
    }
}
