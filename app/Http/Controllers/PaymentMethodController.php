<?php

namespace App\Http\Controllers;

use App\Utility;
use App\PaymenMethod;
use App\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('accounting.payment_method.index');
        } catch (\Exception $e) {
            return response()->json(['errors' => __('Permission Denied')],401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('accounting.payment_method.create');
        } catch (\Exception $e) {
            return response()->json(['errors' => __('Permission Denied')],401);
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
        try {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $paymentmethod = new PaymentMethod();
            $paymentmethod->name = $request->name;
            $paymentmethod->created_by = Auth::user()->id;
            $paymentmethod->save();
            return redirect()->route('payment_methods.index')->with('success', __('Payment Method Add Successfully!'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', __('Permission Denied.'),401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymenMethod  $paymenMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymenMethod  $paymenMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        try {
            return view('accounting.payment_method.edit',compact('paymentMethod'));
        } catch (\Exception $e) {
            return response()->json(['errors' => __('Permission Denied')],401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymenMethod  $paymenMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        try {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $paymentmethod = PaymentMethod::find($paymentMethod->id);
            $paymentmethod->name = $request->name;
            $paymentmethod->save();
            return redirect()->route('payment_methods.index')->with('success', __('Payment Method Updated Successfully!'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', __('Permission Denied.'),401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymenMethod  $paymenMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        try {
            $paymentMethod->delete();
            return redirect()->back()->with('success', __('Payment Method Deleted Successfully.'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', __('Permission Denied.'),401);
        }
    }
}
