<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable=
    [
        'user_id',
        'from',
        'to',
        'reason',
        'created_by',
        'status'
    ];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}
