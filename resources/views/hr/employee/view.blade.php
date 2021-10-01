@extends('layouts.admin')
@section('title')
    {{ __('View User') }}
@endsection
@section('action-button')
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
            <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
        </a>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card">
                <div class="list-group list-group-flush" id="tabs">
                    <div data-href="#accountcontact" class="list-group-item text-primary">
                        <div class="media">
                            <i class="fas fa-user"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('General info') }}</a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#leave" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-industry"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Leave') }}</a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#notes" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-sticky-note"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Notes') }}</a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#performance" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-chart-line"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Performance') }}</a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#policy" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-lock"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Policy') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-lg-1">
            <div class="card bg-gradient-primary hover-shadow-lg border-0">
                <div class="card-body py-3">
                    <div class="row row-grid align-items-center">
                        <div class="col-lg-8">
                            <div class="media align-items-center">
                                <a href="#" class="avatar avatar-lg rounded-circle mr-3">
                                    <img class="avatar avatar-lg" {{ $user->userdetail->img_image }} alt="Owner">
                                </a>
                                <div class="media-body">
                                    <h5 class="text-white mb-0"> {{ ucfirst($user->name) }}</h5>
                                    <div>
                                        {{ Form::open(['route' => ['update.user.profile'],'enctype'=>'multipart/form-data','id' => 'update_avatar']) }}
                                        <input type="file" name="image" id="image" class="custom-input-file custom-input-file-link" data-multiple-caption="{count} files selected" multiple/>
                                        <input type="hidden" name="id" value="{{ $user->userdetail->user_id }}"/>
                                        <label for="image">
                                            <span class="text-white" style="cursor: pointer;">{{__('Change Avatar')}}</span>
                                        </label>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="accountcontact" class="tabs-card">
                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0">{{ __('Basic Info') }}</h5>
                    </div>
                    <div class="card-body">
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Name') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ $user->name }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('User Id') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->user_id) ? $user->user_id : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Email') }}</span>
                                <span class="d-block h6 mb-0 p-2"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></span>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0">{{ __('Work') }}</h5>
                    </div>
                    <div class="card-body">
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Department') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->departmentDesc->title) ? $user->userdetail->departmentDesc->title : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Designation') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->designationDesc->title) ? $user->userdetail->designationDesc->title : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Reporting To') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->reporting_to) ? $user->userdetail->reporting_to : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Date of Hire') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ Utility::getDateFormated($user->date_of_hire) }}</span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Source of Hire') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->source_of_hire) ? __(\App\UserDetail::$source_of_hire[$user->userdetail->source_of_hire]) : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('User Status') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ __(\App\UserDetail::$user_status[$user->user_status]) }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Phone') }}</span>
                                <span class="d-block h6 mb-0 p-2"><a href="tel:{{ $user->userdetail->phone }}">{{ !empty($user->userdetail->phone) ? $user->userdetail->phone : '-' }}</a></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('User Type') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ __(\App\UserDetail::$user_type[$user->user_type]) }}</span>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0">{{ __('Personal Details') }}</h5>
                    </div>
                    <div class="card-body">
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Father Name') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->father_name) ? $user->userdetail->father_name : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Mother Name') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->mother_name) ? $user->userdetail->mother_name : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Address1') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->address1) ? $user->userdetail->address1 : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Address2') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->address2) ? $user->userdetail->address2 : '-' }}</span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('City') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->city) ? $user->userdetail->city : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Country') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->country) ? $user->userdetail->country : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('State') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->state) ? $user->userdetail->state : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Zip Code') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->zip_code) ? $user->userdetail->zip_code : '-' }}</span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Mobile') }}</span>
                                <span class="d-block h6 mb-0 p-2"><a href="tel:{{ $user->userdetail->mobile }}">{{ !empty($user->userdetail->mobile) ? $user->userdetail->mobile : '-' }}</a></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Date Of Birth') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->date_of_birth) ? Utility::getDateFormated($user->userdetail->date_of_birth) : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Gender') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->gender) ? __(\App\UserDetail::$gender[$user->userdetail->gender]) : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Marital Status') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->marital_status) ? __(\App\UserDetail::$marital_status[$user->userdetail->marital_status]) : '-' }}</span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Nationality') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->nationality) ? $user->userdetail->nationality : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Hobbies') }}</span>
                                <span class="d-block h6 mb-0 p-2">{{ !empty($user->userdetail->hobbies) ? $user->userdetail->hobbies : '-' }}</span>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ __('Work Experience') }}</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="{{ __('Add New Work Experience') }}" data-size='lg'
                                        data-url="{{ route('work_experiences.create',['id' => $user->id]) }}" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="5%">{{ __('Previous Company') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="5%">{{ __('Job Title') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="5%">{{ __('From') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="5%">{{ __('To') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="5%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (count($work_experiences) > 0)
                                        @foreach ($work_experiences as $workexperience)
                                            <tr>
                                                <td>{{ $workexperience->previous_company }}</td>
                                                <td>{{ $workexperience->job_title }}</td>
                                                <td>{{ Utility::getDateFormated($workexperience->from) }}</td>
                                                <td>{{ Utility::getDateFormated($workexperience->to) }}</td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                data-url="{{ route('work_experiences.edit', $workexperience->id) }}"
                                                                data-ajax-popup="true" data-title="{{ __('Edit Work Experience') }}"
                                                                data-original-title="{{ __('Edit') }}" data-size='lg'>{{ __('Edit') }}</a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="{{ __('Delete') }}"
                                                                    data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                                                    data-confirm-yes="document.getElementById('delete-form-{{ $workexperience->id }}').submit();">
                                                                    {{ __('Remove') }}
                                                                </a>
                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['work_experiences.destroy', $workexperience->id], 'id' => 'delete-form-' . $workexperience->id]) }}
                                                                {{ Form::close() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ __('Education') }}</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="{{ __('Add New Education') }}" data-size='lg'
                                        data-url="{{ route('educations.create',['id' => $user->id]) }}" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('School Name') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Degree') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Field(s) of Study') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Year of Completion') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (count($educations) > 0)
                                        @foreach ($educations as $education)
                                            <tr>
                                                <td>{{ $education->school_name }}</td>
                                                <td>{{ $education->degree }}</td>
                                                <td>{{ $education->field_of_study }}</td>
                                                <td>{{ $education->year_of_completion }}</td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                data-url="{{ route('educations.edit', $education->id) }}"
                                                                data-ajax-popup="true" data-title="{{ __('Edit Education') }}"
                                                                data-original-title="{{ __('Edit') }}" data-size='lg'>{{ __('Edit') }}</a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="{{ __('Delete') }}"
                                                                    data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                                                    data-confirm-yes="document.getElementById('delete-form-{{ $education->id }}').submit();">
                                                                    {{ __('Remove') }}
                                                                </a>
                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['educations.destroy', $education->id], 'id' => 'delete-form-' . $education->id]) }}
                                                                {{ Form::close() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="leave" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ __('History') }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="50%">{{ __('Date') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="40%">{{ __('Description') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="10%">{{ __('Days') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if ($getleavehistories->count() > 0)
                                        @foreach ($getleavehistories as $getleavehistory)
                                            <tr>
                                                <td>{{ Utility::getDateFormated($getleavehistory->from) .' - '. Utility::getDateFormated($getleavehistory->to) }}</td>
                                                <td class="text-wrap" width="40%">{{ !empty($getleavehistory->reason) ? $getleavehistory->reason : '-' }}</td>
                                                <td>{{ Utility::diffDate($getleavehistory->from,$getleavehistory->to,true) }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="font-style">
                                            <td colspan="6" class="text-center">
                                                <h6 class="text-center">{{ __('No Histroy Found.') }}</h6>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="notes" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ __('Note') }}</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="{{ __('Add New Note') }}" data-size='lg'
                                        data-url="{{ route('notes.create',['type' => 'user','id' => $user->id]) }}" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="80%">{{ __('Note') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="10%">{{ (' ') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="10%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($notes) > 0)
                                        @foreach ($notes as $note)
                                            <tr>
                                                <td class="text-wrap" width="80%">{!! $note->note !!}</td>
                                                <td>{{ Auth::user()->name }}</td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                data-url="{{ route('notes.edit', $note->id) }}"
                                                                data-ajax-popup="true" data-title="{{ __('Edit Note') }}"
                                                                data-original-title="{{ __('Edit') }}" data-size='lg'>{{ __('Edit') }}</a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="{{ __('Delete') }}"
                                                                    data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                                                    data-confirm-yes="document.getElementById('delete-form-{{ $note->id }}').submit();">
                                                                    {{ __('Remove') }}
                                                                </a>
                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['notes.destroy', $note->id], 'id' => 'delete-form-' . $note->id]) }}
                                                                {{ Form::close() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="performance" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ __('Performance Reviews') }}</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="{{ __('Add New Performance Reviews') }}" data-size='lg'
                                        data-url="{{ route('performance_reviews.create',['id' => $user->id]) }}" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Review Date') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Reporting To') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Attendance/Punctuality') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Communication/Listening') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (count($performance_reviews) > 0)
                                        @foreach ($performance_reviews as $performance_review)
                                            <tr>
                                                <td>{{ Utility::getDateFormated($performance_review->review_date) }}</td>
                                                <td>{{ !empty($performance_review->user->name) ?  $performance_review->user->name : '-'}}</td>
                                                <td>{{ !empty($performance_review->attendence_punctuality) ?  __(\App\PerformanceReview::$reviews[$performance_review->attendence_punctuality]) : '-'}}</td>
                                                <td>{{ !empty($performance_review->communication_listening) ? __(\App\PerformanceReview::$reviews[$performance_review->communication_listening]) : '-' }}</td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="{{ __('Delete') }}"
                                                                    data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                                                    data-confirm-yes="document.getElementById('delete-form-{{ $performance_review->id }}').submit();">
                                                                    {{ __('Remove') }}
                                                                </a>
                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['performance_reviews.destroy', $performance_review->id], 'id' => 'delete-form-' . $performance_review->id]) }}
                                                                {{ Form::close() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ __('Performance Comments') }}</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="{{ __('Add New Performance Comments') }}" data-size='lg'
                                        data-url="{{ route('performance_comments.create',['id' => $user->id]) }}" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="15%">{{ __('Date') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="15%">{{ __('Reviewer') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="50%">{{ __('Comments') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (count($performance_comments) > 0)
                                        @foreach ($performance_comments as $performance_comment)
                                            <tr>
                                                <td>{{ Utility::getDateFormated($performance_comment->reference_date) }}</td>
                                                <td>{{ !empty($performance_comment->user->name) ?  $performance_comment->user->name : '-'}}</td>
                                                <td class="text-wrap" width="50%">{{ !empty($performance_comment->comments) ? $performance_comment->comments : '-'}}</td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="{{ __('Delete') }}"
                                                                    data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                                                    data-confirm-yes="document.getElementById('delete-form-{{ $performance_comment->id }}').submit();">
                                                                    {{ __('Remove') }}
                                                                </a>
                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['performance_comments.destroy', $performance_comment->id], 'id' => 'delete-form-' . $performance_comment->id]) }}
                                                                {{ Form::close() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ __('Performance Goals') }}</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="{{ __('Add New Performance Goals') }}" data-size='lg'
                                        data-url="{{ route('performance_goals.create',['id' => $user->id]) }}" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="15%">{{ __('Set Date') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="15%">{{ __('Completion Date') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Supervisor') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="30%">{{ __('Employee Assessment') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (count($performance_goals) > 0)
                                        @foreach ($performance_goals as $performance_goal)
                                            <tr>
                                                <td>{{ Utility::getDateFormated($performance_goal->set_date) }}</td>
                                                <td>{{ Utility::getDateFormated($performance_goal->completion_date) }}</td>
                                                <td>{{ !empty($performance_goal->user->name) ? $performance_goal->user->name : '-'}}</td>
                                                <td>{{ !empty($performance_goal->employee_assessment) ? $performance_goal->employee_assessment : '-' }}</td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="{{ __('Delete') }}"
                                                                    data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                                                    data-confirm-yes="document.getElementById('delete-form-{{ $performance_goal->id }}').submit();">
                                                                    {{ __('Remove') }}
                                                                </a>
                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['performance_goals.destroy', $performance_goal->id], 'id' => 'delete-form-' . $performance_goal->id]) }}
                                                                {{ Form::close() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="policy" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ __('Policy') }}</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="{{ __('Add New Policy') }}" data-size='lg'
                                        data-url="{{ route('policy.create',['id' => $user->id,'dept_id' => $user->userdetail->department]) }}" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="90%">{{ __('Name') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="10%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if ($policies->count() > 0)
                                        @foreach ($policies as $policy)
                                            <tr>
                                                <td>{{$policy->policy_name}}</td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="{{ __('Delete') }}"
                                                                    data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                                                    data-confirm-yes="document.getElementById('delete-form-{{ $policy->id }}').submit();">
                                                                    {{ __('Remove') }}
                                                                </a>
                                                                <a href="#" class="dropdown-item"
                                                                data-url="{{ route('policy.show', $policy->id) }}" data-ajax-popup="true"
                                                                data-title="{{ __('View ').ucfirst($policy->policy_name) }}" data-size='lg'>
                                                                {{ __('View') }}</a>
                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['policy.destroy', $policy->id,$user->id], 'id' => 'delete-form-' . $policy->id]) }}
                                                                {{ Form::close() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
$(document).on('change', '#image', function() {
            $('#update_avatar').submit();
});
</script>
@endpush