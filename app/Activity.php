<?php

namespace App;

use App\Company;
use App\Contact;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public static function get_activity($module_type,$module_id)
    {
        $result=['name'=>'-'];
        if($module_type=='contact')
        {
            $contact= Contact::where('id',$module_id)->orderBy('id','desc')->first();
            if($contact)
            {
                $result =['name' => $contact->name];
            }
        }
        elseif($module_type=='company')
        {
            $company= Company::where('id',$module_id)->orderBy('id','desc')->first();
            if($company)
                {
                    $result =['name' => $company->name];
                }
        }
        elseif($module_type=='employee')
        {
            $employee= Employee::where('id',$module_id)->orderBy('id','desc')->first();
            if($employee)
                {
                    $result =['name' => $employee->first_name.' '.$employee->last_name];
                }
        }
        return $result;
    }
}
