<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillProduct extends Model
{
    protected $fillable = [
        'product_id',
        'bill_id',
        'quantity',
        'tax',
        'total',
    ];

    public function product(){
        return $this->hasOne('App\ProductAndService', 'id', 'product_id')->first();
    }
}
