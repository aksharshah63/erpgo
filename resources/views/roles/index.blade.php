@extends('layouts.admin')

@section('title')
    {{__('Manage Roles')}}
@endsection

@section('action-button')
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        @can('Create Role')
            <a href="#" data-url="{{ route('roles.create') }}" data-ajax-popup="true" data-size="lg" data-title="{{__('Create Role')}}" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        @endcan
    <!-- @can('Manage Permissions')
        <a href="{{ route('permissions.index') }}" class="btn btn-primary btn-sm"><i class="fas fa-lock"></i> {{__('Permissions')}} </a>
    @endcan -->
    </div>

@endsection
@section('content')
   
<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
        <tr>
            <th scope="col" class="sort" data-sort="status">{{__('Role')}}</th>
            <th scope="col" class="sort" data-sort="status">{{__('Permissions')}}</th>
            @if(Gate::check('Edit Role') || Gate::check('Delete Role'))
                <th width="200px">{{__('Action')}}</th>
            @endif
        </tr>
        </thead>
        <tbody class="list">
        @foreach ($roles as $role)
            <tr>
                <td class="Role">{{ $role->name }}</td>
                <td class="Permission">
                    @foreach($role->permissions()->pluck('name') as $permission)
                        <a href="#" class="absent-btn">{{$permission}}</a>
                    @endforeach
                </td>
                @if(Gate::check('Edit Role') || Gate::check('Delete Role'))
                    <td class="Action">
                        @can('Edit Role')
                                <a href="#" data-url="{{ URL::to('roles/'.$role->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Role')}}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                        @endcan
                        @can('Delete Role')
                            <a href="#" class="action-item text-danger" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$role->id}}').submit();"><i class="fas fa-trash"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id],'id'=>'delete-form-'.$role->id]) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
                
@endsection
