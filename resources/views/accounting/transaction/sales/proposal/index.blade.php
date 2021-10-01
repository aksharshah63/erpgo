@extends('layouts.admin')
@section('title')
    {{__('Manage Proposals')}}
@endsection
@section('action-button')
    @can('Create Invoice Proposal')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-12">
                <div class="all-button-box">
                    <a href="{{ route('proposals.create') }}" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
                        <i class="fas fa-plus"></i> {{__('Create')}}
                    </a>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table align-items-center dataTable">
                    <thead>
                        <tr>
                            <th> {{__('Proposal')}}</th>
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Transaction Date')}}</th>
                            <th>{{__('Status')}}</th>
                            @if(Gate::check('Edit Invoice Proposal') || Gate::check('Delete Invoice Proposal') || Gate::check('View Invoice Proposal') || Gate::check('Duplicate Invoice Proposal'))
                                <th>{{__('Action')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($proposals as $proposal)
                            <tr>
                                <td class="Id"><a href="{{ route('proposals.show',$proposal->id) }}">{{ Auth::user()->proposalNumberFormat($proposal->proposal_id) }}</a></td>
                                <td> {{!empty($proposal->customer)? $proposal->customer->first_name. ' '.$proposal->customer->last_name:'' }} </td>
                                <td>{{ Utility::getDateFormated($proposal->transaction_date) }}</td>
                                <td>
                                    @if($proposal->status == 0)
                                        <span class="badge badge-pill badge-primary">{{ __(\App\Proposal::$statues[$proposal->status]) }}</span>
                                    @elseif($proposal->status == 1)
                                        <span class="badge badge-pill badge-info">{{ __(\App\Proposal::$statues[$proposal->status]) }}</span>
                                    @elseif($proposal->status == 2)
                                        <span class="badge badge-pill badge-success">{{ __(\App\Proposal::$statues[$proposal->status]) }}</span>
                                    @elseif($proposal->status == 3)
                                        <span class="badge badge-pill badge-warning">{{ __(\App\Proposal::$statues[$proposal->status]) }}</span>
                                    @elseif($proposal->status == 4)
                                        <span class="badge badge-pill badge-danger">{{ __(\App\Proposal::$statues[$proposal->status]) }}</span>
                                    @endif
                                </td>
                                @if(Gate::check('Edit Invoice Proposal') || Gate::check('Delete Invoice Proposal') || Gate::check('View Invoice Proposal') || Gate::check('Duplicate Invoice Proposal'))
                                    <td class="Action">
                                        @can('Duplicate Invoice Proposal')
                                            <a href="#" class="action-item" data-toggle="tooltip" data-original-title="{{__('Duplicate')}}" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('You want to confirm duplicate this Proposal.').'|'.__('Press Yes to continue or Cancel to go back')}}" data-confirm-yes="document.getElementById('duplicate-form-{{$proposal->id}}').submit();">
                                                <i class="fas fa-copy"></i>
                                                {!! Form::open(['method' => 'get', 'route' => ['proposal.duplicate', $proposal->id],'id'=>'duplicate-form-'.$proposal->id]) !!}
                                                    {!! Form::close() !!}
                                            </a>
                                        @endcan
                                        @can('View Invoice Proposal')
                                            <a href="{{ route('proposals.show',$proposal->id) }}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Detail')}}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endcan
                                        @can('View Invoice Proposal')
                                            <a href="{{ route('proposals.edit',$proposal->id) }}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endcan
                                        @can('Delete Invoice Proposal')
                                            <a href="#" class="action-item text-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This Action Can Not Be Undone. Do You Want To Continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$proposal->id}}').submit();">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['proposals.destroy', $proposal->id],'id'=>'delete-form-'.$proposal->id]) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection