<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\Utility;
use App\VendorDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Vendors'))
        {
            $vendors = Vendor::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('accounting.users.vendor.index',compact('vendors'));
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
        if(\Auth::user()->can('Create Vendor'))
        {
            return view('accounting.users.vendor.create');
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
        if(\Auth::user()->can('Create Vendor'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'first_name' => 'required',
                                   'last_name' => 'required',
                                   'email' => 'required|unique:vendors',
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
            $vendor = new Vendor();
            $vendor->vendor_id        = $this->vendorNumber();
            $vendor->first_name = $request->first_name;
            $vendor->last_name = $request->last_name;
            $vendor->email = $request->email;
            $vendor->created_by = \Auth::user()->creatorId();
            $vendor->save();
    
            $vendordetail = new VendorDetail();
            $vendordetail->vendor_id = $vendor->id;
            $vendordetail->phone_no = $request->phone_no; 
            $vendordetail->company =  $request->company; 
            $vendordetail->mobile_no = $request->mobile;
            $vendordetail->website = $request->website; 
            $vendordetail->notes = $request->notes;
            $vendordetail->fax_no = $request->fax_number;     
            $vendordetail->address1 = $request->address1; 
            $vendordetail->address2 = $request->address2;  
            $vendordetail->city = $request->city;
            $vendordetail->country = $request->country;  
            $vendordetail->state = $request->province_state; 
            $vendordetail->post_code = $request->post_code; 
            $vendordetail->save();
    
            return redirect()->route('vendors.index')->with('success', __('Vendor Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        if(\Auth::user()->can('View Vendor'))
        {
            return view('accounting.users.vendor.view',compact('vendor'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        if(\Auth::user()->can('Edit Vendor'))
        {
            if($vendor->created_by==\Auth::user()->creatorId())
            {
                return view('accounting.users.vendor.edit',compact('vendor'));
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
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        if(\Auth::user()->can('Edit Vendor'))
        {
            if($vendor->created_by==\Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'first_name' => 'required',
                                    'last_name' => 'required',
                                    'email' => 'required|unique:vendors,email,'.$vendor->id.'',
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
                $vendor = Vendor::find($vendor->id);
                $vendor->first_name = $request->first_name;
                $vendor->last_name = $request->last_name;
                $vendor->email = $request->email;
                $vendor->save();

                $vendordetail = VendorDetail::where('vendor_id',$vendor->id)->first();
                $vendordetail->vendor_id = $vendor->id;
                $vendordetail->phone_no = $request->phone_no; 
                $vendordetail->company = $request->company; 
                $vendordetail->mobile_no = $request->mobile;
                $vendordetail->website = $request->website; 
                $vendordetail->notes = $request->notes;
                $vendordetail->fax_no = $request->fax_number;     
                $vendordetail->address1 = $request->address1; 
                $vendordetail->address2 = $request->address2;  
                $vendordetail->city = $request->city;
                $vendordetail->country = $request->country;  
                $vendordetail->state = $request->province_state; 
                $vendordetail->post_code = $request->post_code; 
                $vendordetail->save();
                return redirect()->route('vendors.index')->with('success', __('Vendor Successfully Updated.'));
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
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        if(\Auth::user()->can('Delete Vendor'))
        {
            if($vendor->created_by==\Auth::user()->creatorId())
            {
                $vendor->delete();
                return redirect()->route('vendors.index')->with('success', __('Vendor Successfully Deleted.'));
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
        $vendordetail = VendorDetail::where('vendor_id',$request->id)->first();
        if($request->hasFile('image'))
        {
            Utility::checkFileExistsnDelete([$vendordetail->image]);
            $imageName = time() . '.' . $request->image->extension();
            $vendordetail->image      = $request->file('image')->storeAs('vendor', $imageName);
        }
        $vendordetail->save();
        return redirect()->back()->with('success', __('Image Successfully Updated.'));
    }

    function vendorNumber()
    {
        $latest = Vendor::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->vendor_id + 1;
    }
}
