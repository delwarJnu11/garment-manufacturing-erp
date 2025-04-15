<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;

use App\Models\AccountGroup;
use App\Models\Accounts;
use App\Models\Transaction;
use App\Models\transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{
	public function index()
	{
		$accounts = Account::with('accounts')->paginate(10);
		return view("pages.accounts.account.index", ["accounts" => $accounts]);
	}
	public function create()
	{
		return view(
			"pages.accounts.account.create",
			[
				"accountGroups" => AccountGroup::whereNotNull('parent_id')->get(),
			]
		);
	}

	public function ledger_report(Request $request)
	{
		$accounts = Account::all();
		
        $transactions= transactions::where('account_id', $request->account_id)->whereBetween('transaction_date', [ $request->start_date,$request->end_date ])->with("account")->get();
    
		echo json_encode($accounts);
		// return view("pages.accounts.accounts.show", ["transactions" => $transactions, "accounts" => $accounts]);
	}
	public function store(Request $request)
	{
		//Account::create($request->all());

		$validator = Validator::make($request->all(), [
			'name' => 'required|unique:accounts',
		]);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$lastAccount = DB::table('accounts')->where('account_group_id', $request->account_group_id)->orderByDesc('code')->value('code');
		$parentCode = AccountGroup::where('id', $request->account_group_id)->value('code');
		$gencode = $lastAccount ? str_pad((int)substr($lastAccount, -2) + 1, 2, 0, STR_PAD_LEFT) : "01";
		$accountCode = $parentCode . $gencode;

		$account = new Account;
		$account->code = $accountCode;
		$account->name = $request->name;
		$account->account_group_id = $request->account_group_id;
		$account->is_payment_method = $request->is_payment_method;
		$account->is_trx_no_required = $request->is_trx_no_required;
		$account->description = $request->description;
		$account->is_active = $request->is_active;
		date_default_timezone_set("Asia/Dhaka");
		$account->created_at = date('Y-m-d H:i:s');
		$account->created_by = Auth::user()->id;
		date_default_timezone_set("Asia/Dhaka");
		$account->updated_at = date('Y-m-d H:i:s');
		$account->updated_by = Auth::user()->id;
		$account->save();
		return back()->with('success', 'Created Successfully.');
	}
	public function show($id)
	{
		$account = Account::find($id);
		return view("pages.accounts.account.show", ["account" => $account]);
	}
	public function edit(Account $account)
	{
		return view("pages.accounts.account.edit", ["account" => $account, "accountGroups" => AccountGroup::all()]);
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


	public static function  createAccount(  $request, string $name = "", int $account_group_id = 0, string $description = "")
	{
		// //Account::create($request->all());
        
		$lastAccount = DB::table('accounts')->where('account_group_id', $request['account_group_id'])->orderByDesc('code')->value('code');
		$parentCode = AccountGroup::where('id', $request['account_group_id'])->value('code');
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
}
