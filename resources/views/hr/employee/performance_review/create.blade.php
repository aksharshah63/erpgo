{{ Form::open(['url' => 'performance_reviews', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('review_date', __('Review Date'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('review_date', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('reporting_to', __('Reporting To'), ['class' => 'form-control-label']) }}
            {{ Form::select('reporting_to', $userList, null, ['class' => 'form-control main-element']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('job_knowledge', __('Job Knowledge'), ['class' => 'form-control-label']) }}
            <select name="job_knowledge" id="job_knowledge" class="form-control main-element">
                <option value="">{{__('Please Select')}}</option>
                @foreach(\App\PerformanceReview::$reviews as $k => $v)
                    <option value="{{$k}}">{{__($v)}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('work_quality', __('Work Quality'), ['class' => 'form-control-label']) }}
            <select name="work_quality" id="work_quality" class="form-control main-element">
                <option value="">{{__('Please Select')}}</option>
                @foreach(\App\PerformanceReview::$reviews as $k => $v)
                    <option value="{{$k}}">{{__($v)}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('attendence_punctuality', __('Attendence/Punctuality'), ['class' => 'form-control-label']) }}
            <select name="attendence_punctuality" id="attendence_punctuality" class="form-control main-element">
                <option value="">{{__('Please Select')}}</option>
                @foreach(\App\PerformanceReview::$reviews as $k => $v)
                    <option value="{{$k}}">{{__($v)}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('communication_listening', __('Communication/Listening'), ['class' => 'form-control-label']) }}
            <select name="communication_listening" id="communication_listening" class="form-control main-element">
                <option value="">{{__('Please Select')}}</option>
                @foreach(\App\PerformanceReview::$reviews as $k => $v)
                    <option value="{{$k}}">{{__($v)}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('dependability', __('Dependability'), ['class' => 'form-control-label']) }}
            <select name="dependability" id="dependability" class="form-control main-element">
                <option value="">{{__('Please Select')}}</option>
                @foreach(\App\PerformanceReview::$reviews as $k => $v)
                    <option value="{{$k}}">{{__($v)}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 pt-5 text-right">
        {{ Form::hidden('id', $id) }}
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
