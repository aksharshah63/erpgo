{{ Form::open(['url' => 'performance_comments', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('reference_date', __('Reference Date'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('reference_date', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('reviwer', __('Reviwer'), ['class' => 'form-control-label']) }}
            {{ Form::select('reviwer', $userList, null, ['class' => 'form-control main-element']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('comments', __('Comments'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('comments', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
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
