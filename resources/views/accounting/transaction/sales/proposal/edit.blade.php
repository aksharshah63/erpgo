@extends('layouts.admin')
@section('title')
    {{ __('Edit Proposal') }}
@endsection
@section('content')
{{ Form::model($proposal, array('route' => array('proposals.update', $proposal->id), 'method' => 'PUT','class'=>'w-100')) }}
    <div class="col-12">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            {{ Form::label('proposal_number', __('Proposal Number'),['class'=>'form-control-label']) }}
                                <input type="text" class="form-control" value="{{$proposal_number}}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            {{ Form::label('customer', __('Customer'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            {{ Form::select('customer',$customers, $proposal->customer->id, ['class' => 'form-control main-element','id'=>'customer','required'=>'required']) }}
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            {{ Form::label('transaction_date', __('Transaction Date'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            {{ Form::text('transaction_date', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            {{ Form::label('category', __('Category'), ['class' => 'form-control-label']) }}<span
                            class="text-danger">*</span>
                            {{ Form::select('category',$category, $proposal->category_id, ['class' => 'form-control main-element','id'=>'customer','required'=>'required']) }}
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-8">
                        <div class="form-group">
                            {{ Form::label('billing_address', __('Billing Address'), ['class' => 'form-control-label']) }}
                            {{ Form::textarea('billing_address', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <h5 class="h4 d-inline-block font-weight-400 mb-4">{{__('Product & Services')}}</h5>
        <div class="card repeater" data-value='{!! json_encode($proposal->items) !!}'>
            
            <div class="item-section py-4">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                        <div class="all-button-box">
                            <a href="#" data-repeater-create="" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-toggle="modal" data-target="#add-bank">
                                <i class="fas fa-plus"></i> {{__('Add item')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
      
            <div class="card-body py-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" data-repeater-list="items" id="sortable-table">
                        <thead>
                        <tr>
                            <th>{{__('Items')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Price')}} </th>
                            <th>{{__('Tax')}} (%)</th>
                            <th></th>
                            <th class="text-right">{{__('Amount')}} </th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody class="ui-sortable" data-repeater-item>
                        <tr>
                             {{ Form::hidden('id',null, array('class' => 'form-control id')) }}
                            <td width="25%">
                                {{ Form::select('product_id', $products,null, array('class' => 'form-control select2 item','data-url'=>route('proposal.product'),'required'=>'required')) }}
                            </td>
                            <td>
                                <div class="form-group price-input">
                                    {{ Form::text('quantity','', array('class' => 'form-control quantity','required'=>'required','placeholder'=>__('Qty'),'required'=>'required')) }}
                                </div>
                            </td>
                            <td>
                                <div class="form-group price-input">
                                    {{ Form::text('price','', array('class' => 'form-control price','required'=>'required','placeholder'=>__('Price'),'required'=>'required')) }}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group colorpickerinput">
                                        <div class="taxes"></div>
                                        {{ Form::hidden('tax','', array('class' => 'form-control tax')) }}
                                        {{ Form::hidden('itemTaxPrice','0', array('class' => 'form-control itemTaxPrice')) }}
                                        {{ Form::hidden('itemTaxRate','', array('class' => 'form-control itemTaxRate')) }}
                                    </div>
                                </div>
                            </td>
                            <td></td>
                            <td class="text-right amount">0.00</td>
                            <td>
                                @can('Delete Proposal Product')
                                    <a href="#" class="fas fa-trash text-danger" data-repeater-delete></a>
                                @endcan
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td></td>
                            <td><strong>{{__('Sub Total')}} ({{__(\Auth::user()->currencySymbol())}})</strong></td>
                            <td class="text-right subTotal">0.00</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td></td>
                            <td> {{ Form::select('discount_type', ['discount-percent' => 'Discount percent','discount-value' => 'Discount value'], $proposal->discount_type, ['class' => 'form-control main-element discount_type']) }}</td>
                            <td class="text-right totalDiscount">{{ Form::text('discount_value',null, ['class' => 'form-control']) }}</td>
                            <td><em style="" class="percentage {{$proposal->discount_type=='discount-value' ? 'd-none' : ''}}">%</em></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td></td>
                            <td><strong>{{__('Tax')}} ({{__(\Auth::user()->currencySymbol())}})</strong></td>
                            <td class="text-right totalTax">0.00</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="blue-text"><strong>{{__('Total Amount')}} ({{__(\Auth::user()->currencySymbol())}})</strong></td>
                            <td class="text-right totalAmount blue-text">0.00</td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-12 text-right py-4">
                    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="{{__('Update')}}">
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
                    var el = $(this);
                        var id = $(el.find('.id')).val();

                        $.ajax({
                            url: '{{route('proposal.product.destroy')}}',
                            headers: {
                                'X-CSRF-TOKEN': jQuery('#token').val()
                            },
                            type: 'POST',
                            data: {
                                'id': id
                            },
                            cache: false,
                            success: function (data) {
                                location.reload();
                            },
                        });
                    $(this).slideUp(deleteElement);
                    $(this).remove();

                    var inputs = $(".amount");
                    var subTotal = 0;
                    for (var i = 0; i < inputs.length; i++) {
                        subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                    }
                    $('.subTotal').html(subTotal.toFixed(2));
                   $('.totalAmount').html(subTotal.toFixed(2));
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
            for (var i = 0; i < value.length; i++) {
                    var tr = $('#sortable-table .id[value="' + value[i].id + '"]').parent();
                    tr.find('.item').val(value[i].product_id);
                    changeItem(tr.find('.item'));
                }
        }

    }

    $(document).on('click', '#remove', function () {
            $('#customer-box').removeClass('d-none');
            $('#customer-box').addClass('d-block');
            $('#customer_detail').removeClass('d-block');
            $('#customer_detail').addClass('d-none');
        })

    $(document).on('change', '.item', function () {
        changeItem($(this));
        getDiscountedTotal($('.discount_type').val(),$("input[name=discount_value]").val());
    });

    var proposal_id = '{{$proposal->id}}';

    function changeItem(element) {
            var iteams_id = element.val();
            var url = element.data('url');
            if(url != '' && url != undefined)
            {
                var el = element;
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                                'X-CSRF-TOKEN': jQuery('#token').val()
                    },
                    data: {
                        'product_id': iteams_id
                    },
                    cache: false,
                    success: function (data) {
                        var item = JSON.parse(data);
                        
                        $.ajax({
                            url: '{{route('proposal.items')}}',
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': jQuery('#token').val()
                            },
                            data: {
                                'proposal_id': proposal_id,
                                'product_id': iteams_id,
                            },
                            cache: false,
                            success: function (data) {
                              
                                var proposalItems = JSON.parse(data);
                                if (proposalItems != null) {
                                    var amount = (proposalItems.price * proposalItems.quantity);

                                    $(el.parent().parent().find('.quantity')).val(proposalItems.quantity);
                                    $(el.parent().parent().find('.price')).val(proposalItems.price);
                                    $(el.parent().parent().find('.discount')).val(proposalItems.discount);
                                } else {
                                    $(el.parent().parent().find('.quantity')).val(1);
                                    $(el.parent().parent().find('.price')).val(item.sale_price);
                                    $(el.parent().parent().find('.discount')).val(0);
                                }


                                var taxes = '';
                                var tax = [];

                                var totalItemTaxRate = 0;
                                if(item.taxes =='' || item.taxes ==null){
                                    taxes += '<span class="badge badge-pill badge-primary mt-1 mr-1">' +'tax(0)%'+ '</span>';
                                    totalItemTaxRate=0;
                                    
                                }
                                else
                                {
                                    for (var i = 0; i < item.taxes.length; i++) {
                                        taxes += '<span class="badge badge-pill badge-primary mt-1 mr-1">' + item.taxes[i].name + ' ' + '(' + item.taxes[i].tax_rate + '%)' + '</span>';
                                        tax.push(item.taxes[i].id);
                                        totalItemTaxRate += parseFloat(item.taxes[i].tax_rate);
                                    }
                                }

                                if (proposalItems != null) {
                                    var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (proposalItems.price * proposalItems.quantity));
                                } else {
                                    var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (item.sale_price * 1));
                                }

                                $(el.parent().parent().find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));
                                $(el.parent().parent().find('.itemTaxRate')).val(totalItemTaxRate.toFixed(2));
                                $(el.parent().parent().find('.taxes')).html(taxes);
                                $(el.parent().parent().find('.tax')).val(tax);
                                // $(el.parent().parent().find('.unit')).html(item.unit);
                                //$(el.parent().parent().find('.amount')).html(item.totalAmount);

                                if (proposalItems != null) {
                                    $(el.parent().parent().find('.amount')).html(amount);
                                } else {
                                    $(el.parent().parent().find('.amount')).html(item.totalAmount);
                                }

                                 // For Subtotal
                                var inputs = $(".amount");
                                var subTotal = 0;
                                for (var i = 0; i < inputs.length; i++) {
                                    subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                                }
                                $('.subTotal').html(subTotal.toFixed(2));
                                // end

                                // For Discount
                                var itemDiscountPriceInput = 0;
                                itemDiscountPriceInput = $("[name='discount_value']").val();
                                // end


                                var totalItemPrice = 0;
                                var priceInput = $('.price');
                                for (var j = 0; j < priceInput.length; j++) {
                                    totalItemPrice += parseFloat(priceInput[j].value);
                                }

                                var totalItemTaxPrice = 0;
                                var itemTaxPriceInput = $('.itemTaxPrice');
                                for (var j = 0; j < itemTaxPriceInput.length; j++) {
                                    totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
                                }

                                var discount_type = $('.discount_type').val();
                                var finalAmount=0;
                                var famount = subTotal+totalItemTaxPrice;
                                if(discount_type == 'discount-percent')
                                {
                                    finalAmount = (famount-(famount * itemDiscountPriceInput/100));
                                }
                                else
                                {
                                    if (invoiceItems != null)
                                    {
                                        finalAmount = (subTotal+totalItemTaxPrice) -itemDiscountPriceInput;
                                    }
                                    else
                                    {
                                        finalAmount=0;
                                    }
                                }

                                //var finalAmount = (subTotal+totalItemTaxPrice) -itemDiscountPriceInput;

                                $('.totalTax').html(totalItemTaxPrice.toFixed(2));
                                $('.totalAmount').html(parseFloat(finalAmount).toFixed(2));

                            }
                        });

                        
                    },
                });
            }
        }

        $(document).on('keyup', '.quantity', function () {
            var quntityTotalTaxPrice = 0;

            var el = $(this).parent().parent().parent().parent();
            var quantity = $(this).val();
            var price = $(el.find('.price')).val();
            var discount = $(el.find('.discount')).val();

            var totalItemPrice = (quantity * price);
            var amount = (totalItemPrice);
            $(el.find('.amount')).html(amount);

            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var inputs = $(".amount");
            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }
            $('.subTotal').html(subTotal.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice)).toFixed(2));
            getDiscountedTotal($('.discount_type').val(),$("input[name=discount_value]").val());

        })

        $(document).on('keyup', '.price', function () {

            var el = $(this).parent().parent().parent().parent();
            var price = $(this).val();
            var quantity = $(el.find('.quantity')).val();
            var discount = $(el.find('.discount')).val();
            var totalItemPrice = (quantity * price);

            var amount = (totalItemPrice);
            $(el.find('.amount')).html(amount);


            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var inputs = $(".amount");
            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.subTotal').html(subTotal.toFixed(2));
            $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice)).toFixed(2));
            getDiscountedTotal($('.discount_type').val(),$("input[name=discount_value]").val());

        })

        $(document).on('click', '[data-repeater-create]', function () {
            $('.item :selected').each(function () {
                var id = $(this).val();
                $('.item option[value="' + id + '"]').prop("disabled", true);
            });
        })

        $(document).on('change', '.discount_type', function () {
        var discount_value = $(this).val();
        if(discount_value=='discount-value')
        {
            $('.percentage').addClass('d-none');
        }
        else
        {
            $('.percentage').removeClass('d-none');
        }

        getDiscountedTotal(discount_value,$("input[name=discount_value]").val());
    });

    $(document).ready(function(){
        $(".datepicker").datepicker();
        setTimeout(function(){
            getDiscountedTotal($('.discount_type').val(),$("input[name=discount_value]").val());
        },200);
    });

    $(document).on('keyup',"input[name=discount_value]",function(){
        getDiscountedTotal($('.discount_type').val(),$(this).val());
    })

    function getDiscountedTotal(type,val){
        if(val == '')
        {
            val = 0;
        }

        var el = $(this).parent().parent().parent().parent();
            var price = $('.price').val();
            var quantity = $(el.find('.quantity')).val();
            var discount = $(el.find('.discount')).val();
            var totalItemPrice = (quantity * price);

            var amount = (totalItemPrice);
            $(el.find('.amount')).html(amount);


            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var inputs = $(".amount");
            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }
            //$('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.subTotal').html(subTotal.toFixed(2));
            $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice)).toFixed(2));
            var main_val = $(".totalAmount").html();

        var result = 0;
        if(type == 'discount-percent')
        {
            result = (main_val - ( main_val * val / 100 )).toFixed(2);
        }
        else
        {
            result = (main_val-val).toFixed(2);
        }
        $(".totalAmount").html(result);
    }
    
</script>
@endpush