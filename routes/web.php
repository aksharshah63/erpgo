<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
\Auth::routes();

Route::get('/register', function () {
    return redirect('/login');
});

/* dashboard route start */

Route::get('/', ['as' => 'home','uses' => 'HomeController@index'])->middleware(['XSS']);
Route::get('/home', ['as' => 'home','uses' => 'HomeController@index'])->middleware(['auth','XSS']);
Route::get('hr_dashboard', ['as' => 'hr.dashboard','uses' => 'HomeController@hr_dashboard'])->middleware(['auth','XSS']);
Route::get('ac_dashboard', 'HomeController@accounting_dashboard')->name('accounting.dashboard')->middleware(['auth','XSS']);

/* dashboard route end */

/* crm route start */

//Route::get('crm_dashboard', ['as' => 'crm.dashboard','uses' => 'CrmReportController@crm_dashboard'])->middleware(['auth','XSS']);

Route::resource('contacts', 'ContactController')->middleware(['auth','XSS']);
Route::put('update-contact-groups/{id}', 'ContactController@save_contact_group')->name('update.contact-groups')->middleware(['auth','XSS']);
Route::put('add-company/{id}', 'ContactController@add_company')->name('add.company')->middleware(['auth','XSS']);
Route::post('/contact-profile',['as' => 'update.contact.profile','uses' =>'ContactController@updateProfile'])->middleware(['auth','XSS']);
Route::post('/add-tag',['as' => 'add.tag','uses' =>'ContactController@addtag'])->middleware(['auth','XSS']);

Route::resource('companies', 'CompanyController')->middleware(['auth','XSS']);
Route::put('update-company-contact-groups/{id}', 'CompanyController@save_contact_group')->name('update.company-contact-groups')->middleware(['auth','XSS']);
Route::put('add-contact/{id}', 'CompanyController@add_contact')->name('add.contact')->middleware(['auth','XSS']);
Route::post('/company-profile',['as' => 'update.company.profile','uses' =>'CompanyController@updateProfile'])->middleware(['auth','XSS']);

Route::resource('notes', 'NoteController')->middleware('auth');
Route::get('notes/create/{type}/{id}', ['as' => 'notes.create','uses' => 'NoteController@create'])->middleware('auth');
Route::resource('log_activities', 'LogController')->middleware('auth');
Route::get('log_activities/create/{type}/{id}', ['as' => 'log_activities.create','uses' => 'LogController@create'])->middleware('auth');
Route::resource('schedules', 'ScheduleController')->middleware('auth');
Route::get('schedules/create/{type}/{id}', ['as' => 'schedules.create','uses' => 'ScheduleController@create'])->middleware('auth');
Route::resource('emails', 'EmailController')->middleware('auth');
Route::get('emails/create/{type}/{id}', ['as' => 'emails.create','uses' => 'EmailController@create'])->middleware('auth');
Route::resource('tasks', 'TaskController')->middleware('auth');
Route::get('tasks/create/{type}/{id}', ['as' => 'tasks.create','uses' => 'TaskController@create'])->middleware('auth');

Route::resource('calender_schedules', 'CalenderScheduleController')->middleware(['auth','XSS']);
Route::get('calender_schedules/log/{id}', ['as' => 'shedule.log.view','uses' => 'CalenderScheduleController@logScheduleView'])->middleware(['auth','XSS']);

Route::get('activities', ['as' => 'crm.activities','uses' => 'ActivityController@activity'])->middleware(['auth','XSS']);

Route::resource('contact_groups', 'ContactGroupController')->middleware(['auth','XSS']);

Route::get('crm_activity_report', ['as' => 'crm.activity.report','uses' => 'CrmReportController@crm_activity_report'])->middleware(['auth','XSS']);
Route::get('crm_customer_report', ['as' => 'crm.customer.report','uses' => 'CrmReportController@crm_customer_report'])->middleware(['auth','XSS']);
Route::get('crm_growth_report', ['as' => 'crm.growth.report','uses' => 'CrmReportController@crm_growth_report'])->middleware(['auth','XSS']);

/* crm route ennd */

/* hr route strt */

//Route::get('/hr_dashboard', ['as' => 'hr.dashboard','uses' => 'EmployeeController@dashboard'])->middleware(['auth','XSS']);

Route::resource('work_experiences', 'WorkExperienceController')->middleware(['auth','XSS']);
Route::get('work_experiences/create/{id}', ['as' => 'work_experiences.create','uses' => 'WorkExperienceController@create'])->middleware(['auth','XSS']);
Route::resource('educations', 'EducationController')->middleware(['auth','XSS']);
Route::get('educations/create/{id}', ['as' => 'educations.create','uses' => 'EducationController@create'])->middleware(['auth','XSS']);
Route::resource('performance_reviews', 'PerformanceReviewController')->middleware(['auth','XSS']);
Route::get('performance_reviews/create/{id}', ['as' => 'performance_reviews.create','uses' => 'PerformanceReviewController@create'])->middleware(['auth','XSS']);
Route::resource('performance_comments', 'PerformanceCommentController')->middleware(['auth','XSS']);
Route::get('performance_comments/create/{id}', ['as' => 'performance_comments.create','uses' => 'PerformanceCommentController@create'])->middleware(['auth','XSS']);
Route::resource('performance_goals', 'PerformanceGoalController')->middleware(['auth','XSS']);
Route::get('performance_goals/create/{id}', ['as' => 'performance_goals.create','uses' => 'PerformanceGoalController@create'])->middleware(['auth','XSS']);

Route::resource('departments', 'DepartmentController')->middleware(['auth','XSS']);

Route::resource('designations', 'DesignationController')->middleware(['auth','XSS']);

Route::resource('announcements', 'AnnouncementController')->middleware(['auth']);

Route::resource('leave_requests', 'LeaveRequestController')->middleware(['auth','XSS']);
Route::post('/get_employee', 'LeaveRequestController@get_employee')->middleware(['auth','XSS']);
Route::post('/approve_leave', 'LeaveRequestController@approve_leave')->middleware(['auth','XSS']);
Route::post('/reject_leave', 'LeaveRequestController@reject_leave')->middleware(['auth','XSS']);

Route::resource('holidays', 'HolidayController')->middleware(['auth','XSS']);

Route::resource('policies', 'PolicyController')->middleware(['auth','XSS']);

Route::get('leave_calender/{id?}', ['as' => 'leave_calender.index','uses' => 'CalenderLeaveController@index'])->middleware(['auth','XSS']);

Route::get('gender_profile', ['as' => 'hr.gender_profile','uses' => 'HrReportController@hr_gender_profile'])->middleware(['auth','XSS']);
Route::get('head_count', ['as' => 'hr.head_count','uses' => 'HrReportController@hr_head_count'])->middleware(['auth','XSS']);
Route::get('age_profile', ['as' => 'hr.age_profile','uses' => 'HrReportController@hr_age_profile'])->middleware(['auth','XSS']);
Route::get('leave_report', ['as' => 'hr.leave_report','uses' => 'HrReportController@hr_leave_report'])->middleware(['auth','XSS']);
Route::get('user/{id}/leave/{status}/{type}/{month}/{year}', 'HrReportController@userLeave')->name('report.user.leave')->middleware(['auth','XSS']);

/* hr route end */


/* accounting route start */

//Route::get('ac_dashboard', 'AccountingDashboardController@dashboard')->name('accounting.dashboard')->middleware(['auth','XSS']);

Route::resource('customers', 'CustomerController')->middleware(['auth','XSS']);
Route::post('/customer-profile',['as' => 'update.customer.profile','uses' =>'CustomerController@updateProfile'])->middleware(['auth','XSS']);

Route::post('/vendor-profile',['as' => 'update.vendor.profile','uses' =>'VendorController@updateProfile'])->middleware(['auth','XSS']);
Route::resource('vendors', 'VendorController')->middleware(['auth','XSS']);

Route::resource('invoices', 'InvoiceController')->middleware(['auth','XSS']);
Route::post('invoice/product/destroy', 'InvoiceController@productDestroy')->name('invoice.product.destroy')->middleware(['auth','XSS']);
Route::post('invoice/product', 'InvoiceController@product')->name('invoice.product')->middleware(['auth','XSS']);
Route::get('invoice/items', 'InvoiceController@items')->name('invoice.items')->middleware(['auth','XSS']);
Route::get('invoice/{id}/payment', 'InvoiceController@payment')->name('invoice.payment')->middleware(['auth','XSS']);
Route::post('invoice/{id}/payment', 'InvoiceController@createPayment')->name('invoice.payment')->middleware(['auth','XSS']);
Route::get('invoice/{id}/sent', 'InvoiceController@sent')->name('invoice.sent')->middleware(['auth','XSS']);
Route::post('invoice/{id}/payment/{pid}/destroy', 'InvoiceController@paymentDestroy')->name('invoice.payment.destroy')->middleware(['auth','XSS']);
Route::get('invoice/{id}/duplicate', 'InvoiceController@duplicate')->name('invoice.duplicate')->middleware(['auth','XSS']);
Route::get('invoice/{id}/payment/reminder', 'InvoiceController@paymentReminder')->name('invoice.payment.reminder')->middleware(['auth','XSS']);
Route::get('invoice/{id}/resent', 'InvoiceController@resent')->name('invoice.resent')->middleware(['auth','XSS']);
Route::get('invoice/pdf/{id}', 'InvoiceController@invoice')->name('invoice.pdf')->middleware(['XSS']);
Route::get('invoice/{id}/send', 'InvoiceController@customerInvoiceSend')->name('customer.invoice.send')->middleware(['auth','XSS']);
Route::post('invoice/{id}/send/mail', 'InvoiceController@customerInvoiceSendMail')->name('customer.invoice.send.mail')->middleware(['auth','XSS']);
Route::post('/invoices/template/setting','InvoiceController@saveTemplateSettings')->name('template.setting')->middleware(['auth','XSS']);
Route::get('/invoices/preview/{template}/{color}', 'InvoiceController@previewInvoice')->name('invoice.preview')->middleware(['auth','XSS']);

Route::resource('proposals', 'ProposalController')->middleware(['auth','XSS']);
Route::post('proposal/product', 'ProposalController@product')->name('proposal.product')->middleware(['auth','XSS']);
Route::post('proposal/product/destroy', 'ProposalController@productDestroy')->name('proposal.product.destroy')->middleware(['auth','XSS']);
Route::get('proposal/items', 'ProposalController@items')->name('proposal.items')->middleware(['auth','XSS']);
Route::get('proposal/{id}/sent', 'ProposalController@sent')->name('proposal.sent')->middleware(['auth','XSS']);
Route::get('proposal/{id}/status/change', 'ProposalController@statusChange')->name('proposal.status.change')->middleware(['auth','XSS']);
Route::get('proposal/{id}/duplicate', 'ProposalController@duplicate')->name('proposal.duplicate')->middleware(['auth','XSS']);
Route::get('proposal/{id}/resent', 'ProposalController@resent')->name('proposal.resent')->middleware(['auth','XSS']);
Route::post('/proposal/template/setting', 'ProposalController@saveProposalTemplateSettings')->name('proposal.template.setting')->middleware(['auth','XSS']);
Route::get('/proposal/preview/{template}/{color}', 'ProposalController@previewProposal')->name('proposal.preview')->middleware(['auth','XSS']);
Route::get('proposal/pdf/{id}', 'ProposalController@proposal')->name('proposal.pdf')->middleware(['XSS']);

Route::resource('bills', 'BillController')->middleware(['auth','XSS']);
Route::get('bill/{id}/sent', 'BillController@sent')->name('bill.sent')->middleware(['auth','XSS']);
Route::get('bill/{id}/payment', 'BillController@payment')->name('bill.payment')->middleware(['auth','XSS']);
Route::post('bill/{id}/payment', 'BillController@createPayment')->name('bill.payment')->middleware(['auth','XSS']);
Route::post('bill/{id}/payment/{pid}/destroy', 'BillController@paymentDestroy')->name('bill.payment.destroy')->middleware(['auth','XSS']);
Route::post('bill/product', 'BillController@product')->name('bill.product')->middleware(['auth','XSS']);
Route::post('bill/product/destroy', 'BillController@productDestroy')->name('bill.product.destroy')->middleware(['auth','XSS']);
Route::get('bill/items', 'BillController@items')->name('bill.items')->middleware(['auth','XSS']);
Route::get('bill/{id}/duplicate', 'BillController@duplicate')->name('bill.duplicate')->middleware(['auth','XSS']);
Route::get('bill/{id}/resent', 'BillController@resent')->name('bill.resent')->middleware(['auth','XSS']);
Route::get('bill/{id}/send', 'BillController@vendorBillSend')->name('vendor.bill.send')->middleware(['auth','XSS']);
Route::post('bill/{id}/send/mail', 'BillController@vendorBillSendMail')->name('vendor.bill.send.mail')->middleware(['auth','XSS']);
Route::post('/bill/template/setting','BillController@saveBillTemplateSettings')->name('bill.template.setting')->middleware(['auth','XSS']);
Route::get('/bill/preview/{template}/{color}','BillController@previewBill')->name('bill.preview')->middleware(['auth','XSS']);
Route::get('bill/pdf/{id}', 'BillController@bill')->name('bill.pdf')->middleware(['XSS']);

Route::resource('payments', 'PaymentController')->middleware(['auth','XSS']);

Route::resource('journal_entries', 'JournalEntryController')->middleware(['auth','XSS']);
Route::post('journal-entry/account/destroy', 'JournalEntryController@accountDestroy')->name('journal.account.destroy')->middleware(['auth','XSS']);

Route::resource('chart_of_accounts', 'ChartOfAccountController')->middleware(['auth','XSS']);
Route::post('chart-of-account/subtype', 'ChartOfAccountController@getSubType')->name('charofAccount.subType')->middleware(['auth','XSS']);

Route::resource('bank_accounts', 'BankAccountController')->middleware(['auth','XSS'])->middleware(['auth','XSS']);

Route::resource('transfers', 'TransferController')->middleware(['auth','XSS'])->middleware(['auth','XSS']);

Route::resource('payment_methods', 'PaymentMethodController')->middleware(['auth','XSS']);

Route::resource('product_categories', 'ProductCategoryController')->middleware(['auth','XSS']);

Route::resource('product_and_services', 'ProductAndServiceController')->middleware(['auth','XSS']);

Route::resource('taxrates', 'TaxrateController')->middleware(['auth','XSS']);

Route::get('ledger_report', 'AccountingReportController@ledgerSummary')->name('report.ledger')->middleware(['auth','XSS']);
Route::get('accounting_transaction_report', 'AccountingReportController@transaction_report')->name('accounting.transaction.report')->middleware(['auth','XSS']);
Route::get('invoice_summary_report', 'AccountingReportController@invoice_summary_report')->name('invoice.summary.report')->middleware(['auth','XSS']);
Route::get('bill_summary_report', 'AccountingReportController@bill_summary_report')->name('bill.summary.report')->middleware(['auth','XSS']);
Route::get('tax_summary_report', 'AccountingReportController@tax_summary_report')->name('tax.summary.report')->middleware(['auth','XSS']);
Route::get('income_summary_report', 'AccountingReportController@income_summary_report')->name('income.summary.report')->middleware(['auth','XSS']);
Route::get('expense_summary_report', 'AccountingReportController@expense_summary_report')->name('expense.summary.report')->middleware(['auth','XSS']);
Route::get('profit_loss_summary_report', 'AccountingReportController@profit_loss_summary_report')->name('profit.loss.summary.report')->middleware(['auth','XSS']);
Route::get('account_statement_report', 'AccountingReportController@account_statement_report')->name('account.statement.report')->middleware(['auth','XSS']);
Route::get('income_vs_expense_summary_report', 'AccountingReportController@income_vs_expense_summary_report')->name('income.vs.expense.summary.report')->middleware(['auth','XSS']);

/* accounting route end */

/* staff route start */

Route::resource('users', 'UserController')->middleware(['auth','XSS']);
Route::post('/user-profile',['as' => 'update.user.profile','uses' =>'UserController@updateProfile'])->middleware(['auth','XSS']);
Route::get('policy/create/{id}/{dept_id}', ['as' => 'policy.create','uses' => 'UserController@create_policy'])->middleware(['auth','XSS']); 
Route::post('policy/store', ['as' => 'policy.store','uses' => 'UserController@store_policy'])->middleware(['auth','XSS']); 
Route::delete('policy/destroy/{id}/{user_id}', ['as' => 'policy.destroy','uses' => 'UserController@remove_policy'])->middleware(['auth','XSS']); 
Route::get('policy/view/{id}', ['as' => 'policy.show','uses' => 'UserController@view_policy'])->middleware(['auth','XSS']); 
Route::get('profile', 'UserController@profile')->name('profile')->middleware(['auth','XSS']);
Route::put('update-profile', 'UserController@editprofile')->name('customer.update.profile')->middleware(['auth','XSS']);
Route::put('change.password', 'UserController@updatePassword')->name('customer.update.password')->middleware(['auth','XSS']);

Route::resource('roles', 'RoleController')->middleware(['auth','XSS']);

Route::resource('permissions', 'PermissionController')->middleware(['auth','XSS']);

/* staff route end */

/* company setting route start */

Route::get('company-setting', 'SystemController@companyIndex')->name('company.setting')->middleware(['auth','XSS']);
Route::post('business-setting', 'SystemController@saveBusinessSettings')->name('business.setting')->middleware(['auth','XSS']);
Route::post('system-settings', 'SystemController@saveSystemSettings')->name('system.settings')->middleware(['auth','XSS']);
Route::post('company-settings', 'SystemController@saveCompanySettings')->name('company.settings')->middleware(['auth','XSS']);
Route::post('email-settings', 'SystemController@saveEmailSettings')->name('email.settings')->middleware(['auth','XSS']);
Route::get('test-mail', 'SystemController@testMail')->name('test.mail')->middleware(['auth','XSS']);
Route::post('test-mail', 'SystemController@testSendMail')->name('test.send.mail')->middleware(['auth','XSS']);
Route::post('stripe-settings', 'SystemController@savePaymentSettings')->name('payment.settings')->middleware(['auth','XSS']);

/* company setting route end */

/* language route start */

Route::get('change-language/{lang}', 'LanguageController@changeLanquage')->name('change.language')->middleware(['auth','XSS']);
Route::get('manage-language/{lang}', 'LanguageController@manageLanguage')->name('manage.language')->middleware(['auth','XSS']);
Route::post('store-language-data/{lang}', 'LanguageController@storeLanguageData')->name('store.language.data')->middleware(['auth','XSS']);
Route::get('create-language', 'LanguageController@createLanguage')->name('create.language')->middleware(['auth','XSS']);
Route::post('store-language', 'LanguageController@storeLanguage')->name('store.language')->middleware(['auth','XSS']);
Route::delete('/lang/{lang}', 'LanguageController@destroyLang')->name('lang.destroy')->middleware(['auth','XSS']);

/* language route end */

/* project route start */

Route::resource('projects', 'ProjectController')->middleware(['auth','XSS']);
Route::get('invite-project-member/{id}',['as' => 'invite.project.member.view','uses' => 'ProjectController@inviteMemberView'])->middleware(['auth', 'XSS']);
Route::post('invite-project-user-member',['as' => 'invite.project.user.member','uses' => 'ProjectController@inviteProjectUserMember'])->middleware(['auth', 'XSS']);
Route::get('projects-users',['as' => 'project.user','uses' => 'ProjectController@loadUser'])->middleware(['auth', 'XSS']);
Route::get('projects/{id}/milestone', ['as' => 'project.milestone','uses' => 'ProjectController@milestone'])->middleware(['auth', 'XSS']);
Route::post('projects/{id}/milestone', ['as' => 'project.milestone.store', 'uses' => 'ProjectController@milestoneStore'])->middleware(['auth', 'XSS']);
Route::get('projects/milestone/{id}/edit', ['as' => 'project.milestone.edit', 'uses' => 'ProjectController@milestoneEdit'])->middleware(['auth', 'XSS']);
Route::put('projects/milestone/{id}', ['as' => 'project.milestone.update', 'uses' => 'ProjectController@milestoneUpdate'])->middleware(['auth', 'XSS']);
Route::delete('projects/milestone/{id}', ['as' => 'project.milestone.destroy', 'uses' => 'ProjectController@milestoneDestroy'])->middleware(['auth', 'XSS']);
Route::get('projects/milestone/{id}/show', ['as' => 'project.milestone.show', 'uses' => 'ProjectController@milestoneShow'])->middleware(['auth', 'XSS']);
Route::get('project/{view?}',['as' => 'projects.list','uses' => 'ProjectController@index'])->middleware(['auth', 'XSS']);
Route::get('projects-view',['as' => 'filter.project.view','uses' => 'ProjectController@filterProjectView'])->middleware(['auth', 'XSS']);
Route::get('projects/{id}/gantt/{duration?}',['as' => 'projects.gantt','uses' =>'ProjectController@gantt'])->middleware(['auth','XSS']);
Route::post('projects/{id}/gantt',['as' => 'projects.gantt.post','uses' =>'ProjectController@ganttPost'])->middleware(['auth','XSS']);

/* project route end */

/* Task Stage route start */

Route::resource('task_stages', 'TaskStageController')->middleware(['auth','XSS']);

/* Task Stage route end */

/* Project Task route start */

Route::get('/projects/{id}/task',['as' => 'projects.tasks.index','uses' =>'ProjectTaskController@index'])->middleware(['auth','XSS']);
Route::get('/projects/{pid}/task/{sid}',['as' => 'projects.tasks.create','uses' =>'ProjectTaskController@create'])->middleware(['auth','XSS']);
Route::post('/projects/{pid}/task/{sid}',['as' => 'projects.tasks.store','uses' =>'ProjectTaskController@store'])->middleware(['auth','XSS']);
Route::get('/projects/{id}/task/{tid}/show',['as' => 'projects.tasks.show','uses' =>'ProjectTaskController@show'])->middleware(['auth','XSS']);
Route::get('/projects/{id}/task/{tid}/edit',['as' => 'projects.tasks.edit','uses' =>'ProjectTaskController@edit'])->middleware(['auth','XSS']);
Route::put('/projects/{id}/task/{tid}',['as' => 'projects.tasks.update','uses' =>'ProjectTaskController@update'])->middleware(['auth','XSS']);
Route::delete('/projects/{id}/task/{tid}',['as' => 'projects.tasks.destroy','uses' =>'ProjectTaskController@destroy'])->middleware(['auth','XSS']);
Route::get('stage/{id}/tasks', ['as' => 'stage.tasks','uses' => 'ProjectTaskController@getStageTasks'])->middleware(['auth', 'XSS']);
Route::post('/projects/{id}/change/{tid}/complete',['as' => 'change.complete','uses' =>'ProjectTaskController@changeCom'])->middleware(['auth', 'XSS']);
Route::post('/projects/{id}/change/{tid}/fav',['as' => 'change.fav','uses' =>'ProjectTaskController@changeFav'])->middleware(['auth', 'XSS']);
Route::post('/projects/{id}/change/{tid}/progress',['as' => 'change.progress','uses' =>'ProjectTaskController@changeProg'])->middleware(['auth', 'XSS']);
Route::post('/projects/{id}/checklist/{tid}',['as' => 'checklist.store','uses' =>'ProjectTaskController@checklistStore'])->middleware(['auth', 'XSS']);
Route::put('/projects/{id}/checklist/{cid}',['as' => 'checklist.update','uses' =>'ProjectTaskController@checklistUpdate'])->middleware(['auth', 'XSS']);
Route::delete('/projects/{id}/checklist/{cid}',['as' => 'checklist.destroy','uses' =>'ProjectTaskController@checklistDestroy'])->middleware(['auth', 'XSS']);
Route::post('/projects/{id}/comment/{tid}/file',['as' => 'comment.store.file','uses' =>'ProjectTaskController@commentStoreFile'])->middleware(['auth', 'XSS']);
Route::delete('/projects/{id}/comment/{tid}/file/{fid}',['as' => 'comment.destroy.file','uses' =>'ProjectTaskController@commentDestroyFile'])->middleware(['auth', 'XSS']);
Route::delete('/projects/{id}/comment/{tid}/{cid}',['as' => 'comment.destroy','uses' =>'ProjectTaskController@commentDestroy'])->middleware(['auth', 'XSS']);
Route::post('/projects/{id}/comment/{tid}',['as' => 'comment.store','uses' =>'ProjectTaskController@commentStore'])->middleware(['auth', 'XSS']);
Route::patch('update-task-priority-color', ['as' => 'update.task.priority.color','uses' => 'ProjectTaskController@updateTaskPriorityColor'])->middleware(['auth', 'XSS']);
Route::patch('/projects/{id}/task/order',['as' => 'tasks.update.order','uses' =>'ProjectTaskController@taskOrderUpdate'])->middleware(['auth','XSS']);
Route::get('/projects/task/{id}/get',['as' => 'projects.tasks.get','uses' =>'ProjectTaskController@taskGet'])->middleware(['auth','XSS']);

/* Project Task route End */

/* expense route start */

Route::get('/projects/{id}/expense',['as' => 'projects.expenses.index','uses' =>'ExpenseController@index'])->middleware(['auth','XSS']);
Route::get('/projects/{pid}/expense/create',['as' => 'projects.expenses.create','uses' =>'ExpenseController@create'])->middleware(['auth','XSS']);
Route::post('/projects/{pid}/expense/store',['as' => 'projects.expenses.store','uses' =>'ExpenseController@store'])->middleware(['auth','XSS']);
Route::get('/projects/{id}/expense/{eid}/edit',['as' => 'projects.expenses.edit','uses' =>'ExpenseController@edit'])->middleware(['auth','XSS']);
Route::put('/projects/{id}/expense/{eid}',['as' => 'projects.expenses.update','uses' =>'ExpenseController@update'])->middleware(['auth','XSS']);
Route::delete('/projects/{eid}/expense/',['as' => 'projects.expenses.destroy','uses' =>'ExpenseController@destroy'])->middleware(['auth','XSS']);
Route::get('/expense-list',['as' => 'expense.list','uses' => 'ExpenseController@expenseList'])->middleware(['auth', 'XSS']);

/* expense route end */

/* timesheet route start */

Route::get('/project/{id}/timesheet',['as' => 'timesheet.index','uses' =>'TimesheetController@timesheetView'])->middleware(['auth','XSS']);
Route::get('/project/{id}/timesheet/create',['as' => 'timesheet.create','uses' =>'TimesheetController@timesheetCreate'])->middleware(['auth','XSS']);
Route::post('/project/timesheet',['as' => 'timesheet.store','uses' =>'TimesheetController@timesheetStore'])->middleware(['auth','XSS']);
Route::get('/project/timesheet/{project_id}/edit/{timesheet_id}',['as' => 'timesheet.edit','uses' =>'TimesheetController@timesheetEdit'])->middleware(['auth','XSS']);
Route::put('/project/timesheet/{timesheet_id}',['as' => 'timesheet.update','uses' =>'TimesheetController@timesheetUpdate'])->middleware(['auth','XSS']);
Route::delete('/project/timesheet/{timesheet_id}',['as' => 'timesheet.destroy','uses' =>'TimesheetController@timesheetDestroy'])->middleware(['auth','XSS']);
Route::get('timesheet-list', 'TimesheetController@timesheetList')->name('timesheet.list')->middleware(['auth', 'XSS']);
Route::get('timesheet-list-get', 'TimesheetController@timesheetListGet')->name('timesheet.list.get')->middleware(['auth', 'XSS']);
Route::get('timesheet-table-view', 'TimesheetController@filterTimesheetTableView')->name('filter.timesheet.table.view')->middleware(['auth', 'XSS']);
Route::get('append-timesheet-task-html', 'TimesheetController@appendTimesheetTaskHTML')->name('append.timesheet.task.html')->middleware(['auth', 'XSS']);

/* timesheet route end */





