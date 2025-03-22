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
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller{
	public function index(){
		$transactions = Transaction::paginate(50);
		echo "<pre>";
		print_r($transactions);
		// return view("pages.accounts.transactions.index",["transactions"=>$transactions]);
	}
	public function create(){
		return view("pages.accounts.transactions.create",["accounts"=>Account::all(),"users"=>User::all()]);
	}
	public function store(Request $request){	
		try {
			DB::beginTransaction();

			$transaction = new Transaction;
			$transaction->voucher_ref=$request->voucher_ref??"";
			$transaction->transaction_date=$request->transaction_date;
			$transaction->account_id=$request->account_id;
			$transaction->amount=$request->debit;
			$transaction->description=$request->description;
			$transaction->transaction_against=$request->transaction_against_id;
			$transaction->debit=$request->debit ?? 0;
			$transaction->credit=$request->credit ?? 0;
			$transaction->user_id= Auth::user()->id;
			date_default_timezone_set("Asia/Dhaka");
			$transaction->created_at=date('Y-m-d H:i:s');
			date_default_timezone_set("Asia/Dhaka");
			$transaction->updated_at=date('Y-m-d H:i:s');
			$transaction->save();
	
			$transaction = new Transaction;
			$transaction->voucher_ref=$request->voucher_ref??"";
			$transaction->transaction_date=$request->transaction_date;
			$transaction->account_id= $request->transaction_against_id;
			$transaction->amount=$request->debit;
			$transaction->description=$request->description;
			$transaction->transaction_against=$request->account_id;
			$transaction->debit=$request->t_a_debit ?? 0;
			$transaction->credit=$request->t_a_credit ?? 0;
			$transaction->user_id= Auth::user()->id;
			date_default_timezone_set("Asia/Dhaka");
			$transaction->created_at=date('Y-m-d H:i:s');
			  date_default_timezone_set("Asia/Dhaka");
			$transaction->updated_at=date('Y-m-d H:i:s');
			$transaction->save();
			DB::commit();

			return back()->with('Success', 'Created Successfully.');

		} catch (\Throwable $th) {
			DB::rollBack();
			return back()->with('Error', ' Unsuccessfull.');
		}
	}
	public function show($id){
		$transaction = Transaction::find($id);
		return view("pages.accounts.transactions.show",["transaction"=>$transaction]);
	}
	public function edit(Transaction $transaction){
		return view("pages.accounts.transactions.edit",["transaction"=>$transaction,"accounts"=>Account::all(),"users"=>User::all()]);
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

