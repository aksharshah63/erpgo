@extends('layouts.admin')
@php
$profile=asset(Storage::url('users'));
@endphp
@section('title')
    {{__('Profile Account')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12">
            <div class="card profile-card">
                <div class="avatar avatar-lg rounded-circle">
                    {{-- <img alt="" {{ $userDetail->userdetail->img_image }}  class="avatar avatar-lg"> --}}
                    @if(!empty($userDetail->userdetail->img_image))
                        <img alt="" {{$userDetail->userdetail->img_image}} class="avatar avatar-lg">
                    @else
                        <img alt="" src="{{$profile.'/avatar.png'}}" class="avatar avatar-lg">
                    @endif
                </div>
                <h4 class="h4 mb-0 mt-2"> {{$userDetail->name}}</h4>
                <div class="sal-right-card">
                    <span class="badge badge-pill badge-blue">{{$userDetail->type}}</span>
                </div>
                <h6 class="office-time mb-0 mt-4">{{$userDetail->email}}</h6>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
            <section class="col-lg-12 pricing-plan card">
                <div class="our-system password-card p-3">
                    <div class="row">
                        <!-- <div class="col-lg-12"> -->

                        <ul class="nav nav-tabs my-4" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a data-toggle="pill" href="#personal-info" class="nav-link active" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Personal Info')}}</a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#change-password" class="nav-link" id="pills-profile-tab" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('Change Password')}}</span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div id="personal-info" class="tab-pane fade show active" role="tabpanel" aria-labelledby="pills-home-tab">
                            {{Form::model($userDetail,array('route' => array('customer.update.profile'), 'method' => 'put', 'enctype' => "multipart/form-data"))}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{Form::label('name',__('Name'),array('class'=>'form-control-label'))}}
                                        {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter User Name')))}}
                                        @error('name')
                                        <span class="invalid-name" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{Form::label('email',__('Email'),array('class'=>'form-control-label'))}}
                                    {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email')))}}
                                    @error('email')
                                    <span class="invalid-email" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="choose-file">
                                            <label for="avatar">
                                                <div>{{__('Choose file here')}}</div>
                                                <input type="file" class="form-control" id="avatar" name="profile" data-filename="profiles">
                                            </label>
                                            <p class="profiles"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-right">
                                    <input type="submit" value="{{__('Save Changes')}}" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                        <div id="change-password" class="tab-pane fade" role="tabpanel" aria-labelledby="pills-home-tab">
                            {{Form::model($userDetail,array('route' => array('customer.update.password',$userDetail->id), 'method' => 'put'))}}
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        {{Form::label('current_password',__('Current Password'),array('class'=>'form-control-label'))}}
                                        {{Form::password('current_password',array('class'=>'form-control','placeholder'=>__('Enter Current Password')))}}
                                        @error('current_password')
                                        <span class="invalid-current_password" role="alert">
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        {{Form::label('new_password',__('New Password'),array('class'=>'form-control-label'))}}
                                        {{Form::password('new_password',array('class'=>'form-control','placeholder'=>__('Enter New Password')))}}
                                        @error('new_password')
                                        <span class="invalid-new_password" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{Form::label('confirm_password',__('Re-type New Password'),array('class'=>'form-control-label'))}}
                                        {{Form::password('confirm_password',array('class'=>'form-control','placeholder'=>__('Enter Re-type New Password')))}}
                                        @error('confirm_password')
                                        <span class="invalid-confirm_password" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 text-right">
                                    <input type="submit" value="{{__('Save Changes')}}" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection