{{ Form::open(array('route' => array('store.language'))) }}
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('code', __('Language Code')) }}
            {{ Form::text('code', '', array('class' => 'form-control','required'=>'required')) }}
            @error('code')
            <span class="invalid-code" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<div class="col-12 pt-5 text-right">
    {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
</div>
{{ Form::close() }}