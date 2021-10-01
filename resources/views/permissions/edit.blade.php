{{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', __('Permission Name')) }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Update', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
{{ Form::close() }}