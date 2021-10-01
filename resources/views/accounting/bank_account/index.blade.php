@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Bank Account') }}
@endsection
@section('action-button')
    @can('Create Bank Account')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Bank Account') }}" data-size='md' data-url="{{ route('bank_accounts.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection
<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Name') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Bank') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Account Number') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Current Balance') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Contact Number') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Bank Branch') }}</th>
                @if(Gate::check('Edit Bank Account') || Gate::check('Delete Bank Account'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($bankaccounts as $bank_aacount)
                <tr>
                    <td>{{$bank_aacount->holder_name}}</td>
                    <td>{{$bank_aacount->bank_name}}</td>
                    <td>{{$bank_aacount->account_number}}</td>
                    <td>{{number_format($bank_aacount->opening_balance,2)}}</td>
                    <td>{{$bank_aacount->contact_number}}</td>
                    <td>{{$bank_aacount->bank_address}}</td>
                    @if(Gate::check('Edit Bank Account') || Gate::check('Delete Bank Account'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('Edit Bank Account')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('bank_accounts.edit', $bank_aacount->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Bank Account') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Bank Account')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $bank_aacount->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['bank_accounts.destroy', $bank_aacount->id], 'id' => 'delete-form-' . $bank_aacount->id]) }}
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
