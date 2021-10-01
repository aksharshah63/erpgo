@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Chart of Accounts') }}
@endsection
@section('action-button')
    @can('Create Chart of Account')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Chart of Account') }}" data-size='md' data-url="{{ route('chart_of_accounts.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

@section('content')
    <div class="row">
        @foreach($chartAccounts as $type=>$accounts)
            <div class="col-md-12">
                <div class="card-header">
                    <h6>{{$type}}</h6>
                </div>
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th> {{__('Code')}}</th>
                                <th> {{__('Name')}}</th>
                                <th> {{__('Type')}}</th>
                                <th> {{__('Balance')}}</th>
                                <th> {{__('Status')}}</th>
                                @if(Gate::check('View Chart of Account') || Gate::check('Edit Chart of Account') || Gate::check('Delete Chart of Account'))
                                    <th> {{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($accounts as $account)

                                <tr>
                                    <td>{{ $account->code }}</td>
                                    <td>{{ $account->name }}</td>
                                    <td>{{!empty($account->subType)?$account->subType->name:'-'}}</td>
                                    <td>
                                        @if(!empty($account->balance()) && $account->balance()['netAmount']<0)
                                            {{__('Dr').'. '.\Auth::user()->priceFormat(abs($account->balance()['netAmount']))}}
                                        @elseif(!empty($account->balance()) && $account->balance()['netAmount']>0)
                                            {{__('Cr').'. '.\Auth::user()->priceFormat($account->balance()['netAmount'])}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($account->is_enabled==1)
                                            <span class="badge badge-success">{{__('Enabled')}}</span>
                                        @else
                                            <span class="badge badge-danger">{{__('Disabled')}}</span>
                                        @endif
                                    </td>
                                    @if(Gate::check('View Chart of Account') || Gate::check('Edit Chart of Account') || Gate::check('Delete Chart of Account'))
                                        <td>
                                            <!-- Actions -->
                                            <div class="actions ml-12">
                                                @can('View Chart of Account')
                                                    <a href="{{route('report.ledger')}}?account={{$account->id}}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Ledger Summary')}}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('Edit Chart of Account')
                                                    <a href="#" class="action-item"
                                                        data-url="{{ route('chart_of_accounts.edit', $account->id) }}" data-ajax-popup="true"
                                                        data-title="{{ __('Edit Chart of Account') }}" data-toggle="tooltip"
                                                        data-original-title="{{ __('Edit') }}" data-size='md'>
                                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                                    </a>
                                                @endcan
                                                @can('Delete Chart of Account')
                                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                                        data-original-title="{{ __('Delete') }}"
                                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                                        data-confirm-yes="document.getElementById('delete-form-{{ $account->id }}').submit();">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {{ Form::open(['method' => 'DELETE', 'route' => ['chart_of_accounts.destroy', $account->id], 'id' => 'delete-form-' . $account->id]) }}
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
                </div>
            </div>
        @endforeach
    </div>

@endsection
@push('script')
    <script>
        $(document).on('change', '#type', function () {
            var type = $(this).val();
            $.ajax({
                url: '{{route('charofAccount.subType')}}',
                type: 'POST',
                data: {
                    "type": type, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    $('#sub_type').empty();
                    $.each(data, function (key, value) {
                        $('#sub_type').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        });

    </script>
@endpush