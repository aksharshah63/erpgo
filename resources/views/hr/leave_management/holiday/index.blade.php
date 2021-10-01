@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Holidays') }}
@endsection
@section('action-button')
    @can('Create Holiday')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Holiday') }}" data-size='md' data-url="{{ route('holidays.create') }}">
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
                <th scope="col" class="sort" data-sort="status">{{ __('Start Date') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('End Date') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Duration') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Description') }}</th>
                @if(Gate::check('Edit Holiday') || Gate::check('Delete Holiday'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($holidays as $holiday)
                <tr>
                    <td>{{ $holiday->holiday_name }}</td>
                    <td>{{ Utility::getDateFormated($holiday->start_date) }}</td>
                    <td>{{ (!empty($holiday->end_date) ?  Utility::getDateFormated($holiday->end_date) : '-') }}</td>
                    <td>{{ $holiday->days }} {{ __('Days') }}</td>
                    <td>{{ (!empty($holiday->description) ?  $holiday->description : '-') }}</td>
                    @if(Gate::check('Edit Holiday') || Gate::check('Delete Holiday'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('Edit Holiday')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('holidays.edit', $holiday->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Holiday') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Holiday')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $holiday->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['holidays.destroy', $holiday->id], 'id' => 'delete-form-' . $holiday->id]) }}
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
<script>
    $(document).ready(function() {
        $(document).on('change', '.range', function() {
            if ($('.range').is(":checked"))
                $(".enddate").removeClass('d-none');
            else
                $(".enddate").addClass('d-none');
        });
    });
</script>
@endpush
