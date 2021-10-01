<?php

namespace App\Http\Controllers;

use App\Utility;
use App\JournalItem;
use App\JournalEntry;
use App\ChartOfAccount;
use Illuminate\Http\Request;

class JournalEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Journals'))
        {
            $journalEntries = JournalEntry::where('created_by', '=', \Auth::user()->creatorId())->get();
            return view('accounting.transaction.journal.index', compact('journalEntries'));
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
        if(\Auth::user()->can('Create Journal'))
        {
            $accounts = ChartOfAccount::select(\DB::raw('CONCAT(code, " - ", name) AS code_name, id'))->where('created_by', \Auth::user()->creatorId())->get()->pluck('code_name', 'id');
            $accounts->prepend('--', '');

            $journalId = $this->journalNumber();

            return view('accounting.transaction.journal.create', compact('accounts', 'journalId'));
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
        if(\Auth::user()->can('Create Journal'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'date' => 'required',
                                   'accounts' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }

            $accounts = $request->accounts;

            $totalDebit  = 0;
            $totalCredit = 0;
            for($i = 0; $i < count($accounts); $i++)
            {
                $debit       = isset($accounts[$i]['debit']) ? $accounts[$i]['debit'] : 0;
                $credit      = isset($accounts[$i]['credit']) ? $accounts[$i]['credit'] : 0;
                $totalDebit  += $debit;
                $totalCredit += $credit;
            }

            if($totalCredit != $totalDebit)
            {
                return redirect()->back()->with('errors', __('Debit And Credit Must Be Equal.'));
            }

            $journal              = new JournalEntry();
            $journal->journal_id  = $this->journalNumber();
            $journal->date        = date("Y-m-d H:i:s", strtotime($request->date));
            $journal->reference   = $request->reference;
            $journal->description = $request->description;
            $journal->created_by  = \Auth::user()->creatorId();
            $journal->save();


            for($i = 0; $i < count($accounts); $i++)
            {
                $journalItem              = new JournalItem();
                $journalItem->journal     = $journal->id;
                $journalItem->account     = $accounts[$i]['account'];
                $journalItem->description = $accounts[$i]['description'];
                $journalItem->debit       = isset($accounts[$i]['debit']) ? $accounts[$i]['debit'] : 0;
                $journalItem->credit      = isset($accounts[$i]['credit']) ? $accounts[$i]['credit'] : 0;
                $journalItem->save();
            }

            return redirect()->route('journal_entries.index')->with('success', __('Journal Entry Successfully Created.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JournalEntry  $journalEntry
     * @return \Illuminate\Http\Response
     */
    public function show(JournalEntry $journalEntry)
    {
        if(\Auth::user()->can('View Journal'))
        {
                if($journalEntry->created_by == \Auth::user()->creatorId())
                {
                    $accounts = $journalEntry->accounts;
                    $settings = Utility::settings();

                    return view('accounting.transaction.journal.view', compact('journalEntry', 'accounts', 'settings'));
                }
                else
                {
                    return redirect()->back()->with('errors', __('Permission Denied.'));
                }
        }
        else
        {
            return response()->json(['errors' => __('Permission denied.')], 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JournalEntry  $journalEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(JournalEntry $journalEntry)
    {
        if(\Auth::user()->can('Edit Journal'))
        {
            if($journalEntry->created_by == \Auth::user()->creatorId())
            {
                $accounts = ChartOfAccount::select(\DB::raw('CONCAT(code, " - ", name) AS code_name, id'))->where('created_by', \Auth::user()->creatorId())->get()->pluck('code_name', 'id');
                $accounts->prepend('--', '');

                return view('accounting.transaction.journal.edit', compact('accounts', 'journalEntry'));
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
     * @param  \App\JournalEntry  $journalEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JournalEntry $journalEntry)
    {
        if(\Auth::user()->can('Edit Journal'))
        {
            if($journalEntry->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'date' => 'required',
                                    'accounts' => 'required',
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }

                $accounts = $request->accounts;

                $totalDebit  = 0;
                $totalCredit = 0;
                for($i = 0; $i < count($accounts); $i++)
                {
                    $debit       = isset($accounts[$i]['debit']) ? $accounts[$i]['debit'] : 0;
                    $credit      = isset($accounts[$i]['credit']) ? $accounts[$i]['credit'] : 0;
                    $totalDebit  += $debit;
                    $totalCredit += $credit;
                }

                if($totalCredit != $totalDebit)
                {
                    return redirect()->back()->with('error', __('Debit And Credit Must Be Equal.'));
                }

                $journalEntry->date        = $request->date;
                $journalEntry->reference   = $request->reference;
                $journalEntry->description = $request->description;
                $journalEntry->created_by  = \Auth::user()->creatorId();
                $journalEntry->save();

                for($i = 0; $i < count($accounts); $i++)
                {
                    $journalItem = JournalItem::find($accounts[$i]['id']);

                    if($journalItem == null)
                    {
                        $journalItem          = new JournalItem();
                        $journalItem->journal = $journalEntry->id;
                    }

                    if(isset($accounts[$i]['account']))
                    {
                        $journalItem->account = $accounts[$i]['account'];
                    }

                    $journalItem->description = $accounts[$i]['description'];
                    $journalItem->debit  = isset($accounts[$i]['debit']) ? $accounts[$i]['debit'] : 0;
                    $journalItem->credit = isset($accounts[$i]['credit']) ? $accounts[$i]['credit'] : 0;
                    $journalItem->save();
                }

                return redirect()->route('journal_entries.index')->with('success', __('Journal Entry Successfully Updated.'));

            }
            else
            {
                return redirect()->back()->with('errors', __('Permission Denied.'),401);
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
     * @param  \App\JournalEntry  $journalEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(JournalEntry $journalEntry)
    {
        if(\Auth::user()->can('Delete Journal'))
        {
            if($journalEntry->created_by == \Auth::user()->creatorId())
            {
                $journalEntry->delete();

                JournalItem::where('journal', '=', $journalEntry->id)->delete();

                return redirect()->route('journal_entries.index')->with('success', __('Journal Entry Successfully Deleted.'));
            }
            else
            {
                return redirect()->back()->with('errors', __('Permission Denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    function journalNumber()
    {
        $latest = JournalEntry::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->journal_id + 1;
    }

    public function accountDestroy(Request $request)
    {
        if(\Auth::user()->can('Delete Journal'))
        {
            JournalItem::where('id', '=', $request->id)->delete();

            return redirect()->back()->with('success', __('Journal Entry Account Successfully Deleted.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }
}
