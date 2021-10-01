<?php

namespace App\Http\Controllers;

use App\Utility;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Product Categories'))
        {
            $productcategories = ProductCategory::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('accounting.products.product_categories.index',compact('productcategories'));
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
        if(\Auth::user()->can('Create Product Category'))
        {
            return view('accounting.products.product_categories.create');
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
        if(\Auth::user()->can('Create Product Category'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'category_name' => 'required',
                                   'type' =>'required',
                                   'color'=>'required'
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $productcategory = new ProductCategory();
            $productcategory->name = $request->category_name;
            $productcategory->type = $request->type;
            $productcategory->color = $request->color;
            $productcategory->created_by = \Auth::user()->creatorId();
            $productcategory->save();
            return redirect()->route('product_categories.index')->with('success', __('Product Category Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        if(\Auth::user()->can('Edit Product Category'))
        {
            if($productCategory->created_by == \Auth::user()->creatorId())
            {
                return view('accounting.products.product_categories.edit',compact('productCategory'));
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
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        if(\Auth::user()->can('Edit Product Category'))
        {
            if($productCategory->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'category_name' => 'required',
                                    'type' =>'required',
                                    'color'=>'required'
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $productcategory = ProductCategory::find($productCategory->id);
                $productcategory->name = $request->category_name;
                $productcategory->type = $request->type;
                $productcategory->color = $request->color;
                $productcategory->save();
                return redirect()->route('product_categories.index')->with('success', __('Product Category Update Successfully!'));
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
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        if(\Auth::user()->can('Delete Product Category'))
        {
            if($productCategory->created_by == \Auth::user()->creatorId())
            {
                $productCategory->delete();
                return redirect()->route('product_categories.index')->with('success', __('Product Category Successfully Deleted.'));
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
