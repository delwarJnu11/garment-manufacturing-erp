<?php

namespace App\Http\Controllers;

use App\Models\accountGroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // app/Http/Controllers/AccountGroupsController.php
    public function index(){
		$accountgroups = AccountGroups::paginate(10);
		return view("pages.accounts.accountgroup.index",
		  ["accountgroups"=>$accountgroups])
		;
	}
	public function create(){
		return view("pages.accounts.accountgroup.create",
		["parents"=>AccountGroups::orderBy('code')->get()]
	);
	}
	public function store(Request $request){
		//AccountGroup::create($request->all());
        
		$parent_code= AccountGroups::where('id', $request->parent_id)->value('code');
		$count= DB::table('account_groups')->where('parent_id', $request->parent_id)->count();
		$count=$count+1;

		$genCode=str_pad($count, 2 , '0', STR_PAD_LEFT);
		$accountcode= $parent_code.$genCode;

		// print_r($request->parent_id);
		// print_r($accountcode);

		$accountgroup = new AccountGroups;
		$accountgroup->code=$accountcode;
		$accountgroup->name=$request->name;
		$accountgroup->description=$request->description;
		$accountgroup->parent_id=$request->parent_id;
		$accountgroup->is_active=$request->is_active;
		$accountgroup->system_generated=$request->system_generated;
        date_default_timezone_set("Asia/Dhaka");
		$accountgroup->created_at=date('Y-m-d H:i:s');
        date_default_timezone_set("Asia/Dhaka");
		$accountgroup->updated_at=date('Y-m-d H:i:s');

		 $accountgroup->save();

		return back()->with(['success'=>'Created Successfully.', 'parent_id'=>$request->parent_id]);
	}
	public function show($id){
		$accountgroup = AccountGroups::find($id);
		return view("pages.accounts.accountgroup.show",["accountgroup"=>$accountgroup]);
	}
	public function edit(AccountGroups $accountgroup){
		return view("pages.accounts.accountgroup.edit",["accountgroup"=>$accountgroup,"parents"=>Parent::all()]);
	}
	public function update(Request $request,AccountGroups $accountgroup){
		//AccountGroup::update($request->all());
		$accountgroup = AccountGroups::find($accountgroup->id);
		$accountgroup->code=$request->code;
		$accountgroup->name=$request->name;
		$accountgroup->description=$request->description;
		$accountgroup->parent_id=$request->parent_id;
		$accountgroup->is_active=$request->is_active;
		$accountgroup->system_generated=$request->system_generated;
date_default_timezone_set("Asia/Dhaka");
		$accountgroup->created_at=date('Y-m-d H:i:s');
date_default_timezone_set("Asia/Dhaka");
		$accountgroup->updated_at=date('Y-m-d H:i:s');

		$accountgroup->save();

		return redirect()->route("accountgroups.index")->with('success','Updated Successfully.');
	}
	public function destroy(AccountGroups $accountgroup){
		$accountgroup->delete();
		return redirect()->route("accountgroups.index")->with('success', 'Deleted Successfully.');
	}

}
