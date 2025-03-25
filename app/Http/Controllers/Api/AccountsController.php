<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountGroup;
use App\Models\AccountGroup;
use App\Models\accountGroups;
use App\Models\Transaction;
use App\Models\transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{
	public function index()
	{
		$accounts = Account::all();
		return response()->json($accounts);
	}
	public function journal()
	{
		$journal = Transaction::with(['account', 'againstAccount'])->get();
		return response()->json($journal);
	}
	public function create()
	{
		return view(
			"pages.accounts.accounts.create",
			[
				"accountGroups" => accountGroups::whereNotNull('parent_id')->get(),
			]
		);
	}



	public function store(Request $request)
	{

		// return response()->json($request);
		try {
			DB::beginTransaction();

			$transaction = new Transaction;
			$transaction->voucher_ref = $request->voucher_ref;
			$transaction->transaction_date = $request->transaction_date;
			$transaction->account_id = $request->account_id;
			$transaction->amount = $request->debit;
			$transaction->description = $request->description;
			$transaction->transaction_against = $request->transaction_against_id;
			$transaction->debit = $request->debit ?? 0;
			$transaction->credit = $request->credit ?? 0;
			$transaction->user_id = 1;
			// $transaction->user_id= Auth::user()->id;
			date_default_timezone_set("Asia/Dhaka");
			$transaction->created_at = date('Y-m-d H:i:s');
			date_default_timezone_set("Asia/Dhaka");
			$transaction->updated_at = date('Y-m-d H:i:s');
			$transaction->save();

			$transaction = new Transaction;
			$transaction->voucher_ref = $request->voucher_ref;
			$transaction->transaction_date = $request->transaction_date;
			$transaction->account_id = $request->transaction_against_id;
			$transaction->amount = $request->debit;
			$transaction->description = $request->description;
			$transaction->transaction_against = $request->account_id;
			$transaction->debit = $request->t_a_debit ?? 0;
			$transaction->credit = $request->t_a_credit ?? 0;
			$transaction->user_id = 1;
			date_default_timezone_set("Asia/Dhaka");
			$transaction->created_at = date('Y-m-d H:i:s');
			date_default_timezone_set("Asia/Dhaka");
			$transaction->updated_at = date('Y-m-d H:i:s');
			$transaction->save();
			DB::commit();

			return response()->json("Transaction Successfully saved!");
		} catch (\Throwable $th) {
			DB::rollBack();
			return response()->json("Please Try Again. Error: $th");
		}
	}
	public function show($id)
	{
		$account = Account::find($id);
		return view("pages.accounts.accounts.show", ["account" => $account]);
	}
	public function edit(Account $account)
	{
		return view("pages.accounts.accounts.edit", ["account" => $account, "account_groups" => accountGroups::all()]);
	}
	public function update(Request $request, Account $account)
	{
		//Account::update($request->all());
		$account = Account::find($account->id);
		$account->code = $request->code;
		$account->name = $request->name;
		$account->account_group_id = $request->account_group_id;
		$account->is_payment_method = $request->is_payment_method;
		$account->is_trx_no_required = $request->is_trx_no_required;
		$account->description = $request->description;
		$account->is_active = $request->is_active;
		date_default_timezone_set("Asia/Dhaka");
		$account->created_at = date('Y-m-d H:i:s');
		$account->created_by = $request->created_by;
		date_default_timezone_set("Asia/Dhaka");
		$account->updated_at = date('Y-m-d H:i:s');
		$account->updated_by = $request->updated_by;

		$account->save();

		return redirect()->route("accounts.index")->with('success', 'Updated Successfully.');
	}
	public function destroy(Account $account)
	{
		$account->delete();
		return redirect()->route("accounts.index")->with('success', 'Deleted Successfully.');
	}

	public static function  createAccount($request, string $name = "", int $account_group_id = 0, string $description = "")
	{
		// //Account::create($request->all());

		$lastAccount = DB::table('accounts')->where('account_group_id', $request['account_group_id'])->orderByDesc('code')->value('code');
		$parentCode = AccountGroups::where('id', $request['account_group_id'])->value('code');
		$gencode = $lastAccount ? str_pad((int)substr($lastAccount, -2) + 1, 2, 0, STR_PAD_LEFT) : "01";
		$accountCode = $parentCode . $gencode;

		$account = new Account;
		$account->code = $accountCode;
		$account->name = $request['name'];
		$account->account_group_id = $request['account_group_id'];
		$account->is_payment_method = 0;
		$account->is_trx_no_required = 0;
		$account->description = $request['description'];
		$account->is_active = 1;
		date_default_timezone_set("Asia/Dhaka");
		$account->created_at = date('Y-m-d H:i:s');
		$account->created_by = Auth::user()->id;
		date_default_timezone_set("Asia/Dhaka");
		$account->updated_at = date('Y-m-d H:i:s');
		$account->updated_by = Auth::user()->id;
		$account->save();
		//return back()->with('success', 'Created Successfully.');
	}

	public function ledger_report(Request $request)
	{

		$accounts = Account::all();
		$transactions = transactions::where('account_id', $request->account_id)->whereBetween('transaction_date', [$request->start_date, $request->end_date])->with("account")->get();
		//   echo json_encode($accounts);
		return view("pages.accounts.accounts.show", ["transactions" => $transactions, "accounts" => $accounts]);
	}

	public function trialBalance(Request $request)
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
            ->orderBy('a.code', 'asc')
            ->get();

		return response()->json([$trialBalance, $start_date, $end_date]);

        // return view('pages.accounts.trial_balance.index', compact('trialBalance', 'start_date', 'end_date'));
    }

	public function chartOfAccounts()
    {
        $groups = AccountGroup::whereNull('parent_id')->with('children', 'accounts')->get();

        // echo  json_encode( $groups[0]->children);

		return response()->json($groups);

        // return View('pages.accounts.reports.chartofaccountpdf', compact('groups'));
    }

	public function trialBalance(Request $request)
	{
		// Get date range from request (default: current month)
		$start_date = $request->input('start_date', date('Y-m-01'));
		$end_date = $request->input('end_date', date('Y-m-t'));

		// Fetch trial balance within the selected date range
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
		// echo json_encode($trialBalance);

		return response()->json([$trialBalance, $start_date, $end_date]);
		// return view('pages.accounts.trial_balance.index', compact('trialBalance', 'start_date', 'end_date'));
	}

	public function chartOfAccounts()
	{
		$groups = AccountGroup::whereNull('parent_id')->with('children', 'accounts')->get();

		// echo  json_encode( $groups[0]->children);
		return response()->json($groups);
		// return View('pages.accounts.reports.chartofaccountpdf', compact('groups'));
	}
}
