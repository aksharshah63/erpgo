@extends('layouts.admin')
@section('content')
    
    <div class="modal fade" id="modal-catlog-create" tabindex="-1" role="dialog" aria-labelledby="modal-change-username" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title d-flex align-items-center" id="modal-title-change-username">
                            <div>
                                <div class="icon icon-sm icon-shape icon-info rounded-circle shadow mr-3">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-0">{{__('Add user')}}</h6>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('Username')}}</label>
                                    <input class="form-control" type="text" name="username">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('Email')}}</label>
                                    <input class="form-control" type="text" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('Website')}}</label>
                                    <input class="form-control" type="text" name="website">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('Name')}}</label>
                                    <input class="form-control" type="text" name="name">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('Role')}}</label>
                                        <select data-name="industry" class="form-control main-element" name="role">
                                            <option value="ac_manager">Accounting Manager</option>
                                            <option value="employee">Employee</option>
                                            <option value="subscriber">Subscriber</option>
                                            <option value="contributor">Contributor</option>
                                            <option value="author">Author</option>
                                            <option value="editor">Editor</option>
                                            <option value="admin">Administrator</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('Password')}}</label>
                                    <input class="form-control" type="text" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                            <input type="cheakbox" class="custom-control-input" name="project-privacy" id="radio-project-1">
                                            <label class="custom-control-label form-control-label text-muted" for="radio-project-1">{{__('Send the new user an email about their account.')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <!-- Card header -->
        <div class="card-header actions-toolbar border-0">
            <div class="actions-search" id="actions-search">
                <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-flush" placeholder="Type and hit enter ...">
                    <div class="input-group-append">
                        <a href="#" class="input-group-text bg-transparent" data-action="search-close" data-target="#actions-search"><i class="fas fa-times"></i></a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <h6 class="d-inline-block mb-0">Contact</h6>
                </div>
            </div>
        </div>
        <!-- Table -->
        <div class="table-responsive">

            <table class="table align-items-center" id="myTable">
                <thead>
                <tr>
                    <th scope="col" class="sort" data-sort="budget">{{__('Name')}}</th>
                    <th scope="col" class="sort" data-sort="status">{{__('Username')}}</th>
                    <th scope="col" class="sort" data-sort="status">{{__('Email')}}</th>
                    <th scope="col" class="sort" data-sort="status">{{__('Website')}}</th>
                    <th scope="col" class="sort" data-sort="status">{{__('Role')}}</th>
                    <th scope="col" class="sort" data-sort="status">{{__('Created by')}}</th>
                    <th>Action</th>
                </tr>
                </thead>

                        <tbody class="list">
                        @foreach($users as $userrr)
                        <tr>
                            <td>
                                {{$userrr->name}}
                            </td>
                            <td>
                                {{$userrr->username}}
                            </td>
                            <td>
                                {{$userrr->email}}
                            </td>
                            <td>
                                {{$userrr->website}}
                            </td>
                            <td>
                                {{$userrr->role}}
                            </td>
                            <td>
                                {{$userrr->created_by}}
                            </td>
                            <td>
                                <!-- Actions -->
                                <div class="actions ml-12">
                                    <a href="#" data-url="{{route('user.edit',$userrr->id)}}" data-ajax-popup="true" data-title="{{__('Edit User')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}" class="dropdown-item has-icon"><i class="fas fa-pencil-alt"></i> {{__('Edit')}}</a>
                                </div>                                
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
            </table>

        </div>
    </div>
@endsection
@section('title')
    {{ __('View Users') }}
@endsection
@section('action-button')
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="#modal-catlog-create" class="btn btn-sm btn-white btn-icon-only rounded-circle ml-4" data-toggle="modal">
            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
        </a>
    </div>
@endsection
