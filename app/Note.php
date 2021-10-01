<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable =[
        'note',
        'module_type',
        'module_id',
        'created_by'
    ];
}
