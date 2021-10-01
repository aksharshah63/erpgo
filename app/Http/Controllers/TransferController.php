<?php

namespace App\Http\Controllers;

use App\Utility;
use App\Transfer;
use App\BankAccount;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Bank Transfers'))
        {
            $transfers = Transfer::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('accounting.bank_transfer.index',compact('transfers'));
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
        if(\Auth::user()->can('Create Bank Transfer'))
        {
            $bankAccount = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $bankAccount->prepend(__('Please Select'),0);
            return view('accounting.bank_transfer.create',compact('bankAccount'));
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
        if(\Auth::user()->can('Create Bank Transfer'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                    'from_account' => 'required|numeric',
                                    'to_account' => 'required|numeric',
                                    'amount' => 'required|numeric',
                                    'date' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $transfer                 = new Transfer();
            $transfer->from_account   = $request->from_account;
            $transfer->to_account     = $request->to_account;
            $transfer->amount         = $request->amount;
            $transfer->date           = date("Y-m-d H:i:s", strtotime($request->date));
            $transfer->payment_method = 0;
            $transfer->reference      = $request->reference;
            $transfer->description    = $request->description;
            $transfer->created_by     = \Auth::user()->creatorId();
            $transfer->save();

            Utility::bankAccountBalance($request->from_account, $request->amount, 'debit');

            Utility::bankAccountBalance($request->to_account, $request->amount, 'credit');

            return redirect()->route('transfers.index')->with('success', __('Amount Successfully Transfer.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        if(\Auth::user()->can('Edit Bank Transfer'))
        {
            $bankAccount = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $bankAccount->prepend(__('Please Select'),0);
            return view('accounting.bank_transfer.edit',compact('bankAccount','transfer'));
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
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {
        if(\Auth::user()->can('Edit Bank Transfer'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                    'from_account' => 'required|numeric',
                                    'to_account' => 'required|numeric',
                                    'amount' => 'required|numeric',
                                    'date' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            // Utility::bankAccountBalance($transfer->from_account, $transfer->amount, 'credit');
            // Utility::bankAccountBalance($transfer->to_account, $transfer->amount, 'debit');

            $transfer->from_account   = $request->from_account;
            $transfer->to_account     = $request->to_account;
            $transfer->amount         = $request->amount;
            $transfer->date           = date("Y-m-d H:i:s", strtotime($request->date));
            $transfer->payment_method = 0;
            $transfer->reference      = $request->reference;
            $transfer->description    = $request->description;
            $transfer->save();

            Utility::bankAccountBalance($request->from_account, $request->amount, 'debit');

            Utility::bankAccountBalance($request->to_account, $request->amount, 'credit');

            return redirect()->route('transfers.index')->with('success', __('Amount Successfully Transfer Updated.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        if(\Auth::user()->can('Delete Bank Transfer'))
        {
            if($transfer->created_by == \Auth::user()->creatorId())
            {
                $transfer->delete();

                Utility::bankAccountBalance($transfer->from_account, $transfer->amount, 'credit');
                Utility::bankAccountBalance($transfer->to_account, $transfer->amount, 'debit');

                return redirect()->route('transfers.index')->with('success', __('Amount Transfer Successfully Deleted.'));
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
}
