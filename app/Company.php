<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name','email','created_by'];

    public function con_owner_name()
    {
        return $this->hasOne('App\User','id','contact_owner');
    }

    public static $lifestage=[
        'Customers' => 'Customers',
        'Leads' => 'Leads',
        'Opportunities' => 'Opportunities',
        'Subscriber' => 'Subscriber'
    ];

    public static $contactsource=[
        'advert' => 'Advertisement',
        'chat' => 'Chat',
        'contact_form' => 'Contact Form',
        'employee_referral' => 'Employee Referral',
        'external_referral' => 'External Referral',
        'marketing_campaign' => 'Marketing campaign',
        'newsletter' => 'Newsletter',
        'online_store' => 'OnlineStore',
        'optin_form' => 'Optin Forms',
        'partner' => 'Partner',
        'phone' => 'Phone Call',
        'public_relations' => 'Public Relations',
        'sales_mail_alias' => 'Sales Mail Alias',
        'search_engine' => 'Search Engine',
        'seminar_internal' => 'Seminar-Internal',
        'seminar_partner' => 'Seminar Partner',
        'social_media' => 'Social Media',
        'trade_show' => 'Trade Show',
        'web_download' => 'Web Download',
        'web_research' => 'Web Research'
    ];

    public function companydetail()
    {
        return $this->hasOne('App\CompanyDetail');
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

    public function schedules()
    {
        return $this->hasMany('App\Schedule','module_id','id')->where('module_type','LIKE','company');
    }

    public function notes()
    {
        return $this->hasMany('App\Note','module_id','id')->where('module_type','LIKE','company');
    }

    public function logactivities()
    {
        return $this->hasMany('App\LogActivity','module_id','id')->where('module_type','LIKE','company');
    }

    public function emails()
    {
        return $this->hasMany('App\Email','module_id','id')->where('module_type','LIKE','company');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task','module_id','id')->where('module_type','LIKE','company');
    }

    public function tag()
    {
        return $this->hasOne('App\Tag','module_id','id')->where('module_type','LIKE','company');
    }
}
