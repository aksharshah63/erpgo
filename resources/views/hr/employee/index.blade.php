@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Users') }}
@endsection
@section('action-button')
    @can('Create Employee')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New User') }}" data-size='lg' data-url="{{ route('users.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('User Name') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Designation') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Department') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('User Type') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Joined') }}</th>
                @if(Gate::check('View Employee') || Gate::check('Edit Employee') || Gate::check('Delete Employee'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @if (count($users) > 0)
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }} </td>
                        <td>{{ (!empty($user->userdetail->designationDesc->title) ?  $user->userdetail->designationDesc->title : '-') }}</td>
                        <td>{{ (!empty($user->userdetail->departmentDesc->title) ?  $user->userdetail->departmentDesc->title : '-') }}</td>
                        <td>{{ (!empty($user->user_type) ? __(\App\UserDetail::$user_type[$user->user_type]) : '-' )}}</td>
                        <td>{{ Utility::getDateFormated($user->date_of_hire) }}</td>
                        @if(Gate::check('View Employee') || Gate::check('Edit Employee') || Gate::check('Delete Employee'))
                            <td>
                                <!-- Actions -->
                                <div class="actions ml-12">
                                    @can('View Employee')
                                        <a href="{{ route('users.show', $user->id) }}" class="action-item"
                                            data-toggle="tooltip" title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endcan
                                    @can('Edit Employee')
                                        <a href="#" class="action-item"
                                            data-url="{{ route('users.edit', $user->id) }}" data-ajax-popup="true"
                                            data-title="{{ __('Edit User') }}" data-toggle="tooltip"
                                            data-original-title="{{ __('Edit') }}" data-size='lg'>
                                            <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                        </a>
                                    @endcan
                                    @can('Delete Employee')
                                        <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                            data-original-title="{{ __('Delete') }}"
                                            data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                            data-confirm-yes="document.getElementById('delete-form-{{ $user->id }}').submit();">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        {{ Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'id' => 'delete-form-' . $user->id]) }}
                                        {{ Form::close() }}
                                    @endcan
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

</div>
@endsection
