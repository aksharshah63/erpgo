
    {{ Form::open(array('route' => array('test.send.mail'))) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('email', __('Email')) }}
            {{ Form::text('email', '', array('class' => 'form-control','required'=>'required')) }}
            @error('email')
            <span class="invalid-email" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-12  text-right">
        <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="{{__('Save')}}">
    </div>
    {{ Form::close() }}
