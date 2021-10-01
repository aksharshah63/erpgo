<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable=
    [
        'customer_id',
        'proposal_id',
        'transaction_date',
        'send_date',
        'category_id',
        'billing_address',
        'discount_type',
        'discount_value',
        'status',
        'created_by'
    ];

    public static $statues = [
        'Draft',
        //0
        'Open',
        //1
        'Accepted',
        //2
        'Declined',
        //3
        'Close',
        //4
    ];

    public function items()
    {
        return $this->hasMany('App\ProposalProduct', 'proposal_id', 'id');
    }

    public function customer()
    {
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }

    public function tax()
    {
        return $this->hasOne('App\Tax', 'id', 'tax_id');
    }

    public function getSubTotal()
    {
        $subTotal = 0;
        foreach($this->items as $product)
        {
            $subTotal += ($product->price * $product->quantity);
        }

        return $subTotal;
    }
    
    public function getTotalTax()
    {
        $totalTax = 0;
        foreach($this->items as $product)
        {
            $taxes = Utility::totalTaxRate($product->tax);
            $totalTax += ($taxes / 100) * ($product->price * $product->quantity);
        }

        return $totalTax;
    }
    
    public function getTotalDiscount($is_discount=false)
    {
        if($is_discount==true){
            $totalDiscount = $this->discount_value;
        }
        else
        {
            $subTotal=$this->getSubTotal() + $this->getTotalTax();      
            
            $type=$this->discount_type;
        
            if($type=='discount-percent'){
                $totalDiscount = $subTotal - ($this->discount_value / 100) * ($subTotal);
            }else{
                $totalDiscount = $subTotal - $this->discount_value;
            }
        }
        return $totalDiscount;
    }

    public function getTotal()
    {
        return $this->getTotalDiscount();
    }
    

    public function getDue()
    {
        $due = 0;
        // foreach($this->payments as $payment)
        // {
        //     $due += $payment->amount;
        // }
        return $this->getTotal() - $due;
    }

    public static function change_status($proposal_id, $status)
    {

        $proposal         = Proposal::find($proposal_id);
        $proposal->status = $status;
        $proposal->update();
    }

}
