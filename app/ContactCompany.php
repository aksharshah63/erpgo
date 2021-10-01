<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactCompany extends Model
{
    protected $table = 'contacts_companies';
    
    protected $fillable = ['contact_id', 'company_id', 'created_by'];
}
