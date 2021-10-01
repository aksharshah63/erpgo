@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Users') }}
@endsection
@section('action-button')
    @can('Create Employee')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New User') }}" data-size='xl' data-url="{{ route('users.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Employee Name') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Designation') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Department') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Employement Type') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Joined') }}</th>
                @if(Gate::check('View Employee') || Gate::check('Edit Employee') || Gate::check('Delete Employee'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @if ($department->user_details->count() > 0)
                @foreach ($department->user_details as $user_detail)
                    <tr>
                        <td>{{ $user_detail->user->name }} </td>
                        <td>{{ (!empty($user_detail->designationDesc) ?  $user_detail->designationDesc->title : '-') }}</td>
                        <td>{{ (!empty($department->title) ?  $department->title : '-') }}</td>
                        <td>{{ $user_detail->user->user_type }}</td>
                        <td>{{ Utility::getDateFormated($user_detail->user->date_of_hire) }}</td>
                        @if(Gate::check('View Employee') || Gate::check('Edit Employee') || Gate::check('Delete Employee'))
                            <td>
                                <!-- Actions -->
                                <div class="actions ml-12">
                                    @can('View Employee')
                                        <a href="{{ route('users.show', $user_detail->user->id) }}" class="action-item"
                                            data-toggle="tooltip" title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endcan
                                    @can('Edit Employee')
                                        <a href="#" class="action-item"
                                            data-url="{{ route('users.edit', $user_detail->user->id) }}" data-ajax-popup="true"
                                            data-title="{{ __('Edit User') }}" data-toggle="tooltip"
                                            data-original-title="{{ __('Edit') }}" data-size='xl'>
                                            <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                        </a>
                                    @endcan
                                    @can('Delete Employee')
                                        <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                            data-original-title="{{ __('Delete') }}"
                                            data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                            data-confirm-yes="document.getElementById('delete-form-{{ $user_detail->user->id }}').submit();">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        {{ Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user_detail->user->id], 'id' => 'delete-form-' . $user_detail->user->id]) }}
                                        {{ Form::close() }}
                                    @endcan
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @else
                <tr class="font-style">
                    <td colspan="6" class="text-center">
                        <h6 class="text-center">{{ __('No Users Found.') }}</h6>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

</div>
@endsection
