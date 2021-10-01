@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Accouncements') }}
@endsection
@section('action-button')
    @can('Create Announcement')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Announcement') }}" data-size='lg' data-url="{{ route('announcements.create') }}">
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
                <th scope="col" class="sort" data-sort="status">{{ __('Sent To') }}</th>
                @if(Gate::check('Edit Announcement') || Gate::check('Delete Announcement'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($announcements as $announcement)
                <tr>
                    <td>{{ __($announcement->title) }}</td>
                    <td>{{ (!empty($announcement->send_announcement_to) ?  \App\Announcement::$send_announcement_to[$announcement->send_announcement_to] : '-') }}</td>
                    @if(Gate::check('Edit Announcement') || Gate::check('Delete Announcement'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('Edit Announcement')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('announcements.edit', $announcement->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Announcement') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='lg'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Announcement')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $announcement->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['announcements.destroy', $announcement->id], 'id' => 'delete-form-' . $announcement->id]) }}
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
<script>
    $(document).on('change', '#send_announcement_to', function() {
        var id = $(this).val();
        $('.annoucement_choise').addClass('d-none');
        $('#'+id).removeClass('d-none');
        $('.select2-dropdown').select2();
    });
</script>
@endpush
