<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProposalProduct extends Model
{
    protected $fillable = [
        'product_id',
        'proposal_id',
        'quantity',
        'tax',
        'total',
    ];

    public function product(){
        //return $this->hasOne('App\ProductAndService', 'id', 'product_id')->first();
        return $this->hasOne('App\ProductAndService', 'id', 'product_id');
    }
}
