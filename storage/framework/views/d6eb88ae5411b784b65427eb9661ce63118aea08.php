<?php $__env->startSection('title'); ?>
    <?php echo e(__('View Invoice')); ?>

<?php $__env->stopSection(); ?>
<?php if($invoice->status!=4): ?>
<?php $__env->startSection('action-button'); ?>
    <div class="col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Invoice')): ?>
            <a href="<?php echo e(route('invoices.edit',$invoice->id)); ?>" class="btn btn-sm btn-icon-only rounded-circle btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
            </a>
        <?php endif; ?>
        
        <?php if($invoice->status==0): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Send Invoice')): ?>
                <a href="<?php echo e(route('invoice.sent',$invoice->id)); ?>" class="btn btn-sm btn-icon-only rounded-circle btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo e(__('Mark Sent')); ?>">
                    <span class="btn-inner--icon"><i class="fa fa-paper-plane"></i></span>
                </a>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if($invoice->status!=0): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Payment Invoice')): ?>
                <a href="#" data-url="<?php echo e(route('invoice.payment',$invoice->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Add Receipt')); ?>" class="btn btn-sm btn-icon-only rounded-circle btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo e(__('Add Receipt')); ?>">
                    <span class="btn-inner--icon"><i class="far fa-file"></i></span>
                </a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Send Invoice')): ?>
    <?php if($invoice->status!=4): ?>
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            <div class="timeline-block">
                                <span class="timeline-step timeline-step-sm bg-primary border-primary text-white"><i class="fas fa-plus"></i></span>
                                <div class="timeline-content">
                                    <div class="text-sm h6"><?php echo e(__('Create Invoice')); ?></div>
                                    <small><i class="fas fa-clock mr-1"></i><?php echo e(__('Created on ')); ?> <?php echo e(Utility::getDateFormated($invoice->transaction_date)); ?></small>
                                </div>
                            </div>
                            <div class="timeline-block">
                                <span class="timeline-step timeline-step-sm bg-warning border-warning text-white"><i class="fas fa-envelope"></i></span>
                                <div class="timeline-content">
                                    <div class="text-sm h6 "><?php echo e(__('Send Invoice')); ?></div>
                                    <?php if($invoice->status!=0): ?>
                                        <small><i class="fas fa-clock mr-1"></i><?php echo e(__('Sent On')); ?> <?php echo e(Utility::getDateFormated($invoice->send_date)); ?></small>
                                    <?php else: ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Send Invoice')): ?>
                                            <small><?php echo e(__('Status')); ?> : <?php echo e(__('Not Sent')); ?></small>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="timeline-block">
                                <span class="timeline-step timeline-step-sm bg-info border-info text-white"><i class="far fa-money-bill-alt"></i></span>
                                <div class="timeline-content">
                                    <div class="text-sm h6 "><?php echo e(__('Get Paid')); ?></div>
                                    <small><?php echo e(__('Awaiting payment')); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php if($invoice->created_by==\Auth::user()->id): ?>
    <?php if($invoice->status!=0): ?>
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                <?php if($invoice->status!=4): ?>
                    <div class="all-button-box mx-2">
                        <a href="<?php echo e(route('invoice.payment.reminder',$invoice->id)); ?>" class="btn btn-sm btn-primary btn-icon rounded-pill"><?php echo e(__('Receipt Reminder')); ?></a>
                    </div>
                <?php endif; ?>
                <div class="all-button-box mx-2">
                    <a href="<?php echo e(route('invoice.resent',$invoice->id)); ?>" class="btn btn-sm btn-primary btn-icon rounded-pill"><?php echo e(__('Resend Invoice')); ?></a>
                </div>
                <div class="all-button-box">
                    <a href="<?php echo e(route('invoice.pdf', Crypt::encrypt($invoice->id))); ?>" target="_blank" class="btn btn-sm btn-primary btn-icon rounded-pill"><?php echo e(__('Download')); ?></a>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row invoice-title mt-2">
                            <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                                <h2><?php echo e(__('Invoice')); ?></h2>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-right">
                                <h3 class="invoice-number"><?php echo e(AUth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></h3>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <small class="font-style">
                                    <strong><?php echo e(__('Billed From')); ?> :</strong><br>
                                    <?php echo e(!empty($settings['company_name'])?$settings['company_name']:''); ?><br>
                                    <?php echo e(!empty($settings['company_address'])?$settings['company_address']:''); ?><br>
                                    <?php echo e(!empty($settings['company_city'])?$settings['company_city']:''); ?>, <?php echo e(!empty($settings['company_state'])?$settings['company_state']:''); ?> - <?php echo e(!empty($settings['company_zipcode'])?$settings['company_zipcode']:''); ?><br>
                                    <?php echo e(!empty($settings['company_country'])?$settings['company_country']:''); ?><br>
                                </small>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <small>
                                    <strong><?php echo e(__('Billed To')); ?> :</strong><br>
                                    <?php echo e(!empty($customer->first_name)?__($customer->first_name):''); ?> <?php echo e(!empty($customer->last_name)?__($customer->last_name):''); ?><br>
                                    <?php if(!empty($customer->customerdetail->address1)): ?>
                                        <?php echo e(__($customer->customerdetail->address1)); ?><br>
                                    <?php endif; ?>
                                    <?php if(!empty($customer->customerdetail->address2)): ?>
                                        <?php echo e(__($customer->customerdetail->address2)); ?><br>
                                    <?php endif; ?>
                                    <?php echo e(!empty($customer->customerdetail->city)?__($customer->customerdetail->city):''); ?> , <?php echo e(!empty($customer->customerdetail->state)?__($customer->customerdetail->state):''); ?> - <?php echo e(!empty($customer->customerdetail->post_code)?__($customer->customerdetail->post_code):''); ?><br>
                                    <?php echo e(!empty($customer->customerdetail->country)?__($customer->customerdetail->country):''); ?><br>
                                </small>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-4">
                                <small>
                                    <strong><?php echo e(__('Status')); ?> :</strong><br>
                                    <?php if($invoice->status == 0): ?>
                                        <span class="badge badge-pill badge-primary"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                    <?php elseif($invoice->status == 1): ?>
                                        <span class="badge badge-pill badge-warning"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                    <?php elseif($invoice->status == 2): ?>
                                        <span class="badge badge-pill badge-danger"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                    <?php elseif($invoice->status == 3): ?>
                                        <span class="badge badge-pill badge-info"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                    <?php elseif($invoice->status == 4): ?>
                                        <span class="badge badge-pill badge-success"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                    <?php endif; ?>
                                </small>
                            </div>
                            <div class="col-md-4 text-md-center">
                                <small>
                                    <strong><?php echo e(__('Transaction Date')); ?> :</strong><br>
                                    <?php echo e(\App\Utility::getDateFormated($invoice->transaction_date)); ?><br><br>
                                </small>
                            </div>
                            <div class="col-md-4 text-md-right">
                                <small>
                                    <strong><?php echo e(__('Due Date')); ?> :</strong><br>
                                    <?php echo e(\App\Utility::getDateFormated($invoice->due_date)); ?><br><br>
                                </small>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="font-weight-bold"><?php echo e(__('Product Summary')); ?></div>
                                <small><?php echo e(__('All Items Here Cannot Be Deleted.')); ?></small>
                                <div class="table-responsive mt-2">
                                    <table class="table mb-0 table-striped">
                                        <tr>
                                            <th data-width="40" class="text-dark">#</th>
                                            <th class="text-dark"><?php echo e(__('Product')); ?></th>
                                            <th class="text-dark"><?php echo e(__('Quantity')); ?></th>
                                            <th class="text-dark"><?php echo e(__('Rate')); ?></th>
                                            <th class="text-dark"><?php echo e(__('Tax')); ?></th>
                                            <th class="text-dark"></th>
                                            <th class="text-right text-dark" width="12%"><?php echo e(__('Price')); ?><br>
                                                <small class="text-danger font-weight-bold"><?php echo e(__('Before Tax & Discount')); ?></small>
                                            </th>
                                        </tr>
                                        <?php
                                            $totalQuantity=0;
                                            $totalRate=0;
                                            $totalTaxPrice=0;
                                            $totalDiscount=0;
                                            $taxesData=[];
                                        ?>
                                        <?php $__currentLoopData = $iteams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$iteam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $taxes=\Utility::tax($iteam->tax);
                                                $totalQuantity+=$iteam->quantity;
                                                $totalRate+=$iteam->price;
                                                foreach($taxes as $taxe){
                                                    $taxDataPrice=\Utility::taxRate($taxe->tax_rate,$iteam->price,$iteam->quantity);
                                                    if (array_key_exists($taxe->name,$taxesData))
                                                    {
                                                        $taxesData[$taxe->name] = $taxesData[$taxe->name]+$taxDataPrice;
                                                    }
                                                    else
                                                    {
                                                        $taxesData[$taxe->name] = $taxDataPrice;
                                                    }
                                                }
                                            ?>
                                            <tr>
                                                <td><?php echo e($key+1); ?></td>
                                                <td><?php echo e(!empty($iteam->product())?$iteam->product()->product_name:''); ?></td>
                                                <td><?php echo e($iteam->quantity); ?></td>
                                                <td><?php echo e(\Auth::user()->priceFormat($iteam->price)); ?></td>
                                                <td>
                                                    <table>
                                                        <?php $totalTaxRate = 0;?>
                                                        <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $taxPrice=\Utility::taxRate($tax->tax_rate,$iteam->price,$iteam->quantity);
                                                                $totalTaxPrice+=$taxPrice;
                                                            ?>
                                                            <tr>
                                                                <td><?php echo e($tax->name .' ('.$tax->tax_rate .'%)'); ?></td>
                                                                <td><?php echo e(\Auth::user()->priceFormat($taxPrice)); ?></td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </table>
                                                </td>
                                                <td> 
                                                </td>
                                                <td class="text-right"><?php echo e(\Auth::user()->priceFormat(($iteam->price*$iteam->quantity))); ?></td>

                                            </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <tfoot>
                                        <tr>
                                            <td></td>
                                            <td><b><?php echo e(__('Total')); ?></b></td>
                                            <td><b><?php echo e($totalQuantity); ?></b></td>
                                            <td><b><?php echo e(\Auth::user()->priceFormat($totalRate)); ?></b></td>
                                            <td><b><?php echo e(\Auth::user()->priceFormat($totalTaxPrice)); ?></b></td>
                                            <td>  
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-right"><b><?php echo e(__('Sub Total')); ?></b></td>
                                            <td class="text-right"><?php echo e(\Auth::user()->priceFormat($invoice->getSubTotal())); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-right"><b><?php echo e(__('Discount')); ?></b></td>
                                            <td class="text-right"><?php echo e(\Auth::user()->priceFormat($invoice->getTotalDiscount(true))); ?></td>
                                        </tr>
                                        <?php if(!empty($taxesData)): ?>
                                            <?php $__currentLoopData = $taxesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td colspan="5"></td>
                                                    <td class="text-right"><b><?php echo e(__($taxName)); ?></b></td>
                                                    <td class="text-right"><?php echo e(\Auth::user()->priceFormat($taxPrice)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="blue-text text-right"><b><?php echo e(__('Total')); ?></b></td>
                                            <td class="blue-text text-right"><?php echo e(\Auth::user()->priceFormat($invoice->getTotal())); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-right"><b><?php echo e(__('Paid')); ?></b></td>
                                            <td class="text-right"><?php echo e(\Auth::user()->priceFormat(($invoice->getTotal()-$invoice->getDue()))); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-right"><b><?php echo e(__('Due')); ?></b></td>
                                            <td class="text-right"><?php echo e(\Auth::user()->priceFormat($invoice->getDue())); ?></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <h5 class="h4 d-inline-block font-weight-400 mb-4"><?php echo e(__('Receipt Summary')); ?></h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th class="text-dark"><?php echo e(__('Date')); ?></th>
                        <th class="text-dark"><?php echo e(__('Amount')); ?></th>
                        <th class="text-dark"><?php echo e(__('Payment Type')); ?></th>
                        <th class="text-dark"><?php echo e(__('Account')); ?></th>
                        <th class="text-dark"><?php echo e(__('Reference')); ?></th>
                        <th class="text-dark"><?php echo e(__('Description')); ?></th>
                        <th class="text-dark"><?php echo e(__('Receipt')); ?></th>
                        <th class="text-dark"><?php echo e(__('OrderId')); ?></th>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Payment Invoice')): ?>
                            <th class="text-dark"><?php echo e(__('Action')); ?></th>
                        <?php endif; ?>
                    </tr>
                    <?php if(count($invoice->payments) > 0): ?>
                        <?php $__currentLoopData = $invoice->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(\App\Utility::getDateFormated($payment->date)); ?></td>
                                <td><?php echo e(\Auth::user()->priceFormat($payment->amount)); ?></td>
                                <td><?php echo e($payment->payment_type); ?></td>
                                <td><?php echo e(!empty($payment->bankAccount)?$payment->bankAccount->bank_name.' '.$payment->bankAccount->holder_name:'--'); ?></td>
                                <td><?php echo e(!empty($payment->reference)?$payment->reference:'--'); ?></td>
                                <td><?php echo e(!empty($payment->description)?$payment->description:'--'); ?></td>
                                <td><?php if(!empty($payment->receipt)): ?><a href="<?php echo e($payment->receipt); ?>" target="_blank"> <i class="fas fa-file"></i></a><?php else: ?> -- <?php endif; ?></td>
                                <td><?php echo e(!empty($payment->order_id)?$payment->order_id:'--'); ?></td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Payment Invoice')): ?>
                                    <td>
                                        <a href="#" class="action-item text-danger" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This Action Can Not Be Undone. Do You Want To Continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($payment->id); ?>').submit();">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <?php echo Form::open(['method' => 'post', 'route' => ['invoice.payment.destroy',$invoice->id,$payment->id],'id'=>'delete-form-'.$payment->id]); ?>

                                        <?php echo Form::close(); ?>

                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center text-dark"><p><?php echo e(__('No Data Found')); ?></p></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/transaction/sales/invoice/view.blade.php ENDPATH**/ ?>