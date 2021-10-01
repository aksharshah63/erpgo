<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = 
    [
        'title',
        'description',
        'department_leads',
        'parent_department',
        'created_by'
    ];

    public function user_details()
    {
        return $this->hasMany('App\UserDetail','department','id');
    }

    public function user()
    {
        return $this->hasOne('App\User','id','department_leads');
    }

}
