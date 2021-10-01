<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalenderSchedule extends Model
{
    protected $fillable = ['type', 'date', 'time', 'note', 'created_by'];
}
