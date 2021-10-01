{{ Form::model($LogActivity, ['route' => ['log_activities.update', $LogActivity->id], 'method' => 'PUT']) }}
<div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            {{ Form::label('select_type', __('Select Type'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            <select name="select_type" id="select_type" class="form-control main-element" required>
                <option value="">{{__('Please Select')}}</option>
                @foreach(\App\LogActivity::$type as $k => $v)
                    <option value="{{$k}}" {{ ($LogActivity->type == $k) ? 'selected' : ''}}>{{__($v)}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            {{ Form::label('start_date', __('Start Date'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('start_date', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            {{ Form::label('time', __('Time'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::time('time', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('note', __('Note'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::textarea('note', null, ['class' => 'form-control editor', 'rows' => '4', 'cols' => '50', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Update', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
