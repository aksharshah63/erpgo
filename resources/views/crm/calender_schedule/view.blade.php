<dl class="row p-2">
    <div class="col-4">
        <span class="text-sm text-muted p-2">{{ __('Type') }}</span>
        <span class="d-block h6 mb-0 p-2">{{ucfirst(str_replace('_',' ',$calenderSchedule->type))}}</span>
    </div>
    <div class="col-4">
        <span class="text-sm text-muted p-2">{{ __('Date') }}</span>
        <span class="d-block h6 mb-0 p-2">{{ (isset($calenderSchedule->date) ? $calenderSchedule->date : $calenderSchedule->start_date) }}</span>
    </div>
    <div class="col-4">
        <span class="text-sm text-muted p-2">{{ __('Time') }}</span>
        <span class="d-block h6 mb-0 p-2">{{ (!empty($calenderSchedule->time) ? $calenderSchedule->time : '-') }}</span>
    </div>
</dl>
<dl class="row p-2">
    <div class="col-12">
        <span class="text-sm text-muted p-2">{{ __('Texts') }}</span>
        <span class="d-block h6 mb-0 p-2">
            @if(!empty($calenderSchedule->note))
            {!! $calenderSchedule->note !!}
            @else
                {{'-'}}
            @endif
        </span>
    </div>
</dl>
