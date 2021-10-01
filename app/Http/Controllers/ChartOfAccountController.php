<?php

namespace App\Http\Controllers;

use App\Utility;
use App\ChartOfAccount;
use App\ChartOfAccountType;
use Illuminate\Http\Request;
use App\ChartOfAccountSubType;

class ChartOfAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Chart of Accounts'))
        {
            $types = ChartOfAccountType::get();

            $chartAccounts = [];
            foreach($types as $type)
            {
                $accounts = ChartOfAccount::where('type', $type->id)->where('created_by', '=',  \Auth::user()->creatorId())->get();

                $chartAccounts[$type->name] = $accounts;

            }

            return view('accounting.chart_of_account.index', compact('chartAccounts', 'types'));
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
        if(\Auth::user()->can('Create Chart of Account'))
        {
            $types = ChartOfAccountType::get()->pluck('name', 'id');
            $types->prepend('--', 0);

            return view('accounting.chart_of_account.create', compact('types'));
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
        if(\Auth::user()->can('Create Chart of Account'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'type' => 'required',
                                   'code' => 'required'
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $account              = new ChartOfAccount();
            $account->name        = $request->name;
            $account->code        = $request->code;
            $account->type        = $request->type;
            $account->sub_type    = $request->sub_type;
            $account->description = $request->description;
            $account->is_enabled  = isset($request->is_enabled) ? 1 : 0;
            $account->created_by  = \Auth::user()->creatorId();
            $account->save();
            return redirect()->route('chart_of_accounts.index')->with('success', __('Chart Of Account Add Successfully!'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChartOfAccount  $chartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function show(ChartOfAccount $chartOfAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChartOfAccount  $chartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(ChartOfAccount $chartOfAccount)
    {
        if(\Auth::user()->can('Edit Chart of Account'))
        {
            if($chartOfAccount->created_by==\Auth::user()->creatorId())
            {
                $types = ChartOfAccountType::get()->pluck('name', 'id');
                $types->prepend('--', 0);

                return view('accounting.chart_of_account.edit', compact('types','chartOfAccount'));
            }
            else
            {
                return response()->json(['errors' => __('Permission denied.')], 401);
            } 
        }
        else
        {
            return response()->json(['errors' => __('Permission denied.')], 401);
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChartOfAccount  $chartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChartOfAccount $chartOfAccount)
    {
        if(\Auth::user()->can('Edit Chart of Account'))
        {
            if($chartOfAccount->created_by==\Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'name' => 'required',
                                    'code' => 'required'
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $chartOfAccount->name        = $request->name;
                $chartOfAccount->code        = $request->code;
                $chartOfAccount->description = $request->description;
                $chartOfAccount->is_enabled  = isset($request->is_enabled) ? 1 : 0;
                $chartOfAccount->save();
                return redirect()->route('chart_of_accounts.index')->with('success', __('Chart Of Account Update Successfully!'));
            }
            else
            {
                return response()->json(['errors' => __('Permission denied.')], 401);
            }     
        }
        else
        {
            return response()->json(['errors' => __('Permission denied.')], 401);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChartOfAccount  $chartOfAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChartOfAccount $chartOfAccount)
    {
        if(\Auth::user()->can('Delete Chart of Account'))
        {
            if($chartOfAccount->created_by==\Auth::user()->creatorId())
            {
                $chartOfAccount->delete();

                return redirect()->route('chart_of_accounts.index')->with('success', __('Chart Of Account Delete Successfully!'));
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

    public function getSubType(Request $request)
    {
        $types = ChartOfAccountSubType::where('type', $request->type)->get()->pluck('name', 'id')->toArray();

        return response()->json($types);
    }
}
