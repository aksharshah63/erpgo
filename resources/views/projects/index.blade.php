@extends('layouts.admin')
@section('title')
    {{ __('Manage Projects') }}
@endsection
@section('action-button')
    <div class="col-xs-12 col-sm-12 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
        @if($view == 'grid')
            <a href="{{ route('projects.list','list') }}" class="btn btn-sm btn-icon rounded-pill mr-2 m-0 btn btn-primary">
                <span class="btn-inner--icon">{{__('List View')}}</span>
            </a>
        @else
            <a href="{{ route('projects.index') }}" class="btn btn-sm btn-icon rounded-pill mr-2 m-0 btn btn-primary">
                <span class="btn-inner--icon">{{__('Card View')}}</span>
            </a>
        @endif
        <div class="btn-primary rounded-pill d-inline-block">
            <div class="input-group input-group-sm input-group-merge input-group-flush">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" id="project_keyword" class="form-control form-control-flush" placeholder="{{__('Search by Name or tag')}}">
            </div>
        </div>
        <div class="dropdown btn btn-sm btn-white btn-icon-only rounded-circle ml-2 m-0">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle btn btn-primary" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="btn-inner--icon"><i class="fas fa-filter"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-steady" id="project_sort">
                <a class="dropdown-item active" href="#" data-val="created_at-desc">
                    <i class="fas fa-sort-amount-down"></i>{{__('Newest')}}
                </a>
                <a class="dropdown-item" href="#" data-val="created_at-asc">
                    <i class="fas fa-sort-amount-up"></i>{{__('Oldest')}}
                </a>
                <a class="dropdown-item" href="#" data-val="project_name-asc">
                    <i class="fas fa-sort-alpha-down"></i>{{__('From A-Z')}}
                </a>
                <a class="dropdown-item" href="#" data-val="project_name-desc">
                    <i class="fas fa-sort-alpha-up"></i>{{__('From Z-A')}}
                </a>
            </div>
        </div>
        <div class="dropdown btn btn-sm btn-white btn-icon-only rounded-circle ml-2 m-0">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle btn btn-primary" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="btn-inner--icon"><i class="fas fa-flag"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right project-filter-actions dropdown-steady" id="project_status">
                <a class="dropdown-item filter-action filter-show-all pl-4 active" href="#">{{__('Show All')}}</a>
                @foreach(\App\Project::$project_status as $key => $val)
                    <a class="dropdown-item filter-action pl-4" href="#" data-val="{{ $key }}">{{__($val)}}</a>
                @endforeach
            </div> 
        </div>
        @can('Create Project')
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-2 btn btn-primary" data-url="{{ route('projects.create') }}" data-ajax-popup="true" data-size="lg" data-title="{{__('Create Project')}}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row min-750" id="project_view"></div>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        var sort = 'created_at-desc';
        var status = '';
        ajaxFilterProjectView('created_at-desc');
            //loadProjectUser();

         // when change status
        $(".project-filter-actions").on('click', '.filter-action', function (e) {
            if ($(this).hasClass('filter-show-all')) {
                $('.filter-action').removeClass('active');
                $(this).addClass('active');
            } else {
                $('.filter-show-all').removeClass('active');
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    $(this).blur();
                } else {
                    $(this).addClass('active');
                }
            }

            var filterArray = [];
            var url = $(this).parents('.project-filter-actions').attr('data-url');
            $('div.project-filter-actions').find('.active').each(function () {
                filterArray.push($(this).attr('data-val'));
            });

            status = filterArray;

            ajaxFilterProjectView(sort, $('#project_keyword').val(), status);
        });

        // when change sorting order
        $('#project_sort').on('click', 'a', function () {
                sort = $(this).attr('data-val');
                ajaxFilterProjectView(sort, $('#project_keyword').val(), status);
                $('#project_sort a').removeClass('active');
                $(this).addClass('active');
            });

        // when searching by project name
        $(document).on('keyup', '#project_keyword', function () {
            ajaxFilterProjectView(sort, $(this).val(), status);
        });


        $(document).on('click', '.invite_usr', function () {
            var project_id = $('#project_id').val();
            var user_id = $(this).attr('data-id');

            $.ajax({
                url: '{{ route('invite.project.user.member') }}',
                method: 'POST',
                dataType: 'json',
                data: {
                    'project_id': project_id,
                    'user_id': user_id,
                },
                success: function (data) {
                    if (data.code == '200') {
                        //$('#commonModal').modal('hide');
                        show_toastr(data.status, data.success, 'success')
                        setInterval('location.reload()', 5000); 
                        //loadProjectUser();
                        //if ($('#project_users').length > 0) {
                        //     loadProjectUser();
                        // } else {
                        //     ajaxFilterProjectView('created_at-desc', $('#project_keyword').val());
                        // }
                    } else if (data.code == '404') {
                        show_toastr(data.status, data.errors, 'error')
                    }
                }
            });
        });
    });

    var currentRequest = null;

        function ajaxFilterProjectView(project_sort, keyword = '', status = '') {
            var mainEle = $('#project_view');
            var view = '{{$view}}';
            var data = {
                view: view,
                sort: project_sort,
                keyword: keyword,
                status: status,
            }

            currentRequest = $.ajax({
                url: '{{ route('filter.project.view') }}',
                data: data,
                beforeSend: function () {
                    if (currentRequest != null) {
                        currentRequest.abort();
                    }
                },
                success: function (data) {
                    mainEle.html(data.html);
                    $('[id^=fire-modal]').remove();
                    loadConfirm();
                }
            });
        }
</script>
@endpush
