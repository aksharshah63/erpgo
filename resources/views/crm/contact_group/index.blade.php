@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Contact Group') }}
@endsection
@section('action-button')
    @can('Create Contact Group')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Contact Group') }}" data-size='lg' data-url="{{ route('contact_groups.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{__('Name')}}</th>
                <th scope="col" class="sort" data-sort="status">{{__('Description')}}</th>
                <th scope="col" class="sort" data-sort="status">{{__('Private')}}</th>
                @if(Gate::check('Edit Contact Group') || Gate::check('Delete Contact Group'))
                    <th>{{__('Action')}}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($contact_groups as $contactgroup)
                <tr>
                    <td>{{ $contactgroup->name }}</td>
                    <td>{{ (!empty($contactgroup->description) ? $contactgroup->description : '-') }}</td>
                    <td>{{ ($contactgroup->private==1) ? __("Yes") : __("No") }} </td>
                    @if(Gate::check('Edit Contact Group') || Gate::check('Delete Contact Group'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('Edit Contact Group')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('contact_groups.edit', $contactgroup->id) }}"
                                        data-ajax-popup="true" data-title="{{ __('Edit Contact Group') }}"
                                        data-toggle="tooltip" data-original-title="{{ __('Edit') }}" data-size='lg'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Contact Group')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $contactgroup->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['contact_groups.destroy', $contactgroup->id], 'id' => 'delete-form-' . $contactgroup->id]) }}
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
