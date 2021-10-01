<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\Payment;
use App\Utility;
use App\BankAccount;
use App\BillPayment;
use App\Transaction;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Bill Payments'))
        {
            $payments = Payment::where('created_by', \Auth::user()->creatorId())->get();
            return view('accounting.transaction.expense.payment.index',compact('payments'));
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
        if(\Auth::user()->can('Create Bill Payment'))
        {
            $vendors = Vendor::where('created_by', \Auth::user()->creatorId())->get();

            $vendors = $vendors->map(function($vendor) {
                $vendor['full_name'] = $vendor['first_name'] . ' ' .$vendor['last_name'];
                return $vendor;
            })->pluck('full_name','id');
            $vendors->prepend(__('Please Select'),0);
            $categories = ProductCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 2)->get()->pluck('name', 'id');
            $accounts   = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            return view('accounting.transaction.expense.payment.create',compact('vendors','categories','accounts'));
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
        if(\Auth::user()->can('Create Bill Payment'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'date' => 'required',
                                   'amount' => 'required',
                                   'account_id' => 'required',
                                   'category_id' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }

            $payment                 = new Payment();
            $payment->date           = date("Y-m-d H:i:s", strtotime($request->date));
            $payment->amount         = $request->amount;
            $payment->account_id     = $request->account_id;
            $payment->vendor_id      = $request->vendor_id;
            $payment->category_id    = $request->category_id;
            $payment->payment_method = 0;
            $payment->reference      = $request->reference;
            $payment->description    = $request->description;
            $payment->created_by     = \Auth::user()->creatorId();
            $payment->save();

            $category            = ProductCategory::where('id', $request->category_id)->first();
            $payment->payment_id = $payment->id;
            $payment->type       = 'Payment';
            $payment->category   = $category->name;
            $payment->user_id    = $payment->vendor_id;
            $payment->user_type  = 'Vendor';
            $payment->account    = $request->account_id;

            Transaction::addTransaction($payment);

            $vendor          = Vendor::where('id', $request->vendor_id)->first();
            // $payment         = new BillPayment();
            // $payment->name   = $vendor['name'];
            // $payment->method = '-';
            // $payment->date   = Utility::getDateFormated($request->date);
            // $payment->amount = \Auth::user()->priceFormat($request->amount);
            // $payment->bill   = '';

            if(!empty($request->vendor_id))
            {
                Utility::userBalance('vendor', $vendor->id, $request->amount, 'debit');
            }

            Utility::bankAccountBalance($request->account_id, $request->amount, 'debit');

            return redirect()->route('payments.index')->with('success', __('Payment Successfully Created.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        if(\Auth::user()->can('Edit Bill Payment'))
        {
            if($payment->created_by== \Auth::user()->creatorId())
            {
                $vendors = Vendor::where('created_by', \Auth::user()->creatorId())->get();

                $vendors = $vendors->map(function($vendor) {
                    $vendor['full_name'] = $vendor['first_name'] . ' ' .$vendor['last_name'];
                    return $vendor;
                })->pluck('full_name','id');
                $categories = ProductCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 2)->get()->pluck('name', 'id');
                $accounts   = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                return view('accounting.transaction.expense.payment.edit',compact('vendors','categories','accounts','payment'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        if(\Auth::user()->can('Edit Bill Payment'))
        {
            if($payment->created_by== \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'date' => 'required',
                                    'amount' => 'required',
                                    'account_id' => 'required',
                                    'category_id' => 'required',
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $vendor = Vendor::where('id', $request->vendor_id)->first();
                if(!empty($vendor))
                {
                    Utility::userBalance('vendor', $vendor->id, $payment->amount, 'credit');
                }
                Utility::bankAccountBalance($request->account_id, $payment->amount, 'credit');

                $payment                 = Payment::find($payment->id);
                $payment->date           = date("Y-m-d H:i:s", strtotime($request->date));
                $payment->amount         = $request->amount;
                $payment->account_id     = $request->account_id;
                $payment->vendor_id      = $request->vendor_id;
                $payment->category_id    = $request->category_id;
                $payment->payment_method = 0;
                $payment->reference      = $request->reference;
                $payment->description    = $request->description;
                $payment->save();

                $category            = ProductCategory::where('id', $request->category_id)->first();
                $payment->payment_id = $payment->id;
                $payment->type       = 'Payment';
                $payment->category   = $category->name;
                $payment->user_id    = $payment->vendor_id;
                $payment->user_type  = 'Vendor';
                $payment->account    = $request->account_id;

                Transaction::editTransaction($payment);

                //$vendor          = Vendor::where('id', $request->vendor_id)->first();
                // $payment         = new BillPayment();
                // $payment->name   = $vendor['name'];
                // $payment->method = '-';
                // $payment->date   = Utility::getDateFormated($request->date);
                // $payment->amount = \Auth::user()->priceFormat($request->amount);
                // $payment->bill   = '';

                if(!empty($vendor))
                {
                    Utility::userBalance('vendor', $vendor->id, $request->amount, 'debit');
                }

                Utility::bankAccountBalance($request->account_id, $request->amount, 'debit');

                return redirect()->route('payments.index')->with('success', __('Payment successfully Updated.'));
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
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        if(\Auth::user()->can('Delete Bill Payment'))
        {
            if($payment->created_by == \Auth::user()->creatorId())
            {
                $payment->delete();
                $type = 'Payment';
                $user = 'Vendor';
                Transaction::destroyTransaction($payment->id, $type, $user);

                if($payment->vendor_id != 0)
                {
                    Utility::userBalance('vendor', $payment->vendor_id, $payment->amount, 'credit');
                }
                Utility::bankAccountBalance($payment->account_id, $payment->amount, 'credit');

                return redirect()->route('payments.index')->with('success', __('Payment Successfully Deleted.'));
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
