{{ Form::open(['url' => 'projects', 'method' => 'post','enctype' => 'multipart/form-data']) }}
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('project_name', __('Project Name'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('project_name', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('start_date', __('Start Date'), ['class' => 'form-control-label']) }}
            {{ Form::text('start_date', null, ['class' => 'form-control datepicker']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('end_date', __('End Date'), ['class' => 'form-control-label']) }}
            {{ Form::text('end_date', null, ['class' => 'form-control datepicker']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('project_image', __('Project Image'), ['class' => 'form-control-label']) }}
            <input type="file" name="project_image" id="image" class="custom-input-file" accept="image/*">
            <label for="image">
                <i class="fa fa-upload"></i>
                <span>Choose a file…</span>
            </label>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('budget', __('Budget'), ['class' => 'form-control-label']) }}
            {{ Form::number('budget', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('tag', __('Tag'), ['class' => 'form-control-label']) }}
            {{ Form::text('tag', null, ['class' => 'form-control', 'data-toggle' => 'tags']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('status', __('Status'), ['class' => 'form-control-label']) }}
            <select name="status" id="status" class="form-control main-element">
                @foreach(\App\Project::$project_status as $k => $v)
                    <option value="{{$k}}">{{__($v)}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}