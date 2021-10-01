@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Policies') }}
@endsection
@section('action-button')
    @can('Create Policy')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Policy') }}" data-size='md' data-url="{{ route('policies.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Policy Name') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Department') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Description') }}</th>
                @if(Gate::check('Edit Policy') || Gate::check('Delete Policy'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($policies as $policy)
                <tr>
                    <td>{{ $policy->policy_name }}</td>
                    <td>{{ $policy->departmentDesc->title }}</td>
                    <td class="text-wrap" width="50%">{!! $policy->description !!}</td>
                    @if(Gate::check('Edit Policy') || Gate::check('Delete Policy'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('Edit Policy')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('policies.edit', $policy->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Policy') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Policy')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $policy->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['policies.destroy', $policy->id], 'id' => 'delete-form-' . $policy->id]) }}
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
@push('script')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
@endpush