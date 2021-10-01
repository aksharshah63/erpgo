{{ Form::open(['url' => 'vendors', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                    aria-controls="general" aria-selected="true">{{ __('General info') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="other-tab" data-toggle="tab" href="#other" role="tab" aria-controls="other"
                    aria-selected="false">{{ __('Others info') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="additional-tab" data-toggle="tab" href="#additional" role="tab"
                    aria-controls="additional" aria-selected="false">{{ __('Additional info') }}</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{ Form::label('first_name', __('First Name'), ['class' => 'form-control-label']) }}<span
                                class="text-danger">*</span>
                            {{ Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required']) }}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{ Form::label('last_name', __('Last Name'), ['class' => 'form-control-label']) }}<span
                                class="text-danger">*</span>
                            {{ Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required']) }}
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
                            {{ Form::label('phone_no', __('Phone'), ['class' => 'form-control-label']) }}
                            {{ Form::text('phone_no', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('company', __('Company'), ['class' => 'form-control-label']) }}
                            {{ Form::text('company', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('mobile', __('Mobile'), ['class' => 'form-control-label']) }}
                            {{ Form::number('mobile', null, ['class' => 'form-control']) }}
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
                            {{ Form::label('fax_number', __('Fax'), ['class' => 'form-control-label']) }}
                            {{ Form::number('fax_number', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('address1', __('Address1'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            {{ Form::text('address1', null, ['class' => 'form-control','required' => 'required']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('address2', __('Address2'), ['class' => 'form-control-label']) }}
                            {{ Form::text('address2', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('city', __('City'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            {{ Form::text('city', null, ['class' => 'form-control', 'required' => 'required']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('country', __('Country'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            {{ Form::text('country', null, ['class' => 'form-control', 'required' => 'required']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('province_state', __('Province / State'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            {{ Form::text('province_state', null, ['class' => 'form-control', 'required' => 'required']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('post_code', __('Post Code / Zip Code'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            {{ Form::text('post_code', null, ['class' => 'form-control', 'required' => 'required']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{ Form::label('notes', __('Note'), ['class' => 'form-control-label']) }}
                            {{ Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
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
