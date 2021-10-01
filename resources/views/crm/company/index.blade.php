@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Companies') }}
@endsection
@section('action-button')
    @can('Create Company')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Company') }}" data-size='lg' data-url="{{ route('companies.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Company Name') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Email Address') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Phone') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Life stage') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Owner') }}</th>
                @if(Gate::check('View Company') || Gate::check('Edit Company') || Gate::check('Delete Company'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ (!empty($company->companydetail->phone_no) ?  $company->companydetail->phone_no : '-') }}</td>
                    <td>{{ (!empty($company->companydetail->life_stage) ? __(\App\Company::$lifestage[$company->companydetail->life_stage]) : '-') }}</td>
                    <td>{{ (!empty($company->companydetail->user->name) ?  $company->companydetail->user->name : '-') }}</td>
                    @if(Gate::check('View Company') || Gate::check('Edit Company') || Gate::check('Delete Company'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('View Company')
                                    <a href="{{ route('companies.show', $company->id) }}" class="action-item"
                                        data-toggle="tooltip" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endcan
                                @can('Edit Company')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('companies.edit', $company->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Comapny') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='lg'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Company')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $company->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['companies.destroy', $company->id], 'id' => 'delete-form-' . $company->id]) }}
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
