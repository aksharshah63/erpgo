@extends('layouts.admin')

@section('title')
    {{__('Manage Permissions')}}
@endsection

@push('head')
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
@endpush

@push('script')
    <script src="{{asset('assets/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/modules/jquery-ui/jquery-ui.min.js')}}"></script>
@endpush

@section('action-button')
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        {{-- @can('Create Permission') --}}
            <a href="#" data-url="{{ route('permissions.create') }}" data-ajax-popup="true" data-title="{{__('Create Permission')}}" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        {{-- @endcan --}}
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table align-items-center dataTable">
            <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{__('Permissions')}}</th>
                <th class="text-right" width="200px">{{__('Action')}}</th>
            </tr>
            </thead>
            <tbody class="list">
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td class="text-right">
                        @can('Edit Permission')
                            <a href="#" data-url="{{ URL::to('permissions/'.$permission->id.'/edit') }}" data-ajax-popup="true" data-title="{{__('Edit Permission')}}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                        @endcan
                        @can('Delete Permission')
                            <a href="#" class="action-item text-danger" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$permission->id}}').submit();"><i class="fas fa-trash"></i> </a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id],'id'=>'delete-form-'.$permission->id]) !!}
                            {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
                
@endsection
