<?php

use App\User;
use App\Utility;
use App\UserDetail;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrPermissions = [
            // Role Permission
            'Manage Roles' ,
            'Create Role',
            'Edit Role',
            'Delete Role',
            //CRM contact permission
            'Manage Contacts',
            'Create Contact',
            'View Contact',
            'Edit Contact',
            'Delete Contact',
            //CRM company permssion
            'Manage Companies',
            'Create Company',
            'View Company',
            'Edit Company',
            'Delete Company',
            //CRM schedule permission
            'Manage Schedules',
            'Create Schedule',
            'View Schedule',
            //CRM activity permission
            'View CRM Activity',
            //CRM contactgroup permission
            'Manage Contact Groups',
            'Create Contact Group',
            'Edit Contact Group',
            'Delete Contact Group',
            //CRM activity report permission
            'View CRM Activity Report',
            //CRM customer report permission
            'View CRM Customer Report',
            //CRM growth report permission
            'View CRM Growth Report',
            //HR employee permssion
            'Manage Employees',
            'Create Employee',
            'View Employee',
            'Edit Employee',
            'Delete Employee',
            //HR department permission
            'Manage Departments',
            'Create Department',
            'View Department',
            'Edit Department',
            'Delete Department',
            //HR designation permssion
            'Manage Designations',
            'Create Designation',
            'View Designation',
            'Edit Designation',
            'Delete Designation',
            //HR announcement permission
            'Manage Announcements',
            'Create Announcement',
            'Edit Announcement',
            'Delete Announcement',
            //HR leave request permission
            'Manage Leave Requests',
            'Create Leave Request',
            'Edit Leave Request',
            //HR holiday permission
            'Manage Holidays',
            'Create Holiday',
            'Edit Holiday',
            'Delete Holiday',
            //HR policy permission
            'Manage Policies',
            'Create Policy',
            'Edit Policy',
            'Delete Policy',
            //HR leave calender permission
            'View HR Leave Calender',
            //HR gender profile report permission
            'View HR Gender Profile Report',
            //HR head count report permission
            'View HR Head Count Report',
            //HR age profile report permission
            'View HR Age Profile Report',
            //HR leave report permission
            'View HR Leave Report',
            //accounting customer permission
            'Manage Customers',
            'Create Customer',
            'View Customer',
            'Edit Customer',
            'Delete Customer',
            //accounting vendor permission
            'Manage Vendors',
            'Create Vendor',
            'View Vendor',
            'Edit Vendor',
            'Delete Vendor',
            //accounting invoice permission
            'Manage Invoices',
            'Create Invoice',
            'Duplicate Invoice',
            'View Invoice',
            'Edit Invoice',
            'Delete Invoice',
            'Delete Invoice Product',
            'Send Invoice',
            'Create Payment Invoice',
            'Delete Payment Invoice',
            //accounting invoice proposal permission
            'Manage Invoice Proposals',
            'Create Invoice Proposal',
            'Duplicate Invoice Proposal',
            'View Invoice Proposal',
            'Edit Invoice Proposal',
            'Delete Invoice Proposal',
            'Delete Proposal Product',
            'Send Invoice Proposal',
            //accounting bill permission
            'Manage Bills',
            'Create Bill',
            'Duplicate Bill',
            'View Bill',
            'Edit Bill',
            'Delete Bill',
            'Delete Bill Product',
            'Send Bill',
            'Create Payment Bill',
            'Delete Payment Bill',
            //accounting bill payment permission
            'Manage Bill Payments',
            'Create Bill Payment',
            'Edit Bill Payment',
            'Delete Bill Payment',
            //accounting journal permission
            'Manage Journals',
            'Create Journal',
            'View Journal',
            'Edit Journal',
            'Delete Journal',
            //accounting chart of account permission
            'Manage Chart of Accounts',
            'Create Chart of Account',
            'View Chart of Account',
            'Edit Chart of Account',
            'Delete Chart of Account',
            //accounting bank account permission
            'Manage Bank Accounts',
            'Create Bank Account',
            'Edit Bank Account',
            'Delete Bank Account',
            //accounting bank transfer permission
            'Manage Bank Transfers',
            'Create Bank Transfer',
            'Edit Bank Transfer',
            'Delete Bank Transfer',
            //accounting payment method permission
            'Manage Payment Methods',
            'Create Payment Method',
            'Edit Payment Method',
            'Delete Payment Method',
            //accounting product category permission
            'Manage Product Categories',
            'Create Product Category',
            'Edit Product Category',
            'Delete Product Category',
            //accounting product permisssion
            'Manage Products',
            'Create Product',
            'Edit Product',
            'Delete Product',
            //accounting tax permission
            'Manage Taxs',
            'Create Tax',
            'Edit Tax',
            'Delete Tax',
            //accounting transaction report permission
            'View Accounting Transaction Report',
            //accounting account statement report permission
            'View Accounting Account Statement Report',
            //accounting income report permission
            'View Accounting Income Report',
            //accounting expense report permission
            'View Accounting Expense Report',
            //accounting income vs expense report permission
            'View Accounting IncomeVSExpense Report',
            //accounting tax report permission
            'View Accounting Tax Report',
            //accounting profit and loss report permission
            'View Accounting ProfitLoss Report',
            //accounting invoice report permission
            'View Accounting Invoice Report',
            //accounting bill report permission
            'View Accounting Bill Report',
            // Language
            'Manage Languages',
            'Create Language',
            'Edit Language',
            'Delete Language',
            //system settting permission
            'Manage System Settings',
            'Manage Stripe Settings',
            //projects permission
            'Manage Projects',
            'Create Project',
            'Edit Project',
            'Delete Project',
            'View Project',
            //milestone permission
            "Create Milestone",
            "Edit Milestone",
            "Delete Milestone",
            'View Milestone',
            //task permission
            'Manage Tasks',
            "Create Task",
            "Edit Task",
            "Delete Task",
            "View Task",
            "Move Task",
            //timesheet permission
            'Manage Timesheets',
            "Create Timesheet",
            'Edit Timesheet',
            'View Timesheet',
            //grant chart permission
            'View Grant Chart',
            //expense permission
            'Manage Expenses',
            "Create Expense",
            'Edit Expense',
            "View Expense",
            'Delete Expense',
            //activity permission
            "View Activity",
            //task stage permission
            'Manage Task Stages',
            'Create Task Stage',
            'Delete Task Stage'
        ];

        // Create Permissions
        foreach($arrPermissions as $ap)
        {
            Permission::create(['name' => $ap]);
        }
        // Create Admin Role
        $adminRole = Role::create(
            [
                'name' => 'Admin',
                'created_by' => 0,
            ]
        );

        // Assign Permission to Admin Role
        foreach($arrPermissions as $ap)
        {
            $permission = Permission::findByName($ap);
            $adminRole->givePermissionTo($permission);
        }
        
        // Create Admin User
        $admin = User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('1234'),
                'type' => 'Admin',
            ]
        );
        $admindetail = UserDetail::create(
            [
                'user_id' => $admin->id,
                'image' => 'avatar.png'
            ]
        );

        // Assign admin role to admin user
        $admin->assignRole($adminRole);
        //Utility::chartOfAccountTypeData($admin);
        //Utility::chartOfAccountData($admin);
        Utility::default_data($admin);


        // Create Employee Role
        $empRole = Role::create(
            [
                'name' => 'Employee',
                'created_by' => $admin->id,
            ]
        );

        $empPermissions = [
            //CRM contact permission
            'Manage Contacts',
            'Create Contact',
            'View Contact',
            'Edit Contact',
            'Delete Contact',
            //CRM company permssion
            'Manage Companies',
            'Create Company',
            'View Company',
            'Edit Company',
            'Delete Company',
        ];

         // Assign Permission to Employee Role
         foreach($empPermissions as $ap)
         {
             $permission = Permission::findByName($ap);
             $empRole->givePermissionTo($permission);
         }

         // Create Employee User
        $emp = User::create(
            [
                'name' => 'Employee',
                'email' => 'employee@example.com',
                'password' => Hash::make('1234'),
                'type' => 'User',
            ]
        );
        $empdetail = UserDetail::create(
            [
                'user_id' => $emp->id,
                'image' => 'avatar.png'
            ]
        );

        // Assign Employee role to Employee user
        $emp->assignRole($empRole);
    }
}
