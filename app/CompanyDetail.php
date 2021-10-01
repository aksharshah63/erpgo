<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    protected $fillable = [
        'phone_no', 
        'image', 
        'life_stage', 
        'contact_owner', 
        'mobile_no', 
        'website', 
        'fax_no', 
        'address1', 
        'address2', 
        'city', 
        'country', 
        'state', 
        'zip_code',
        'assign_group', 
        'contact_source', 
        'others', 
        'notes', 
        'facebook', 
        'twitter', 
        'google_plus', 
        'linkedin'
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
            return $this->attributes['img_image'] = 'avatar=' . $this->company->name;
        }
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'contact_owner', 'id');
    }
}
