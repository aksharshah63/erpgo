{{ Form::open(['url' => 'policy/store', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-12 col-md-12" id="selected_employee">
        <div class="form-group">
            {{ Form::label('policy', __('Policy'), ['class' => 'form-control-label']) }}
            {{ Form::select('policy', $policies, null, ['class' => 'form-control main-element select2-dropdown','multiple'=>'multiple','name'=>'policy[]']) }}
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::hidden('id', $id) }}
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}