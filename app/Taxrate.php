<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxrate extends Model
{
    protected $fillable=
    [
        'name',
        'tax_rate',
        'created_by'
    ];
}
