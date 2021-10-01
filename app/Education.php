<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable=
    [
        'school_name',
        'degree',
        'field_of_study',
        'year_of_completion',
        'description',
        'user_id',
        'created_by'
    ];
}
