@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Departments') }}
@endsection
@section('action-button')
    @can('Create Department')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Department') }}" data-size='md' data-url="{{ route('departments.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Title') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Department Leads') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('No of Employee') }}</th>
                @if(Gate::check('View Employee') || Gate::check('Edit Department') || Gate::check('Delete Department'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->title }}</td>
                    <td>{{ (isset($department->user->name) ?  $department->user->name : '-') }}</td>
                    <td>{{ (isset($user[$department->id]) ? $user[$department->id] : 0) }}</td>
                    @if(Gate::check('View Employee') || Gate::check('Edit Department') || Gate::check('Delete Department'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('View Employee')
                                    <a href="{{ route('departments.show', $department->id) }}" class="action-item"
                                        data-toggle="tooltip" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endcan
                                @can('Edit Department')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('departments.edit', $department->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Department') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Department')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $department->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['departments.destroy', $department->id], 'id' => 'delete-form-' . $department->id]) }}
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
