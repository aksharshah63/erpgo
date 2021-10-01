<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable=
    [
        'vendor_id',
        'first_name',
        'last_name',
        'email',
        'created_by'
    ];

    public function vendordetail()
    {
        return $this->hasOne('App\VendorDetail');
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

    public function vendorTotalBillSum($vendorId)
    {
        $bills = Bill:: where('vendor_id', $vendorId)->get();
        $total = 0;
        foreach($bills as $bill)
        {
            $total += $bill->getTotal();
        }

        return $total;
    }

    public function vendorTotalBill($vendorId)
    {
        $bills = Bill:: where('vendor_id', $vendorId)->count();

        return $bills;
    }

    public function vendorOverdue($vendorId)
    {
        $dueBill = Bill:: where('vendor_id', $vendorId)->whereNotIn(
            'status', [
                        '0',
                        '4',
                    ]
        )->where('due_date', '<', date('Y-m-d'))->get();
        $due     = 0;
        foreach($dueBill as $bill)
        {
            $due += $bill->getDue();
        }

        return $due;
    }

    public function vendorInvoice($vendorId)
    {
        $bills  = Bill:: where('vendor_id', $vendorId)->orderBy('transaction_date', 'desc')->get();

        return $bills;
    }

}
