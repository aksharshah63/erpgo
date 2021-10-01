@component('mail::message')
<span><b>{{__('Title')}}</b></span> : <span>{{ $details['title'] }}</span><br/>
<span><b>{{__('Start Date')}}</b></span> : <span>{{ $details['start_date'] }}</span><br/>
<span><b>{{__('End Date')}}</b></span> : <span>{{ $details['end_date'] }}</span><br/>
<span><b>{{__('Start Time')}}</b></span> : <span>{{ $details['start_time'] }}</span><br/>
<span><b>{{__('End Time')}}</b></span> : <span>{{ $details['end_time'] }}</span><br/>
<span><b>{{__('Note')}}</b></span> : <span>{{ strip_tags($details['note']) }}</span><br/>
<span><b>{{__('Agent')}}</b></span> : <span>{{ $details['agent_or_manager'] }}</span><br/>
<span><b>{{__('Schedule Type')}}</b></span> : <span>{{ $details['schedule_type'] }}</span><br/>

{{__('Thanks,')}}<br>
{{ config('app.name') }}
@endcomponent
