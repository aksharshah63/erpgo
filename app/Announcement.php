<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable=
    [
        'title',
        'description',
        'send_announcement_to',
        'select_users',
        'by_department',
        'by_designation',
        'created_by'
    ];

    public static $send_announcement_to = 
    [
        'all_user' => 'All Users',
        'selected_user' => 'Selected User',
        'by_department' => 'By Department',
        'by_designation' => 'By Designation'
    ];
}
