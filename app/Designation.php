<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable=['title','description','created_by'];

    public function user_details()
    {
        return $this->hasMany('App\UserDetail','designation','id');
    }
}
