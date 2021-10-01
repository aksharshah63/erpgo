<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Utility;
use App\BankAccount;
use App\BillPayment;
use App\Transaction;
use App\InvoicePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Bank Accounts'))
        {
            $bankaccounts = BankAccount::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('accounting.bank_account.index',compact('bankaccounts'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('Create Bank Account'))
        {
            return view('accounting.bank_account.create');
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Bank Account'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                    'holder_name' => 'required',
                                    'bank_name' => 'required',
                                    'account_number' => 'required',
                                    'opening_balance' => 'required',
                                    'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                                ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $account                  = new BankAccount();
            $account->holder_name     = $request->holder_name;
            $account->bank_name       = $request->bank_name;
            $account->account_number  = $request->account_number;
            $account->opening_balance = $request->opening_balance;
            $account->contact_number  = $request->contact_number;
            $account->bank_address    = $request->bank_address;
            $account->created_by      =\Auth::user()->creatorId();
            $account->save();
            return redirect()->route('bank_accounts.index')->with('success', __('Bank Account Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bankAccount)
    {
        if(\Auth::user()->can('Edit Bank Account'))
        {
            if($bankAccount->created_by == \Auth::user()->creatorId())
            {
                return view('accounting.bank_account.edit',compact('bankAccount'));
            }
            else
            {
                return response()->json(['errors' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAccount $bankAccount)
    {
        if(\Auth::user()->can('Edit Bank Account'))
        {
            if($bankAccount->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                        'holder_name' => 'required',
                                        'bank_name' => 'required',
                                        'account_number' => 'required',
                                        'opening_balance' => 'required',
                                        'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $account                  = BankAccount::find($bankAccount->id);
                $account->holder_name     = $request->holder_name;
                $account->bank_name       = $request->bank_name;
                $account->account_number  = $request->account_number;
                $account->opening_balance = $request->opening_balance;
                $account->contact_number  = $request->contact_number;
                $account->bank_address    = $request->bank_address;
                $account->save();
                return redirect()->route('bank_accounts.index')->with('success', __('Bank Account Updated Successfully!'));
            }
            else
            {
                return redirect()->back()->with('errors', __('Permission denied.'));
            }    
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bankAccount)
    {
        if(\Auth::user()->can('Delete Bank Account'))
        {
            if($bankAccount->created_by ==  \Auth::user()->creatorId())
            {
                $invoicePayment = InvoicePayment::where('account_id', $bankAccount->id)->first();
                $transaction    = Transaction::where('account', $bankAccount->id)->first();
                $payment        = Payment::where('account_id', $bankAccount->id)->first();
                $billPayment    = BillPayment::first();
                if(!empty($invoicePayment) && !empty($transaction) && !empty($payment) && !empty($billPayment))
                {
                    return redirect()->route('bank_accounts.index')->with('error', __('Please Delete Related Record Of This Account.'));
                }
                else
                {
                    $bankAccount->delete();

                    return redirect()->route('bank_accounts.index')->with('success', __('Bank Account Successfully Deleted.'));
                }
            }
            else
            {
                return redirect()->back()->with('errors', __('Permission Denied.'),401);
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }
}
