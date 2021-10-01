<div class="list-group list-group-flush mb-4">
    <div class="row">
        @if(count($users) > 0)
            @foreach($users as $user)
                <div class="col-6">
                    <div class="list-group-item px-0">
                        <div class="row align-items-center">
                            <div class="col-auto ml-3">
                                <a href="#" class="avatar avatar-sm rounded-circle">
                                    <img {{$user->userdetail->img_image}} />
                                </a>
                            </div>
                            <div class="col ml-n2">
                                <p class="d-block h6 text-sm mb-0">{{ $user->name }}</p>
                                <p class="card-text text-sm text-muted mb-0">{{ $user->email }}</p>
                            </div>
                            <div class="col-auto text-right invite_usr" data-id="{{ $user->id }}">
                                <button type="button" class="btn btn-xs btn-animated btn-primary rounded-pill btn-animated-y mr-3">
                                <span class="btn-inner--visible">
                                <i class="fas fa-plus" id="usr_icon_{{$user->id}}"></i>
                                </span>
                                    <span class="btn-inner--hidden" id="usr_txt_{{$user->id}}">{{__('Add')}}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 text-center">
                <h5>{{__('No User Exist')}}</h5>
            </div>
        @endif
    </div>
    {{ Form::hidden('project_id', $project_id,['id'=>'project_id']) }}
</div>