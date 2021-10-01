<?php $__env->startSection('title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title mb-0"><b><?php echo e(!empty($customers) ? $customers : 0); ?></b></h1>
                    <h5 class="card-title mt-2"><?php echo e(__('Customers')); ?></h5>
                </div>
                <div class="card-body card-desc">
                    <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-sm btn-primary card-btn"><?php echo e(__('View Customers')); ?></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title mb-0"><b><?php echo e(!empty($vendors) ? $vendors :0); ?></b></h1>
                    <h5 class="card-title mt-2"><?php echo e(__('Vendors')); ?></h5>
                </div>
                <div class="card-body card-desc">
                    <a href="<?php echo e(route('vendors.index')); ?>" class="btn btn-sm btn-primary card-btn"><?php echo e(__('View Vendors')); ?></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title mb-0"><b><?php echo e(!empty($invoices) ? $invoices : 0); ?></b></h1>
                    <h5 class="card-title mt-2"><?php echo e(__('Invoices')); ?></h5>
                </div>
                <div class="card-body card-desc">
                    <a href="<?php echo e(route('invoices.index')); ?>" class="btn btn-sm btn-primary card-btn"><?php echo e(__('View Invoices')); ?></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title mb-0"><b><?php echo e(!empty($bills) ? $bills : 0); ?></b></h1>
                    <h5 class="card-title mt-2"><?php echo e(__('Bills')); ?></h5>
                </div>
                <div class="card-body card-desc">
                    <a href="<?php echo e(route('bills.index')); ?>" class="btn btn-sm btn-primary card-btn"><?php echo e(__('View Bills')); ?></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div>
                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Cashflow')); ?></h4>
                <h6 class="last-day-text"><?php echo e(__('Last')); ?> <span><?php echo e('15'. __('Days')); ?></span></h6>
            </div>
            <div class="card">
                <div class="card-body">
                    <canvas id="canvas3" height="230" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4">
            <h4 class="h4 font-weight-400"><?php echo e(__('Income Vs Expense')); ?></h4>
            <div class="card bg-none dashboard-box-1">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <tbody class="list">
                        <tr>
                            <td>
                                <h4 class="mb-0"><?php echo e(__('Income')); ?></h4>
                                <h5 class="mb-0"><?php echo e(__('Today')); ?></h5>
                            </td>
                            <td>
                                <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->todayIncome())); ?></h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4 class="mb-0"><?php echo e(__('Expense')); ?></h4>
                                <h5 class="mb-0"><?php echo e(__('Today')); ?></h5>
                            </td>
                            <td>
                                <h3 class="red-text"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->todayExpense())); ?></h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4 class="mb-0"><?php echo e(__('Income This')); ?></h4>
                                <h5 class="mb-0"><?php echo e(__('Month')); ?></h5>
                            </td>
                            <td>
                                <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->incomeCurrentMonth())); ?></h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4 class="mb-0"><?php echo e(__('Expense This')); ?></h4>
                                <h5 class="mb-0"><?php echo e(__('Month')); ?></h5>
                            </td>
                            <td>
                                <h3 class="red-text"><?php echo e(\Auth::user()->priceFormat(\Auth::user()->expenseCurrentMonth())); ?></h3>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-8 col-md-8">
            <div class="">
                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Account Balance')); ?></h4>
            </div>
            <div class="card bg-none dashboard-box-1">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th><?php echo e(__('Bank')); ?></th>
                            <th><?php echo e(__('Holder Name')); ?></th>
                            <th><?php echo e(__('Balance')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $bankaccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bankaccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="font-style">
                                <td><?php echo e($bankaccount->bank_name); ?></td>
                                <td><?php echo e($bankaccount->holder_name); ?></td>
                                <td><?php echo e(\Auth::user()->priceFormat($bankaccount->opening_balance)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4">
                                    <div class="text-center">
                                        <h6><?php echo e(__('There Is No Account Balance')); ?></h6>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div>
                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Income & Expense')); ?></h4>
                <h6 class="last-day-text"><?php echo e(__('Current Year').' - '.$data['currentYear']); ?></h6>
            </div>
            <div class="card">
                <div class="card-body">
                    <canvas id="canvas2" height="230" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12 col-12 col-sm-12">
            <div>
                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Income By Category')); ?></h4>
                <h6 class="last-day-text"><?php echo e(__('Current Year').' - '.$data['currentYear']); ?></h6>
            </div>
            <div class="card">
                <div class="card-body">
                    <canvas id="canvas" height="230" width="600"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12 col-sm-12">
            <div>
                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Expense By Category')); ?></h4>
                <h6 class="last-day-text"><?php echo e(__('Current Year').' - '.$data['currentYear']); ?></h6>
            </div>
            <div class="card">
                <div class="card-body">
                    <canvas id="canvas1" height="230" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="">
                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Latest Income')); ?></h4>
                <a href="<?php echo e(route('invoices.index')); ?>" class="more-text history-text float-right"><?php echo e(__('View All')); ?></a>
            </div>
            <div class="card bg-none dashboard-box-1">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th><?php echo e(__('Date')); ?></th>
                            <th><?php echo e(__('Customer')); ?></th>
                            <th><?php echo e(__('Amount Due')); ?></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php $__empty_1 = true; $__currentLoopData = $data['latestIncome']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(!empty($income->transaction_date) ? \App\Utility::getDateFormated($income->transaction_date) : '-'); ?></td>
                                <td><?php echo e(!empty($income->customer)?$income->customer->first_name.' '.$income->customer->last_name:'-'); ?></td>
                                <td><?php echo e($income->getDue()); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4">
                                    <div class="text-center">
                                        <h6><?php echo e(__('There Is No Latest Income')); ?></h6>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="">
                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Latest Expense')); ?></h4>
                <a href="<?php echo e(route('payments.index')); ?>" class="more-text history-text float-right"><?php echo e(__('View All')); ?></a>
            </div>
            <div class="card bg-none dashboard-box-1">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th><?php echo e(__('Date')); ?></th>
                            <th><?php echo e(__('Customer')); ?></th>
                            <th><?php echo e(__('Amount Due')); ?></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php $__empty_1 = true; $__currentLoopData = $data['latestExpense']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(!empty($expense->date) ? \App\Utility::getDateFormated($expense->date) :'-'); ?></td>
                                <td><?php echo e(!empty($expense->vendor)?$expense->vendor->first_name.' '.$expense->vendor->last_name:'-'); ?></td>
                                <td><?php echo e(!empty($expense->amount) ? \Auth::user()->priceFormat($expense->amount) :'-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4">
                                    <div class="text-center">
                                        <h6><?php echo e(__('There Is No Latest Expense')); ?></h6>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="">
                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Invoices')); ?></h4>
            </div>
            <div class="card bg-none invo-tab dashboard-box-2">
                <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#weekly_statistics" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo e(__('Weekly Statistics')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#monthly_statistics" role="tab" aria-controls="pills-home" aria-selected="false"><?php echo e(__('Monthly Statistics')); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="weekly_statistics" class="tab-pane in active">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <tbody class="list">
                                <tr>
                                    <td>
                                        <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                        <h5 class="mb-0"><?php echo e(__('Invoice Generated')); ?></h5>
                                    </td>
                                    <td>
                                        <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($data['weeklyInvoice']['invoiceTotal'])); ?></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                        <h5 class="mb-0"><?php echo e(__('Paid')); ?></h5>
                                    </td>
                                    <td>
                                        <h3 class="red-text"><?php echo e(\Auth::user()->priceFormat($data['weeklyInvoice']['invoicePaid'])); ?></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                        <h5 class="mb-0"><?php echo e(__('Due')); ?></h5>
                                    </td>
                                    <td>
                                        <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($data['weeklyInvoice']['invoiceDue'])); ?></h3>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="monthly_statistics" class="tab-pane">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0 ">
                                <tbody class="list">
                                <tr>
                                    <td>
                                        <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                        <h5 class="mb-0"><?php echo e(__('Invoice Generated')); ?></h5>
                                    </td>
                                    <td>
                                        <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($data['monthlyInvoice']['invoiceTotal'])); ?></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                        <h5 class="mb-0"><?php echo e(__('Paid')); ?></h5>
                                    </td>
                                    <td>
                                        <h3 class="red-text"><?php echo e(\Auth::user()->priceFormat($data['monthlyInvoice']['invoicePaid'])); ?></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                        <h5 class="mb-0"><?php echo e(__('Due')); ?></h5>
                                    </td>
                                    <td>
                                        <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($data['monthlyInvoice']['invoiceDue'])); ?></h3>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 col-md-6">
            <div class="">
                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Recent Invoices')); ?></h4>
            </div>
            <div class="card bg-none dashboard-box-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo e(__('Customer')); ?></th>
                            <th><?php echo e(__('Issue Date')); ?></th>
                            <th><?php echo e(__('Due Date')); ?></th>
                            <th><?php echo e(__('Amount')); ?></th>
                            <th><?php echo e(__('Status')); ?></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php $__empty_1 = true; $__currentLoopData = $data['recentInvoice']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(\Auth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></td>
                                <td><?php echo e(!empty($invoice->customer)? $invoice->customer->first_name.' '.$invoice->customer->last_name:'-'); ?> </td>
                                <td><?php echo e(\App\Utility::getDateFormated($invoice->transaction_date)); ?></td>
                                <td><?php echo e(\App\Utility::getDateFormated($invoice->due_date)); ?></td>
                                <td><?php echo e(\Auth::user()->priceFormat($invoice->getTotal())); ?></td>
                                <td>
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
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6">
                                    <div class="text-center">
                                        <h6><?php echo e(__('There Is No Recent Invoice')); ?></h6>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-6">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Recent Bills')); ?></h4>
                </div>
                <div class="card bg-none dashboard-box-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('Vendor')); ?></th>
                                <th><?php echo e(__('Bill Date')); ?></th>
                                <th><?php echo e(__('Due Date')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <?php $__empty_1 = true; $__currentLoopData = $data['recentBill']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(\Auth::user()->billNumberFormat($bill->bill_id)); ?></td>
                                    <td><?php echo e(!empty($bill->vender)? $bill->vender->first_name.' '.$bill->vender->last_name:''); ?> </td>
                                    <td><?php echo e(\App\Utility::getDateFormated($bill->transaction_date)); ?></td>
                                    <td><?php echo e(\App\Utility::getDateFormated($bill->due_date)); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($bill->getTotal())); ?></td>
                                    <td>
                                        <?php if($bill->status == 0): ?>
                                            <span class="badge badge-pill badge-primary"><?php echo e(__(\App\Bill::$statues[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 1): ?>
                                            <span class="badge badge-pill badge-warning"><?php echo e(__(\App\Bill::$statues[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 2): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__(\App\Bill::$statues[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 3): ?>
                                            <span class="badge badge-pill badge-info"><?php echo e(__(\App\Bill::$statues[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 4): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__(\App\Bill::$statues[$bill->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center">
                                            <h6><?php echo e(__('There Is No Recent Bill')); ?></h6>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Bills')); ?></h4>
                </div>
                <div class="card bg-none invo-tab dashboard-box-2">
                    <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#bill_weekly_statistics" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo e(__('Weekly Statistics')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#bill_monthly_statistics" role="tab" aria-controls="pills-home" aria-selected="false"><?php echo e(__('Monthly Statistics')); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="bill_weekly_statistics" class="tab-pane in active">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <tbody class="list">
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Bill Generated')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($data['weeklyBill']['billTotal'])); ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Paid')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="red-text"><?php echo e(\Auth::user()->priceFormat($data['weeklyBill']['billPaid'])); ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Due')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($data['weeklyBill']['billDue'])); ?></h3>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="bill_monthly_statistics" class="tab-pane">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <tbody class="list">
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Bill Generated')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($data['monthlyBill']['billTotal'])); ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Paid')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="red-text"><?php echo e(\Auth::user()->priceFormat($data['monthlyBill']['billPaid'])); ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0"><?php echo e(__('Total')); ?></h4>
                                            <h5 class="mb-0"><?php echo e(__('Due')); ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text"><?php echo e(\Auth::user()->priceFormat($data['monthlyBill']['billDue'])); ?></h3>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('assets/js/Chart.min.js')); ?>"></script>
<script>
    var barChartData = {
        type: 'pie',
        data: {
            datasets: [{
                data: <?php echo json_encode($data['incomeCatAmount']); ?>,
                backgroundColor: <?php echo json_encode($data['incomeCategoryColor']); ?>

            }],
            labels: <?php echo json_encode($data['incomeCategory']); ?>

        },
        options:{
            legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: '#333',
                        usePointStyle: true,
                    }
                },
        }
    };

    var barChartData1 = {
        type: 'pie',
        data: {
            datasets: [{
                data: <?php echo json_encode($data['expenseCatAmount']); ?>,
                backgroundColor: <?php echo json_encode($data['expenseCategoryColor']); ?>

            }],
            labels: <?php echo json_encode($data['expenseCategory']); ?>

        },
        options:{
            legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: '#333',
                        usePointStyle: true,
                    }
                },
        }
    };

    var barChartData2 = {
        type: 'bar',
        data:{
            datasets: [
                        {
                            label: "Income",
                            backgroundColor: <?php echo json_encode($data['incExpBarChartData']['income_color']); ?>,
                            data: <?php echo json_encode($data['incExpBarChartData']['income']); ?>

                        },
                        {
                            label: "Expense",
                            backgroundColor: <?php echo json_encode($data['incExpBarChartData']['expense_color']); ?>,
                            data: <?php echo json_encode($data['incExpBarChartData']['expense']); ?>

                        },
            ],
            labels: <?php echo json_encode($data['incExpBarChartData']['month']); ?>,
        },
        options: {
            barValueSpacing: 20,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            precision: 0
                        }
                    }]
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: '#333',
                        usePointStyle: true,
                    }
                },
        }
    
    };

    var barChartData3 = {
        type: 'line',
        data:{
            datasets: [
                        {
                            label: "<?php echo e(__('Income')); ?>",
                            borderWidth: 3,
                            borderColor: <?php echo json_encode($data['incExpLineChartData']['income_color']); ?>,
                            fill: false,
                            data: <?php echo json_encode($data['incExpBarChartData']['income']); ?>

                        },
                        {
                            label: "<?php echo e(__('Expense')); ?>",
                            borderWidth: 3,
                            borderColor: <?php echo json_encode($data['incExpLineChartData']['expense_color']); ?>,
                            fill: false,
                            data: <?php echo json_encode($data['incExpLineChartData']['expense']); ?>

                        },
            ],
            labels: <?php echo json_encode($data['incExpLineChartData']['day']); ?>,
        },
        options: {
            barValueSpacing: 20,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            precision: 0
                        }
                    }]
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: '#333',
                        usePointStyle: true,
                    }
                },
        }
    
    };


    window.onload = function() {
    window.myBar = new Chart(document.getElementById("canvas"), barChartData);
    window.myBar1 = new Chart(document.getElementById("canvas1"), barChartData1);
    window.myBar2 = new Chart(document.getElementById("canvas2"), barChartData2);
    window.myBar3 = new Chart(document.getElementById("canvas3"), barChartData3);
};
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/dashboard.blade.php ENDPATH**/ ?>