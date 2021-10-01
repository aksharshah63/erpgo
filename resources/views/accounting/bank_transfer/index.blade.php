@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Bank Transfer') }}
@endsection
@section('action-button')
    @can('Create Bank Transfer')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Bank Transfer') }}" data-size='md' data-url="{{ route('transfers.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Date') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('From  Account') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('To  Account') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Amount') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Reference') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Description') }}</th>
                @if(Gate::check('Edit Bank Transfer') || Gate::check('Delete Bank Transfer'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($transfers as $bank_transfer)
                <tr>
                    <td>{{  Utility::getDateFormated($bank_transfer->date)}}</td>
                    <td>{{ !empty($bank_transfer->fromBankAccount())? $bank_transfer->fromBankAccount()->bank_name.' '.$bank_transfer->fromBankAccount()->holder_name:''}}</td>
                    <td>{{ !empty( $bank_transfer->toBankAccount())? $bank_transfer->toBankAccount()->bank_name.' '. $bank_transfer->toBankAccount()->holder_name:''}}</td>
                    <td>{{ number_format($bank_transfer->amount,2)}}</td>
                    <td>{{ !empty($bank_transfer->reference) ? $bank_transfer->reference :'-'}}</td>
                    <td>{{ !empty($bank_transfer->description) ? $bank_transfer->description : '-'}}</td>
                    @if(Gate::check('Edit Bank Transfer') || Gate::check('Delete Bank Transfer'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('Edit Bank Transfer')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('transfers.edit', $bank_transfer->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Bank Transfer') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Bank Transfer')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $bank_transfer->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['transfers.destroy', $bank_transfer->id], 'id' => 'delete-form-' . $bank_transfer->id]) }}
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
