<?php

namespace App\Http\Controllers;

use App\Note;
use App\Email;
use App\Company;
use App\Contact;
use App\Utility;
use App\Schedule;
use App\CompanyDetail;
use App\ContactDetail;
use App\CalenderSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrmReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function crm_activity_report()
    {
        if(\Auth::user()->can('View CRM Activity Report'))
        {
            $schedules = Schedule::where('created_by', '=', \Auth::user()->creatorId())->get()->count();
            $notes = Note::where('created_by', '=', \Auth::user()->creatorId())->get()->count();
            return view('crm.report.activity_report',compact('schedules','notes'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function crm_customer_report()
    {
        if(\Auth::user()->can('View CRM Customer Report'))
        {
            $contactList = Contact::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('id')->toArray();

            $contacts = \DB::table('contact_details')
             ->select(\DB::raw('count(*) as total, life_stage'))->whereIn('contact_id',$contactList)
             ->groupBy('life_stage')
             ->get()->pluck('total','life_stage')->toArray();

             $companyList = Company::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('id')->toArray();

             $companies = \DB::table('company_details')
             ->select(\DB::raw('count(*) as total, life_stage'))->whereIn('company_id',$companyList)
             ->groupBy('life_stage')
             ->get()->pluck('total','life_stage')->toArray();

             $arr = [];
             foreach($contacts as $key => $val)
             {
                $arr[$key] = $val + (isset($companies[$key]) ? $companies[$key] : 0);
             }

             foreach($companies as $key => $val)
             {
                 if(!isset($arr[$key]))
                 {
                    $arr[$key] = $val; 
                 }
             }
            
            return view('crm.report.customer_report',compact('arr'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function crm_growth_report()
    {
        if(\Auth::user()->can('View CRM Growth Report'))
        {
            $months=[];
            $contactList =Contact::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('id')->toArray();
            $companyList = Company::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('id')->toArray();

            for ($m=1; $m<=12; $m++) {
                $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
                $months[] = $month;
            }

            $arrResponse = [];
            $lifeStage = ['red'=>'Opportunities','green'=>'Customers','blue'=>'Leads'];
            foreach($lifeStage as $key => $stage)
            {
                $arrMonth = [];
                for ($m=1; $m<=12; $m++) {
                    $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
                        $contact = ContactDetail::whereIn('contact_id',$contactList)
                        ->whereMonth('created_at', $m)->where('life_stage','LIKE',$stage)
                        ->whereYear('created_at', date('Y'))->count();

                        $company = CompanyDetail::whereIn('company_id',$companyList)
                        ->whereMonth('created_at', $m)->where('life_stage','LIKE',$stage)
                        ->whereYear('created_at', date('Y'))->count();
            
                        $arrMonth[] = $contact + $company;
                }

                $arrResponse[] = [
                    'label' => $stage,
                    'backgroundColor' => Utility::random_color_part(),
                    'data'=> $arrMonth,
                ];
            }
            return view('crm.report.growth_report',compact('arrResponse','months'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function crm_dashboard()
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
}
