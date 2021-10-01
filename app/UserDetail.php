<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable=
    [
        'user_id',
        'image',
        'department',
        'designation',
        'location',
        'reporting_to',
        'source_of_hire',
        'pay_rate',
        'pay_type',
        'father_name',
        'mother_name',
        'mobile',
        'phone',
        'date_of_birth',
        'nationality',
        'gender',
        'marital_status',
        'hobbies',
        'website',
        'address1',
        'address2',
        'city',
        'country',
        'state',
        'zip_code',
        'biography',
        'policy_id'
    ];

    public static $user_type=[
        'permanent' => 'Full Time',
        'parttime' => 'Part Time',
        'contract' => 'On Contract',
        'temporary' => 'Temporary',
        'trainee' => 'Trainee'
    ];

    public static $user_status=[
        'active' => 'Active',
        'inactive' => 'Inactive',
        'terminated' => 'Terminated',
        'deceased' => 'Deceased',
        'resigned' => 'Resigned'
    ];

    public static $source_of_hire=[
        'direct' => 'Direct',
        'referral' => 'Referral',
        'web' => 'Web',
        'newspaper' => 'Newspaper',
        'advertisement' => 'Advertisement',
        'social' => 'Social Network',
        'other' => 'Other'
    ];

    public static $pay_type=[
        'hourly' => 'Hourly',
        'daily' => 'Daily',
        'weekly' => 'Weekly',
        'biweekly' => 'Biweekly',
        'monthly' => 'Monthly',
        'contract' => 'Contract'
    ];

    public static $gender=[
        'male' => 'Male',
        'female' => 'Female',
        'other' => 'Other'
    ];

    public static $marital_status=[
        'single' => 'Single',
        'married' => 'Married',
        'widowed' => 'Widowed'
    ];

    // Change image while fetching
    protected $appends = ['img_image'];

    // Make new attribute for directly get image
    public function getImgImageAttribute()
    {
        if(\Storage::exists($this->image) && !empty($this->image))
        {
            return $this->attributes['img_image'] = 'src=' . asset(\Storage::url($this->image));
        }
        else
        {
            return $this->attributes['img_image'] = 'avatar=' . $this->user->name;
        }
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function departmentDesc()
    {
        return $this->hasOne('App\Department','id','department');
    }
    
    public function designationDesc()
    {
        return $this->hasOne('App\Designation','id','designation');
    }
}
