<?php

namespace App;

use App\Vendor;
use App\Project;
use App\Taxrate;
use App\Customer;
use App\TaskStage;
use Carbon\Carbon;
use App\BankAccount;
use App\ChartOfAccount;
use Carbon\CarbonPeriod;
use App\ChartOfAccountType;
use App\ChartOfAccountSubType;
use App\Mail\CommonEmailTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Utility extends Model
{
    // get Setting
    public static function settings()
    {
        $data = \DB::table('settings');
        if(\Auth::check())
        {
            $userId = \Auth::user()->creatorId();
            $data   = $data->where('created_by', '=', $userId);
        }
        else
        {
            $data = $data->where('created_by', '=', 1);
        }
        $data     = $data->get();
        $settings = [
            "site_currency" => "USD",
            "site_currency_symbol" => "$",
            "site_currency_symbol_position" => "pre",
            "site_date_format" => "M j, Y",
            "site_time_format" => "g:i A",
            "company_name" => "",
            "company_address" => "",
            "company_city" => "",
            "company_state" => "",
            "company_zipcode" => "",
            "company_country" => "",
            "company_telephone" => "",
            "company_email" => "",
            "company_email_from_name" => "",
            "invoice_prefix" => "#INVO",
            "invoice_color" => "ffffff",
            "proposal_prefix" => "#PROP",
            "user_prefix" => "#USER",
            //"proposal_color" => "ffffff",
            "bill_prefix" => "#BILL",
            "bill_color" => "ffffff",
            "customer_prefix" => "#CUST",
            "vender_prefix" => "#VEND",
            "footer_title" => "",
            "footer_notes" => "",
            "invoice_template" => "template1",
            "bill_template" => "template1",
            //"proposal_template" => "template1",
           // "registration_number" => "",
            //"vat_number" => "",
            "default_language" => "en",
            //"enable_stripe" => "",
            //"enable_paypal" => "",
            //"paypal_mode" => "",
           // "paypal_client_id" => "",
            //"paypal_secret_key" => "",
           // "stripe_key" => "",
           // "stripe_secret" => "",
            "decimal_number" => "2",
            "tax_type" => "",
           // "shipping_display" => "on",
            "journal_prefix" => "#JUR",
            "display_landing_page" => "on",
            "footer_link_title_1"=>"Support",
            "footer_link_href_1"=>"#",
            "footer_link_title_2"=>"Terms",
            "footer_link_href_2"=>"#",
            "footer_link_title_3"=>"Privacy",
            "footer_link_href_3"=>"#",
            "enable_landing"=>"yes"
        ];

        foreach($data as $row)
        {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }

    public static function getValByName($key)
    {
        $setting = self::settings();

        if(!isset($setting[$key]) || empty($setting[$key]))
        {
            $setting[$key] = '';
        }

        return $setting[$key];
    }

    // Error Format
    public static function errorFormat($errors){
        $err = '';
        
        foreach($errors->all() as $msg)
        {
            $err .= $msg.'<br>';
        }

        return $err;
    }

    // Get languages
    public static function languages()
    {
        $dir     = base_path() . '/resources/lang/';
        $glob    = glob($dir . "*", GLOB_ONLYDIR);
        $arrLang = array_map(
            function ($value) use ($dir){
                return str_replace($dir, '', $value);
            }, $glob
        );
        $arrLang = array_map(
            function ($value) use ($dir){
                return preg_replace('/[0-9]+/', '', $value);
            }, $arrLang
        );
        $arrLang = array_filter($arrLang);

        return $arrLang;
    }

    // Check File is exist and delete these
    public static function checkFileExistsnDelete(array $files)
    {
        $status = false;
        foreach($files as $key => $file)
        {
            if(Storage::exists($file))
            {
                $status = Storage::delete($file);
            }
        }

        return $status;
    }

    // Save Settings on .env file
    public static function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str     = file_get_contents($envFile);
        if(count($values) > 0)
        {
            foreach($values as $envKey => $envValue)
            {
                $keyPosition       = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine           = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                // If key does not exist, add it
                if(!$keyPosition || !$endOfLinePosition || !$oldLine)
                {
                    $str .= "{$envKey}='{$envValue}'\n";
                }
                else
                {
                    $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        $str .= "\n";
        if(!file_put_contents($envFile, $str))
        {
            return false;
        }

        return true;
    }

    // for invoice number format
    public static function invoiceNumberFormat($settings, $number)
    {
        //return '#' . sprintf("%05d", $number);
        return $settings["invoice_prefix"] . sprintf("%05d", $number);
    }

    // get date formated
    public static function getDateFormated($date)
    {
        if(!empty($date) && $date != '0000-00-00')
        {
            return date(self::getValByName('site_date_format'), strtotime($date));
        }
        else
        {
            return '';
        }
    }
    public static function dateFormat($settings, $date)
    {
        return date($settings['site_date_format'], strtotime($date));
    }

    public static function timeFormat($time)
    {
        return date(self::getValByName('site_time_format'), strtotime($time));
    }

    public static function proposalNumberFormat($settings, $number)
    {
        return $settings["proposal_prefix"] . sprintf("%05d", $number);
    }

    public static function priceFormat($settings, $price)
    {
        return (($settings['site_currency_symbol_position'] == "pre") ? $settings['site_currency_symbol'] : '') . number_format($price, Utility::getValByName('decimal_number')) . (($settings['site_currency_symbol_position'] == "post") ? $settings['site_currency_symbol'] : '');
    }

    public static function customerProposalNumberFormat($number)
    {
        $settings = Utility::settings();

        return $settings["proposal_prefix"] . sprintf("%05d", $number);
    }

    public static function customerInvoiceNumberFormat($number)
    {
        $settings = Utility::settings();

        return $settings["invoice_prefix"] . sprintf("%05d", $number);
    }

    public static function billNumberFormat($settings, $number)
    {
        return $settings["bill_prefix"] . sprintf("%05d", $number);
    }

    public static function vendorBillNumberFormat($number)
    {
        $settings = Utility::settings();

        return $settings["bill_prefix"] . sprintf("%05d", $number);
    }


    // For Delete Directory
    public static function delete_directory($dir)
    {
        if(!file_exists($dir))
        {
            return true;
        }

        if(!is_dir($dir))
        {
            return unlink($dir);
        }

        foreach(scandir($dir) as $item)
        {
            if($item == '.' || $item == '..')
            {
                continue;
            }

            if(!self::delete_directory($dir . DIRECTORY_SEPARATOR . $item))
            {
                return false;
            }

        }

        return rmdir($dir);
    }

    // Get Two Dates Different (true = remove sunday)
    public static function diffDate($from,$to,$removeSunday = false)
    {
        $from = date("Y-m-d H:i:s", strtotime($from));
        $to = date("Y-m-d H:i:s", strtotime($to)); 
        $datetime1 = new \DateTime($from);
        $datetime2 = new \DateTime($to);
        $interval = $datetime1->diff($datetime2);
        $day = $interval->format('%a')+1;
        $days = $datetime1->diff($datetime2, true)->days;

        if($removeSunday == true)
        {
            $sundays = intval($days / 7) + ($datetime1->format('N') + $days % 7 >= 7);
            $available_days = $day - $sundays;
            return $available_days;
        }
        else
        {
            return $days;
        }
    }

    public static function tax($taxes)
    {

        $taxArr = explode(',', $taxes);
        $taxes  = [];
        foreach($taxArr as $tax)
        {
            if(!empty($tax))
            {
                $taxes[] = Taxrate::find($tax);
            }
            else
            {
                $taxes;
            }
            
        }

        return $taxes;
    }

    public static function totalTaxRate($taxes)
    {

        $taxArr  = explode(',', $taxes);
        
        $taxRate = 0;

        foreach($taxArr as $tax)
        {

            $tax     = Taxrate::find($tax);
            $taxRate += !empty($tax->tax_rate) ? $tax->tax_rate : 0;
        }

        return $taxRate;
    }

    public static function taxRate($taxRate, $price, $quantity)
    {
        return ($taxRate / 100) * ($price * $quantity);
    }

    public static function userBalance($users, $id, $amount, $type)
    {
        
        if($users == 'customer')
        {
            $user = Customer::find($id);
        }
        else
        {
            $user = Vendor::find($id);
        }

        if(!empty($user))
        {
            if($type == 'credit')
            {
                $oldBalance    = $user->balance;
                $user->balance = $oldBalance + $amount;
                $user->save();
            }
            elseif($type == 'debit')
            {
                $oldBalance    = $user->balance;
                $user->balance = $oldBalance - $amount;
                $user->save();
            }
        }
    }

    public static function bankAccountBalance($id, $amount, $type)
    {
        $bankAccount = BankAccount::find($id);
        if($bankAccount)
        {
            if($type == 'credit')
            {
                $oldBalance                   = $bankAccount->opening_balance;
                $bankAccount->opening_balance = $oldBalance + $amount;
                $bankAccount->save();
            }
            elseif($type == 'debit')
            {
                $oldBalance                   = $bankAccount->opening_balance;
                $bankAccount->opening_balance = $oldBalance - $amount;
                $bankAccount->save();
            }
        }

    }


    public static $chartOfAccountType = [
        'assets' => 'Assets',
        'liabilities' => 'Liabilities',
        'expenses' => 'Expenses',
        'income' => 'Income',
        'equity' => 'Equity',
    ];


    public static $chartOfAccountSubType = array(
        "assets" => array(
            '1' => 'Current Asset',
            '2' => 'Fixed Asset',
            '3' => 'Inventory',
            '4' => 'Non-current Asset',
            '5' => 'Prepayment',
            '6' => 'Bank & Cash',
            '7' => 'Depreciation',
        ),
        "liabilities" => array(
            '1' => 'Current Liability',
            '2' => 'Liability',
            '3' => 'Non-current Liability',
        ),
        "expenses" => array(
            '1' => 'Direct Costs',
            '2' => 'Expense',
        ),
        "income" => array(
            '1' => 'Revenue',
            '2' => 'Sales',
            '3' => 'Other Income',
        ),
        "equity" => array(
            '1' => 'Equity',
        ),

    );

    

    public static $chartOfAccount = array(

        [
            'code' => '120',
            'name' => 'Accounts Receivable',
            'type' => 1,
            'sub_type' => 1,
        ],
        [
            'code' => '160',
            'name' => 'Computer Equipment',
            'type' => 1,
            'sub_type' => 2,
        ],
        [
            'code' => '150',
            'name' => 'Office Equipment',
            'type' => 1,
            'sub_type' => 2,
        ],
        [
            'code' => '140',
            'name' => 'Inventory',
            'type' => 1,
            'sub_type' => 3,
        ],
        [
            'code' => '857',
            'name' => 'Budget - Finance Staff',
            'type' => 1,
            'sub_type' => 6,
        ],
        [
            'code' => '170',
            'name' => 'Accumulated Depreciation',
            'type' => 1,
            'sub_type' => 7,
        ],
        [
            'code' => '200',
            'name' => 'Accounts Payable',
            'type' => 2,
            'sub_type' => 8,
        ],
        [
            'code' => '205',
            'name' => 'Accruals',
            'type' => 2,
            'sub_type' => 8,
        ],
        [
            'code' => '150',
            'name' => 'Office Equipment',
            'type' => 2,
            'sub_type' => 8,
        ],
        [
            'code' => '855',
            'name' => 'Clearing Account',
            'type' => 2,
            'sub_type' => 8,
        ],
        [
            'code' => '235',
            'name' => 'Employee Benefits Payable',
            'type' => 2,
            'sub_type' => 8,
        ],
        [
            'code' => '236',
            'name' => 'Employee Deductions payable',
            'type' => 2,
            'sub_type' => 8,
        ],
        [
            'code' => '255',
            'name' => 'Historical Adjustments',
            'type' => 2,
            'sub_type' => 8,
        ],
        [
            'code' => '835',
            'name' => 'Revenue Received in Advance',
            'type' => 2,
            'sub_type' => 8,
        ],
        [
            'code' => '260',
            'name' => 'Rounding',
            'type' => 2,
            'sub_type' => 8,
        ],
        [
            'code' => '500',
            'name' => 'Costs of Goods Sold',
            'type' => 3,
            'sub_type' => 11,
        ],
        [
            'code' => '600',
            'name' => 'Advertising',
            'type' => 3,
            'sub_type' => 12,
        ],
        [
            'code' => '644',
            'name' => 'Automobile Expenses',
            'type' => 3,
            'sub_type' => 12,
        ],
        [
            'code' => '684',
            'name' => 'Bad Debts',
            'type' => 3,
            'sub_type' => 12,
        ],
        [
            'code' => '810',
            'name' => 'Bank Revaluations',
            'type' => 3,
            'sub_type' => 12,
        ],
        [
            'code' => '605',
            'name' => 'Bank Service Charges',
            'type' => 3,
            'sub_type' => 12,
        ],
        [
            'code' => '615',
            'name' => 'Consulting & Accounting',
            'type' => 3,
            'sub_type' => 12,
        ],
        [
            'code' => '700',
            'name' => 'Depreciation',
            'type' => 3,
            'sub_type' => 12,
        ],
        [
            'code' => '628',
            'name' => 'General Expenses',
            'type' => 3,
            'sub_type' => 12,
        ],
        [
            'code' => '460',
            'name' => 'Interest Income',
            'type' => 4,
            'sub_type' => 13,
        ],
        [
            'code' => '470',
            'name' => 'Other Revenue',
            'type' => 4,
            'sub_type' => 13,
        ],
        [
            'code' => '475',
            'name' => 'Purchase Discount',
            'type' => 4,
            'sub_type' => 13,
        ],
        [
            'code' => '400',
            'name' => 'Sales',
            'type' => 4,
            'sub_type' => 13,
        ],
        [
            'code' => '330',
            'name' => 'Common Stock',
            'type' => 5,
            'sub_type' => 16,
        ],
        [
            'code' => '300',
            'name' => 'Owners Contribution',
            'type' => 5,
            'sub_type' => 16,
        ],
        [
            'code' => '310',
            'name' => 'Owners Draw',
            'type' => 5,
            'sub_type' => 16,
        ],
        [
            'code' => '320',
            'name' => 'Retained Earnings',
            'type' => 5,
            'sub_type' => 16,
        ],
    );

    // public static function chartOfAccountTypeData($admin)
    // {
    //     $chartOfAccountTypes = Self::$chartOfAccountType;
    //     foreach($chartOfAccountTypes as $k => $type)
    //     {

    //         $accountType = ChartOfAccountType::create(
    //             [
    //                 'name' => $type,
    //                 'created_by' => $admin->id,
    //             ]
    //         );

    //         $chartOfAccountSubTypes = Self::$chartOfAccountSubType;

    //         foreach($chartOfAccountSubTypes[$k] as $subType)
    //         {
    //             ChartOfAccountSubType::create(
    //                 [
    //                     'name' => $subType,
    //                     'type' => $accountType->id,
    //                 ]
    //             );
    //         }
    //     }
    // }

    // public static function chartOfAccountData($user)
    // {
    //     $chartOfAccounts = Self::$chartOfAccount;
    //     foreach($chartOfAccounts as $account)
    //     {
    //         ChartOfAccount::create(
    //             [
    //                 'code' => $account['code'],
    //                 'name' => $account['name'],
    //                 'type' => $account['type'],
    //                 'sub_type' => $account['sub_type'],
    //                 'is_enabled' => 1,
    //                 'created_by' => $user->id,
    //             ]
    //         );

    //     }
    // }

    public static function default_data($admin)
    {
        $stages = ['Todo','In Progress','Review','Done'];
        $order=0;
        $chartOfAccountTypes = Self::$chartOfAccountType;
        foreach($chartOfAccountTypes as $k => $type)
        {

            $accountType = ChartOfAccountType::create(
                [
                    'name' => $type,
                    'created_by' => $admin->id,
                ]
            );

            $chartOfAccountSubTypes = Self::$chartOfAccountSubType;

            foreach($chartOfAccountSubTypes[$k] as $subType)
            {
                ChartOfAccountSubType::create(
                    [
                        'name' => $subType,
                        'type' => $accountType->id,
                    ]
                );
            }
        }
        $chartOfAccounts = Self::$chartOfAccount;
        foreach($chartOfAccounts as $account)
        {
            ChartOfAccount::create(
                [
                    'code' => $account['code'],
                    'name' => $account['name'],
                    'type' => $account['type'],
                    'sub_type' => $account['sub_type'],
                    'is_enabled' => 1,
                    'created_by' => $admin->id,
                ]
            );

        }

        foreach($stages as $stage)
        {
            TaskStage::create(
                [
                    'name' => $stage,
                    'order' => $order++,
                    'created_by' => $admin->id,
                ]
            );
        }

    }

    public static function random_color_part() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

    // This function is not used anywhere it's just create for set some keyword language base
    public function languageArray(){
            [
                // Contact Lifestage
                __('Customers'),
                __('Leads'),
                __('Opportunities'),
                __('Subscriber'),
                // Contact Source
                __('Advertisement'),
                __('Chat'),
                __('Contact Form'),
                __('Employee Referral'),
                __('External Referral'),
                __('Marketing campaign'),
                __('Newsletter'),
                __('OnlineStore'),
                __('Optin Forms'),
                __('Partner'),
                __('Phone Call'),
                __('Public Relations'),
                __('Sales Mail Alias'),
                __('Search Engine'),
                __('Seminar-Internal'),
                __('Seminar Partner'),
                __('Social Media'),
                __('Trade Show'),
                __('Web Download'),
                __('Web Research'),
                //log activity type
                __('Log A Call'),
                __('Log A Email'),
                __('Log A SMS'),
                __('Log A Meeting'),
                //scheduele type
                __('Meeting'),
                __('Call'),
                //employee type
                __('Full Time'),
                __('Part Time'),
                __('On Contract'),
                __('Temporary'),
                __('Trainee'),
                //employee status
                __('Active'),
                __('Inactive'),
                __('Terminated'),
                __('Deceased'),
                __('Resigned'),
                //source of hire
                __('Direct'),
                __('Referral'),
                __('Web'),
                __('Newspaper'),
                __('Advertisement'),
                __('Social Network'),
                __('Other'),
                //pay type
                 __('Hourly'),
                 __('Daily'),
                 __('Weekly'),
                 __('Biweekly'),
                 __('Monthly'),
                 __('Contract'),
                 //gender
                 __('Male'),
                 __('Female'),
                 __('Other'),
                 //marital status
                  __('Single'),
                  __('Married'),
                  __('Widowed'),
                  //performance_review
                  __('Very Bad'),
                  __('Poor'),
                  __('Average'),
                  __('Good'),
                  __('Excellent'),
                  //send announcement to
                  __('All Users'),
                  __('Selected User'),
                  __('By Department'),
                  __('By Designation'),
                  //product_category type
                  __('Product & Service'),
                  __('Income'),
                  __('Expense'),
                  //product_type
                  __('Inventory'),
                  __('Service'),
                  //project_status
                 __('On Hold'),
                 __('In Progress'),
                 __('Complete'),
                 __('Canceled'),
                 //project status_color
                 __('warning'),
                 __('info'),
                 __('success'),
                 __('danger'),
                //project task priority
                __('Critical'),
                __('High'),
                __('Medium'),
                __('Low'),
            ];
    }

    public static function templateData()
    {
        $arr              = [];
        $arr['colors']    = [
            '003580',
            '666666',
            '6676ef',
            'f50102',
            'f9b034',
            'fbdd03',
            'c1d82f',
            '37a4e4',
            '8a7966',
            '6a737b',
            '050f2c',
            '0e3666',
            '3baeff',
            '3368e6',
            'b84592',
            'f64f81',
            'f66c5f',
            'fac168',
            '46de98',
            '40c7d0',
            'be0028',
            '2f9f45',
            '371676',
            '52325d',
            '511378',
            '0f3866',
            '48c0b6',
            '297cc0',
            'ffffff',
            '000',
        ];
        $arr['templates'] = [
            "template1" => "New York",
            "template2" => "Toronto",
            "template3" => "Rio",
            "template4" => "London",
            "template5" => "Istanbul",
            "template6" => "Mumbai",
            "template7" => "Hong Kong",
            "template8" => "Tokyo",
            "template9" => "Sydney",
            "template10" => "Paris",
        ];

        return $arr;
    }

    public static function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3)
        {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        }
        else
        {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array(
            $r,
            $g,
            $b,
        );

        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }

    public static function getFontColor($color_code)
    {
        $rgb = self::hex2rgb($color_code);
        $R   = $G = $B = $C = $L = $color = '';

        $R = (floor($rgb[0]));
        $G = (floor($rgb[1]));
        $B = (floor($rgb[2]));

        $C = [
            $R / 255,
            $G / 255,
            $B / 255,
        ];

        for($i = 0; $i < count($C); ++$i)
        {
            if($C[$i] <= 0.03928)
            {
                $C[$i] = $C[$i] / 12.92;
            }
            else
            {
                $C[$i] = pow(($C[$i] + 0.055) / 1.055, 2.4);
            }
        }

        $L = 0.2126 * $C[0] + 0.7152 * $C[1] + 0.0722 * $C[2];

        if($L > 0.179)
        {
            $color = 'black';
        }
        else
        {
            $color = 'white';
        }

        return $color;
    }

    public static function getProgressColor($percentage)
    {
        $color = '';

        if($percentage <= 20)
        {
            $color = 'danger';
        }
        elseif($percentage > 20 && $percentage <= 40)
        {
            $color = 'warning';
        }
        elseif($percentage > 40 && $percentage <= 60)
        {
            $color = 'info';
        }
        elseif($percentage > 60 && $percentage <= 80)
        {
            $color = 'primary';
        }
        elseif($percentage >= 80)
        {
            $color = 'success';
        }

        return $color;
    }

    // Return Percentage from two value
    public static function getPercentage($val1 = 0, $val2 = 0)
    {
        $percentage = 0;
        if($val1 > 0 && $val2 > 0)
        {
            $percentage = intval(($val1 / $val2) * 100);
        }

        return $percentage;
    }

    // get project wise currency formatted amount
    public static function projectCurrencyFormat($project_id, $amount, $decimal = false)
    {
        $project = Project::find($project_id);
        if(empty($project))
        {
            $settings = Utility::settings();

            return (($settings['site_currency_symbol_position'] == "pre") ? $settings['site_currency_symbol'] : '') . number_format($price, Utility::getValByName('decimal_number')) . (($settings['site_currency_symbol_position'] == "post") ? $settings['site_currency_symbol'] : '');
        }

        
    }

     // Return Week first day and last day
     public static function getFirstSeventhWeekDay($week = null)
     {
         $first_day = $seventh_day = null;
         if(isset($week))
         {
             $first_day   = Carbon::now()->addWeeks($week)->startOfWeek();
             $seventh_day = Carbon::now()->addWeeks($week)->endOfWeek();
             //            $first_day   = Carbon::now()->addWeeks($week);
             //            $seventh_day = Carbon::now()->addWeeks($week + 1)->subDays(1);
         }
         $dateCollection['first_day']   = $first_day;
         $dateCollection['seventh_day'] = $seventh_day;
         $period                        = CarbonPeriod::create($first_day, $seventh_day);
         foreach($period as $key => $dateobj)
         {
             $dateCollection['datePeriod'][$key] = $dateobj;
         }
 
         return $dateCollection;
     }


    // Return timesheet sum of array
    public static function calculateTimesheetHours($times)
    {
        $minutes = 0;
        foreach($times as $time)
        {
            list($hour, $minute) = explode(':', $time);
            $minutes += $hour * 60;
            $minutes += $minute;
        }
        $hours   = floor($minutes / 60);
        $minutes -= $hours * 60;

        return sprintf('%02d:%02d', $hours, $minutes);
    }

    public static function timeToHr($times)
    {
        $totaltime = self::calculateTimesheetHours($times);
        $timeArray = explode(':', $totaltime);
        if($timeArray[1] <= '30')
        {
            $totaltime = $timeArray[0];
        }
        $totaltime = $totaltime != '00' ? $totaltime : '0';

        return $totaltime;
    }

    // Return Last 7 Days with date & day name
    public static function getLastSevenDays()
    {
        $arrDuration   = [];
        $previous_week = strtotime("-1 week +1 day");

        for($i = 0; $i < 7; $i++)
        {
            $arrDuration[date('Y-m-d', $previous_week)] = date('D', $previous_week);
            $previous_week                              = strtotime(date('Y-m-d', $previous_week) . " +1 day");
        }

        return $arrDuration;
    }


}
