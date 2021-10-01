@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Designations') }}
@endsection
@section('action-button')
    @can('Create Designation')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Designation') }}" data-size='md' data-url="{{ route('designations.create') }}">
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
                <th scope="col" class="sort" data-sort="status">{{ __('No of Employee') }}</th>
                @if(Gate::check('View Employee') || Gate::check('Edit Designation') || Gate::check('Delete Designation'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($designations as $designation)
                <tr>
                    <td>{{$designation->title }}</td>
                    <td>{{ (isset($user[$designation->id]) ? $user[$designation->id] : 0) }}</td>
                    @if(Gate::check('View Employee') || Gate::check('Edit Designation') || Gate::check('Delete Designation'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('View Employee')
                                    <a href="{{ route('designations.show', $designation->id) }}" class="action-item"
                                        data-toggle="tooltip" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endcan
                                @can('Edit Designation')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('designations.edit', $designation->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Designation') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Designation')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $designation->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['designations.destroy', $designation->id], 'id' => 'delete-form-' . $designation->id]) }}
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
