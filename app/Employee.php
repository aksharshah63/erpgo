<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable=
    [
        'first_name',
        'last_name',
        'employee_id',
        'email',
        'employee_type',
        'employee_status',
        'date_of_hire',
        'created_by'
    ];

    public function employeedetail()
    {
        return $this->hasOne('App\EmployeeDetail');
    }

    public function workexperiences()
    {
        return $this->hasMany('App\WorkExperience','employee_id','id');
    }

    public function educations()
    {
        return $this->hasMany('App\Education','employee_id','id');
    }

    public function notes()
    {
        return $this->hasMany('App\Note','module_id','id');
    }

    public function performance_reviews()
    {
        return $this->hasMany('App\PerformanceReview','employee_id','id');
    }

    public function performance_comments()
    {
        return $this->hasMany('App\PerformanceComment','employee_id','id');
    }

    public function performance_goals()
    {
        return $this->hasMany('App\PerformanceGoal','employee_id','id');
    }

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
             return $this->attributes['img_image'] = 'avatar=' . $this->name;
         }
     }

     
}
