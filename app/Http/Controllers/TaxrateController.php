<?php

namespace App\Http\Controllers;

use App\Taxrate;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaxrateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Taxs'))
        {
            $taxrates = Taxrate::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('accounting.tax.taxrate.index',compact('taxrates'));
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
        if(\Auth::user()->can('Create Tax'))
        {
            return view('accounting.tax.taxrate.create');
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
        if(\Auth::user()->can('Create Tax'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'tax_rate' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $taxrate = new Taxrate();
            $taxrate->name = $request->name;
            $taxrate->tax_rate = $request->tax_rate;
            $taxrate->created_by = \Auth::user()->creatorId();
            $taxrate->save();
            return redirect()->route('taxrates.index')->with('success', __('Tax Rate Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taxrate  $taxrate
     * @return \Illuminate\Http\Response
     */
    public function show(Taxrate $taxrate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taxrate  $taxrate
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxrate $taxrate)
    {
        if(\Auth::user()->can('Edit Tax'))
        {
            if($taxrate->created_by == \Auth::user()->creatorId())
            {
                return view('accounting.tax.taxrate.edit',compact('taxrate'));
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
     * @param  \App\Taxrate  $taxrate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taxrate $taxrate)
    {
        if(\Auth::user()->can('Edit Tax'))
        {
            if($taxrate->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'name' => 'required',
                                    'tax_rate' => 'required',
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $taxrate = Taxrate::find($taxrate->id);
                $taxrate->name = $request->name;
                $taxrate->tax_rate = $request->tax_rate;
                $taxrate->save();
                return redirect()->route('taxrates.index')->with('success', __('Tax Rate Update Successfully!'));
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
     * @param  \App\Taxrate  $taxrate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taxrate $taxrate)
    {
        if(\Auth::user()->can('Delete Tax'))
        {
            if($taxrate->created_by == \Auth::user()->creatorId())
            {
                $taxrate->delete();
                return redirect()->back()->with('success', __('Tax Rate Deleted Successfully.'));
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
