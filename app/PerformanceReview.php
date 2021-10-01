<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceReview extends Model
{
    protected $fillable=
    [
        'user_id',
        'review_date',
        'reporting_to',
        'job_knowledge',
        'work_quality',
        'attendence_punctuality',
        'communication_listening',
        'dependability',
        'created_by'
    ];

    public static $reviews = [
        'very bad' => 'Very Bad',
        'poor' => 'Poor',
        'average' => 'Average',
        'good' => 'Good',
        'excellent' => 'Excellent'
    ];

    public function user()
    {
        return $this->hasOne('App\User','id','reporting_to');
    }
}
