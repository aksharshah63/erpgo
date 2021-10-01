<?php

namespace App;

use App\Taxrate;
use Illuminate\Database\Eloquent\Model;

class ProductAndService extends Model
{
    protected $fillable=
    [
        'product_name',
        'product_type',
        'category',
        'cost_price',
        'sale_price',
        'owner',
        'vendor_id',
        'tax_rate_id',
        'created_by'
    ];

    public static $product_type=[
        'inventory' => 'Inventory',
        'service' => 'Service'
    ];

    public function productcategory()
    {
        return $this->hasOne('App\ProductCategory','id','category');
    } 

    public function tax()
    {
        return $this->hasOne('App\Taxrate','id','tax_rate_id');
    } 

    public function taxRate($taxes)
    {
        $taxArr  = explode(',', $taxes);
        $taxRate = 0;
        foreach($taxArr as $tax)
        {
            if(!empty($tax)){
                $tax     = Taxrate::find($tax);
                $taxRate += $tax->tax_rate;
            }
            else{
                $taxRate;
            }
            
        }
        return $taxRate;
    }

    public function taxs($taxes)
    {
        $taxArr = explode(',', $taxes);

        $taxes  = [];
        foreach($taxArr as $tax)
        {
            $taxes[] = Taxrate::find($tax);
        }

        return $taxes;
    }
}
