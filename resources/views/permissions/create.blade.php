{{ Form::open(array('url' => 'permissions')) }}

    <div class="form-group">
        {{ Form::label('name', __('Permission Name')) }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('roles', __('Assign Roles',['class'=>'form-label'])) }}
        <div class="row gutters-xs">

            @foreach ($roles as $role)
                <div class="col-6 custom-control custom-checkbox">
                    {{ Form::checkbox('roles[]',$role->id,false,['class' => 'custom-control-input','id'=>'permission_'.$role->id]) }}
                    {{ Form::label('permission_'.$role->id, ucfirst($role->name),['class'=>'custom-control-label ml-4']) }}
                </div>
            @endforeach

        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
{{ Form::close() }}
