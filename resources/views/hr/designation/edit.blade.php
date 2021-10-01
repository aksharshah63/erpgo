{{ Form::model($designation, ['route' => ['designations.update', $designation->id], 'method' => 'PUT']) }}
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('title', __('Title'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
