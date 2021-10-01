{{ Form::model($contact, ['route' => ['contacts.update', $contact->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
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
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">{{ __('Contact Group') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="additional-tab" data-toggle="tab" href="#additional" role="tab"
                    aria-controls="additional" aria-selected="false">{{ __('Additional info') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="social"
                    aria-selected="false">{{ __('Social info') }}</a>
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
                            {{ Form::label('phone_no', __('Phone Number'), ['class' => 'form-control-label']) }}
                            {{ Form::text('phone_no', (isset($contact->contactdetail->phone_no) ? $contact->contactdetail->phone_no : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('life_stage', __('Life stage'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            <select name="life_stage" id="life_stage" class="form-control main-element" required >
                                <option value="">{{__('Please Select')}}</option>
                                @foreach(\App\Contact::$lifestage as $k => $v)
                                    <option value="{{$k}}" {{ ($contact->contactdetail->life_stage == $k) ? 'selected' : ''}}>{{__($v)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('contact_owner', __('Contact Owner'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            {{ Form::select('contact_owner', $users, $contact->contactdetail->contact_owner, ['class' => 'form-control main-element','required' => 'required']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('dob', __('Date Of Birth'), ['class' => 'form-control-label']) }}
                            {{ Form::text('dob', $contact->contactdetail->date_of_birth, ['class' => 'form-control datepicker']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('age', __('Age (years)'), ['class' => 'form-control-label']) }}
                            {{ Form::number('age', (isset($contact->contactdetail->age) ? $contact->contactdetail->age : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('mobile', __('Mobile'), ['class' => 'form-control-label']) }}
                            {{ Form::number('mobile', (isset($contact->contactdetail->mobile_no) ? $contact->contactdetail->mobile_no : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('website', __('Website'), ['class' => 'form-control-label']) }}
                            {{ Form::text('website', (isset($contact->contactdetail->website) ? $contact->contactdetail->website : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('fax_number', __('Fax Number'), ['class' => 'form-control-label']) }}
                            {{ Form::number('fax_number', (isset($contact->contactdetail->fax_no) ? $contact->contactdetail->fax_no : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('address1', __('Address1'), ['class' => 'form-control-label']) }}
                            {{ Form::text('address1', (isset($contact->contactdetail->address1) ? $contact->contactdetail->address1 : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('address2', __('Address2'), ['class' => 'form-control-label']) }}
                            {{ Form::text('address2', (isset($contact->contactdetail->address2) ? $contact->contactdetail->address2 : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('city', __('City'), ['class' => 'form-control-label']) }}
                            {{ Form::text('city', (isset($contact->contactdetail->city) ? $contact->contactdetail->city : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('country', __('Country'), ['class' => 'form-control-label']) }}
                            {{ Form::text('country', (isset($contact->contactdetail->country) ? $contact->contactdetail->country : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('province_state', __('Province / State'), ['class' => 'form-control-label']) }}
                            {{ Form::text('province_state', (isset($contact->contactdetail->state) ? $contact->contactdetail->state : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('post_code', __('Post Code / Zip Code'), ['class' => 'form-control-label']) }}
                            {{ Form::text('post_code', (isset($contact->contactdetail->zip_code) ? $contact->contactdetail->zip_code : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('assign_group', __('Assign Group'), ['class' => 'form-control-label']) }}
                            @foreach (Auth::user()->contact_groups as $contactgroup)
                                <div class="custom-control custom-checkbox">
                                    {{ Form::checkbox('assign_group[]', $contactgroup->name, in_array($contactgroup->name,explode(",",$contact->contactdetail->assign_group)), ['class' => 'custom-control-input', 'id' => $contactgroup->name]) }}
                                    {{ Form::label($contactgroup->name, $contactgroup->name, ['class' => 'custom-control-label']) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('contact_source', __('Contact Source'), ['class' => 'form-control-label']) }}
                            <select name="contact_source" id="contact_source" class="form-control main-element">
                                <option value="">{{__('Please Select')}}</option>
                                @foreach(\App\Contact::$contactsource as $k => $v)
                                    <option value="{{$k}}" {{ ($contact->contactdetail->contact_source == $k) ? 'selected' : ''}}>{{__($v)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('others', __('Others'), ['class' => 'form-control-label']) }}
                            {{ Form::text('others', (isset($contact->contactdetail->others) ? $contact->contactdetail->others : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('notes', __('Notes'), ['class' => 'form-control-label']) }}
                            {{ Form::textarea('notes', (isset($contact->contactdetail->notes) ? $contact->contactdetail->notes : null), ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('facebook', __('Facebook'), ['class' => 'form-control-label']) }}
                            {{ Form::text('facebook', (isset($contact->contactdetail->facebook) ? $contact->contactdetail->facebook : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('twitter', __('Twitter'), ['class' => 'form-control-label']) }}
                            {{ Form::text('twitter', (isset($contact->contactdetail->twitter) ? $contact->contactdetail->twitter : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('google_plus', __('Google Plus'), ['class' => 'form-control-label']) }}
                            {{ Form::text('google_plus', (isset($contact->contactdetail->google_plus) ? $contact->contactdetail->google_plus : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('linkedin', __('Linkedin'), ['class' => 'form-control-label']) }}
                            {{ Form::text('linkedin', (isset($contact->contactdetail->linkedin) ? $contact->contactdetail->linkedin : null), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Update', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
