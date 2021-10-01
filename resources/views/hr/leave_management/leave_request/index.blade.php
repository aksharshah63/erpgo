@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Leave Requests') }}
@endsection
@section('action-button')
    @can('Create Leave Request')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Leave Request') }}" data-size='md' data-url="{{ route('leave_requests.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection


<ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link status active" id="pills-home-tab" data-toggle="pill" href="#pending" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Pending').'('.__($pendingstatues).')'}}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link status" id="pills-profile-tab" data-toggle="pill" href="#approve" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('Approve').'('.__($approvestatues).')'}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link status" id="pills-profile-tab" data-toggle="pill" href="#reject" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('Reject').'('.__($rejectstatues).')'}}</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="table-responsive">
                <table class="table align-items-center dataTable">
                    <thead>
                        <tr>
                            <th scope="col" class="sort" data-sort="status">{{ __('User Name') }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __('From') }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __('To') }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __('Reason') }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __('Status') }}</th>
                            @if(Gate::check('Edit Leave Request'))
                                <th>{{ __('Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($leave_requests as $leave_request)
                            @if($leave_request->status=='Pending')
                                <tr>
                                    <td>{{ !empty($leave_request->user->name) ? $leave_request->user->name : '-' }}</td>
                                    <td>{{ Utility::getDateFormated($leave_request->from) }}</td>
                                    <td>{{ Utility::getDateFormated($leave_request->to) }}</td>
                                    <td>{{ $leave_request->reason }}</td>
                                    <td>{{ $leave_request->status }}</td>
                                    @if(Gate::check('Edit Leave Request'))
                                        <td>
                                            <!-- Actions -->
                                            <div class="actions ml-12">
                                                @can('Edit Leave Request')
                                                    <a href="#" class="action-item text-success approve">
                                                        <input type="hidden" value="{{$leave_request->user_id}}">
                                                        <i class="fas fa-check approve" data-toggle="tooltip" data-original-title="{{__('Approve')}}"></i>
                                                    </a>
                                                @endcan
                                                @can('Edit Leave Request')
                                                    <a href="#" class="action-item text-danger danger">
                                                        <input type="hidden" value="{{$leave_request->user_id}}">
                                                        <i class="fas fa-ban danger" data-toggle="tooltip" data-original-title="{{__('Reject')}}"></i>
                                                    </a>
                                                @endcan
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
        
            </div>
    </div>
    <div class="tab-pane fade" id="approve" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="table-responsive">
                <table class="table align-items-center dataTable">
                    <thead>
                        <tr>
                            <th scope="col" class="sort" data-sort="status">{{ __('User Name') }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __('From') }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __('To') }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __('Reason') }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($leave_requests as $leave_request)
                            @if($leave_request->status=='Approve')
                                <tr>
                                    <td>{{ !empty($leave_request->user->name) ? $leave_request->user->name : '-' }}</td>
                                    <td>{{ Utility::getDateFormated($leave_request->from) }}</td>
                                    <td>{{ Utility::getDateFormated($leave_request->to) }}</td>
                                    <td>{{ $leave_request->reason }}</td>
                                    <td>{{ $leave_request->status }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
        
            </div>
    </div>
    <div class="tab-pane fade" id="reject" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="table-responsive">
                <table class="table align-items-center dataTable">
                    <thead>
                        <tr>
                            <th scope="col" class="sort" data-sort="status">{{ __('User Name') }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __('From') }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __('To') }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __('Reason') }}</th>
                            <th scope="col" class="sort" data-sort="status">{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($leave_requests as $leave_request)
                            @if($leave_request->status=='Reject')
                                <tr>
                                    <td>{{ !empty($leave_request->user->name) ? $leave_request->user->name : '-' }}</td>
                                    <td>{{ Utility::getDateFormated($leave_request->from) }}</td>
                                    <td>{{ Utility::getDateFormated($leave_request->to) }}</td>
                                    <td>{{ $leave_request->reason }}</td>
                                    <td>{{ $leave_request->status }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection
@push('script')
<script>
$(document).on('change', '#employee', function() {
    var id = $(this).val();
    $.ajax({
        url: "{{ url('/get_employee') }}",
        data: {
            '_token': "{{ csrf_token() }}",
            'id': id,
        },
        type: "POST",
        success: function(data) {
    
        }
    });
});

$(document).on('click', '.fa-check', function() {
    var id = $(this).prev().val();
    $.ajax({
        url: "{{ url('/approve_leave') }}",
        data: {
            '_token': "{{ csrf_token() }}",
            'id': id,
        },
        type: "POST",
        success: function(data) {
            if(data.is_success == true)
            {
                show_toastr('{{__('Success')}}', data.msg, 'success');
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
            else
            {
                show_toastr('{{__('Error')}}', data.msg, 'errors');
            }
        }
    });
});

$(document).on('click', '.fa-ban', function() {
    var id = $(this).prev().val();
    $.ajax({
        url: "{{ url('/reject_leave') }}",
        data: {
            '_token': "{{ csrf_token() }}",
            'id': id,
        },
        type: "POST",
        success: function(data) {
            if(data.is_success == true)
            {
                show_toastr('{{__('Success')}}', data.msg, 'success');
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
            else
            {
                show_toastr('{{__('Error')}}', data.msg, 'errors');
            }
        }
    });
});
</script>
@endpush