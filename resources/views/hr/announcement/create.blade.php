{{ Form::open(['url' => 'announcements', 'method' => 'post']) }}
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
            {{ Form::textarea('description', null, ['class' => 'form-control editor', 'rows' => '4', 'cols' => '50']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('send_announcement_to', __('Send Announcement To'), ['class' => 'form-control-label']) }}
            <select name="send_announcement_to" id="send_announcement_to" class="form-control main-element">
                <option value="">{{__('Please Select')}}</option>
                @foreach(\App\Announcement::$send_announcement_to as $k => $v)
                    <option value="{{$k}}">{{__($v)}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 annoucement_choise d-none" id="selected_user">
        <div class="form-group">
            {{ Form::label('select_users', __('Select Users'), ['class' => 'form-control-label']) }}
            {{ Form::select('select_users', $users, null, ['class' => 'form-control main-element select2-dropdown','multiple'=>'multiple','name'=>'select_users[]']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 annoucement_choise d-none" id="by_department">
        <div class="form-group">
            {{ Form::label('by_department', __('By Departments'), ['class' => 'form-control-label']) }}
            {{ Form::select('by_department', $departments, null, ['class' => 'form-control main-element select2-dropdown','multiple'=>'multiple','name'=>'by_department[]']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 annoucement_choise d-none" id="by_designation">
        <div class="form-group">
            {{ Form::label('by_designation', __('By Designation'), ['class' => 'form-control-label']) }}
            {{ Form::select('by_designation', $designations, null, ['class' => 'form-control main-element select2-dropdown','multiple'=>'multiple','name'=>'by_designation[]']) }}
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
