@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Payment') }}
@endsection
@section('action-button')
    @can('Create Bill Payment')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Create New Payment') }}" data-size='lg' data-url="{{ route('payments.create') }}">
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
                <th scope="col" class="sort" data-sort="status">{{ __('Amount') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Account') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Vendor') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Category') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Reference') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Description') }}</th>
                @if(Gate::check('Edit Bill Payment') || Gate::check('Delete Bill Payment'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($payments as $payment)
                <tr>
                    <td>{{\App\Utility::getDateFormated($payment->date)}}</td>
                    <td>{{Auth::user()->priceFormat($payment->amount)}}</td>
                    <td>{{ !empty($payment->bankAccount)?$payment->bankAccount->bank_name.' '.$payment->bankAccount->holder_name:''}}</td>
                    <td>{{  !empty($payment->vendor)?$payment->vendor->first_name.' '.$payment->vendor->last_name:'-'}}</td>
                    <td>{{  !empty($payment->category)?$payment->category->name:'-'}}</td>
                    <td>{{  !empty($payment->reference)?$payment->reference:'-'}}</td>
                    <td>{{  !empty($payment->description)?$payment->description:'-'}}</td>
                    @if(Gate::check('Edit Bill Payment') || Gate::check('Delete Bill Payment'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('Edit Bill Payment')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('payments.edit', $payment->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Payment') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Bill Payment')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $payment->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['payments.destroy', $payment->id], 'id' => 'delete-form-' . $payment->id]) }}
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
