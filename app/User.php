<?php

namespace App;

use App\Bill;
use App\Invoice;
use App\Payment;
use App\Utility;
use App\ProjectTask;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'email',
        'user_type',
        'user_status',
        'date_of_hire',
        'email',
        'password',
        'role',
        'website',
        'profile',
        'username',
        'created_by',
        'lang'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userdetail()
    {
        return $this->hasOne('App\UserDetail');
    }

    public function workexperiences()
    {
        return $this->hasMany('App\WorkExperience','user_id','id');
    }

    public function educations()
    {
        return $this->hasMany('App\Education','user_id','id');
    }

    public function emp_notes()
    {
        return $this->hasMany('App\Note','module_id','id');
    }

    public function performance_reviews()
    {
        return $this->hasMany('App\PerformanceReview','user_id','id');
    }

    public function performance_comments()
    {
        return $this->hasMany('App\PerformanceComment','user_id','id');
    }

    public function performance_goals()
    {
        return $this->hasMany('App\PerformanceGoal','user_id','id');
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

    public function contactdetail()
    {
        return $this->hasOne('App\ContactDetail');
    }

    public function contact_groups()
    {
        return $this->hasMany('App\ContactGroup','created_by','id');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact','created_by','id');
    }

    public function companydetail()
    {
        return $this->hasOne('App\CompanyDetail');
    }

    public function companies()
    {
        return $this->hasMany('App\Company','created_by','id');
    }
    
    public function calenderschedule()
    {
        return $this->hasMany('App\CalenderSchedule','created_by','id');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule','created_by','id');
    }

    public function notes()
    {
        return $this->hasMany('App\Note','created_by','id');
    }

    public function departments()
    {
        return $this->hasMany('App\Department','created_by','id');
    }

    public function designations()
    {
        return $this->hasMany('App\Designation','created_by','id');
    }

    public function users()
    {
        return $this->hasMany('App\User','created_by','id');
    }

    // public function userdetail()
    // {
    //     return $this->hasOne('App\UserDetail');
    // }

    public function announcements()
    {
        return $this->hasMany('App\Announcement','created_by','id');
    }

    public function holidays()
    {
        return $this->hasMany('App\Holiday','created_by','id');
    }

    public function policies()
    {
        return $this->hasMany('App\Policy','created_by','id');
    }

    public function leave_requests()
    {
        return $this->hasMany('App\LeaveRequest','created_by','id');
    }

    public function customerdetail()
    {
        return $this->hasOne('App\CustomerDetail');
    }

    public function customers()
    {
        return $this->hasMany('App\Customer','created_by','id');
    }

    public function vendordetail()
    {
        return $this->hasOne('App\VendorDetail');
    }

    public function vendors()
    {
        return $this->hasMany('App\Vendor','created_by','id');
    }

    public function product_categories()
    {
        return $this->hasMany('App\ProductCategory','created_by','id');
    }

    public function productandservices()
    {
        return $this->hasMany('App\ProductAndService','created_by','id');
    }

    public function payment_methods()
    {
        return $this->hasMany('App\PaymentMethod','created_by','id');
    }

    public function taxrates()
    {
        return $this->hasMany('App\Taxrate','created_by','id');
    }

    public function bank_aacounts()
    {
        return $this->hasMany('App\BankAccount','created_by','id');
    }

    public function bank_transfers()
    {
        return $this->hasMany('App\Transfer','created_by','id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment','created_by','id');
    }

    public function creatorId()
    {
        if($this->type == 'company' || $this->type == 'Admin')
        {
            return $this->id;
        }
        else
        {
            return $this->created_by;
        }
    }

    public function invoiceNumberFormat($number)
    {
        $settings = Utility::settings();

        return $settings["invoice_prefix"] . sprintf("%05d", $number);
    }

    public function priceFormat($price)
    {
        $settings = Utility::settings();

        return (($settings['site_currency_symbol_position'] == "pre") ? $settings['site_currency_symbol'] : '') . number_format($price, Utility::getValByName('decimal_number')) . (($settings['site_currency_symbol_position'] == "post") ? $settings['site_currency_symbol'] : '');
    }

    public function journalNumberFormat($number)
    {
        $settings = Utility::settings();

        return $settings["journal_prefix"] . sprintf("%05d", $number);
    }

    public function currencySymbol()
    {
        $settings = Utility::settings();

        return $settings['site_currency_symbol'];
    }

    public function proposalNumberFormat($number)
    {
        $settings = Utility::settings();

        return $settings["proposal_prefix"] . sprintf("%05d", $number);
    }

    public function customerNumberFormat($number)
    {
        $settings = Utility::settings();

        return $settings["customer_prefix"] . sprintf("%05d", $number);
    }

    public function vendorNumberFormat($number)
    {
        $settings = Utility::settings();

        return $settings["vender_prefix"] . sprintf("%05d", $number);
    }

    public function billNumberFormat($number)
    {
        $settings = Utility::settings();

        return $settings["bill_prefix"] . sprintf("%05d", $number);
    }

    public function userNumberFormat($number)
    {
        $settings = Utility::settings();

        return $settings["user_prefix"] . sprintf("%05d", $number);
    }

    public function footer_link_title_1()
    {
        $settings = Utility::settings();

        return $settings['footer_link_title_1'];
    }

    public function footer_link_title_2()
    {
        $settings = Utility::settings();

        return $settings['footer_link_title_2'];
    }

    public function footer_link_title_3()
    {
        $settings = Utility::settings();

        return $settings['footer_link_title_3'];
    }

    public function todayIncome()
    {
        $invoices     = Invoice:: select('*')->where('created_by', \Auth::user()->creatorId())->whereRAW('Date(send_date) = CURDATE()')->get();
        $invoiceArray = array();
        foreach($invoices as $invoice)
        {
            $invoiceArray[] = $invoice->getTotal();
        }
        $totalIncome = (!empty($invoiceArray) ? array_sum($invoiceArray) : 0);

        return $totalIncome;
    }

    public function todayExpense()
    {
        $payment = Payment::where('created_by', '=', $this->creatorId())->where('created_by', \Auth::user()->creatorId())->whereRaw('Date(date) = CURDATE()')->sum('amount');

        $bills = Bill:: select('*')->where('created_by', \Auth::user()->creatorId())->whereRAW('Date(send_date) = CURDATE()')->get();

        $billArray = array();
        foreach($bills as $bill)
        {
            $billArray[] = $bill->getTotal();
        }

        $totalExpense = (!empty($payment) ? $payment : 0) + (!empty($billArray) ? array_sum($billArray) : 0);

        return $totalExpense;
    }

    public function incomeCurrentMonth()
    {
        $currentMonth = date('m');

        $invoices = Invoice:: select('*')->where('created_by', \Auth::user()->creatorId())->whereRAW('MONTH(send_date) = ?', [$currentMonth])->get();

        $invoiceArray = array();
        foreach($invoices as $invoice)
        {
            $invoiceArray[] = $invoice->getTotal();
        }
        $totalIncome = (!empty($invoiceArray) ? array_sum($invoiceArray) : 0);

        return $totalIncome;

    }

    public function expenseCurrentMonth()
    {
        $currentMonth = date('m');

        $payment = Payment::where('created_by', '=', $this->creatorId())->whereRaw('MONTH(date) = ?', [$currentMonth])->sum('amount');

        $bills     = Bill:: select('*')->where('created_by', \Auth::user()->creatorId())->whereRAW('MONTH(send_date) = ?', [$currentMonth])->get();
        $billArray = array();
        foreach($bills as $bill)
        {
            $billArray[] = $bill->getTotal();
        }

        $totalExpense = (!empty($payment) ? $payment : 0) + (!empty($billArray) ? array_sum($billArray) : 0);

        return $totalExpense;
    }

    public function weeklyInvoice()
    {
        $staticstart  = date('Y-m-d', strtotime('last Week'));
        $currentDate  = date('Y-m-d');
        $invoices     = Invoice:: select('*')->where('created_by', \Auth::user()->creatorId())->where('transaction_date', '>=', $staticstart)->where('transaction_date', '<=', $currentDate)->get();
        $invoiceTotal = 0;
        $invoicePaid  = 0;
        $invoiceDue   = 0;
        foreach($invoices as $invoice)
        {
            $invoiceTotal += $invoice->getTotal();
            $invoicePaid  += ($invoice->getTotal() - $invoice->getDue());
            $invoiceDue   += $invoice->getDue();
        }

        $invoiceDetail['invoiceTotal'] = $invoiceTotal;
        $invoiceDetail['invoicePaid']  = $invoicePaid;
        $invoiceDetail['invoiceDue']   = $invoiceDue;

        return $invoiceDetail;
    }

    public function monthlyInvoice()
    {
        $staticstart  = date('Y-m-d', strtotime('last Month'));
        $currentDate  = date('Y-m-d');
        $invoices     = Invoice:: select('*')->where('created_by', \Auth::user()->creatorId())->where('transaction_date', '>=', $staticstart)->where('transaction_date', '<=', $currentDate)->get();
        $invoiceTotal = 0;
        $invoicePaid  = 0;
        $invoiceDue   = 0;
        foreach($invoices as $invoice)
        {
            $invoiceTotal += $invoice->getTotal();
            $invoicePaid  += ($invoice->getTotal() - $invoice->getDue());
            $invoiceDue   += $invoice->getDue();
        }

        $invoiceDetail['invoiceTotal'] = $invoiceTotal;
        $invoiceDetail['invoicePaid']  = $invoicePaid;
        $invoiceDetail['invoiceDue']   = $invoiceDue;

        return $invoiceDetail;
    }

    public function weeklyBill()
    {
        $staticstart = date('Y-m-d', strtotime('last Week'));
        $currentDate = date('Y-m-d');
        $bills       = Bill:: select('*')->where('created_by', \Auth::user()->creatorId())->where('transaction_date', '>=', $staticstart)->where('transaction_date', '<=', $currentDate)->get();
        $billTotal   = 0;
        $billPaid    = 0;
        $billDue     = 0;
        foreach($bills as $bill)
        {
            $billTotal += $bill->getTotal();
            $billPaid  += ($bill->getTotal() - $bill->getDue());
            $billDue   += $bill->getDue();
        }

        $billDetail['billTotal'] = $billTotal;
        $billDetail['billPaid']  = $billPaid;
        $billDetail['billDue']   = $billDue;

        return $billDetail;
    }

    public function monthlyBill()
    {
        $staticstart = date('Y-m-d', strtotime('last Month'));
        $currentDate = date('Y-m-d');
        $bills       = Bill:: select('*')->where('created_by', \Auth::user()->creatorId())->where('transaction_date', '>=', $staticstart)->where('transaction_date', '<=', $currentDate)->get();
        $billTotal   = 0;
        $billPaid    = 0;
        $billDue     = 0;
        foreach($bills as $bill)
        {
            $billTotal += $bill->getTotal();
            $billPaid  += ($bill->getTotal() - $bill->getDue());
            $billDue   += $bill->getDue();
        }

        $billDetail['billTotal'] = $billTotal;
        $billDetail['billPaid']  = $billPaid;
        $billDetail['billDue']   = $billDue;

        return $billDetail;
    }
    public function getIncExpLineChartDate()
    {
        $usr           = \Auth::user();
        $m             = date("m");
        $de            = date("d");
        $y             = date("Y");
        $format        = 'Y-m-d';
        $arrDate       = [];
        $arrDateFormat = [];

        for($i = 0; $i <= 15 - 1; $i++)
        {
            $date = date($format, mktime(0, 0, 0, $m, ($de - $i), $y));

            $arrDay[]        = date('D', mktime(0, 0, 0, $m, ($de - $i), $y));
            $arrDate[]       = $date;
            $arrDateFormat[] = date("d-M", strtotime($date));;
        }
        $dataArr['day'] = $arrDateFormat;
        for($i = 0; $i < count($arrDate); $i++)
        {
            $invoices     = Invoice:: select('*')->where('created_by', \Auth::user()->creatorId())->whereRAW('send_date = ?', $arrDate[$i])->get();
            $invoiceArray = array();
            foreach($invoices as $invoice)
            {
                $invoiceArray[] = $invoice->getTotal();
            }

            $incomeAmount[] = (!empty($invoiceArray) ? array_sum($invoiceArray) : 0);
            //$incomeArr[]  = number_format($incomeAmount, 2);

            $dayExpense = Payment::selectRaw('sum(amount) amount')->where('created_by', \Auth::user()->creatorId())->whereRaw('date = ?', $arrDate[$i])->first();

            $bills     = Bill:: select('*')->where('created_by', \Auth::user()->creatorId())->whereRAW('send_date = ?', $arrDate[$i])->get();
            $billArray = array();
            foreach($bills as $bill)
            {
                $billArray[] = $bill->getTotal();
            }
            $expenseAmount[] = (!empty($dayExpense->amount) ? $dayExpense->amount : 0) + (!empty($billArray) ? array_sum($billArray) : 0);
            // $expenseArr[]  = number_format($expenseAmount, 2);;
        }

        $dataArr['income']  = $incomeAmount;
        $dataArr['income_color']  = '#28a745';
        $dataArr['expense'] = $expenseAmount;
        $dataArr['expense_color']  = '#dc3545';

        return $dataArr;
    }
    
    public function getincExpBarChartData()
    {
        $month[]          = __('January');
        $month[]          = __('February');
        $month[]          = __('March');
        $month[]          = __('April');
        $month[]          = __('May');
        $month[]          = __('June');
        $month[]          = __('July');
        $month[]          = __('August');
        $month[]          = __('September');
        $month[]          = __('October');
        $month[]          = __('November');
        $month[]          = __('December');
        $dataArr['month'] = $month;


        for($i = 1; $i <= 12; $i++)
        {
            $invoices      = Invoice:: select('*')->where('created_by', \Auth::user()->creatorId())->whereRaw('year(`send_date`) = ?', array(date('Y')))->whereRaw('month(`send_date`) = ?', $i)->get();

            $invoiceArray = array();
            foreach($invoices as $invoice)
            {
                $invoiceArray[] = $invoice->getTotal();
            }
            $totalIncome = (!empty($invoiceArray) ? array_sum($invoiceArray) : 0);


            $incomeArr[] = !empty($totalIncome) ? $totalIncome : 0;

            $monthlyExpense = Payment::selectRaw('sum(amount) amount')->where('created_by', '=', $this->creatorId())->whereRaw('year(`date`) = ?', array(date('Y')))->whereRaw('month(`date`) = ?', $i)->first();
            $bills          = Bill:: select('*')->where('created_by', \Auth::user()->creatorId())->whereRaw('year(`send_date`) = ?', array(date('Y')))->whereRaw('month(`send_date`) = ?', $i)->get();
            $billArray      = array();
            foreach($bills as $bill)
            {
                $billArray[] = $bill->getTotal();
            }

            $totalExpense = (!empty($monthlyExpense) ? $monthlyExpense->amount : 0) + (!empty($billArray) ? array_sum($billArray) : 0);

            $expenseArr[] = !empty($totalExpense) ? $totalExpense : 0;
        }

        $dataArr['income']  = $incomeArr;
        $dataArr['income_color']  = '#28a745';
        $dataArr['expense'] = $expenseArr;
        $dataArr['expense_color']  = '#dc3545';

        return $dataArr;


    }

    public function projects()
    {
        return $this->belongsToMany('App\Project', 'project_users', 'user_id', 'project_id');
    }

    public function project_user()
    {
        return $this->hasMany('App\ProjectUser', 'user_id', 'id');
    }

    // Get task users
    public function tasks()
    {
        return ProjectTask::whereRaw("find_in_set('" . $this->id . "',assign_to)")->get();
    }
}
