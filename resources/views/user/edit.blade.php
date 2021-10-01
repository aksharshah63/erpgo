
<form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @PUT
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title d-flex align-items-center" id="modal-title-change-username">
                            <div>
                                <div class="icon icon-sm icon-shape icon-info rounded-circle shadow mr-3">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-0">{{__('Edit User')}}</h6>
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