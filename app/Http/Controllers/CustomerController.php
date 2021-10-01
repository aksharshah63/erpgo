<?php

namespace App\Http\Controllers;

use App\Utility;
use App\Customer;
use App\CustomerDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Customers'))
        {
            $customers = Customer::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('accounting.users.customer.index',compact('customers'));
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
        if(\Auth::user()->can('Create Customer'))
        {
            return view('accounting.users.customer.create');
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
        if(\Auth::user()->can('Create Customer'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'first_name' => 'required',
                                   'last_name' => 'required',
                                   'email' => 'required|unique:customers',
                                   'address1' => 'required',
                                   'city' => 'required',
                                   'country' => 'required',
                                   'province_state' => 'required',
                                   'post_code' => 'required'
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
    
            $id = Auth::id();
            $customer = new Customer();
            $customer->customer_id     = $this->customerNumber();
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->email = $request->email;
            $customer->created_by =\Auth::user()->creatorId();
            $customer->save();
    
            $customerdetail = new CustomerDetail();
            $customerdetail->customer_id = $customer->id;
            $customerdetail->phone_no = $request->phone_no; 
            $customerdetail->company =  $request->company; 
            $customerdetail->mobile_no = $request->mobile;
            $customerdetail->website = $request->website; 
            $customerdetail->notes = $request->notes;
            $customerdetail->fax_no = $request->fax_number;     
            $customerdetail->address1 = $request->address1; 
            $customerdetail->address2 = $request->address2;  
            $customerdetail->city = $request->city;
            $customerdetail->country = $request->country;  
            $customerdetail->state = $request->province_state; 
            $customerdetail->post_code = $request->post_code; 
            $customerdetail->save();
    
            return redirect()->route('customers.index')->with('success', __('Customer Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        if(\Auth::user()->can('View Customer'))
        {
            return view('accounting.users.customer.view',compact('customer'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        if(\Auth::user()->can('Edit Customer'))
        {
            if($customer->created_by==\Auth::user()->creatorId())
            {
                return view('accounting.users.customer.edit',compact('customer'));
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
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        if(\Auth::user()->can('Edit Customer'))
        {
            if($customer->created_by==\Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'first_name' => 'required',
                                    'last_name' => 'required',
                                    'email' => 'required|unique:customers,email,'.$customer->id.'',
                                    'address1' => 'required',
                                    'city' => 'required',
                                    'country' => 'required',
                                    'province_state' => 'required',
                                    'post_code' => 'required'
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $customer = Customer::find($customer->id);
                $customer->first_name = $request->first_name;
                $customer->last_name = $request->last_name;
                $customer->email = $request->email;
                $customer->save();

                $customerdetail = CustomerDetail::where('customer_id',$customer->id)->first();
                $customerdetail->customer_id = $customer->id;
                $customerdetail->phone_no = $request->phone_no; 
                $customerdetail->company = $request->company; 
                $customerdetail->mobile_no = $request->mobile;
                $customerdetail->website = $request->website; 
                $customerdetail->notes = $request->notes;
                $customerdetail->fax_no = $request->fax_number;     
                $customerdetail->address1 = $request->address1; 
                $customerdetail->address2 = $request->address2;  
                $customerdetail->city = $request->city;
                $customerdetail->country = $request->country;  
                $customerdetail->state = $request->province_state; 
                $customerdetail->post_code = $request->post_code; 
                $customerdetail->save();
                return redirect()->route('customers.index')->with('success', __('Customer Successfully Updated.'));
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
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        if(\Auth::user()->can('Delete Customer'))
        {
            if($customer->created_by==\Auth::user()->creatorId())
            {
                $customer->delete();
                return redirect()->route('customers.index')->with('success', __('Customer Successfully Deleted.'));
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

    public function updateProfile(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), [
                                'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
                            ]
        );
        if($validator->fails())
        {
            return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
        }
        $customerdetail = CustomerDetail::where('customer_id',$request->id)->first();
        if($request->hasFile('image'))
        {
            Utility::checkFileExistsnDelete([$customerdetail->image]);
            $imageName = time() . '.' . $request->image->extension();
            $customerdetail->image      = $request->file('image')->storeAs('customer', $imageName);
        }
        $customerdetail->save();
        return redirect()->back()->with('success', __('Image Successfully Updated.'));
    }

    function customerNumber()
    {
        $latest = Customer::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->customer_id + 1;
    }
}
