<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Invoice;
use App\Payment;
use App\BankAccount;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountingDashboardController extends Controller
{
    public function dashboard()
    {
        $customers = Auth::user()->customers->where('created_by',\Auth::user()->creatorId())->count();
        $vendors = Auth::user()->vendors->where('created_by',\Auth::user()->creatorId())->count();
        $invoices = Invoice::where('created_by',\Auth::user()->creatorId())->count();
        $bills = Bill::where('created_by',\Auth::user()->creatorId())->count();
        $bankaccounts = BankAccount::where('created_by', '=', \Auth::user()->creatorId())->get();

        $incomeCategory = ProductCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 1)->get();
        $inColor        = array();
        $inCategory     = array();
        $inAmount       = array();
        for($i = 0; $i < count($incomeCategory); $i++)
        {
            $inColor[]    = $incomeCategory[$i]->color;
            $inCategory[] = $incomeCategory[$i]->name;
            $inAmount[]   = $incomeCategory[$i]->incomeCategoryAmount();
        }


        $data['incomeCategoryColor'] = $inColor;
        $data['incomeCategory']      = $inCategory;
        $data['incomeCatAmount']     = $inAmount;

        $expenseCategory = ProductCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 2)->get();
        $exColor         = array();
        $exCategory      = array();
        $exAmount        = array();
        for($i = 0; $i < count($expenseCategory); $i++)
        {
            $exColor[]    = $expenseCategory[$i]->color;
            $exCategory[] = $expenseCategory[$i]->name;
            $exAmount[]   = $expenseCategory[$i]->expenseCategoryAmount();
        }

        $data['expenseCategoryColor'] = $exColor;
        $data['expenseCategory']      = $exCategory;
        $data['expenseCatAmount']     = $exAmount;

        $data['incExpLineChartData'] = \Auth::user()->getIncExpLineChartDate();
        $data['incExpBarChartData']  = \Auth::user()->getincExpBarChartData();

        $data['currentYear']  = date('Y');

        $data['latestIncome']  = Invoice::where('created_by', '=', \Auth::user()->creatorId())->orderBy('id', 'desc')->limit(5)->get();
        $data['latestExpense'] = Payment::where('created_by', '=', \Auth::user()->creatorId())->orderBy('id', 'desc')->limit(5)->get();

        $data['weeklyInvoice']     = \Auth::user()->weeklyInvoice();
        $data['monthlyInvoice']    = \Auth::user()->monthlyInvoice();
        $data['recentInvoice']     = Invoice::where('created_by', '=', \Auth::user()->creatorId())->orderBy('id', 'desc')->limit(5)->get();

        $data['recentBill']        = Bill::where('created_by', '=', \Auth::user()->creatorId())->orderBy('id', 'desc')->limit(5)->get();
        $data['weeklyBill']        = \Auth::user()->weeklyBill();
        $data['monthlyBill']       = \Auth::user()->monthlyBill();
        return view('accounting.dashboard',compact('customers','vendors','invoices','bills','bankaccounts','data'));
    }
}
