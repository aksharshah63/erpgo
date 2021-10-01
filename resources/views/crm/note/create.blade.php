{{ Form::open(['url' => 'notes', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('note', __('Note'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::textarea('note', null, ['class' => 'form-control editor', 'rows' => '4', 'cols' => '50', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::hidden('type', $type) }}
        {{ Form::hidden('id', $id) }}
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
