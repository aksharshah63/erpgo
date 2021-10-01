<?php echo e(Form::open(array('route' => array('invoice.payment', $invoice->id),'method'=>'post'))); ?>

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('date', __('Date'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('date', '', array('class' => 'form-control datepicker','required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('amount', __('Amount'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('amount',$invoice->getDue(), array('class' => 'form-control','required'=>'required'))); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('account_id', __('Account'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('account_id',$accounts,null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('reference', __('Reference'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::text('reference', '', array('class' => 'form-control'))); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'))); ?>

            <?php echo e(Form::textarea('description', '', array('class' => 'form-control','rows'=>3))); ?>

        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        <?php echo e(Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill'])); ?>

    </div>
</div>
<?php echo Form::close(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/transaction/sales/invoice/payment.blade.php ENDPATH**/ ?>