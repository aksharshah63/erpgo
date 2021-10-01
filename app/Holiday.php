<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = 
    [
        'holiday_name',
        'start_date',
        'range',
        'end_date',
        'description',
        'days',
        'created_by'
    ];
}
