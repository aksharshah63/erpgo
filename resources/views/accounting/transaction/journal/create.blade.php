@extends('layouts.admin')
@section('title')
    {{ __('New Journal Entry') }}
@endsection
@section('content')
    {{ Form::open(['url' => 'journal_entries', 'method' => 'post']) }}
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            {{ Form::label('journal_number', __('Journal Number'),['class'=>'form-control-label']) }}
                            <input type="text" class="form-control" value="{{\Auth::user()->journalNumberFormat($journalId)}}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            {{ Form::label('date', __('Transaction Date'),['class'=>'form-control-label']) }}<span
                            class="text-danger">*</span>
                            {{ Form::text('date', '', array('class' => 'form-control datepicker','required'=>'required')) }}
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            {{ Form::label('reference', __('Reference'),['class'=>'form-control-label']) }}
                            {{ Form::text('reference', '', array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{ Form::label('description', __('Description'),['class'=>'form-control-label']) }}
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card repeater">
                    <div class="item-section py-4">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                                <div class="all-button-box">
                                    <a href="#" data-repeater-create="" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-toggle="modal" data-target="#add-bank">
                                        <i class="fas fa-plus"></i> {{__('Add Account')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0" data-repeater-list="accounts" id="sortable-table">
                                <thead>
                                <tr>
                                    <th>{{__('Account')}}</th>
                                    <th>{{__('Debit')}}</th>
                                    <th>{{__('Credit')}} </th>
                                    <th>{{__('Description')}}</th>
                                    <th class="text-right">{{__('Amount')}} </th>
                                    <th width="2%"></th>
                                </tr>
                                </thead>
    
                                <tbody class="ui-sortable" data-repeater-item>
                                <tr>
                                    <td width="25%">
                                        {{ Form::select('account', $accounts,'', array('class' => 'form-control select2','required'=>'required')) }}
                                    </td>
    
                                    <td>
                                        <div class="form-group price-input">
                                            {{ Form::text('debit','', array('class' => 'form-control debit','required'=>'required','placeholder'=>__('Debit'),'required'=>'required')) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group price-input">
                                            {{ Form::text('credit','', array('class' => 'form-control credit','required'=>'required','placeholder'=>__('Credit'),'required'=>'required')) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            {{ Form::text('description','', array('class' => 'form-control','placeholder'=>__('Description'))) }}
                                        </div>
                                    </td>
                                    <td class="text-right amount">0.00</td>
                                    <td>
                                        <a href="#" class="fas fa-trash text-danger" data-repeater-delete></a>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td class="text-right"><strong>{{__('Total Credit')}} ({{__(\Auth::user()->currencySymbol())}})</strong></td>
                                    <td class="text-right totalCredit">0.00</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td class="text-right"><strong>{{__('Total Debit')}} ({{__(\Auth::user()->currencySymbol())}})</strong></td>
                                    <td class="text-right totalDebit">0.00</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-12 text-right py-4">
                            <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="{{__('Create')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@push('script')
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.repeater.min.js')}}"></script>
    <script>
        var selector = "body";
        if ($(selector + " .repeater").length) {
            var $dragAndDrop = $("body .repeater tbody").sortable({
                handle: '.sort-handler'
            });
            var $repeater = $(selector + ' .repeater').repeater({
                initEmpty: false,
                defaultValues: {
                    'status': 1
                },
                show: function () {
                    $(this).slideDown();
                    var file_uploads = $(this).find('input.multi');
                    if (file_uploads.length) {
                        $(this).find('input.multi').MultiFile({
                            max: 3,
                            accept: 'png|jpg|jpeg',
                            max_size: 2048
                        });
                    }
                    $('.select2').select2();
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        $(this).remove();

                        var inputs = $(".debit");
                        var totalDebit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            totalDebit = parseFloat(totalDebit) + parseFloat($(inputs[i]).val());
                        }
                        $('.totalDebit').html(totalDebit.toFixed(2));


                        var inputs = $(".credit");
                        var totalCredit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            totalCredit = parseFloat(totalCredit) + parseFloat($(inputs[i]).val());
                        }
                        $('.totalCredit').html(totalCredit.toFixed(2));


                    }
                },
                ready: function (setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });
            var value = $(selector + " .repeater").attr('data-value');
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
            }

        }

        $(document).on('keyup', '.debit', function () {
            var el = $(this).parent().parent().parent().parent();
            var debit = $(this).val();
            var credit = 0;
            el.find('.credit').val(credit);
            el.find('.amount').html(debit);


            var inputs = $(".debit");
            var totalDebit = 0;
            for (var i = 0; i < inputs.length; i++) {
                totalDebit = parseFloat(totalDebit) + parseFloat($(inputs[i]).val());
            }
            $('.totalDebit').html(totalDebit.toFixed(2));

            el.find('.credit').attr("disabled", true);
            if (debit == '') {
                el.find('.credit').attr("disabled", false);
            }
        })

        $(document).on('keyup', '.credit', function () {
            var el = $(this).parent().parent().parent().parent();
            var credit = $(this).val();
            var debit = 0;
            el.find('.debit').val(debit);
            el.find('.amount').html(credit);

            var inputs = $(".credit");
            var totalCredit = 0;
            for (var i = 0; i < inputs.length; i++) {
                totalCredit = parseFloat(totalCredit) + parseFloat($(inputs[i]).val());
            }
            $('.totalCredit').html(totalCredit.toFixed(2));

            el.find('.debit').attr("disabled", true);
            if (credit == '') {
                el.find('.debit').attr("disabled", false);
            }
        })


        $(document).ready(function(){
            $(".datepicker").datepicker();
        });

    </script>
@endpush