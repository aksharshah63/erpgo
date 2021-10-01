@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Language') }}
@endsection
@section('action-button')
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" data-url="{{ route('create.language') }}" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true" data-title="{{__('Create New Language')}}">
                <i class="fas fa-plus"></i> 
            </a>
        @if($currantLang != (!empty(env('default_language')) ? env('default_language') : 'en'))
                <a href="#!" class="btn btn-sm btn-icon-only rounded-circle btn btn-danger" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').' | '.__('This Action Can Not Be Undone. Do You Want To Continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$currantLang}}').submit();">
                    <i class="fas fa-trash"></i> 
                </a>
                {!! Form::open(['method' => 'DELETE', 'route' => ['lang.destroy', $currantLang],'id'=>'delete-form-'.$currantLang]) !!}
                {!! Form::close() !!}
        @endif
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="language-wrap">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 language-list-wrap">
                        <div class="language-list">
                            <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                @foreach($languages as $lang)
                                    <li class="nav-item">
                                        <a href="{{route('manage.language',[$lang])}}" class="nav-link {{($currantLang == $lang)?'active':''}}">{{Str::upper($lang)}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 language-form-wrap">
                        <div class="language=form">
                            <div class="tab-content no-padding" id="myTab2Content">
                                <div class="tab-pane fade show active" id="lang1" role="tabpanel" aria-labelledby="home-tab4">
                                    <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __('Labels')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ __('Messages')}}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <form method="post" action="{{route('store.language.data',[$currantLang])}}">
                                                @csrf
                                                <div class="row">
                                                    @foreach($arrLabel as $label => $value)
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="example3cols1Input">{{$label}} </label>
                                                                <input type="text" class="form-control" name="label[{{$label}}]" value="{{$value}}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="col-12 pt-5 text-right">
                                                        <input type="submit" value="{{__('Save Change')}}" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <form method="post" action="{{route('store.language.data',[$currantLang])}}">
                                                @csrf
                                                <div class="row">
                                                    @foreach($arrMessage as $fileName => $fileValue)
                                                        <div class="col-lg-12">
                                                            <h3>{{ucfirst($fileName)}}</h3>
                                                        </div>
                                                        @foreach($fileValue as $label => $value)
                                                            @if(is_array($value))
                                                                @foreach($value as $label2 => $value2)
                                                                    @if(is_array($value2))
                                                                        @foreach($value2 as $label3 => $value3)
                                                                            @if(is_array($value3))
                                                                                @foreach($value3 as $label4 => $value4)
                                                                                    @if(is_array($value4))
                                                                                        @foreach($value4 as $label5 => $value5)
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label class="form-control-label">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}.{{$label5}}</label>
                                                                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}][{{$label5}}]" value="{{$value5}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @else
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label class="form-control-label">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}</label>
                                                                                                <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}]" value="{{$value4}}">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-control-label">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}</label>
                                                                                        <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}]" value="{{$value3}}">
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label">{{$fileName}}.{{$label}}.{{$label2}}</label>
                                                                                <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}]" value="{{$value2}}">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label">{{$fileName}}.{{$label}}</label>
                                                                        <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}]" value="{{$value}}">
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </div>
                                                <div class="col-12 pt-5 text-right">
                                                    <input type="submit" value="{{__('Save Change')}}" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection