{{ Form::open(array('url' => 'roles')) }}
<div class="row">
    <div class="col-12">
        <div class="form-group">
            {{ Form::label('name', __('Role Name'),['class'=>'form-control-label']) }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            {{ Form::label('permissions', __('Assign Permissions'),['class'=>'form-control-label']) }}
            <table class="table table-striped">
                <tr>
                    <th class="text-dark">{{__('Module')}}</th>
                    <th class="text-dark">{{__('Permissions')}}</th>
                </tr>
                <?php
                $modules = [
                    'Contact',
                    'Company',
                    'Schedule',
                    'Contact Group',
                    'Employee',
                    'Department',
                    'Designation',
                    'Announcement',
                    'Leave Request',
                    'Holiday',
                    'Policy',
                    'Customer',
                    'Vendor',
                    'Invoice',
                    'Invoice Product',
                    'Payment Invoice',
                    'Invoice Proposal',
                    'Proposal Product',
                    'Bill',
                    'Bill Product',
                    'Payment Bill',
                    'Bill Payment',
                    'Journal',
                    'Chart of Account',
                    'Bank Account',
                    'Bank Transfer',
                    'Payment Method',
                    'Product Category',
                    'Product',
                    'Tax',
                    'System Setting',
                    'Stripe Setting',
                    'Project',
                    'Milestone',
                    'Task',
                    'Timesheet',
                    'Grant Chart',
                    'Expense',
                    'Activity',
                    'Task Stage'
                ];

                $other_modules = [
                    'View CRM Activity',
                    'View CRM Activity Report',
                    'View CRM Customer Report',
                    'View CRM Growth Report',
                    'View HR Leave Calender',
                    'View HR Gender Profile Report',
                    'View HR Head Count Report',
                    'View HR Age Profile Report',
                    'View HR Leave Report',
                    'View Accounting Transaction Report',
                    'View Accounting Account Statement Report',
                    'View Accounting Income Report',
                    'View Accounting Expense Report',
                    'View Accounting IncomeVSExpense Report',
                    'View Accounting Tax Report',
                    'View Accounting ProfitLoss Report',
                    'View Accounting Invoice Report',
                    'View Accounting Bill Report',
                ];

                if(\Auth::user()->type == 'Admin')
                {
                    $modules[] = 'Language';
                }

                ?>
                @foreach($modules as $module)
                    <?php

                    // if($module == 'Expense Category')
                    // {
                    //     $s_name = 'Expense Categories';
                    // }
                    // else
                    {
                        $s_name = $module . "s";
                        $plural_name = str_replace('y','ies',$module);
                    }
                    ?>
                    <tr>
                        <td>{{__($module)}}</td>
                        <td>
                            <div class="row">
                                @if(in_array('Manage '.$s_name,$permissions))
                                    @php($key = array_search('Manage '.$s_name, $permissions))
                                    <div class="col-3 custom-control custom-checkbox">
                                        {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                        {{ Form::label('permission_'.$key, 'Manage',['class'=>'custom-control-label font-weight-500']) }}
                                    </div>
                                @elseif(in_array('Manage '.$plural_name,$permissions))
                                    @php($key = array_search('Manage '.$plural_name, $permissions))
                                    <div class="col-3 custom-control custom-checkbox">
                                        {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                        {{ Form::label('permission_'.$key, 'Manage',['class'=>'custom-control-label font-weight-500']) }}
                                    </div>
                                @endif
                                @if(in_array('Create '.$module,$permissions))
                                    @php($key = array_search('Create '.$module, $permissions))
                                    <div class="col-3 custom-control custom-checkbox">
                                        {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                        {{ Form::label('permission_'.$key, __('Create'),['class'=>'custom-control-label font-weight-500']) }}
                                    </div>
                                @endif
                                @if(in_array('Request '.$module,$permissions))
                                    @php($key = array_search('Request '.$module, $permissions))
                                    <div class="col-3 custom-control custom-checkbox">
                                        {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                        {{ Form::label('permission_'.$key, __('Request'),['class'=>'custom-control-label font-weight-500']) }}
                                    </div>
                                @endif
                                @if(in_array('Edit '.$module,$permissions))
                                    @php($key = array_search('Edit '.$module, $permissions))
                                    <div class="col-3 custom-control custom-checkbox">
                                        {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                        {{ Form::label('permission_'.$key, __('Edit'),['class'=>'custom-control-label font-weight-500']) }}
                                    </div>
                                @endif
                                @if(in_array('Delete '.$module,$permissions))
                                    @php($key = array_search('Delete '.$module, $permissions))
                                    <div class="col-3 custom-control custom-checkbox">
                                        {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                        {{ Form::label('permission_'.$key, __('Delete'),['class'=>'custom-control-label font-weight-500']) }}
                                    </div>
                                @endif
                                @if(in_array('View '.$module,$permissions))
                                    @php($key = array_search('View '.$module, $permissions))
                                    <div class="col-3 custom-control custom-checkbox">
                                        {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                        {{ Form::label('permission_'.$key, __('View'),['class'=>'custom-control-label font-weight-500']) }}
                                    </div>
                                @endif
                                @if(in_array('Send '.$module,$permissions))
                                    @php($key = array_search('Send '.$module, $permissions))
                                    <div class="col-3 custom-control custom-checkbox">
                                        {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                        {{ Form::label('permission_'.$key, __('Send'),['class'=>'custom-control-label font-weight-500']) }}
                                    </div>
                                @endif
                                @if(in_array('Duplicate '.$module,$permissions))
                                    @php($key = array_search('Duplicate '.$module, $permissions))
                                    <div class="col-3 custom-control custom-checkbox">
                                        {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                        {{ Form::label('permission_'.$key, __('Duplicate'),['class'=>'custom-control-label font-weight-500']) }}
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td>{{__('Other')}}</td>
                    <td>
                        <div class="row">
                            @foreach($other_modules as $o_module)
                                @if(in_array($o_module,$permissions))
                                    @php($key = array_search($o_module, $permissions))
                                    <div class="col-6 custom-control custom-checkbox">
                                        {{ Form::checkbox('permissions[]',$key,false,['class' => 'custom-control-input','id'=>'permission_'.$key]) }}
                                        {{ Form::label('permission_'.$key, __($o_module),['class'=>'custom-control-label font-weight-500']) }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{{ Form::close() }}
