<div class="sidenav custom-sidenav" id="sidenav-main">
    <!-- Sidenav header -->
    <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="./index.html">
            @if(!empty(Utility::getValByName('company_logo')))
                <img src="{{asset(Storage::url('logo/'.Utility::getValByName('company_logo')))}}" class="navbar-brand-img" alt="...">
            @else
                <img src="{{asset(Storage::url('logo/logo.png'))}}" class="navbar-brand-img" alt="...">
            @endif
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
                    <a class="nav-link {{ (Request::route()->getName() == 'home' || Request::route()->getName() == 'hr.dashboard' || Request::route()->getName() == 'accounting.dashboard')?'active':'collapsed'}}" href="#dashboard" data-toggle="collapse" role="button" aria-expanded="{{ (Request::route()->getName() == 'home' || Request::route()->getName() == 'hr.dashboard' || Request::route()->getName() == 'accounting.dashboard')?'true':'false'}}" aria-controls="fleet">
                        <i class="fas fa-fire"></i>{{__('Dashboard')}}
                        <i class="fas fa-sort-up"></i>
                    </a>
                    <div class="collapse {{ (Request::route()->getName() == 'home' || Request::route()->getName() == 'hr.dashboard' || Request::route()->getName() == 'accounting.dashboard')?'show':''}}" id="dashboard" style="">
                        <ul class="nav flex-column">
                            <li class="nav-item {{ (Request::route()->getName() == 'home') ? 'active' :''}}">
                                <a href="{{route('home')}}" class="nav-link">{{__('CRM Dashboard')}}</a>
                            </li>
                        </ul>
                        <ul class="nav flex-column">
                            <li class="nav-item {{ (Request::route()->getName() == 'hr.dashboard') ? 'active' :''}}">
                                <a href="{{route('hr.dashboard')}}" class="nav-link">{{__('HR Dashboard')}}</a>
                            </li>
                        </ul>
                        <ul class="nav flex-column">
                            <li class="nav-item {{ (Request::route()->getName() == 'accounting.dashboard') ? 'active' :''}}">
                                <a href="{{route('accounting.dashboard')}}" class="nav-link">{{__('Accounting Dashboard')}}</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if( Gate::check('Manage Contacts') || Gate::check('Manage Companies') || Gate::check('Manage Schedules') || Gate::check('View CRM Activity') || Gate::check('Manage Contact Groups'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::segment(1) == 'crm_dashboard' ||Request::segment(1) == 'contacts' || Request::segment(1) == 'companies' || Request::segment(1) == 'calender_schedules' || Request::segment(1) == 'activities' || Request::segment(1) == 'contact_groups' || Request::segment(1) == 'crm_activity_report' || Request::segment(1) == 'crm_customer_report' || Request::segment(1) == 'crm_growth_report')?'active':'collapsed'}}" href="#crm" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'crm_dashboard' || Request::segment(1) == 'contacts' || Request::segment(1) == 'companies' || Request::segment(1) == 'calender_schedules' || Request::segment(1) == 'activities' || Request::segment(1) == 'contact_groups' || Request::segment(1) == 'crm_activity_report' || Request::segment(1) == 'crm_customer_report' || Request::segment(1) == 'crm_growth_report')?'true':'false'}}" aria-controls="fleet">
                            <i class="fas fa-user"></i>{{__('CRM')}}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::segment(1) == 'crm_dashboard' || Request::segment(1) == 'contacts' || Request::segment(1) == 'companies' || Request::segment(1) == 'calender_schedules' || Request::segment(1) == 'activities' || Request::segment(1) == 'contact_groups' || Request::segment(1) == 'crm_activity_report' || Request::segment(1) == 'crm_customer_report' || Request::segment(1) == 'crm_growth_report')?'show':''}}" id="crm" style="">
                            <ul class="nav flex-column">
                                {{-- <li class="nav-item {{ (Request::route()->getName() == 'crm.dashboard') ? 'active' :''}}">
                                    <a href="{{route('crm.dashboard')}}" class="nav-link">{{__('Dashboard')}}</a>
                                </li> --}}
                                @can('Manage Contacts')
                                    <li class="nav-item {{ (request()->is('contacts*') ? 'active' : '')}}">
                                        <a href="{{route('contacts.index')}}" class="nav-link">{{__('Contacts')}}</a>
                                    </li>
                                @endcan
                                @can('Manage Companies')
                                    <li class="nav-item {{ (request()->is('companies*') ? 'active' : '')}}">
                                        <a href="{{route('companies.index')}}" class="nav-link">{{__('Companies')}}</a>
                                    </li>
                                @endcan
                                @can('Manage Schedules')
                                    <li class="nav-item {{ (Request::route()->getName() == 'calender_schedules.index') ?'active' :''}}">
                                        <a href="{{route('calender_schedules.index')}}" class="nav-link">{{__('Schedule')}}</a>
                                    </li>
                                @endcan
                                @can('View CRM Activity')
                                    <li class="nav-item {{ (Request::route()->getName() == 'crm.activities') ?'active' :''}}">
                                        <a href="{{route('crm.activities')}}" class="nav-link">{{__('Activities')}}</a>
                                    </li>
                                @endcan
                                @can('Manage Contact Groups')
                                    <li class="nav-item {{ (Request::route()->getName() == 'contact_groups.index') ?'active' :''}}">
                                        <a href="{{route('contact_groups.index')}}" class="nav-link">{{__('Contact Group')}}</a>
                                    </li>
                                @endcan
                                @if( Gate::check('View CRM Activity Report') || Gate::check('View CRM Customer Report') || Gate::check('View CRM Growth Report'))
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-crm" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link {{ (Request::segment(1) == 'crm_activity_report' || Request::segment(1) == 'crm_customer_report' || Request::segment(1) == 'crm_growth_report')?'active' :'collapsed'}}" href="#navbar-crm-report" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'crm_activity_report' || Request::segment(1) == 'crm_customer_report' || Request::segment(1) == 'crm_growth_report')?'true':'false'}}" aria-controls="navbar-getting-started1">
                                                            {{__('Reports')}}
                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul {{ (Request::segment(1) == 'crm_activity_report' || Request::segment(1) == 'crm_customer_report' || Request::segment(1) == 'crm_growth_report')?'show' :'collapse'}}" id="navbar-crm-report" style="">
                                                            <ul class="nav flex-column">
                                                                @can('View CRM Activity Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'crm.activity.report') ?'active' :''}}">
                                                                        <a href="{{route('crm.activity.report')}}" class="nav-link">{{__('Activity Report')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('View CRM Customer Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'crm.customer.report') ?'active' :''}}">
                                                                        <a href="{{route('crm.customer.report')}}" class="nav-link">{{__('Customer Report')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('View CRM Growth Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'crm.growth.report') ?'active' :''}}">
                                                                        <a href="{{route('crm.growth.report')}}" class="nav-link">{{__('Growth Report')}}</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
                @if( Gate::check('Manage Departments') || Gate::check('Manage Designations') || Gate::check('Manage Announcements'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::segment(1) == 'departments' || Request::segment(1) == 'designations' || Request::segment(1) == 'announcements' || Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender' || Request::segment(1) == 'gender_profile' || Request::segment(1) == 'head_count' || Request::segment(1) == 'age_profile' || Request::segment(1) == 'leave_report') ? 'active' : 'collapsed'}}" href="#fleet" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'departments' || Request::segment(1) == 'designations' || Request::segment(1) == 'announcements' || Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender' || Request::segment(1) == 'gender_profile' || Request::segment(1) == 'head_count' || Request::segment(1) == 'age_profile' || Request::segment(1) == 'leave_report') ? 'true' : 'false'}}" aria-controls="fleet">
                            <i class="fas fa-chart-pie"></i>{{__('HR')}}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::segment(1) == 'departments' || Request::segment(1) == 'designations' || Request::segment(1) == 'announcements' || Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender' || Request::segment(1) == 'gender_profile' || Request::segment(1) == 'head_count' || Request::segment(1) == 'age_profile' || Request::segment(1) == 'leave_report')? 'show' :''}}" id="fleet" style="">
                            <ul class="nav flex-column">
                                {{-- <li class="nav-item {{ (Request::route()->getName() == 'hr.dashboard') ?'active' :''}}">
                                    <a href="{{route('hr.dashboard')}}" class="nav-link">{{__('Dashboard')}}</a>
                                </li> --}}
                                @can('Manage Departments')
                                    <li class="nav-item {{ (request()->is('departments*') ? 'active' : '')}}">
                                        <a href="{{route('departments.index')}}" class="nav-link">{{__('Department')}}</a>
                                    </li>
                                @endcan
                                @can('Manage Designations')
                                    <li class="nav-item {{ (request()->is('designations*') ? 'active' : '')}}">
                                        <a href="{{route('designations.index')}}" class="nav-link">{{__('Designations')}}</a>
                                    </li>
                                @endcan
                                @can('Manage Announcements')
                                    <li class="nav-item {{ (Request::route()->getName() == 'announcements.index') ?'active' :''}}">
                                        <a href="{{route('announcements.index')}}" class="nav-link">{{__('Announcements')}}</a>
                                    </li>
                                @endcan
                                
                                @if( Gate::check('Manage Leave Requests') || Gate::check('Manage Holidays') || Gate::check('Manage Policies') || Gate::check('View HR Leave Calender'))
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-hr" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link {{ (Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender') ? 'active' :'collapsed'}}" href="#navbar-hr-leave_management" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays') ? 'true' :'false'}}" aria-controls="navbar-getting-started1">
                                                            {{__('Leave Management')}}
                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul {{ (Request::segment(1) == 'leave_requests' || Request::segment(1) == 'holidays' || Request::segment(1) == 'policies' || Request::segment(1) == 'leave_calender') ? 'show' :'collapse'}}" id="navbar-hr-leave_management" style="">
                                                            <ul class="nav flex-column">
                                                                @can('Manage Leave Requests')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'leave_requests.index') ?'active' :''}}">
                                                                        <a href="{{route('leave_requests.index')}}" class="nav-link">{{__('Requestes')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('Manage Holidays')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'holidays.index') ?'active' :''}}">
                                                                        <a href="{{route('holidays.index')}}" class="nav-link">{{__('Holidays')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('Manage Policies')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'policies.index') ?'active' :''}}">
                                                                        <a href="{{route('policies.index')}}" class="nav-link">{{__('Policies')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('View HR Leave Calender')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'leave_calender.index') ?'active' :''}}">
                                                                        <a href="{{route('leave_calender.index')}}" class="nav-link">{{__('Calendar')}}</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                @if( Gate::check('View HR Gender Profile Report') || Gate::check('View HR Head Count Report') || Gate::check('View HR Age Profile Report') || Gate::check('View HR Leave Report'))
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-hr1" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link {{ (Request::segment(1) == 'gender_profile' || Request::segment(1) == 'head_count' || Request::segment(1) == 'age_profile' || Request::segment(1) == 'leave_report') ? 'active' : 'collapsed'}}" href="#navbar-hr-reports" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'gender_profile' || Request::segment(1) == 'head_count' || Request::segment(1) == 'age_profile' || Request::segment(1) == 'leave_report') ? 'true' : 'false'}}" aria-controls="navbar-getting-started1">
                                                            {{__('Reports')}}
                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul {{ (Request::segment(1) == 'gender_profile' || Request::segment(1) == 'head_count' || Request::segment(1) == 'age_profile' || Request::segment(1) == 'leave_report') ? 'show' : 'collapse'}}" id="navbar-hr-reports" style="">
                                                            <ul class="nav flex-column">
                                                                @can('View HR Gender Profile Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'hr.gender_profile') ?'active' :''}}">
                                                                        <a href="{{route('hr.gender_profile')}}" class="nav-link">{{__('Gender Profile')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('View HR Head Count Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'hr.head_count') ?'active' :''}}">
                                                                        <a href="{{route('hr.head_count')}}" class="nav-link">{{__('Head Count')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('View HR Age Profile Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'hr.age_profile') ?'active' :''}}">
                                                                        <a href="{{route('hr.age_profile')}}" class="nav-link">{{__('Age Profile')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('View HR Leave Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'hr.leave_report') ?'active' :''}}">
                                                                        <a href="{{route('hr.leave_report')}}" class="nav-link">{{__('Leave Report')}}</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
                @if( Gate::check('Manage Customers') || Gate::check('Manage Vendors') || Gate::check('Manage Invoices') || Gate::check('Manage Invoice Proposals') || Gate::check('Manage Bills') || Gate::check('Manage Bill Payments') || Gate::check('Manage Journals') || Gate::check('Manage Chart of Accounts') || Gate::check('Manage Bank Accounts') || Gate::check('Manage Bank Transfers') || Gate::check('Manage Product Categories') || Gate::check('Manage Products') || Gate::check('Manage Taxs'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::segment(1) == 'customers' || Request::segment(1) == 'vendors' || Request::segment(1) == 'invoices' || Request::segment(1) == 'proposals' || Request::segment(1) == 'bills' || Request::segment(1) == 'payments' || Request::segment(1) == 'journal_entries' || Request::segment(1) == 'ledger_report' || Request::segment(1) == 'chart_of_accounts' || Request::segment(1) == 'bank_accounts' || Request::segment(1) == 'transfers' || Request::segment(1) == 'payment_methods' || Request::segment(1) == 'product_categories' || Request::segment(1) == 'product_and_services' || Request::segment(1) == 'taxrates' || Request::segment(1) == 'accounting_transaction_report' || Request::segment(1) == 'invoice_summary_report' || Request::segment(1) == 'bill_summary_report' || Request::segment(1) == 'tax_summary_report' || Request::segment(1) == 'income_summary_report' || Request::segment(1) == 'expense_summary_report' || Request::segment(1) == 'profit_loss_summary_report' || Request::segment(1) == 'account_statement_report' || Request::segment(1) == 'income_vs_expense_summary_report') ? 'active' : 'collapsed'}}" href="#accounting" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'customers' || Request::segment(1) == 'vendors' || Request::segment(1) == 'invoices' || Request::segment(1) == 'proposals' || Request::segment(1) == 'bills' || Request::segment(1) == 'payments' || Request::segment(1) == 'journal_entries' || Request::segment(1) == 'ledger_report' || Request::segment(1) == 'chart_of_accounts' || Request::segment(1) == 'bank_accounts' || Request::segment(1) == 'transfers' || Request::segment(1) == 'payment_methods' || Request::segment(1) == 'product_categories' || Request::segment(1) == 'product_and_services' || Request::segment(1) == 'taxrates' || Request::segment(1) == 'accounting_transaction_report' || Request::segment(1) == 'invoice_summary_report' || Request::segment(1) == 'bill_summary_report' || Request::segment(1) == 'tax_summary_report' || Request::segment(1) == 'income_summary_report' || Request::segment(1) == 'expense_summary_report' || Request::segment(1) == 'profit_loss_summary_report' || Request::segment(1) == 'account_statement_report' || Request::segment(1) == 'income_vs_expense_summary_report') ? 'true' : 'false'}}" aria-controls="fleet">
                            <i class="fa fa-calculator"></i>{{__('Accounting')}}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::segment(1) == 'customers' || Request::segment(1) == 'vendors' || Request::segment(1) == 'invoices' || Request::segment(1) == 'proposals' || Request::segment(1) == 'bills' || Request::segment(1) == 'payments' || Request::segment(1) == 'journal_entries' || Request::segment(1) == 'ledger_report' || Request::segment(1) == 'chart_of_accounts' || Request::segment(1) == 'bank_accounts' || Request::segment(1) == 'transfers' || Request::segment(1) == 'payment_methods' || Request::segment(1) == 'product_categories' || Request::segment(1) == 'product_and_services' || Request::segment(1) == 'taxrates' || Request::segment(1) == 'accounting_transaction_report' || Request::segment(1) == 'invoice_summary_report' || Request::segment(1) == 'bill_summary_report' || Request::segment(1) == 'tax_summary_report' || Request::segment(1) == 'income_summary_report' || Request::segment(1) == 'expense_summary_report' || Request::segment(1) == 'profit_loss_summary_report' || Request::segment(1) == 'account_statement_report' || Request::segment(1) == 'income_vs_expense_summary_report') ? 'show' : ''}}" id="accounting" style="">
                            <ul class="nav flex-column">
                                {{-- <li class="nav-item {{ (Request::route()->getName() == 'accounting.dashboard') ?'active' :''}}">
                                    <a href="{{route('accounting.dashboard')}}" class="nav-link">{{__('Dashboard')}}</a>
                                </li> --}}
                                @if( Gate::check('Manage Customers') || Gate::check('Manage Vendors'))
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-accounting" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link {{ (Request::segment(1) == 'customers' || Request::segment(1) == 'vendors') ? 'active' : 'collapsed'}}" href="#navbar-accounting-users" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'customers' || Request::segment(1) == 'vendors') ? 'true' : 'false'}}" aria-controls="navbar-getting-started1">
                                                            {{__('Users')}}
                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul {{ (Request::segment(1) == 'customers' || Request::segment(1) == 'vendors') ? 'show' : 'collapse'}}" id="navbar-accounting-users" style="">
                                                            <ul class="nav flex-column">
                                                                @can('Manage Customers')
                                                                    <li class="nav-item {{ (request()->is('customers*') ? 'active' : '')}}">
                                                                        <a href="{{route('customers.index')}}" class="nav-link">{{__('Customers')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('Manage Vendors')
                                                                    <li class="nav-item {{ (request()->is('vendors*') ? 'active' : '')}}">
                                                                        <a href="{{route('vendors.index')}}" class="nav-link">{{__('Vendors')}}</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                @if( Gate::check('Manage Invoices') || Gate::check('Manage Invoice Proposals') || Gate::check('Manage Bills') || Gate::check('Manage Bill Payments') || Gate::check('Manage Journals'))
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-accounting1" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link {{(Request::segment(1) == 'invoices' || Request::segment(1) == 'proposals' || Request::segment(1) == 'bills' || Request::segment(1) == 'payments' || Request::segment(1) == 'journal_entries') ? 'active' :'collapsed'}}" href="#navbar-accounting1-transaction" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'invoices' || Request::segment(1) == 'proposals' || Request::segment(1) == 'bills' || Request::segment(1) == 'payments' || Request::segment(1) == 'journal_entries') ? 'true' : 'false'}}" aria-controls="navbar-getting-started1">
                                                            {{__('Transactions')}}
                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul {{(Request::segment(1) == 'invoices' || Request::segment(1) == 'proposals' || Request::segment(1) == 'bills' || Request::segment(1) == 'payments' || Request::segment(1) == 'journal_entries') ? 'show' :'collapse'}}" id="navbar-accounting1-transaction" style="">
                                                            <ul class="nav flex-column">
                                                                @can('Manage Invoices')
                                                                    <li class="nav-item {{ (request()->is('invoices*') ? 'active' : '')}}">
                                                                        <a href="{{route('invoices.index')}}" class="nav-link">{{__('Invoice')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('Manage Invoice Proposals')
                                                                    <li class="nav-item {{ (request()->is('proposals*') ? 'active' : '')}}">
                                                                        <a href="{{route('proposals.index')}}" class="nav-link">{{__('Invoice Proposal')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('Manage Bills')
                                                                    <li class="nav-item {{ (request()->is('bills*') ? 'active' : '')}}">
                                                                        <a href="{{route('bills.index')}}" class="nav-link">{{__('Bills')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('Manage Bill Payments')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'payments.index') ?'active' :''}}">
                                                                        <a href="{{route('payments.index')}}" class="nav-link">{{__('Payment')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('Manage Journals')
                                                                    <li class="nav-item {{ (request()->is('journal_entries*') ? 'active' : '')}}">
                                                                        <a href="{{route('journal_entries.index')}}" class="nav-link">{{__('Journals')}}</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                @can('Manage Chart of Accounts')
                                    <li class="nav-item {{ (Request::route()->getName() == 'chart_of_accounts.index' || Request::route()->getName() == 'report.ledger') ?'active' :''}}">
                                        <a href="{{route('chart_of_accounts.index')}}" class="nav-link">{{__('Chart Of Account')}}</a>
                                    </li>
                                @endcan
                                @if( Gate::check('Manage Bank Accounts') || Gate::check('Manage Bank Transfers') || Gate::check('Manage Payment Methods'))
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-accounting2" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link {{(Request::segment(1) == 'bank_accounts' || Request::segment(1) == 'transfers' || Request::segment(1) == 'payment_methods')? 'active' :'collapsed'}}" href="#navbar-accounting2-Bank" data-toggle="collapse" role="button" aria-expanded="{{(Request::segment(1) == 'bank_accounts' || Request::segment(1) == 'transfers' || Request::segment(1) == 'payment_methods')? 'true' :'false'}}" aria-controls="navbar-getting-started1">
                                                            {{__('Bank')}}
                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul {{(Request::segment(1) == 'bank_accounts' || Request::segment(1) == 'transfers' || Request::segment(1) == 'payment_methods')? 'show' :'collapse'}}" id="navbar-accounting2-Bank" style="">
                                                            <ul class="nav flex-column">
                                                                @can('Manage Bank Accounts')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'bank_accounts.index') ?'active' :''}}">
                                                                        <a href="{{route('bank_accounts.index')}}" class="nav-link">{{__('Bank Account')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('Manage Bank Transfers')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'transfers.index') ?'active' :''}}">
                                                                        <a href="{{route('transfers.index')}}" class="nav-link">{{__('Bank Transfer')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('Manage Payment Methods')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'payment_methods.index') ?'active' :''}}">
                                                                        <a href="{{route('payment_methods.index')}}" class="nav-link">{{__('Payment Method')}}</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                @if( Gate::check('Manage Product Categories') || Gate::check('Manage Products'))
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-accounting3" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link {{(Request::segment(1) == 'product_categories' || Request::segment(1) == 'product_and_services')? 'active' :'collapsed'}}" href="#navbar-accounting3-Product" data-toggle="collapse" role="button" aria-expanded="{{(Request::segment(1) == 'product_categories' || Request::segment(1) == 'product_and_services')? 'true' :'false'}}" aria-controls="navbar-getting-started1">
                                                            {{__('Products')}}
                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul {{(Request::segment(1) == 'product_categories' || Request::segment(1) == 'product_and_services')? 'show' :'collapse'}}" id="navbar-accounting3-Product" style="">
                                                            <ul class="nav flex-column">
                                                                @can('Manage Product Categories')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'product_categories.index') ?'active' :''}}">
                                                                        <a href="{{route('product_categories.index')}}" class="nav-link">{{__('Product Categories')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('Manage Products')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'product_and_services.index') ?'active' :''}}">
                                                                        <a href="{{route('product_and_services.index')}}" class="nav-link">{{__('Product & Service')}}</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                @can('Manage Taxs')
                                    <li class="nav-item {{ (Request::route()->getName() == 'taxrates.index') ?'active' :''}}">
                                        <a href="{{route('taxrates.index')}}" class="nav-link">{{__('Tax')}}</a>
                                    </li>
                                @endcan
                                @if( Gate::check('View Accounting Transaction Report') || Gate::check('View Accounting Account Statement Report') || Gate::check('View Accounting Income Report') || Gate::check('View Accounting Expense Report') || Gate::check('View Accounting IncomeVSExpense Report') || Gate::check('View Accounting Tax Report') || Gate::check('View Accounting ProfitLoss Report') || Gate::check('View Accounting Invoice Report') || Gate::check('View Accounting Bill Report'))
                                    <li class="nav-item">
                                        <div class="collapse show" id="navbar-accounting4" style="">
                                            <ul class="nav flex-column">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item submenu-li ">
                                                        <a class="nav-link {{(Request::segment(1) == 'accounting_transaction_report' || Request::segment(1) == 'invoice_summary_report' || Request::segment(1) == 'bill_summary_report' || Request::segment(1) == 'tax_summary_report' || Request::segment(1) == 'income_summary_report' || Request::segment(1) == 'expense_summary_report' || Request::segment(1) == 'profit_loss_summary_report' || Request::segment(1) == 'account_statement_report' || Request::segment(1) == 'income_vs_expense_summary_report')? 'active' :'collapsed'}}" href="#navbar-accounting4-Report" data-toggle="collapse" role="button" aria-expanded="{{(Request::segment(1) == 'accounting_transaction_report' || Request::segment(1) == 'invoice_summary_report' || Request::segment(1) == 'bill_summary_report' || Request::segment(1) == 'tax_summary_report' || Request::segment(1) == 'income_summary_report' || Request::segment(1) == 'expense_summary_report' || Request::segment(1) == 'profit_loss_summary_report' || Request::segment(1) == 'account_statement_report' || Request::segment(1) == 'income_vs_expense_summary_report')? 'true' :'false'}}" aria-controls="navbar-getting-started1">
                                                            {{__('Reports')}}
                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <div class="submenu-ul {{(Request::segment(1) == 'accounting_transaction_report' || Request::segment(1) == 'invoice_summary_report' || Request::segment(1) == 'bill_summary_report' || Request::segment(1) == 'tax_summary_report' || Request::segment(1) == 'income_summary_report' || Request::segment(1) == 'expense_summary_report' || Request::segment(1) == 'profit_loss_summary_report' || Request::segment(1) == 'account_statement_report' || Request::segment(1) == 'income_vs_expense_summary_report')? 'show' :'collapse'}}" id="navbar-accounting4-Report" style="">
                                                            <ul class="nav flex-column">
                                                                @can('View Accounting Transaction Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'accounting.transaction.report') ?'active' :''}}">
                                                                        <a href="{{route('accounting.transaction.report')}}" class="nav-link">{{__('Transaction Report')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('View Accounting Account Statement Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'account.statement.report') ?'active' :''}}">
                                                                        <a href="{{route('account.statement.report')}}" class="nav-link">{{__('Account Statement')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('View Accounting Income Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'income.summary.report') ?'active' :''}}">
                                                                        <a href="{{route('income.summary.report')}}" class="nav-link">{{__('Income Summary')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('View Accounting Expense Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'expense.summary.report') ?'active' :''}}">
                                                                        <a href="{{route('expense.summary.report')}}" class="nav-link">{{__('Expense Summary')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('View Accounting IncomeVSExpense Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'income.vs.expense.summary.report') ?'active' :''}}">
                                                                        <a href="{{route('income.vs.expense.summary.report')}}" class="nav-link">{{__('Income Vs Expense')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('View Accounting Tax Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'tax.summary.report') ?'active' :''}}">
                                                                        <a href="{{route('tax.summary.report')}}" class="nav-link">{{__('Tax Summary')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('View Accounting ProfitLoss Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'profit.loss.summary.report') ?'active' :''}}">
                                                                        <a href="{{route('profit.loss.summary.report')}}" class="nav-link">{{__('Profit & Loss Summary')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('View Accounting Invoice Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'invoice.summary.report') ?'active' :''}}">
                                                                        <a href="{{route('invoice.summary.report')}}" class="nav-link">{{__('Invoice Summary')}}</a>
                                                                    </li>
                                                                @endcan
                                                                @can('VView Accounting Bill Report')
                                                                    <li class="nav-item {{ (Request::route()->getName() == 'bill.summary.report') ?'active' :''}}">
                                                                        <a href="{{route('bill.summary.report')}}" class="nav-link">{{__('Bill Summary')}}</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
                @if( Gate::check('Manage Employees') || Gate::check('Manage Roles'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::segment(1) == 'users' || Request::segment(1) == 'roles') ? 'active' : 'collapsed'}}" href="#user" data-toggle="collapse" role="button" aria-expanded="{{(Request::segment(1) == 'users' || Request::segment(1) == 'roles') ? 'true' : 'false'}}" aria-controls="user">
                            <i class="fa fa-users"></i>{{__('Staff')}}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse{{ (Request::segment(1) == 'users' || Request::segment(1) == 'roles') ? 'show' : ''}}" id="user" style="">
                            <ul class="nav flex-column">
                                @can('Manage Employees')
                                    <li class="nav-item {{ (request()->is('users*') ? 'active' : '')}}">
                                        <a href="{{route('users.index')}}" class="nav-link">{{__('User')}}</a>
                                    </li>
                                @endcan
                                @if(\Auth::user()->type=='Admin')
                                    <li class="nav-item {{ (request()->is('roles*') ? 'active' : '')}}">
                                        <a href="{{route('roles.index')}}" class="nav-link">{{__('Role')}}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
                @if( Gate::check('Manage Projects') || Gate::check('Manage Task Stages'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::segment(1) == 'projects' || Request::segment(1) == 'task_stages')?'active':'collapsed'}}" href="#project" data-toggle="collapse" role="button" aria-expanded="{{ (Request::segment(1) == 'projects' || Request::segment(1) == 'task_stages')?'true':'false'}}" aria-controls="fleet">
                            <i class="fas fa-project-diagram"></i>{{__('Projects')}}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::segment(1) == 'projects' || Request::segment(1) == 'task_stages')?'show':''}}" id="project" style="">
                            <ul class="nav flex-column">
                                @can('Manage Projects')
                                    <li class="nav-item {{ (request()->is('projects*') ? 'active' : '')}}">
                                        <a href="{{route('projects.index')}}" class="nav-link">{{__('Projects')}}</a>
                                    </li>
                                @endcan
                            </ul>
                            <ul class="nav flex-column">
                                @can('Manage Task Stages')
                                    <li class="nav-item {{ (request()->is('task_stages*') ? 'active' : '')}}">
                                        <a href="{{route('task_stages.index')}}" class="nav-link">{{__('Task Stages')}}</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('company.setting')}}" class="nav-link ">
                        <i class="fas fa-sliders-h"></i>{{__('Setting')}}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
