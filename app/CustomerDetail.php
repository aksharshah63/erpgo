<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    protected $fillable=
    [
        'customer_id',
        'phone_no',
        'image',
        'company',
        'mobile_no',
        'website',
        'notes',
        'fax_no',
        'address1',
        'address2',
        'city',
        'country',
        'state',
        'post_code'
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
            return $this->attributes['img_image'] = 'avatar=' . $this->customer->first_name;
        }
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
