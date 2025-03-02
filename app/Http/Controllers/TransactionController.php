<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
class TransactionController extends Controller{
	public function index(){
		$transactions = Transaction::paginate(10);
		return view("pages.accounts.transaction.index",["transactions"=>$transactions]);
	}
	public function create(){
		return view("pages.accounts.transaction.create",["accounts"=>Account::all(),"users"=>User::all()]);
	}
	public function store(Request $request){

		
		//Transaction::create($request->all());
		$transaction = new Transaction;
		$transaction->voucher_ref=$request->voucher_ref;
		$transaction->transaction_date=$request->transaction_date;
		$transaction->account_id=$request->account_id;
		$transaction->amount=$request->amount;
		$transaction->description=$request->description;
		$transaction->transaction_against=$request->transaction_against;
		$transaction->debit=$request->debit;
		$transaction->credit=$request->credit;
		$transaction->user_id=$request->user_id;
        date_default_timezone_set("Asia/Dhaka");
		$transaction->created_at=date('Y-m-d H:i:s');
          date_default_timezone_set("Asia/Dhaka");
		$transaction->updated_at=date('Y-m-d H:i:s');

		$transaction->save();

		return back()->with('success', 'Created Successfully.');
	}
	public function show($id){
		$transaction = Transaction::find($id);
		return view("pages.accounts.transaction.show",["transaction"=>$transaction]);
	}
	public function edit(Transaction $transaction){
		return view("pages.accounts.transaction.edit",["transaction"=>$transaction,"accounts"=>Account::all(),"users"=>User::all()]);
	}
	public function update(Request $request,Transaction $transaction){
		//Transaction::update($request->all());
		$transaction = Transaction::find($transaction->id);
		$transaction->voucher_ref=$request->voucher_ref;
		$transaction->transaction_date=$request->transaction_date;
		$transaction->account_id=$request->account_id;
		$transaction->amount=$request->amount;
		$transaction->description=$request->description;
		$transaction->transaction_against=$request->transaction_against;
		$transaction->debit=$request->debit;
		$transaction->credit=$request->credit;
		$transaction->user_id=$request->user_id;
date_default_timezone_set("Asia/Dhaka");
		$transaction->created_at=date('Y-m-d H:i:s');
date_default_timezone_set("Asia/Dhaka");
		$transaction->updated_at=date('Y-m-d H:i:s');

		$transaction->save();

		return redirect()->route("transactions.index")->with('success','Updated Successfully.');
	}
	public function destroy(Transaction $transaction){
		$transaction->delete();
		return redirect()->route("transactions.index")->with('success', 'Deleted Successfully.');
	}
}
?>
