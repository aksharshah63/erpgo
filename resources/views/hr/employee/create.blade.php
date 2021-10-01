{{ Form::open(['url' => 'users', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                    aria-controls="general" aria-selected="true">{{ __('General info') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="other-tab" data-toggle="tab" href="#other" role="tab" aria-controls="other"
                    aria-selected="false">{{ __('Work') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">{{ __('Personal Details') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="additional-tab" data-toggle="tab" href="#additional" role="tab"
                    aria-controls="additional" aria-selected="false">{{ __('Additional info') }}</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{ Form::label('name', __('Name'), ['class' => 'form-control-label']) }}<span
                                class="text-danger">*</span>
                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('email', __('Email'), ['class' => 'form-control-label']) }}<span
                                class="text-danger">*</span>
                            {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('password', __('Password'), ['class' => 'form-control-label']) }}<span
                                class="text-danger">*</span>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('user_type', __('User Type'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            <select name="user_type" id="user_type" class="form-control main-element" required >
                                <option value="">{{__('Please Select')}}</option>
                                @foreach(\App\UserDetail::$user_type as $k => $v)
                                    <option value="{{$k}}">{{__($v)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('user_status', __('User Status'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            <select name="user_status" id="user_status" class="form-control main-element" required >
                                <option value="">{{__('Please Select')}}</option>
                                @foreach(\App\UserDetail::$user_status as $k => $v)
                                    <option value="{{$k}}">{{__($v)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('date_of_hire', __('Date of Hire'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            {{ Form::text('date_of_hire', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('role', __('Role'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            <select name="role" class="form-control main-element" required id="role">
                                <option value="">{{__('Select Role')}}</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('department', __('Department'), ['class' => 'form-control-label']) }}
                            {{ Form::select('department', $departments, null, ['class' => 'form-control main-element']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('designation', __('Designation'), ['class' => 'form-control-label']) }}
                            {{ Form::select('designation', $designations, null, ['class' => 'form-control main-element']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('location', __('Location'), ['class' => 'form-control-label']) }}
                            {{ Form::text('location', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('reporting_to', __('Reporting To'), ['class' => 'form-control-label']) }}
                            {{ Form::select('reporting_to', $userList, null, ['class' => 'form-control main-element']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('source_of_hire', __('Source of Hire'), ['class' => 'form-control-label']) }}
                            <select name="source_of_hire" id="source_of_hire" class="form-control main-element">
                                <option value="">{{__('Please Select')}}</option>
                                @foreach(\App\UserDetail::$source_of_hire as $k => $v)
                                    <option value="{{$k}}">{{__($v)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('pay_rate', __('Pay Rate'), ['class' => 'form-control-label']) }}
                            {{ Form::number('pay_rate', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('pay_type', __('Pay Type'), ['class' => 'form-control-label']) }}
                            <select name="pay_type" id="pay_type" class="form-control main-element">
                                <option value="">{{__('Please Select')}}</option>
                                @foreach(\App\UserDetail::$pay_type as $k => $v)
                                    <option value="{{$k}}">{{__($v)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('father_name', __('Father Name'), ['class' => 'form-control-label']) }}
                            {{ Form::text('father_name', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('mother_name', __('Mother Name'), ['class' => 'form-control-label']) }}
                            {{ Form::text('mother_name', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('mobile', __('Mobile'), ['class' => 'form-control-label']) }}
                            {{ Form::number('mobile', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('phone', __('Phone'), ['class' => 'form-control-label']) }}
                            {{ Form::number('phone', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('date_of_birth', __('Date Of Birth'), ['class' => 'form-control-label']) }}
                            {{ Form::text('date_of_birth', null, ['class' => 'form-control datepicker']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('nationality', __('Nationality'), ['class' => 'form-control-label']) }}
                            {{ Form::text('nationality', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('gender', __('Gender'), ['class' => 'form-control-label']) }}
                            <select name="gender" id="gender" class="form-control main-element">
                                <option value="">{{__('Please Select')}}</option>
                                @foreach(\App\UserDetail::$gender as $k => $v)
                                    <option value="{{$k}}">{{__($v)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('marital_status', __('Marital Status'), ['class' => 'form-control-label']) }}
                            <select name="marital_status" id="marital_status" class="form-control main-element">
                                <option value="">{{__('Please Select')}}</option>
                                @foreach(\App\UserDetail::$marital_status as $k => $v)
                                    <option value="{{$k}}">{{__($v)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('hobbies', __('Hobbies'), ['class' => 'form-control-label']) }}
                            {{ Form::text('hobbies', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('website', __('Website'), ['class' => 'form-control-label']) }}
                            {{ Form::text('website', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('address1', __('Address1'), ['class' => 'form-control-label']) }}
                            {{ Form::text('address1', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('address2', __('Address2'), ['class' => 'form-control-label']) }}
                            {{ Form::text('address2', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('city', __('City'), ['class' => 'form-control-label']) }}
                            {{ Form::text('city', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('country', __('Country'), ['class' => 'form-control-label']) }}
                            {{ Form::text('country', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('state', __('State'), ['class' => 'form-control-label']) }}
                            {{ Form::text('state', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('zip_code', __('Zip Code'), ['class' => 'form-control-label']) }}
                            {{ Form::text('zip_code', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{ Form::label('biography', __('Biography'), ['class' => 'form-control-label']) }}
                            {{ Form::textarea('biography', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
