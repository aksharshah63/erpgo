<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $fillable = [
        'product_id',
        'invoice_id',
        'quantity',
        'tax',
        'total',
    ];

    public function product(){
        return $this->hasOne('App\ProductAndService', 'id', 'product_id')->first();
    }
}
