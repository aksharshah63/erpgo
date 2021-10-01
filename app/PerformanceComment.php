<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceComment extends Model
{
    protected $fillable=
    [
        'user_id',
        'reference_date',
        'reviwer',
        'comments',
        'created_by'
    ];

    public function user()
    {
        return $this->hasOne('App\User','id','reviwer');
    }
}
