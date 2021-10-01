<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $fillable=
    [
        'policy_name',
        'description',
        'department',
        'created_by'
    ];

    public function departmentDesc()
    {
        return $this->hasOne('App\Department','id','department');
    }
}
