@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Contacts') }}
@endsection
@section('action-button')
    @can('Create Contact')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Contact') }}" data-size='lg' data-url="{{ route('contacts.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Contact Name') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Email Address') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Phone') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Life stage') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Owner') }}</th>
                @if(Gate::check('View Contact') || Gate::check('Edit Contact') || Gate::check('Delete Contact'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ (!empty($contact->contactdetail->phone_no) ?  $contact->contactdetail->phone_no : '-') }}</td>
                    <td>{{ (!empty($contact->contactdetail->life_stage) ? __(\App\Contact::$lifestage[$contact->contactdetail->life_stage]) : '-') }}</td>
                    <td>{{ (!empty($contact->contactdetail->user->name) ?  $contact->contactdetail->user->name : '-') }}</td>
                    @if(Gate::check('View Contact') || Gate::check('Edit Contact') || Gate::check('Delete Contact'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('View Contact')
                                    <a href="{{ route('contacts.show', $contact->id) }}" class="action-item"
                                        data-toggle="tooltip" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endcan
                                @can('Edit Contact')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('contacts.edit', $contact->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Contact') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='lg'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Contact')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $contact->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['contacts.destroy', $contact->id], 'id' => 'delete-form-' . $contact->id]) }}
                                    {{ Form::close() }}
                                @endcan
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
