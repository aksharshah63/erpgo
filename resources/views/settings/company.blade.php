@extends('layouts.admin')
@section('title')
    {{__('Settings')}}
@endsection
@php
    $logo=asset(Storage::url('logo/'));
    $company_logo=Utility::getValByName('company_logo');
    $company_favicon=Utility::getValByName('company_favicon');
    $landing_logo=Utility::getValByName('landing_logo');
@endphp
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="nav-tabs">
                <div class="col-lg-12 our-system">
                    <div class="row">
                        <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a data-toggle="pill" href="#business-setting" class="nav-link active" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Business Setting')}}</a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#system-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false">{{__('System Setting')}} </a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#company-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false">{{__('Company Setting')}} </a>
                            </li>
                            @if(\Auth::user()->can('Manage System Settings'))
                                <li class="nav-item">
                                    <a data-toggle="pill" href="#email-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false">{{__('Email Setting')}} </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a data-toggle="pill" href="#proposal-template-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false">{{__('Proposal Print Setting')}} </a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#invoice-template-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false">{{__('Invoice Print Setting')}} </a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#bill-template-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false">{{__('Bill Print Setting')}} </a>
                            </li>
                            @if(\Auth::user()->can('Manage Stripe Settings'))
                                <li class="annual-billing">
                                    <a data-toggle="pill" href="#payment-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false">{{__('Payment Setting')}} </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="business-setting" class="tab-pane in active">
                        {{Form::model($settings,array('route'=>'business.setting','method'=>'POST','enctype' => "multipart/form-data"))}}
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2">{{__('Business Settings')}}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4>{{__('Logo')}}</h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="logo-content">
                                        <img src="{{$logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo.png')}}" class="big-logo" alt=""/>
                                    </div>
                                    <div class="choose-file mt-4">
                                        <label for="company_logo">
                                            <div>{{__('Choose File Here')}}</div>
                                            <input type="file" class="form-control" name="company_logo" id="company_logo" data-filename="edit-company_logo">
                                        </label>
                                        <p class="edit-company_logo"></p>
                                    </div>
                                    <p class="mt-3 text-primary"> {{__('These Logo Will Appear On Bill And Invoice As Well.')}}</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4>{{__('Favicon')}}</h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="logo-content">
                                        <img src="{{$logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')}}" class="small-logo" alt=""/>
                                    </div>
                                    <div class="choose-file mt-5">
                                        <label for="company_favicon">
                                            <div>{{__('Choose File Here')}}</div>
                                            <input type="file" class="form-control" name="company_favicon" id="company_favicon" data-filename="edit-company-favicon">
                                        </label>
                                        <p class="edit-company-favicon"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4>{{__('Landing Page Logo')}}</h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="logo-content">
                                        <img src="{{$logo.'/'.(isset($landing_logo) && !empty($landing_logo)?$landing_logo:'landing_logo.png')}}" class="small-logo" alt=""/>
                                    </div>
                                    <div class="choose-file mt-5">
                                        <label for="company_favicon">
                                            <div>{{__('Choose File Here')}}</div>
                                            <input type="file" class="form-control" name="landing_logo" id="landing_logo" data-filename="edit-company-favicon">
                                        </label>
                                        <p class="edit-landing-logo"></p>
                                    </div>
                                    <div class="col-12">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="enable_landing" id="enable_landing" {{ (\App\Utility::getValByName('enable_landing') == 'yes') ? 'checked' : '' }}>
                                            <label class="custom-control-label form-control-label" for="enable_landing">{{__('Enable Landing Page')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4>{{__('Settings')}}</h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="form-group">
                                        {{Form::label('title_text',__('Title Text'),array('class'=>'form-control-label'),array('class'=>'form-control-label')) }}
                                        {{Form::text('title_text',null,array('class'=>'form-control','placeholder'=>__('Title Text')))}}
                                        @error('title_text')
                                        <span class="invalid-title_text" role="alert">
                                             <strong class="text-danger">{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('footer_title',__('Footer Title'),array('class'=>'form-control-label'),array('class'=>'form-control-label')) }}
                                        {{Form::text('footer_title',null,array('class'=>'form-control','placeholder'=>__('Footer Title')))}}
                                        @error('footer_title')
                                        <span class="invalid-footer_title" role="alert">
                                             <strong class="text-danger">{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12 text-right">
                                <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="{{__('Save Changes')}}">
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                    <div id="system-setting" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2">{{__('System Settings')}}</h4>
                                </div>
                            </div>
                            <div class="card bg-none">
                                {{Form::model($settings,array('route'=>'system.settings','method'=>'post'))}}
                                <div class="card-body pd-0">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            {{Form::label('site_currency',__('Currency *'),array('class'=>'form-control-label')) }}
                                            {{Form::text('site_currency',null,array('class'=>'form-control font-style'))}}
                                            <small> {{__('Note: Add Currency Code As Per Three-Letter ISO Code.')}} <a href="https://stripe.com/docs/currencies" target="_blank">{{__('You Can Find Out Here..')}}</a></small> <br>
                                            @error('site_currency')
                                            <span class="invalid-site_currency" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('site_currency_symbol',__('Currency Symbol *'),array('class'=>'form-control-label')) }}
                                            {{Form::text('site_currency_symbol',null,array('class'=>'form-control'))}}
                                            @error('site_currency_symbol')
                                            <span class="invalid-site_currency_symbol" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="example3cols3Input">{{__('Currency Symbol Position')}}</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-radio mb-3">

                                                            <input type="radio" id="customRadio5" name="site_currency_symbol_position" value="pre" class="custom-control-input" @if(@$settings['site_currency_symbol_position'] == 'pre') checked @endif>
                                                            <label class="custom-control-label" for="customRadio5">{{__('Pre')}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" id="customRadio6" name="site_currency_symbol_position" value="post" class="custom-control-input" @if(@$settings['site_currency_symbol_position'] == 'post') checked @endif>
                                                            <label class="custom-control-label" for="customRadio6">{{__('Post')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="site_date_format" class="form-control-label">{{__('Date Format')}}</label>
                                            <select type="text" name="site_date_format" class="form-control select2" id="site_date_format">
                                                <option value="M j, Y" @if(@$settings['site_date_format'] == 'M j, Y') selected="selected" @endif>{{date('M j, Y')}}</option>
                                                <option value="d-m-Y" @if(@$settings['site_date_format'] == 'd-m-Y') selected="selected" @endif>{{date('d-m-y')}}</option>
                                                <option value="m-d-Y" @if(@$settings['site_date_format'] == 'm-d-Y') selected="selected" @endif>{{date('m-d-y')}}</option>
                                                <option value="Y-m-d" @if(@$settings['site_date_format'] == 'Y-m-d') selected="selected" @endif>{{date('y-m-d')}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="site_time_format" class="form-control-label">{{__('Time Format')}}</label>
                                            <select type="text" name="site_time_format" class="form-control select2" id="site_time_format">
                                                <option value="g:i A" @if(@$settings['site_time_format'] == 'g:i A') selected="selected" @endif>{{date('g:i A')}}</option>
                                                <option value="g:i a" @if(@$settings['site_time_format'] == 'g:i a') selected="selected" @endif>{{date('g:i a')}}</option>
                                                <option value="H:i" @if(@$settings['site_time_format'] == 'H:i') selected="selected" @endif>{{date('H:i')}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('invoice_prefix',__('Invoice Prefix'),array('class'=>'form-control-label')) }}
                                            {{Form::text('invoice_prefix',null,array('class'=>'form-control'))}}
                                            @error('invoice_prefix')
                                            <span class="invalid-invoice_prefix" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('proposal_prefix',__('Proposal Prefix'),array('class'=>'form-control-label')) }}
                                            {{Form::text('proposal_prefix',null,array('class'=>'form-control'))}}
                                            @error('proposal_prefix')
                                            <span class="invalid-proposal_prefix" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('bill_prefix',__('Bill Prefix'),array('class'=>'form-control-label')) }}
                                            {{Form::text('bill_prefix',null,array('class'=>'form-control'))}}
                                            @error('bill_prefix')
                                            <span class="invalid-bill_prefix" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('customer_prefix',__('Customer Prefix'),array('class'=>'form-control-label')) }}
                                            {{Form::text('customer_prefix',null,array('class'=>'form-control'))}}
                                            @error('customer_prefix')
                                            <span class="invalid-customer_prefix" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('vender_prefix',__('Vender Prefix'),array('class'=>'form-control-label')) }}
                                            {{Form::text('vender_prefix',null,array('class'=>'form-control'))}}
                                            @error('vender_prefix')
                                            <span class="invalid-vender_prefix" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('user_prefix',__('User Prefix'),array('class'=>'form-control-label')) }}
                                            {{Form::text('user_prefix',null,array('class'=>'form-control'))}}
                                            @error('user_prefix')
                                            <span class="invalid-user_prefix" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('journal_prefix',__('Journal Prefix'),array('class'=>'form-control-label')) }}
                                            {{Form::text('journal_prefix',null,array('class'=>'form-control'))}}
                                            @error('journal_prefix')
                                            <span class="invalid-journal_prefix" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('footer_title',__('Invoice/Bill Footer Title'),array('class'=>'form-control-label')) }}
                                            {{Form::text('footer_title',null,array('class'=>'form-control'))}}
                                            @error('footer_title')
                                            <span class="invalid-footer_title" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            {{Form::label('decimal_number',__('Decimal Number Format'),array('class'=>'form-control-label')) }}
                                            {{Form::number('decimal_number', null, ['class'=>'form-control'])}}
                                            @error('decimal_number')
                                            <span class="invalid-decimal_number" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        

                                        {{-- <div class="form-group col-md-6">
                                            {{Form::label('shipping_display',__('Shipping Display in Proposal / Invoice / Bill ?'),array('class'=>'form-control-label')) }}
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="email-template-checkbox custom-control-input" name="shipping_display" id="email_tempalte_13" {{($settings['shipping_display']=='on')?'checked':''}} >
                                                <label class="custom-control-label form-control-label" for="email_tempalte_13"></label>
                                            </div>

                                            @error('shipping_display')
                                            <span class="invalid-shipping_display" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group col-md-6">
                                            {{Form::label('footer_notes',__('Invoice/Bill Footer Notes'),array('class'=>'form-control-label')) }}
                                            {{Form::textarea('footer_notes', null, ['class'=>'form-control','rows'=>'3'])}}
                                            @error('footer_notes')
                                            <span class="invalid-footer_notes" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('footer_link_title_1',__('Footer Link Title 1'),array('class'=>'form-control-label')) }}
                                            {{Form::text('footer_link_title_1',null,array('class'=>'form-control'))}}
                                            @error('footer_link_title_1')
                                            <span class="invalid-footer_link_title_1" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('footer_link_href_1',__('Footer Link href 1'),array('class'=>'form-control-label')) }}
                                            {{Form::text('footer_link_href_1',null,array('class'=>'form-control'))}}
                                            @error('footer_link_href_1')
                                            <span class="invalid-footer_link_href_1" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('footer_link_title_2',__('Footer Link Title 2'),array('class'=>'form-control-label')) }}
                                            {{Form::text('footer_link_title_2',null,array('class'=>'form-control'))}}
                                            @error('footer_link_title_2')
                                            <span class="invalid-footer_link_title_2" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('footer_link_href_2',__('Footer Link href 2'),array('class'=>'form-control-label')) }}
                                            {{Form::text('footer_link_href_2',null,array('class'=>'form-control'))}}
                                            @error('footer_link_href_2')
                                            <span class="invalid-footer_link_href_2" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('footer_link_title_3',__('Footer Link Title 3'),array('class'=>'form-control-label')) }}
                                            {{Form::text('footer_link_title_3',null,array('class'=>'form-control'))}}
                                            @error('footer_link_title_3')
                                            <span class="invalid-footer_link_title_3" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('footer_link_href_3',__('Footer Link href 3'),array('class'=>'form-control-label')) }}
                                            {{Form::text('footer_link_href_3',null,array('class'=>'form-control'))}}
                                            @error('footer_link_href_3')
                                            <span class="invalid-footer_link_href_3" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12  text-right">
                                    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="{{__('Save Changes')}}">
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                    <div id="company-setting" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2">{{__('Company Settings')}}</h4>
                                </div>
                            </div>
                            <div class="card bg-none">
                                {{Form::model($settings,array('route'=>'company.settings','method'=>'post'))}}
                                <div class="card-body pd-0">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            {{Form::label('company_name *',__('Company Name *'),array('class'=>'form-control-label')) }}
                                            {{Form::text('company_name',null,array('class'=>'form-control font-style'))}}
                                            @error('company_name')
                                            <span class="invalid-company_name" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('company_address',__('Address'),array('class'=>'form-control-label')) }}
                                            {{Form::text('company_address',null,array('class'=>'form-control font-style'))}}
                                            @error('company_address')
                                            <span class="invalid-company_address" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('company_city',__('City'),array('class'=>'form-control-label')) }}
                                            {{Form::text('company_city',null,array('class'=>'form-control font-style'))}}
                                            @error('company_city')
                                            <span class="invalid-company_city" role="alert">
                                                                    <strong class="text-danger">{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('company_state',__('State'),array('class'=>'form-control-label')) }}
                                            {{Form::text('company_state',null,array('class'=>'form-control font-style'))}}
                                            @error('company_state')
                                            <span class="invalid-company_state" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('company_zipcode',__('Zip/Post Code'),array('class'=>'form-control-label')) }}
                                            {{Form::text('company_zipcode',null,array('class'=>'form-control'))}}
                                            @error('company_zipcode')
                                            <span class="invalid-company_zipcode" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group  col-md-6">
                                            {{Form::label('company_country',__('Country'),array('class'=>'form-control-label')) }}
                                            {{Form::text('company_country',null,array('class'=>'form-control font-style'))}}
                                            @error('company_country')
                                            <span class="invalid-company_country" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('company_telephone',__('Telephone'),array('class'=>'form-control-label')) }}
                                            {{Form::text('company_telephone',null,array('class'=>'form-control'))}}
                                            @error('company_telephone')
                                            <span class="invalid-company_telephone" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('company_email',__('System Email *'),array('class'=>'form-control-label')) }}
                                            {{Form::text('company_email',null,array('class'=>'form-control'))}}
                                            @error('company_email')
                                            <span class="invalid-company_email" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('company_email_from_name',__('Email (From Name) *'),array('class'=>'form-control-label')) }}
                                            {{Form::text('company_email_from_name',null,array('class'=>'form-control font-style'))}}
                                            @error('company_email_from_name')
                                            <span class="invalid-company_email_from_name" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group col-md-6">
                                            {{Form::label('registration_number',__('Company Registration Number *'),array('class'=>'form-control-label')) }}
                                            {{Form::text('registration_number',null,array('class'=>'form-control'))}}

                                        </div> --}}

                                        {{-- <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" id="customRadio8" name="tax_type" value="VAT" class="custom-control-input" {{($settings['tax_type'] == 'VAT')?'checked':''}} >
                                                            <label class="custom-control-label" for="customRadio8">{{__('VAT Number')}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" id="customRadio7" name="tax_type" value="GST" class="custom-control-input" {{($settings['tax_type'] == 'GST')?'checked':''}}>
                                                            <label class="custom-control-label" for="customRadio7">{{__('GST Number')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{Form::text('vat_number',null,array('class'=>'form-control','placeholder'=>__('Enter VAT / GST Number')))}}

                                            </div>
                                        </div> --}}

                                    </div>
                                </div>
                                <div class="col-lg-12  text-right">
                                    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="{{__('Save Changes')}}">
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                    <div id="proposal-template-setting" class="tab-pane">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2">{{__('Proposal Print Settings')}}</h4>
                            </div>
                        </div>
                        <div class="card">
                            <form id="setting-form" method="post" action="{{route('proposal.template.setting')}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <form id="setting-form" method="post" action="{{route('proposal.template.setting')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="address" class="form-control-label">{{__('Proposal Template')}}</label>
                                                    <select class="form-control select2" name="proposal_template">
                                                        @foreach(Utility::templateData()['templates'] as $key => $template)
                                                            <option value="{{$key}}" {{(isset($settings['proposal_template']) && $settings['proposal_template'] == $key) ? 'selected' : ''}}>{{$template}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label form-control-label">{{__('Color Input')}}</label>
                                                    <div class="row gutters-xs">
                                                        @foreach(Utility::templateData()['colors'] as $key => $color)
                                                            <div class="col-auto">
                                                                <label class="colorinput">
                                                                    <input name="proposal_color" type="radio" value="{{$color}}" class="colorinput-input" {{(isset($settings['proposal_color']) && $settings['proposal_color'] == $color) ? 'checked' : ''}}>
                                                                    <span class="colorinput-color" style="background: #{{$color}}"></span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-primary rounded-pill">
                                                    {{__('Save')}}
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-10">
                                            @if(isset($settings['proposal_template']) && isset($settings['proposal_color']))
                                                <iframe id="proposal_frame" class="w-100 h-1450" frameborder="0" src="{{route('proposal.preview',[$settings['proposal_template'],$settings['proposal_color']])}}"></iframe>
                                            @else
                                                <iframe id="proposal_frame" class="w-100 h-1450" frameborder="0" src="{{route('proposal.preview',['template1','fffff'])}}"></iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-sm btn-primary rounded-pill">
                                        {{__('Save')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="invoice-template-setting" class="tab-pane">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2">{{__('Invoice Print Settings')}}</h4>
                            </div>
                        </div>
                        <div class="card">
                            <form id="setting-form" method="post" action="{{route('proposal.template.setting')}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <form id="setting-form" method="post" action="{{route('template.setting')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="address" class="form-control-label">{{__('Invoice Template')}}</label>
                                                    <select class="form-control select2" name="invoice_template">
                                                        @foreach(Utility::templateData()['templates'] as $key => $template)
                                                            <option value="{{$key}}" {{(isset($settings['invoice_template']) && $settings['invoice_template'] == $key) ? 'selected' : ''}}>{{$template}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label form-control-label">{{__('Color Input')}}</label>
                                                    <div class="row gutters-xs">
                                                        @foreach(Utility::templateData()['colors'] as $key => $color)
                                                            <div class="col-auto">
                                                                <label class="colorinput">
                                                                    <input name="invoice_color" type="radio" value="{{$color}}" class="colorinput-input" {{(isset($settings['invoice_color']) && $settings['invoice_color'] == $color) ? 'checked' : ''}}>
                                                                    <span class="colorinput-color" style="background: #{{$color}}"></span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                    {{__('Save')}}
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-10">
                                            @if(isset($settings['invoice_template']) && isset($settings['invoice_color']))
                                                <iframe id="invoice_frame" class="w-100 h-1450" frameborder="0" src="{{route('invoice.preview',[$settings['invoice_template'],$settings['invoice_color']])}}"></iframe>
                                            @else
                                                <iframe id="invoice_frame" class="w-100 h-1450" frameborder="0" src="{{route('invoice.preview',['template1','fffff'])}}"></iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-sm btn-primary btn-icon rounded-pill">
                                        {{__('Save')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="bill-template-setting" class="tab-pane">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2">{{__('Bill Print Settings')}}</h4>
                            </div>
                        </div>
                        <div class="card">
                            <form id="setting-form" method="post" action="{{route('proposal.template.setting')}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <form id="setting-form" method="post" action="{{route('bill.template.setting')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="address" class="form-control-label">{{__('Bill Template')}}</label>
                                                    <select class="form-control" name="bill_template">
                                                        @foreach(Utility::templateData()['templates'] as $key => $template)
                                                            <option value="{{$key}}" {{(isset($settings['bill_template']) && $settings['bill_template'] == $key) ? 'selected' : ''}}>{{$template}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group form-control-label">
                                                    <label class="form-label">{{__('Color Input')}}</label>
                                                    <div class="row gutters-xs">
                                                        @foreach(Utility::templateData()['colors'] as $key => $color)
                                                            <div class="col-auto">
                                                                <label class="colorinput">
                                                                    <input name="bill_color" type="radio" value="{{$color}}" class="colorinput-input" {{(isset($settings['bill_color']) && $settings['bill_color'] == $color) ? 'checked' : ''}}>
                                                                    <span class="colorinput-color" style="background: #{{$color}}"></span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-primary rounded-pill">
                                                    {{__('Save')}}
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-10">
                                            @if(isset($settings['bill_template']) && isset($settings['bill_color']))
                                                <iframe id="bill_frame" class="w-100 h-1450" frameborder="0" src="{{route('bill.preview',[$settings['bill_template'],$settings['bill_color']])}}"></iframe>
                                            @else
                                                <iframe id="bill_frame" class="w-100 h-1450" frameborder="0" src="{{route('bill.preview',['template1','fffff'])}}"></iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-sm btn-primary rounded-pill">
                                        {{__('Save')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if(\Auth::user()->can('Manage System Settings'))
                        <div id="email-setting" class="tab-pane">
                            <div class="col-md-12">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                        <h4 class="h4 font-weight-400 float-left pb-2">{{__('Email Settings')}}</h4>
                                    </div>
                                </div>
                                <div class="card bg-none">
                                    {{Form::model($settings,array('route'=>'email.settings','method'=>'post'))}}
                                    <div class="card-body pd-0">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                {{Form::label('mail_driver',__('Mail Driver'),array('class'=>'form-control-label')) }}
                                                {{Form::text('mail_driver',env('MAIL_DRIVER'),array('class'=>'form-control font-style'))}}
                                                @error('mail_driver')
                                                <span class="invalid-mail_driver" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-3">
                                                {{Form::label('mail_host',__('Mail Host'),array('class'=>'form-control-label')) }}
                                                {{Form::text('mail_host',env('MAIL_HOST'),array('class'=>'form-control font-style'))}}
                                                @error('mail_host')
                                                <span class="invalid-mail_host" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-3">
                                                {{Form::label('mail_port',__('Mail Port'),array('class'=>'form-control-label')) }}
                                                {{Form::text('mail_port',env('MAIL_PORT'),array('class'=>'form-control font-style'))}}
                                                @error('mail_port')
                                                <span class="invalid-mail_port" role="alert">
                                                                        <strong class="text-danger">{{ $message }}</strong>
                                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-3">
                                                {{Form::label('mail_username',__('Mail Username'),array('class'=>'form-control-label')) }}
                                                {{Form::text('mail_username',env('MAIL_USERNAME'),array('class'=>'form-control font-style'))}}
                                                @error('mail_username')
                                                <span class="invalid-mail_username" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                {{Form::label('mail_password',__('Mail Password'),array('class'=>'form-control-label')) }}
                                                {{Form::text('mail_password',env('MAIL_PASSWORD'),array('class'=>'form-control'))}}
                                                @error('mail_password')
                                                <span class="invalid-mail_password" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                            </div>
                                            <div class="form-group  col-md-3">
                                                {{Form::label('mail_encryption',__('Mail Encryption'),array('class'=>'form-control-label')) }}
                                                {{Form::text('mail_encryption',env('MAIL_ENCRYPTION'),array('class'=>'form-control font-style'))}}
                                                @error('mail_encryption')
                                                <span class="invalid-mail_encryption" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-3">
                                                {{Form::label('mail_from_address',__('Mail From Address'),array('class'=>'form-control-label')) }}
                                                {{Form::text('mail_from_address',env('MAIL_FROM_ADDRESS'),array('class'=>'form-control'))}}
                                                @error('mail_from_address')
                                                <span class="invalid-mail_from_address" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-3">
                                                {{Form::label('mail_from_name',__('Mail From Name'),array('class'=>'form-control-label')) }}
                                                {{Form::text('mail_from_name',env('MAIL_FROM_NAME'),array('class'=>'form-control'))}}
                                                @error('mail_from_name')
                                                <span class="invalid-mail_from_name" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <a href="#" data-url="{{route('test.mail')}}" data-ajax-popup="true" data-title="Send Test Mail" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                    {{__('Send Test Mail')}}
                                                </a>
                                            </div>
                                            <div class="form-group col-md-6 text-right">
                                                <input type="submit" value="Save Changes" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                            </div>
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(\Auth::user()->can('Manage Stripe Settings'))
                        <div id="payment-setting" class="tab-pane">
                            <div class="col-md-12">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                        <h4 class="h4 font-weight-400 float-left pb-2">{{__('Payment settings')}}</h4>
                                    </div>
                                </div>
                                <div class="card bg-none">
                                    {{Form::model($settings,['route'=>'payment.settings', 'method'=>'POST'])}}
                                    <div class="card-body pd-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('currency_symbol',__('Currency Symbol *'),array('class'=>'form-control-label')) }}
                                                    {{Form::text('currency_symbol',env('CURRENCY_SYMBOL'),array('class'=>'form-control','required','placeholder'=>__('Enter Currency Symbol')))}}
                                                    @error('currency_symbol')
                                                    <span class="invalid-currency_symbol" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('currency',__('Currency *'),array('class'=>'form-control-label')) }}
                                                    {{Form::text('currency',env('CURRENCY'),array('class'=>'form-control font-style','required','placeholder'=>__('Enter Currency')))}}
                                                    <small> {{__('Note: Add currency code as per three-letter ISO code.')}}<a href="https://stripe.com/docs/currencies" target="_blank">{{__('you can find out here..')}}</a></small> <br>
                                                    @error('currency')
                                                    <span class="invalid-currency" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                            <div class="col-6 py-2">
                                                <h5 class="h5">{{__('Stripe')}}</h5>
                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="enable_stripe" id="enable_stripe" {{ env('ENABLE_STRIPE') == 'on' ? 'checked="checked"' : '' }}>
                                                    <label class="custom-control-label form-control-label" for="enable_stripe">{{__('Enable Stripe')}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('stripe_key',__('Stripe Key'),array('class'=>'form-control-label')) }}
                                                    {{Form::text('stripe_key',env('STRIPE_KEY'),['class'=>'form-control','placeholder'=>__('Enter Stripe Key')])}}
                                                    @error('stripe_key')
                                                    <span class="invalid-stripe_key" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('stripe_secret',__('Stripe Secret'),array('class'=>'form-control-label')) }}
                                                    {{Form::text('stripe_secret',env('STRIPE_SECRET'),['class'=>'form-control ','placeholder'=>__('Enter Stripe Secret')])}}
                                                    @error('stripe_secret')
                                                    <span class="invalid-stripe_secret" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>
        
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                            <div class="col-6 py-2">
                                                <h5 class="h5">{{__('PayPal')}}</h5>
                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="enable_paypal" id="enable_paypal" {{ env('ENABLE_PAYPAL') == 'on' ? 'checked="checked"' : '' }}>
                                                    <label class="custom-control-label form-control-label" for="enable_paypal">{{__('Enable Paypal')}}</label>
                                                </div>
                                            </div>
        
                                            <div class="col-md-12 pb-4">
                                                <label class="paypal-label form-control-label" for="paypal_mode">{{__('Paypal Mode')}}</label> <br>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-primary btn-sm  {{ env('PAYPAL_MODE') == '' || env('PAYPAL_MODE') == 'sandbox' ? 'active' : '' }}">
                                                        <input type="radio" name="paypal_mode" value="sandbox">{{__('Sandbox')}}
                                                    </label>
                                                    <label class="btn btn-primary btn-sm  {{ env('PAYPAL_MODE') == 'live' ? 'active' : '' }}">
                                                        <input type="radio" name="paypal_mode" value="live">{{__('Live')}}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paypal_client_id">{{ __('Client ID') }}</label>
                                                    <input type="text" name="paypal_client_id" id="paypal_client_id" class="form-control" value="{{env('PAYPAL_CLIENT_ID')}}" placeholder="{{ __('Client ID') }}"/>
                                                    @if ($errors->has('paypal_client_id'))
                                                        <span class="invalid-feedback d-block">
                                                    {{ $errors->first('paypal_client_id') }}
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paypal_secret_key">{{ __('Secret Key') }}</label>
                                                    <input type="text" name="paypal_secret_key" id="paypal_secret_key" class="form-control" value="{{env('PAYPAL_SECRET_KEY')}}" placeholder="{{ __('Secret Key') }}"/>
                                                    @if ($errors->has('paypal_secret_key'))
                                                        <span class="invalid-feedback d-block">
                                                    {{ $errors->first('paypal_secret_key') }}
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12  text-right">
                                        <input type="submit" value="{{__('Save Changes')}}" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).on("change", "select[name='proposal_template'], input[name='proposal_color']", function () {
            var template = $("select[name='proposal_template']").val();
            var color = $("input[name='proposal_color']:checked").val();
            $('#proposal_frame').attr('src', '{{url('/proposal/preview')}}/' + template + '/' + color);
        });

        $(document).on("change", "select[name='invoice_template'], input[name='invoice_color']", function () {
            var template = $("select[name='invoice_template']").val();
            var color = $("input[name='invoice_color']:checked").val();
            $('#invoice_frame').attr('src', '{{url('/invoices/preview')}}/' + template + '/' + color);
        });

        $(document).on("change", "select[name='bill_template'], input[name='bill_color']", function () {
            var template = $("select[name='bill_template']").val();
            var color = $("input[name='bill_color']:checked").val();
            $('#bill_frame').attr('src', '{{url('/bill/preview')}}/' + template + '/' + color);
        });
    </script>
@endpush
