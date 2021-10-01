<?php

namespace App\Http\Controllers;

use App\Taxrate;
use App\Utility;
use App\ProductCategory;
use App\ProductAndService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductAndServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(\Auth::user()->can('Manage Products'))
        {
            $productandservices = ProductAndService::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('accounting.products.product_and_service.index',compact('productandservices'));
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
        if(\Auth::user()->can('Create Product'))
        {
            $categoryids = ProductCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type',0)->get()->pluck("name","id");
            $categoryids->prepend(__('Please Select'),0);
            $taxids = Taxrate::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck("name","id");
            $taxids->prepend(__('Please Select'),0);
            return view('accounting.products.product_and_service.create',compact('categoryids','taxids'));
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
        if(\Auth::user()->can('Create Product'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'product_name' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $productandservice = new ProductAndService();
            $productandservice->product_name = $request->product_name;
            $productandservice->product_type = $request->product_type;
            $productandservice->category = $request->category;
            $productandservice->cost_price = $request->cost_price;
            $productandservice->sale_price = $request->sale_price;
            $productandservice->tax_rate_id = isset($request->tax) ? implode(',', $request->tax) : 0;
            $productandservice->created_by =  \Auth::user()->creatorId();
            $productandservice->save();
            return redirect()->route('product_and_services.index')->with('success', __('Product Service Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductAndService  $productAndService
     * @return \Illuminate\Http\Response
     */
    public function show(ProductAndService $productAndService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductAndService  $productAndService
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductAndService $productAndService)
    {
        if(\Auth::user()->can('Edit Product'))
        {
            if($productAndService->created_by ==  \Auth::user()->creatorId())
            {
                $categoryids = ProductCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type',0)->get()->pluck("name","id");
                $categoryids->prepend(__('Please Select'),0);
                $taxids = Taxrate::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck("name","id");
                $taxids->prepend(__('Please Select'),0);
                return view('accounting.products.product_and_service.edit',compact('categoryids','productAndService','taxids'));
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
     * @param  \App\ProductAndService  $productAndService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductAndService $productAndService)
    {
        if(\Auth::user()->can('Edit Product'))
        {
            if($productAndService->created_by ==  \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'product_name' => 'required',
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $productandservice = ProductAndService::find($productAndService->id);
                $productandservice->product_name = $request->product_name;
                $productandservice->product_type = $request->product_type;
                $productandservice->category = $request->category;
                $productandservice->cost_price = $request->cost_price;
                $productandservice->sale_price = $request->sale_price;
                $productandservice->tax_rate_id = isset($request->tax) ? implode(',', $request->tax) : 0;
                $productandservice->save();
                return redirect()->route('product_and_services.index')->with('success', __('Product Service Updated Successfully!'));
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
     * @param  \App\ProductAndService  $productAndService
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAndService $productAndService)
    {
        if(\Auth::user()->can('Delete Product'))
        {
            if($productAndService->created_by ==  \Auth::user()->creatorId())
            {
                $productAndService->delete();
                return redirect()->route('product_and_services.index')->with('success', __('Product Service Successfully Deleted.'));
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
