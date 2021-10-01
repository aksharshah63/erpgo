@component('mail::message')
<span><b>{{__('Description')}}</b></span> : <span>{{ strip_tags($details['description']) }}</span><br/>

{{__('Thanks,')}}<br>
{{ config('app.name') }}
@endcomponent
