<?php

namespace App\Http\Controllers;

use Stripe;
use App\Bill;
use App\User;
use App\Email;
use App\Company;
use App\Contact;
use App\Holiday;
use App\Invoice;
use App\Payment;
use App\Utility;
use App\Schedule;
use App\Department;
use App\BankAccount;
use App\Designation;
use App\Announcement;
use App\CompanyDetail;
use App\ContactDetail;
use App\ProductCategory;
use App\CalenderSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use \RachidLaasri\LaravelInstaller\Helpers\MigrationsHelper;

    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check())
        {
            $customers = ContactDetail::where('life_stage','Customers')->count();
                $leads =  ContactDetail::where('life_stage','Leads')->count();
                $opportunities = ContactDetail::where('life_stage','Opportunities')->count();
                $subscriber = ContactDetail::where('life_stage','Subscriber')->count();
                $result = $customers+$leads+$opportunities+$subscriber;

                $contact_life_stage=[
                    'customers' => $customers,
                    'leads' => $leads,
                    'opportunities' => $opportunities,
                    'subscriber' => $subscriber,
                    'result' => $result
                ];
                
                $company_customers = CompanyDetail::where('life_stage','Customers')->count();
                $company_leads =  CompanyDetail::where('life_stage','Leads')->count();
                $company_opportunities = CompanyDetail::where('life_stage','Opportunities')->count();
                $company_subscriber = CompanyDetail::where('life_stage','Subscriber')->count();
                $result = $company_customers+$company_leads+$company_opportunities+$company_subscriber;

                $company_life_stage=[
                    'customers' => $company_customers,
                    'leads' => $company_leads,
                    'opportunities' => $company_opportunities,
                    'subscriber' => $company_subscriber,
                    'result' => $result
                ];

            $contacts = Contact::where('created_by',\Auth::user()->creatorId())->orderBy('id', 'desc')->take(5)->get();
            $companies = Company::where('created_by',\Auth::user()->creatorId())->orderBy('id', 'desc')->take(5)->get();

            $schedules = Schedule::where('created_by',\Auth::user()->creatorId())->where('start_date',date("Y-m-d"))->count();
            $upcomingschedules = Schedule::where('created_by',\Auth::user()->creatorId())->where('start_date','>',date("Y-m-d"))->count();

            $emails = Email::where('created_by',\Auth::user()->creatorId())->count();
            
            $schedules1 = CalenderSchedule::where('created_by',\Auth::user()->creatorId())->get();
                $arrschedules = [];
                foreach($schedules1 as $schedule){
                    $arschedules = [];
                    if((!empty($schedule->date) && $schedule->date != '0000-00-00'))
                    {
                        $arschedules['id']    = $schedule->id;
                        $arschedules['title'] = $schedule->time.' - '.ucfirst(str_replace('_',' ',$schedule->type));

                        if(!empty($schedule->date) && $schedule->date != '0000-00-00')
                        {
                            $arschedules['date'] = $schedule->date;
                        }

                        $arschedules['allDay']      = !0;
                        $arschedules['text'] = $schedule->note;
                        $arschedules['url']         = route('calender_schedules.show', $schedule->id);
                        $arschedules['color'] = '#011c4b';
                        $arrschedules[] = $arschedules;
                    }
                }

                return view('crm.dashboard',compact('contact_life_stage','company_life_stage','contacts','companies','schedules','upcomingschedules','emails','arrschedules'));
        }
        else
        {
            if(!file_exists(storage_path() . "/installed"))
            {
                header('location:install');
                die;
            }
            else
            {
                if(Utility::getValByName('enable_landing') == 'yes')
                {
                    return view('layouts.landing');
                }
                else
                {
                    return redirect()->route('login');
                }
            }
        }
            
    }

    public function hr_dashboard()
    {
        $userlist =User::where('created_by', \Auth::user()->creatorId())->get()->count();
        $departmentlist = Department::where('created_by', \Auth::user()->creatorId())->get()->count();
        $designationlist = Designation::where('created_by', \Auth::user()->creatorId())->get()->count();
        $announcements = Announcement::where('created_by', \Auth::user()->creatorId())->orderBy('title', 'desc')->take(5)->get();

        $holidays = Holiday::where('created_by', \Auth::user()->creatorId())->get();
        if(count($holidays) > 0)
        {
            foreach($holidays as $holiday){
                $arschedules = [];
                if((!empty($holiday->start_date) && $holiday->start_date != '0000-00-00') || (!empty($holiday->end_date) && $holiday->end_date != '0000-00-00'))
                {
                    $arschedules['id']    = $holiday->id;
                    $arschedules['title'] = $holiday->holiday_name;
                    $arschedules['start'] = $holiday->start_date;
                    $arschedules['end'] = date('Y-m-d H:i:s', strtotime($holiday->end_date . ' +1 day'));
                    $arschedules['color'] = '#FF5354';
                    $arschedules['allDay']      = !0;
                    //$arschedules['url']         = url('employees/'.$employee->id);
                $arrschedules[] = $arschedules;
                }
            }
            return view('hr.dashboard',compact('userlist','departmentlist','designationlist','announcements','arrschedules'));
        }
        else
        {
            $arrschedules='';
        }
        return view('hr.dashboard',compact('userlist','departmentlist','designationlist','announcements','arrschedules'));
    }

    public function accounting_dashboard()
    {
        $customers = Auth::user()->customers->where('created_by',\Auth::user()->creatorId())->count();
        $vendors = Auth::user()->vendors->where('created_by',\Auth::user()->creatorId())->count();
        $invoices = Invoice::where('created_by',\Auth::user()->creatorId())->count();
        $bills = Bill::where('created_by',\Auth::user()->creatorId())->count();
        $bankaccounts = BankAccount::where('created_by', '=', \Auth::user()->creatorId())->get();

        $incomeCategory = ProductCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 1)->get();
        $inColor        = array();
        $inCategory     = array();
        $inAmount       = array();
        for($i = 0; $i < count($incomeCategory); $i++)
        {
            $inColor[]    = $incomeCategory[$i]->color;
            $inCategory[] = $incomeCategory[$i]->name;
            $inAmount[]   = $incomeCategory[$i]->incomeCategoryAmount();
        }


        $data['incomeCategoryColor'] = $inColor;
        $data['incomeCategory']      = $inCategory;
        $data['incomeCatAmount']     = $inAmount;

        $expenseCategory = ProductCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 2)->get();
        $exColor         = array();
        $exCategory      = array();
        $exAmount        = array();
        for($i = 0; $i < count($expenseCategory); $i++)
        {
            $exColor[]    = $expenseCategory[$i]->color;
            $exCategory[] = $expenseCategory[$i]->name;
            $exAmount[]   = $expenseCategory[$i]->expenseCategoryAmount();
        }

        $data['expenseCategoryColor'] = $exColor;
        $data['expenseCategory']      = $exCategory;
        $data['expenseCatAmount']     = $exAmount;

        $data['incExpLineChartData'] = \Auth::user()->getIncExpLineChartDate();
        $data['incExpBarChartData']  = \Auth::user()->getincExpBarChartData();

        $data['currentYear']  = date('Y');

        $data['latestIncome']  = Invoice::where('created_by', '=', \Auth::user()->creatorId())->orderBy('id', 'desc')->limit(5)->get();
        $data['latestExpense'] = Payment::where('created_by', '=', \Auth::user()->creatorId())->orderBy('id', 'desc')->limit(5)->get();

        $data['weeklyInvoice']     = \Auth::user()->weeklyInvoice();
        $data['monthlyInvoice']    = \Auth::user()->monthlyInvoice();
        $data['recentInvoice']     = Invoice::where('created_by', '=', \Auth::user()->creatorId())->orderBy('id', 'desc')->limit(5)->get();

        $data['recentBill']        = Bill::where('created_by', '=', \Auth::user()->creatorId())->orderBy('id', 'desc')->limit(5)->get();
        $data['weeklyBill']        = \Auth::user()->weeklyBill();
        $data['monthlyBill']       = \Auth::user()->monthlyBill();
        return view('accounting.dashboard',compact('customers','vendors','invoices','bills','bankaccounts','data'));
    }
}
