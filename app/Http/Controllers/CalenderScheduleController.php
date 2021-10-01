<?php

namespace App\Http\Controllers;

use App\Company;
use App\Contact;
use App\Utility;
use App\LogActivity;
use App\CalenderSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalenderScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Schedules'))
        {
            $schedules = CalenderSchedule::where('created_by',\Auth::user()->creatorId())->get();
            $arrschedules = [];
            foreach($schedules as $schedule){
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

            $allSchedules = [];
            $arrContact = Contact::where('created_by',\Auth::user()->creatorId())->get()->pluck('id')->toArray();
            $objContacts = LogActivity::where('created_by',\Auth::user()->creatorId())->where('module_type','LIKE','contact')->whereIn('module_id',$arrContact)->get();
            
            foreach($objContacts as $objContact){
                $allSchedule=[];
                if((!empty($objContact->start_date) && $objContact->start_date != '0000-00-00'))
                {                    
                    $allSchedule['id']    = $objContact->id;
                    $allSchedule['title'] = $objContact->time.' - '.ucfirst(str_replace('_',' ',$objContact->type));

                    if(!empty($objContact->start_date) && $objContact->start_date != '0000-00-00')
                    {
                        $allSchedule['date'] = $objContact->start_date;
                    }

                    $allSchedule['allDay']      = !0;
                    $allSchedule['text'] = $objContact->note;
                    $allSchedule['url']         = route('shedule.log.view', $objContact->id);
                    $allSchedule['color'] = '#011c4b';
                    $allSchedules[] = $allSchedule;
                }
            }

            $arrCompany = Company::where('created_by',\Auth::user()->creatorId())->get()->pluck('id')->toArray();
            $objCompanies = LogActivity::where('created_by',\Auth::user()->creatorId())->where('module_type','LIKE','company')->whereIn('module_id',$arrCompany)->get();
                       
            foreach($objCompanies as $objCompany){
                $allSchedule=[];
                if((!empty($objCompany->start_date) && $objCompany->start_date != '0000-00-00'))
                {                    
                    $allSchedule['id']    = $objCompany->id;
                    $allSchedule['title'] = $objCompany->time.' - '.ucfirst(str_replace('_',' ',$objCompany->type));

                    if(!empty($objCompany->start_date) && $objCompany->start_date != '0000-00-00')
                    {
                        $allSchedule['date'] = $objCompany->start_date;
                    }

                    $allSchedule['allDay']      = !0;
                    $allSchedule['text'] = $objCompany->note;
                    $allSchedule['url']         = route('shedule.log.view', $objCompany->id);
                    $allSchedule['color'] = '#011c4b';
                    $allSchedules[] = $allSchedule;
                }
            }

            $allSchedules = array_merge(array_values($allSchedules),array_values($arrschedules));

            return view('crm.calender_schedule.index',compact('arrschedules','allSchedules'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('Create Schedule'))
        {
            return view('crm.calender_schedule.create');
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Schedule'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'time' => 'required',
                                   'type' => 'required'
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }

            $calenderschedule = new CalenderSchedule();
            $calenderschedule->type = $request->type;
            $calenderschedule->date = $request->date;
            $calenderschedule->time = $request->time;
            $calenderschedule->note = $request->note;
            $calenderschedule->created_by = \Auth::user()->creatorId();
            $calenderschedule->save();
            return redirect()->back()->with('success', __('Schedule Successfully Added.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CalenderSchedule  $calenderSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(CalenderSchedule $calenderSchedule)
    {
        if(\Auth::user()->can('View Schedule'))
        {
            return view('crm.calender_schedule.view',compact('calenderSchedule'));
        } 
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CalenderSchedule  $calenderSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(CalenderSchedule $calenderSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CalenderSchedule  $calenderSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalenderSchedule $calenderSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CalenderSchedule  $calenderSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalenderSchedule $calenderSchedule)
    {
        //
    }

    public function logScheduleView($id){
        if(\Auth::user()->can('View Schedule'))
        {
            $calenderSchedule = LogActivity::find($id);
            if(!empty($calenderSchedule))
            {
                return view('crm.calender_schedule.view',compact('calenderSchedule'));
            }
            else
            {
                return response()->json(['errors' => __('Record Not Found.!')],401);
            }
        } 
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }
}
