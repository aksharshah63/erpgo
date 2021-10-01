<?php

namespace App;

use App\Invoice;
use App\Proposal;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable=
    [
        'customer_id',
        'first_name',
        'last_name',
        'email',
        'balance',
        'created_by'
    ];

    public function customerdetail()
    {
        return $this->hasOne('App\CustomerDetail');
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

    public function customerInvoice($customerId)
    {
        $invoices  = Invoice:: where('customer_id', $customerId)->orderBy('transaction_date', 'desc')->get();

        return $invoices;
    }

    public function customerProposal($customerId)
    {
        $proposals = Proposal:: where('customer_id', $customerId)->orderBy('transaction_date', 'desc')->get();

        return $proposals;
    }

    public function customerTotalInvoiceSum($customerId)
    {
        $invoices = Invoice:: where('customer_id', $customerId)->get();
        $total    = 0;
        foreach($invoices as $invoice)
        {
            $total += $invoice->getTotal();
        }

        return $total;
    }

    public function customerTotalInvoice($customerId)
    {
        $invoices = Invoice:: where('customer_id', $customerId)->count();

        return $invoices;
    }

    public function customerOverdue($customerId)
    {
        $dueInvoices = Invoice:: where('customer_id', $customerId)->whereNotIn(
            'status', [
                        '0',
                        '4',
                    ]
        )->where('due_date', '<', date('Y-m-d'))->get();
        $due         = 0;
        foreach($dueInvoices as $invoice)
        {
            $due += $invoice->getDue();
        }

        return $due;
    }

}
