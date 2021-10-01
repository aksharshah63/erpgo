@extends('layouts.admin')
@section('title')
    {{ __('View Contact') }}
@endsection
@section('action-button')
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
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
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Basic Info') }}</a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#tag" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-tags"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Tag') }}</a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#assign_com" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-industry"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Companies') }}</a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#assign_con" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-users"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Contact Group') }}</a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#accountopportunities" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-history"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Activities') }}</a>
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
                                    <img class="avatar avatar-lg" {{ $contact->contactdetail->img_image }} alt="Owner">
                                </a>
                                <div class="media-body">
                                    <h5 class="text-white mb-0"> {{ ucfirst($contact->name) }}</h5>
                                    <div>
                                        {{ Form::open(['route' => ['update.contact.profile'], 'enctype' => 'multipart/form-data', 'id' => 'update_avatar']) }}
                                        <input type="file" name="image" id="image"
                                            class="custom-input-file custom-input-file-link"
                                            data-multiple-caption="{count} files selected" multiple />
                                        <input type="hidden" name="id"
                                            value="{{ $contact->contactdetail->contact_id }}" />
                                        <label for="image">
                                            <span class="text-white" style="cursor: pointer;">{{ __('Change Avatar') }}</span>
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
                                <span class="d-block h6 mb-0 p-2">{{ $contact->name }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Email') }}</span>
                                <span class="d-block h6 mb-0 p-2"><a
                                        href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Date Of Birth') }}</span>
                                <span
                                    class="d-block h6 mb-0 p-2">{{ !empty($contact->contactdetail->date_of_birth) ? Utility::getDateFormated($contact->contactdetail->date_of_birth) : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Age') }}</span>
                                <span
                                    class="d-block h6 mb-0 p-2">{{ !empty($contact->contactdetail->age) ? $contact->contactdetail->age : '-' }}</span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Phone') }}</span>
                                <span class="d-block h6 mb-0 p-2"><a
                                        href="tel:{{ $contact->contactdetail->phone_no }}">{{ !empty($contact->contactdetail->phone_no) ? $contact->contactdetail->phone_no : '-' }}</a></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Mobile') }}</span>
                                <span class="d-block h6 mb-0 p-2"><a
                                        href="tel:{{ $contact->contactdetail->mobile_no }}">{{ !empty($contact->contactdetail->mobile_no) ? $contact->contactdetail->mobile_no : '-' }}</a></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Life Stage') }}</span>
                                <span
                                    class="d-block h6 mb-0 p-2">{{ __(\App\Contact::$lifestage[$contact->contactdetail->life_stage]) }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Website') }}</span>
                                <span
                                    class="d-block h6 mb-0 p-2">{{ !empty($contact->contactdetail->website) ? $contact->contactdetail->website : '-' }}</span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Fax') }}</span>
                                <span
                                    class="d-block h6 mb-0 p-2">{{ !empty($contact->contactdetail->fax_no) ? $contact->contactdetail->fax_no : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Address1') }}</span>
                                <span
                                    class="d-block h6 mb-0 p-2">{{ !empty($contact->contactdetail->address1) ? $contact->contactdetail->address1 : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Address2') }}</span>
                                <span
                                    class="d-block h6 mb-0 p-2">{{ !empty($contact->contactdetail->address2) ? $contact->contactdetail->address2 : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('City') }}</span>
                                <span
                                    class="d-block h6 mb-0 p-2">{{ !empty($contact->contactdetail->city) ? $contact->contactdetail->city : '-' }}</span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Country') }}</span>
                                <span
                                    class="d-block h6 mb-0 p-2">{{ !empty($contact->contactdetail->country) ? $contact->contactdetail->country : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('State') }}</span>
                                <span
                                    class="d-block h6 mb-0 p-2">{{ !empty($contact->contactdetail->state) ? $contact->contactdetail->state : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Postel Code') }}</span>
                                <span
                                    class="d-block h6 mb-0 p-2">{{ !empty($contact->contactdetail->zip_code) ? $contact->contactdetail->zip_code : '-' }}</span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2">{{ __('Source') }}</span>
                                <span
                                    class="d-block h6 mb-0 p-2">{{ !empty($contact->contactdetail->contact_source) ? __(\App\Contact::$contactsource[$contact->contactdetail->contact_source]) : '-' }}</span>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
            <div id="accountopportunities" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ __('New Note') }}</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="{{ __('Add New Note') }}"
                                        data-size='lg'
                                        data-url="{{ route('notes.create', ['type' => 'contact', 'id' => $contact->id]) }}"
                                        class="action-item"><i class="fas fa-plus"></i></a>
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
                                        <th scope="col" class="sort" data-sort="status" width="95%">{{ __('Note') }}
                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="5%">{{ __('Action') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (count($notes) > 0)
                                        @foreach ($notes as $note)
                                            <tr>
                                                <td class="text-wrap" width="75%">{!! $note->note !!}</td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-url="{{ route('notes.edit', $note->id) }}"
                                                                    data-ajax-popup="true"
                                                                    data-title="{{ __('Edit Note') }}"
                                                                    data-original-title="{{ __('Edit') }}"
                                                                    data-size='lg'>{{ __('Edit') }}</a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="{{ __('Delete') }}"
                                                                    data-confirm="{{ __('Are You Sure?|This action can not be undone. Do you want to continue?') }}"
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
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ __('Log Activity') }}</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="{{ __('Add New Log') }}"
                                        data-size='lg'
                                        data-url="{{ route('log_activities.create', ['type' => 'contact', 'id' => $contact->id]) }}"
                                        class="action-item"><i class="fas fa-plus"></i></a>
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
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Note') }}
                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Type') }}
                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">
                                            {{ __('Start Date') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Time') }}
                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Action') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (count($logactivities) > 0)
                                        @foreach ($logactivities as $logactivity)
                                            <tr>
                                                <td class="text-wrap" width="50%">{!! $logactivity->note !!}</td>
                                                <td>{{ __(\App\LogActivity::$type[$logactivity->type]) }}</td>
                                                <td>{{ Utility::getDateFormated($logactivity->start_date) }}</td>
                                                <td>{{ Utility::timeFormat($logactivity->time) }}</td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-url="{{ route('log_activities.edit', $logactivity->id) }}"
                                                                    data-ajax-popup="true"
                                                                    data-title="{{ __('Edit Log Activity') }}"
                                                                    data-original-title="{{ __('Edit') }}"
                                                                    data-size='lg'>{{ __('Edit') }}</a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="{{ __('Delete') }}"
                                                                    data-confirm="{{ __('Are You Sure?|This action can not be undone. Do you want to continue?') }}"
                                                                    data-confirm-yes="document.getElementById('delete-form-{{ $logactivity->id }}').submit();">
                                                                    {{ __('Remove') }}
                                                                </a>
                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['log_activities.destroy', $logactivity->id], 'id' => 'delete-form-' . $logactivity->id]) }}
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
                                <h6 class="mb-0">{{ __('Schedule') }}</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="{{ __('Add New Schedule') }}"
                                        data-size='lg'
                                        data-url="{{ route('schedules.create', ['type' => 'contact', 'id' => $contact->id]) }}"
                                        class="action-item"><i class="fas fa-plus"></i></a>
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
                                        <th scope="col" class="sort" data-sort="status" width="20%">
                                            {{ __('Schedule Title') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">
                                            {{ __('Start Date') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('End Date') }}
                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Note') }}
                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Action') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (count($schesules) > 0)
                                        @foreach ($schesules as $schedule)
                                            <tr>
                                                <td>{{ $schedule->title }}</td>
                                                <td>{{ Utility::getDateFormated($schedule->start_date) }}</td>
                                                <td>{{ Utility::getDateFormated($schedule->end_date) }}</td>
                                                <td class="text-wrap" width="50%">{!! $schedule->note !!}</td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-url="{{ route('schedules.edit', $schedule->id) }}"
                                                                    data-ajax-popup="true"
                                                                    data-title="{{ __('Edit Schedule') }}"
                                                                    data-original-title="{{ __('Edit') }}"
                                                                    data-size='lg'>{{ __('Edit') }}</a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="{{ __('Delete') }}"
                                                                    data-confirm="{{ __('Are You Sure?|This action can not be undone. Do you want to continue?') }}"
                                                                    data-confirm-yes="document.getElementById('delete-form-{{ $schedule->id }}').submit();">
                                                                    {{ __('Remove') }}
                                                                </a>
                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['schedules.destroy', $schedule->id], 'id' => 'delete-form-' . $schedule->id]) }}
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
                                <h6 class="mb-0">{{ __('Email') }}</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="{{ __('Add New Email') }}"
                                        data-size='lg'
                                        data-url="{{ route('emails.create', ['type' => 'contact', 'id' => $contact->id]) }}"
                                        class="action-item"><i class="fas fa-plus"></i></a>
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
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Email') }}
                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Subject') }}
                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">
                                            {{ __('Description') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Action') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (count($emails) > 0)
                                        @foreach ($emails as $email)
                                            <tr>
                                                <td>{{ $email->email }}</td>
                                                <td>{{ $email->subject }}</td>
                                                <td class="text-wrap" width="50%">{!! $email->description !!}</td>
                                                <td>{{ $email->created_at->diffForHumans() }}</td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-url="{{ route('emails.show', $email->id) }}"
                                                                    data-ajax-popup="true"
                                                                    data-title="{{ __('View Email') }}"
                                                                    data-original-title="{{ __('View') }}"
                                                                    data-size='lg'>{{ __('View') }}</a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="{{ __('Delete') }}"
                                                                    data-confirm="{{ __('Are You Sure?|This action can not be undone. Do you want to continue?') }}"
                                                                    data-confirm-yes="document.getElementById('delete-form-{{ $email->id }}').submit();">
                                                                    {{ __('Remove') }}
                                                                </a>
                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['emails.destroy', $email->id], 'id' => 'delete-form-' . $email->id]) }}
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
                                <h6 class="mb-0">{{ __('Task') }}</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="{{ __('Add New Task') }}"
                                        data-size='lg'
                                        data-url="{{ route('tasks.create', ['type' => 'contact', 'id' => $contact->id]) }}"
                                        class="action-item"><i class="fas fa-plus"></i></a>
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
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Title') }}
                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Manager') }}
                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Date') }}
                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">
                                            {{ __('Description') }}</th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">{{ __('Action') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (count($tasks) > 0)
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>{{ $task->title }}</td>
                                                <td>{{ $task->agent_or_manager }}</td>
                                                <td>{{ Utility::getDateFormated($task->date) }}</td>
                                                <td class="text-wrap" width="50%">{!! $task->description !!}</td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-url="{{ route('tasks.edit', $task->id) }}"
                                                                    data-ajax-popup="true"
                                                                    data-title="{{ __('Edit Task') }}"
                                                                    data-original-title="{{ __('Edit') }}"
                                                                    data-size='lg'>{{ __('Edit') }}</a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="{{ __('Delete') }}"
                                                                    data-confirm="{{ __('Are You Sure?|This action can not be undone. Do you want to continue?') }}"
                                                                    data-confirm-yes="document.getElementById('delete-form-{{ $task->id }}').submit();">
                                                                    {{ __('Remove') }}
                                                                </a>
                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['tasks.destroy', $task->id], 'id' => 'delete-form-' . $task->id]) }}
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
            <div id="tag" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0">{{ __('Tag') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                {{ Form::open(['url' => 'add-tag', 'method' => 'post']) }}
                                <div class="form-group">
                                    {{ Form::text('tag', isset($contact->tag) ? $contact->tag->text : '', ['class' => 'form-control', 'data-toggle' => 'tags']) }}
                                </div>
                                <div class="col-12 pt-5 text-right">
                                    {{ Form::hidden('type', 'contact') }}
                                    {{ Form::hidden('id', $contact->id) }}
                                    <button type="submit"
                                        class="btn btn-sm btn-primary btn-icon rounded-pill ">{{ __('Save') }}</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="assign_com" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h6 mb-0">{{ __('Companies') }}</h5>
                    </div>
                    <div class="card-body">
                        {{ Form::model($contact, ['route' => ['add.company', $contact->id], 'method' => 'PUT']) }}
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::select('company', $companies, null, ['class' => 'form-control main-element']) }}
                                </div>
                            </div>
                            <div class="col-12 pt-5 text-right">
                                <button type="submit"
                                    class="btn btn-sm btn-primary btn-icon rounded-pill">{{ __('Save') }}</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div id="assign_con" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0">{{ __('Contact Group') }}</h5>
                    </div>
                    <div class="card-body">
                        {{ Form::model($contact, ['route' => ['update.contact-groups', $contact->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                            <div class="row">
                                <div class="col-sm-12 col-md-8">
                                    <div class="form-group">
                                        @foreach (Auth::user()->contact_groups as $contactgroup)
                                            <div class="custom-control custom-checkbox">
                                                {{ Form::checkbox('contact_group[]', $contactgroup->name, in_array($contactgroup->name, explode(',', $contact->contactdetail->assign_group)), ['class' => 'custom-control-input', 'id' => $contactgroup->name]) }}
                                                {{ Form::label($contactgroup->name, $contactgroup->name, ['class' => 'custom-control-label']) }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12 pt-5 text-right">
                                    {{ Form::submit('Update', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '.all_day', function() {
                if ($(this).prop("checked") == true) {
                    $(".start_time").addClass('d-none');
                    $(".end_time").addClass('d-none');
                } else if ($(this).prop("checked") == false) {
                    $(".start_time").removeClass('d-none');
                    $(".end_time").removeClass('d-none');
                }
            });

            $(document).on('change', '.all_notification', function() {
                if ($('.all_notification').is(":checked"))
                    $(".notification_allow").removeClass('d-none');
                else
                    $(".notification_allow").addClass('d-none');
            });

            $(document).on('change', '#image', function() {
                $('#update_avatar').submit();
            });
        });

    </script>
@endpush
