@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Payment Method') }}
@endsection
@section('action-button')
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
            data-title="{{ __('Add New Payment Method') }}" data-size='md' data-url="{{ route('payment_methods.create') }}">
            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
        </a>
    </div>
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Name') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody class="list">
            @if (count(Auth::user()->payment_methods) > 0)
                @foreach (Auth::user()->payment_methods as $payment_method)
                    <tr>
                        <td>{{$payment_method->name }}</td>
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                <a href="#" class="action-item"
                                    data-url="{{ route('payment_methods.edit', $payment_method->id) }}" data-ajax-popup="true"
                                    data-title="{{ __('Edit Payment Method') }}" data-toggle="tooltip"
                                    data-original-title="{{ __('Edit') }}" data-size='md'>
                                    <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                </a>
                                <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                    data-original-title="{{ __('Delete') }}"
                                    data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                    data-confirm-yes="document.getElementById('delete-form-{{ $payment_method->id }}').submit();">
                                    <i class="fas fa-trash"></i>
                                </a>
                                {{ Form::open(['method' => 'DELETE', 'route' => ['payment_methods.destroy', $payment_method->id], 'id' => 'delete-form-' . $payment_method->id]) }}
                                {{ Form::close() }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="font-style">
                    <td colspan="6" class="text-center">
                        <h6 class="text-center">{{ __('No Payment Methods Found.') }}</h6>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

</div>
@endsection
