<div class="sidenav custom-sidenav" id="sidenav-main">
    <!-- Sidenav header -->
    <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="./index.html">
            <?php if(!empty(Utility::getValByName('company_logo'))): ?>
                <img src="<?php echo e(asset(Storage::url('logo/'.Utility::getValByName('company_logo')))); ?>" class="navbar-brand-img" alt="...">
            <?php else: ?>
                <img src="<?php echo e(asset(Storage::url('logo/logo.png'))); ?>" class="navbar-brand-img" alt="...">
            <?php endif; ?>
        </a>
        <div class="ml-auto">
            <!-- Sidenav toggler -->
            <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-div">
        <div class="div-mega">
            <ul class="navbar-nav navbar-nav-docs">
                <li class="nav-item">
                    <a class="nav-link <?php echo e((Request::route()->getName() == 'home' || Request::route()->getName() == 'hr.dashboard' || Request::route()->getName() == 'accounting.dashboard')?'active':'collapsed'); ?>" href="#dashboard" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::route()->getName() == 'home' || Request::route()->getName() == 'hr.dashboard' || Request::route()->getName() == 'accounting.dashboard')?'true':'false'); ?>" aria-controls="fleet">
                        <i class="fas fa-fire"></i><?php echo e(__('Dashboard')); ?>

                        <i class="fas fa-sort-up"></i>
                    </a>
                    <div class="collapse <?php echo e((Request::route()->getName() == 'home' || Request::route()->getName() == 'hr.dashboard' || Request::route()->getName() == 'accounting.dashboard')?'show':''); ?>" id="dashboard" style="">
                        <ul class="nav flex-column">
                            <li class="nav-item <?php echo e((Request::route()->getName() == 'home') ? 'active' :''); ?>">
                                <a href="<?php echo e(route('home')); ?>" class="nav-link"><?php echo e(__('CRM Dashboard')); ?></a>
                            </li>
                        </ul>
                        <ul class="nav flex-column">
                            <li class="nav-item <?php echo e((Request::route()->getName() == 'hr.dashboard') ? 'active' :''); ?>">
                                <a href="<?php echo e(route('hr.dashboard')); ?>" class="nav-link"><?php echo e(__('HR Dashboard')); ?></a>
                            </li>
                        </ul>
                        <ul class="nav flex-column">
                            <li class="nav-item <?php echo e((Request::route()->getName() == 'accounting.dashboard') ? 'active' :''); ?>">
                                <a href="<?php echo e(route('accounting.dashboard')); ?>" class="nav-link"><?php echo e(__('Accounting Dashboard')); ?></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php if( Gate::check('Manage Contacts') || Gate::check('Manage Companies') || Gate::check('Manage Schedules') || Gate::check('View CRM Activity') || Gate::check('Manage Contact Groups')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::segment(1) == 'crm_dashboard' ||Request::segment(1) == 'contacts' || Request::segment(1) == 'companies' || Request::segment(1) == 'calender_schedules' || Request::segment(1) == 'activities' || Request::segment(1) == 'contact_groups' || Request::segment(1) == 'crm_activity_report' || Request::segment(1) == 'crm_customer_report' || Request::segment(1) == 'crm_growth_report')?'active':'collapsed'); ?>" href="#crm" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'crm_dashboard' || Request::segment(1) == 'contacts' || Request::segment(1) == 'companies' || Request::segment(1) == 'calender_schedules' || Request::segment(1) == 'activities' || Request::segment(1) == 'contact_groups' || Request::segment(1) == 'crm_activity_report' || Request::segment(1) == 'crm_customer_report' || Request::segment(1) == 'crm_growth_report')?'true':'false'); ?>" aria-controls="fleet">
                            <i class="fas fa-user"></i><?php echo e(__('CRM')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::segment(1) == 'crm_dashboard' || Request::segment(1) == 'contacts' || Request::segment(1) == 'companies' || Request::segment(1) == 'calender_schedules' || Request::segment(1) == 'activities' || Request::segment(1) == 'contact_groups' || Request::segment(1) == 'crm_activity_report' || Request::segment(1) == 'crm_customer_report' || Request::segment(1) == 'crm_growth_report')?'show':''); ?>" id="crm" style="">
                            <ul class="nav flex-column">
                                
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Contacts')): ?>
                                    <li class="nav-item <?php echo e((request()->is('contacts*') ? 'active' : '')); ?>">
                                        <a href="<?php echo e(route('contacts.index')); ?>" class="nav-link"><?php echo e(__('Contacts')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Companies')): ?>
                                    <li class="nav-item <?php echo e((request()->is('companies*') ? 'active' : '')); ?>">
                                        <a href="<?php echo e(route('companies.index')); ?>" class="nav-link"><?php echo e(__('Companies')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Schedules')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'calender_schedules.index') ?'active' :''); ?>">
                                        <a href="<?php echo e(route('calender_schedules.index')); ?>" class="nav-link"><?php echo e(__('Schedule')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View CRM Activity')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'crm.activities') ?'active' :''); ?>">
                                        <a href="<?php echo e(route('crm.activities')); ?>" class="nav-link"><?php echo e(__('Activities')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Contact Groups')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'contact_groups.index') ?'active' :''); ?>">
                                        <a href="<?php echo e(route('contact_groups.index')); ?>" class="nav-link"><?php echo e(__('Contact Group')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if( Gate::check('View CRM Activity Report') || Gate::check('View CRM Customer Report') || Gate::check('View CRM Growth Report')): ?>
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-crm" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link <?php echo e((Request::segment(1) == 'crm_activity_report' || Request::segment(1) == 'crm_customer_report' || Request::segment(1) == 'crm_growth_report')?'active' :'collapsed'); ?>" href="#navbar-crm-report" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'crm_activity_report' || Request::segment(1) == 'crm_customer_report' || Request::segment(1) == 'crm_growth_report')?'true':'false'); ?>" aria-controls="navbar-getting-started1">
                                                            <?php echo e(__('Reports')); ?>

                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul <?php echo e((Request::segment(1) == 'crm_activity_report' || Request::segment(1) == 'crm_customer_report' || Request::segment(1) == 'crm_growth_report')?'show' :'collapse'); ?>" id="navbar-crm-report" style="">
                                                            <ul class="nav flex-column">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View CRM Activity Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'crm.activity.report') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('crm.activity.report')); ?>" class="nav-link"><?php echo e(__('Activity Report')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View CRM Customer Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'crm.customer.report') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('crm.customer.report')); ?>" class="nav-link"><?php echo e(__('Customer Report')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View CRM Growth Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'crm.growth.report') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('crm.growth.report')); ?>" class="nav-link"><?php echo e(__('Growth Report')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if( Gate::check('Manage Departments') || Gate::check('Manage Designations') || Gate::check('Manage Announcements')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::segment(1) == 'departments' || Request::segment(1) == 'designations' || Request::segment(1) == 'announcements' || Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender' || Request::segment(1) == 'gender_profile' || Request::segment(1) == 'head_count' || Request::segment(1) == 'age_profile' || Request::segment(1) == 'leave_report') ? 'active' : 'collapsed'); ?>" href="#fleet" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'departments' || Request::segment(1) == 'designations' || Request::segment(1) == 'announcements' || Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender' || Request::segment(1) == 'gender_profile' || Request::segment(1) == 'head_count' || Request::segment(1) == 'age_profile' || Request::segment(1) == 'leave_report') ? 'true' : 'false'); ?>" aria-controls="fleet">
                            <i class="fas fa-chart-pie"></i><?php echo e(__('HR')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::segment(1) == 'departments' || Request::segment(1) == 'designations' || Request::segment(1) == 'announcements' || Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender' || Request::segment(1) == 'gender_profile' || Request::segment(1) == 'head_count' || Request::segment(1) == 'age_profile' || Request::segment(1) == 'leave_report')? 'show' :''); ?>" id="fleet" style="">
                            <ul class="nav flex-column">
                                
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Departments')): ?>
                                    <li class="nav-item <?php echo e((request()->is('departments*') ? 'active' : '')); ?>">
                                        <a href="<?php echo e(route('departments.index')); ?>" class="nav-link"><?php echo e(__('Department')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Designations')): ?>
                                    <li class="nav-item <?php echo e((request()->is('designations*') ? 'active' : '')); ?>">
                                        <a href="<?php echo e(route('designations.index')); ?>" class="nav-link"><?php echo e(__('Designations')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Announcements')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'announcements.index') ?'active' :''); ?>">
                                        <a href="<?php echo e(route('announcements.index')); ?>" class="nav-link"><?php echo e(__('Announcements')); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if( Gate::check('Manage Leave Requests') || Gate::check('Manage Holidays') || Gate::check('Manage Policies') || Gate::check('View HR Leave Calender')): ?>
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-hr" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link <?php echo e((Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender') ? 'active' :'collapsed'); ?>" href="#navbar-hr-leave_management" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays') ? 'true' :'false'); ?>" aria-controls="navbar-getting-started1">
                                                            <?php echo e(__('Leave Management')); ?>

                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul <?php echo e((Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender') ? 'show' :'collapse'); ?>" id="navbar-hr-leave_management" style="">
                                                            <ul class="nav flex-column">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Leave Requests')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'leave_requests.index') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('leave_requests.index')); ?>" class="nav-link"><?php echo e(__('Requestes')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Holidays')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'holidays.index') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('holidays.index')); ?>" class="nav-link"><?php echo e(__('Holidays')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Policies')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'policies.index') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('policies.index')); ?>" class="nav-link"><?php echo e(__('Policies')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View HR Leave Calender')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'leave_calender.index') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('leave_calender.index')); ?>" class="nav-link"><?php echo e(__('Calendar')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endif; ?>
                                <?php if( Gate::check('View HR Gender Profile Report') || Gate::check('View HR Head Count Report') || Gate::check('View HR Age Profile Report') || Gate::check('View HR Leave Report')): ?>
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-hr1" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link <?php echo e((Request::segment(1) == 'gender_profile' || Request::segment(1) == 'head_count' || Request::segment(1) == 'age_profile' || Request::segment(1) == 'leave_report') ? 'active' : 'collapsed'); ?>" href="#navbar-hr-reports" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'gender_profile' || Request::segment(1) == 'head_count' || Request::segment(1) == 'age_profile' || Request::segment(1) == 'leave_report') ? 'true' : 'false'); ?>" aria-controls="navbar-getting-started1">
                                                            <?php echo e(__('Reports')); ?>

                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul <?php echo e((Request::segment(1) == 'gender_profile' || Request::segment(1) == 'head_count' || Request::segment(1) == 'age_profile' || Request::segment(1) == 'leave_report') ? 'show' : 'collapse'); ?>" id="navbar-hr-reports" style="">
                                                            <ul class="nav flex-column">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View HR Gender Profile Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'hr.gender_profile') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('hr.gender_profile')); ?>" class="nav-link"><?php echo e(__('Gender Profile')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View HR Head Count Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'hr.head_count') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('hr.head_count')); ?>" class="nav-link"><?php echo e(__('Head Count')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View HR Age Profile Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'hr.age_profile') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('hr.age_profile')); ?>" class="nav-link"><?php echo e(__('Age Profile')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View HR Leave Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'hr.leave_report') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('hr.leave_report')); ?>" class="nav-link"><?php echo e(__('Leave Report')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if( Gate::check('Manage Customers') || Gate::check('Manage Vendors') || Gate::check('Manage Invoices') || Gate::check('Manage Invoice Proposals') || Gate::check('Manage Bills') || Gate::check('Manage Bill Payments') || Gate::check('Manage Journals') || Gate::check('Manage Chart of Accounts') || Gate::check('Manage Bank Accounts') || Gate::check('Manage Bank Transfers') || Gate::check('Manage Product Categories') || Gate::check('Manage Products') || Gate::check('Manage Taxs')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::segment(1) == 'customers' || Request::segment(1) == 'vendors' || Request::segment(1) == 'invoices' || Request::segment(1) == 'proposals' || Request::segment(1) == 'bills' || Request::segment(1) == 'payments' || Request::segment(1) == 'journal_entries' || Request::segment(1) == 'ledger_report' || Request::segment(1) == 'chart_of_accounts' || Request::segment(1) == 'bank_accounts' || Request::segment(1) == 'transfers' || Request::segment(1) == 'payment_methods' || Request::segment(1) == 'product_categories' || Request::segment(1) == 'product_and_services' || Request::segment(1) == 'taxrates' || Request::segment(1) == 'accounting_transaction_report' || Request::segment(1) == 'invoice_summary_report' || Request::segment(1) == 'bill_summary_report' || Request::segment(1) == 'tax_summary_report' || Request::segment(1) == 'income_summary_report' || Request::segment(1) == 'expense_summary_report' || Request::segment(1) == 'profit_loss_summary_report' || Request::segment(1) == 'account_statement_report' || Request::segment(1) == 'income_vs_expense_summary_report') ? 'active' : 'collapsed'); ?>" href="#accounting" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'customers' || Request::segment(1) == 'vendors' || Request::segment(1) == 'invoices' || Request::segment(1) == 'proposals' || Request::segment(1) == 'bills' || Request::segment(1) == 'payments' || Request::segment(1) == 'journal_entries' || Request::segment(1) == 'ledger_report' || Request::segment(1) == 'chart_of_accounts' || Request::segment(1) == 'bank_accounts' || Request::segment(1) == 'transfers' || Request::segment(1) == 'payment_methods' || Request::segment(1) == 'product_categories' || Request::segment(1) == 'product_and_services' || Request::segment(1) == 'taxrates' || Request::segment(1) == 'accounting_transaction_report' || Request::segment(1) == 'invoice_summary_report' || Request::segment(1) == 'bill_summary_report' || Request::segment(1) == 'tax_summary_report' || Request::segment(1) == 'income_summary_report' || Request::segment(1) == 'expense_summary_report' || Request::segment(1) == 'profit_loss_summary_report' || Request::segment(1) == 'account_statement_report' || Request::segment(1) == 'income_vs_expense_summary_report') ? 'true' : 'false'); ?>" aria-controls="fleet">
                            <i class="fa fa-calculator"></i><?php echo e(__('Accounting')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::segment(1) == 'customers' || Request::segment(1) == 'vendors' || Request::segment(1) == 'invoices' || Request::segment(1) == 'proposals' || Request::segment(1) == 'bills' || Request::segment(1) == 'payments' || Request::segment(1) == 'journal_entries' || Request::segment(1) == 'ledger_report' || Request::segment(1) == 'chart_of_accounts' || Request::segment(1) == 'bank_accounts' || Request::segment(1) == 'transfers' || Request::segment(1) == 'payment_methods' || Request::segment(1) == 'product_categories' || Request::segment(1) == 'product_and_services' || Request::segment(1) == 'taxrates' || Request::segment(1) == 'accounting_transaction_report' || Request::segment(1) == 'invoice_summary_report' || Request::segment(1) == 'bill_summary_report' || Request::segment(1) == 'tax_summary_report' || Request::segment(1) == 'income_summary_report' || Request::segment(1) == 'expense_summary_report' || Request::segment(1) == 'profit_loss_summary_report' || Request::segment(1) == 'account_statement_report' || Request::segment(1) == 'income_vs_expense_summary_report') ? 'show' : ''); ?>" id="accounting" style="">
                            <ul class="nav flex-column">
                                
                                <?php if( Gate::check('Manage Customers') || Gate::check('Manage Vendors')): ?>
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-accounting" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link <?php echo e((Request::segment(1) == 'customers' || Request::segment(1) == 'vendors') ? 'active' : 'collapsed'); ?>" href="#navbar-accounting-users" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'customers' || Request::segment(1) == 'vendors') ? 'true' : 'false'); ?>" aria-controls="navbar-getting-started1">
                                                            <?php echo e(__('Users')); ?>

                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul <?php echo e((Request::segment(1) == 'customers' || Request::segment(1) == 'vendors') ? 'show' : 'collapse'); ?>" id="navbar-accounting-users" style="">
                                                            <ul class="nav flex-column">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Customers')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('customers*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('customers.index')); ?>" class="nav-link"><?php echo e(__('Customers')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Vendors')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('vendors*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('vendors.index')); ?>" class="nav-link"><?php echo e(__('Vendors')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endif; ?>
                                <?php if( Gate::check('Manage Invoices') || Gate::check('Manage Invoice Proposals') || Gate::check('Manage Bills') || Gate::check('Manage Bill Payments') || Gate::check('Manage Journals')): ?>
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-accounting1" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link <?php echo e((Request::segment(1) == 'invoices' || Request::segment(1) == 'proposals' || Request::segment(1) == 'bills' || Request::segment(1) == 'payments' || Request::segment(1) == 'journal_entries') ? 'active' :'collapsed'); ?>" href="#navbar-accounting1-transaction" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'invoices' || Request::segment(1) == 'proposals' || Request::segment(1) == 'bills' || Request::segment(1) == 'payments' || Request::segment(1) == 'journal_entries') ? 'true' : 'false'); ?>" aria-controls="navbar-getting-started1">
                                                            <?php echo e(__('Transactions')); ?>

                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul <?php echo e((Request::segment(1) == 'invoices' || Request::segment(1) == 'proposals' || Request::segment(1) == 'bills' || Request::segment(1) == 'payments' || Request::segment(1) == 'journal_entries') ? 'show' :'collapse'); ?>" id="navbar-accounting1-transaction" style="">
                                                            <ul class="nav flex-column">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Invoices')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('invoices*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('invoices.index')); ?>" class="nav-link"><?php echo e(__('Invoice')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Invoice Proposals')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('proposals*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('proposals.index')); ?>" class="nav-link"><?php echo e(__('Invoice Proposal')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Bills')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('bills*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('bills.index')); ?>" class="nav-link"><?php echo e(__('Bills')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Bill Payments')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'payments.index') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('payments.index')); ?>" class="nav-link"><?php echo e(__('Payment')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Journals')): ?>
                                                                    <li class="nav-item <?php echo e((request()->is('journal_entries*') ? 'active' : '')); ?>">
                                                                        <a href="<?php echo e(route('journal_entries.index')); ?>" class="nav-link"><?php echo e(__('Journals')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Chart of Accounts')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'chart_of_accounts.index' || Request::route()->getName() == 'report.ledger') ?'active' :''); ?>">
                                        <a href="<?php echo e(route('chart_of_accounts.index')); ?>" class="nav-link"><?php echo e(__('Chart Of Account')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if( Gate::check('Manage Bank Accounts') || Gate::check('Manage Bank Transfers') || Gate::check('Manage Payment Methods')): ?>
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-accounting2" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link <?php echo e((Request::segment(1) == 'bank_accounts' || Request::segment(1) == 'transfers' || Request::segment(1) == 'payment_methods')? 'active' :'collapsed'); ?>" href="#navbar-accounting2-Bank" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'bank_accounts' || Request::segment(1) == 'transfers' || Request::segment(1) == 'payment_methods')? 'true' :'false'); ?>" aria-controls="navbar-getting-started1">
                                                            <?php echo e(__('Bank')); ?>

                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul <?php echo e((Request::segment(1) == 'bank_accounts' || Request::segment(1) == 'transfers' || Request::segment(1) == 'payment_methods')? 'show' :'collapse'); ?>" id="navbar-accounting2-Bank" style="">
                                                            <ul class="nav flex-column">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Bank Accounts')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'bank_accounts.index') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('bank_accounts.index')); ?>" class="nav-link"><?php echo e(__('Bank Account')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Bank Transfers')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'transfers.index') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('transfers.index')); ?>" class="nav-link"><?php echo e(__('Bank Transfer')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payment Methods')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'payment_methods.index') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('payment_methods.index')); ?>" class="nav-link"><?php echo e(__('Payment Method')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endif; ?>
                                <?php if( Gate::check('Manage Product Categories') || Gate::check('Manage Products')): ?>
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-accounting3" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link <?php echo e((Request::segment(1) == 'product_categories' || Request::segment(1) == 'product_and_services')? 'active' :'collapsed'); ?>" href="#navbar-accounting3-Product" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'product_categories' || Request::segment(1) == 'product_and_services')? 'true' :'false'); ?>" aria-controls="navbar-getting-started1">
                                                            <?php echo e(__('Products')); ?>

                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul <?php echo e((Request::segment(1) == 'product_categories' || Request::segment(1) == 'product_and_services')? 'show' :'collapse'); ?>" id="navbar-accounting3-Product" style="">
                                                            <ul class="nav flex-column">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Product Categories')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'product_categories.index') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('product_categories.index')); ?>" class="nav-link"><?php echo e(__('Product Categories')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Products')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'product_and_services.index') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('product_and_services.index')); ?>" class="nav-link"><?php echo e(__('Product & Service')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Taxs')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'taxrates.index') ?'active' :''); ?>">
                                        <a href="<?php echo e(route('taxrates.index')); ?>" class="nav-link"><?php echo e(__('Tax')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if( Gate::check('View Accounting Transaction Report') || Gate::check('View Accounting Account Statement Report') || Gate::check('View Accounting Income Report') || Gate::check('View Accounting Expense Report') || Gate::check('View Accounting IncomeVSExpense Report') || Gate::check('View Accounting Tax Report') || Gate::check('View Accounting ProfitLoss Report') || Gate::check('View Accounting Invoice Report') || Gate::check('View Accounting Bill Report')): ?>
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-accounting4" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link <?php echo e((Request::segment(1) == 'accounting_transaction_report' || Request::segment(1) == 'invoice_summary_report' || Request::segment(1) == 'bill_summary_report' || Request::segment(1) == 'tax_summary_report' || Request::segment(1) == 'income_summary_report' || Request::segment(1) == 'expense_summary_report' || Request::segment(1) == 'profit_loss_summary_report' || Request::segment(1) == 'account_statement_report' || Request::segment(1) == 'income_vs_expense_summary_report')? 'active' :'collapsed'); ?>" href="#navbar-accounting4-Report" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'accounting_transaction_report' || Request::segment(1) == 'invoice_summary_report' || Request::segment(1) == 'bill_summary_report' || Request::segment(1) == 'tax_summary_report' || Request::segment(1) == 'income_summary_report' || Request::segment(1) == 'expense_summary_report' || Request::segment(1) == 'profit_loss_summary_report' || Request::segment(1) == 'account_statement_report' || Request::segment(1) == 'income_vs_expense_summary_report')? 'true' :'false'); ?>" aria-controls="navbar-getting-started1">
                                                            <?php echo e(__('Reports')); ?>

                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul <?php echo e((Request::segment(1) == 'accounting_transaction_report' || Request::segment(1) == 'invoice_summary_report' || Request::segment(1) == 'bill_summary_report' || Request::segment(1) == 'tax_summary_report' || Request::segment(1) == 'income_summary_report' || Request::segment(1) == 'expense_summary_report' || Request::segment(1) == 'profit_loss_summary_report' || Request::segment(1) == 'account_statement_report' || Request::segment(1) == 'income_vs_expense_summary_report')? 'show' :'collapse'); ?>" id="navbar-accounting4-Report" style="">
                                                            <ul class="nav flex-column">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Accounting Transaction Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'accounting.transaction.report') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('accounting.transaction.report')); ?>" class="nav-link"><?php echo e(__('Transaction Report')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Accounting Account Statement Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'account.statement.report') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('account.statement.report')); ?>" class="nav-link"><?php echo e(__('Account Statement')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Accounting Income Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'income.summary.report') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('income.summary.report')); ?>" class="nav-link"><?php echo e(__('Income Summary')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Accounting Expense Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'expense.summary.report') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('expense.summary.report')); ?>" class="nav-link"><?php echo e(__('Expense Summary')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Accounting IncomeVSExpense Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'income.vs.expense.summary.report') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('income.vs.expense.summary.report')); ?>" class="nav-link"><?php echo e(__('Income Vs Expense')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Accounting Tax Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'tax.summary.report') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('tax.summary.report')); ?>" class="nav-link"><?php echo e(__('Tax Summary')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Accounting ProfitLoss Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'profit.loss.summary.report') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('profit.loss.summary.report')); ?>" class="nav-link"><?php echo e(__('Profit & Loss Summary')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Accounting Invoice Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'invoice.summary.report') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('invoice.summary.report')); ?>" class="nav-link"><?php echo e(__('Invoice Summary')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('VView Accounting Bill Report')): ?>
                                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'bill.summary.report') ?'active' :''); ?>">
                                                                        <a href="<?php echo e(route('bill.summary.report')); ?>" class="nav-link"><?php echo e(__('Bill Summary')); ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if( Gate::check('Manage Employees') || Gate::check('Manage Roles')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'roles') ? 'active' : 'collapsed'); ?>" href="#user" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'roles') ? 'true' : 'false'); ?>" aria-controls="user">
                            <i class="fa fa-users"></i><?php echo e(__('Staff')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse<?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'roles') ? 'show' : ''); ?>" id="user" style="">
                            <ul class="nav flex-column">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Employees')): ?>
                                    <li class="nav-item <?php echo e((request()->is('users*') ? 'active' : '')); ?>">
                                        <a href="<?php echo e(route('users.index')); ?>" class="nav-link"><?php echo e(__('User')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(\Auth::user()->type=='Admin'): ?>
                                    <li class="nav-item <?php echo e((request()->is('roles*') ? 'active' : '')); ?>">
                                        <a href="<?php echo e(route('roles.index')); ?>" class="nav-link"><?php echo e(__('Role')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if( Gate::check('Manage Projects') || Gate::check('Manage Task Stages')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::segment(1) == 'projects' || Request::segment(1) == 'task_stages')?'active':'collapsed'); ?>" href="#project" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::segment(1) == 'projects' || Request::segment(1) == 'task_stages')?'true':'false'); ?>" aria-controls="fleet">
                            <i class="fas fa-project-diagram"></i><?php echo e(__('Projects')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::segment(1) == 'projects' || Request::segment(1) == 'task_stages')?'show':''); ?>" id="project" style="">
                            <ul class="nav flex-column">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Projects')): ?>
                                    <li class="nav-item <?php echo e((request()->is('projects*') ? 'active' : '')); ?>">
                                        <a href="<?php echo e(route('projects.index')); ?>" class="nav-link"><?php echo e(__('Projects')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <ul class="nav flex-column">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Task Stages')): ?>
                                    <li class="nav-item <?php echo e((request()->is('task_stages*') ? 'active' : '')); ?>">
                                        <a href="<?php echo e(route('task_stages.index')); ?>" class="nav-link"><?php echo e(__('Task Stages')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('company.setting')); ?>" class="nav-link ">
                        <i class="fas fa-sliders-h"></i><?php echo e(__('Setting')); ?>

                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/include/admin/side_bar.blade.php ENDPATH**/ ?>