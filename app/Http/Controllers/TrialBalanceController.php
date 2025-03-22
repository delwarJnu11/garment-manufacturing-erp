<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
// use PDF;

class TrialBalanceController extends Controller
{
    public function index(Request $request)
    {
        // Get date range from request (default: current month)
        $start_date = $request->input('start_date', date('Y-m-01'));
        $end_date = $request->input('end_date', date('Y-m-t'));

        // Fetch trial balance within the selected date range
        $trialBalance = DB::table('accounts as a')
            ->rightJoin('transactions', 'a.id', '=', 'transactions.account_id')
            ->select(
                'a.id',
                'a.code',
                'a.name',
                DB::raw("SUM(CASE WHEN transaction_date BETWEEN '$start_date' AND '$end_date' THEN debit ELSE 0 END) as total_debit"),
                DB::raw("SUM(CASE WHEN transaction_date BETWEEN '$start_date' AND '$end_date' THEN credit ELSE 0 END) as total_credit"),
               
               
                DB::raw("(SUM(CASE WHEN transaction_date BETWEEN '$start_date' AND '$end_date' THEN debit ELSE 0 END) -
                  SUM(CASE WHEN transaction_date BETWEEN '$start_date' AND '$end_date' THEN credit ELSE 0 END)) as balance")
            )
            ->groupBy('a.id', 'a.code', 'a.name')
            ->orderBy('a.code')
            ->get();

          

                    // echo json_encode($trialBalance);

        return view('pages.accounts.trial_balance.index', compact('trialBalance', 'start_date', 'end_date'));
    }

    public function printPdf(Request $request)
    {
        $start_date = $request->input('start_date', date('Y-m-01'));
        $end_date = $request->input('end_date', date('Y-m-t'));

        $trialBalance = DB::table('accounts as a')
            ->leftJoin('transactions', 'a.id', '=', 'transactions.account_id')
            ->select(
                'a.id',
                'a.code',
                'a.name',
                DB::raw("SUM(CASE WHEN transaction_date BETWEEN '$start_date' AND '$end_date' THEN debit ELSE 0 END) as total_debit"),
                DB::raw("SUM(CASE WHEN transaction_date BETWEEN '$start_date' AND '$end_date' THEN credit ELSE 0 END) as total_credit"),
              DB::raw("(SUM(CASE WHEN transaction_date BETWEEN '$start_date' AND '$end_date' THEN debit ELSE 0 END) -
                  SUM(CASE WHEN transaction_date BETWEEN '$start_date' AND '$end_date' THEN credit ELSE 0 END)) as balance")
            )
            ->groupBy('a.id', 'a.code', 'a.name')
            ->orderBy('a.code')
            ->get();


        $pdf = Pdf::loadView('pages.erp.trial_balance.pdf', compact('trialBalance', 'start_date', 'end_date'));
        // return $pdf->download('Trial_Balance.pdf');
        return $pdf->stream('invoice.pdf');
    }
}

// SELECT
//     a.account_id,
//     a.code,
//     a.account_name,
//     SUM(at.debit) AS total_debit,
//     SUM(at.credit) AS total_credit,
//     (SUM(at.debit) - SUM(at.credit)) AS balance
// FROM accounts a
// LEFT JOIN account_transactions at ON a.account_id = at.account_id
// GROUP BY a.account_id, a.code, a.account_name
// ORDER BY a.code;

