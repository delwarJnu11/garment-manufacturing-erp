<?php

namespace App\Http\Controllers;

use App\Models\Hrm_employee_bank_accounts;
use App\Models\Hrm_employees;
use Illuminate\Http\Request;

class HrmEmployeeBankAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Hrm_employee_bank_accounts::all();
         //print_r( $accounts );

         return view('pages.hrm.employee.hrm_employee_bank_accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees=Hrm_employees::all();
        return view('pages.hrm.employee.hrm_employee_bank_accounts.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|string|max:50',
            'bank_name' => 'required|string|max:50',
            'account_number' => 'required|string|max:200',
            'bank_identifier_code' => 'required|string|max:200',
            'branch_name' => 'required|string|max:200',
            'branch_location' => 'required|string|max:200',
        ]);

        $accounts = new Hrm_employee_bank_accounts();
        $accounts->employee_id= $request->employee_id;
        $accounts->bank_name= $request->bank_name;
        $accounts->account_number= $request->account_number;
        $accounts->bank_identifier_code= $request->bank_identifier_code;
        $accounts->branch_name= $request->branch_name;
        $accounts->branch_location= $request->branch_location;

        if($accounts->save()){
            return redirect()->back()->with('success', 'Employee Account has been added successfully!');
         } ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_employee_bank_accounts $Hrm_employee_bank_accounts, $id)
    {
        $accounts = Hrm_employee_bank_accounts::find($id);
        return view('pages.hrm.employee.hrm_employee_bank_accounts.show', compact('accounts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_employee_bank_accounts $Hrm_employee_bank_accounts, $id)
    {
        $employees=Hrm_employees::all();
        $accounts = Hrm_employee_bank_accounts::find($id);


        return view('pages.hrm.employee.hrm_employee_bank_accounts.update', compact('accounts','employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_employee_bank_accounts $Hrm_employee_bank_accounts, $id)
    {

        $request->validate([
            'employee_id' => 'required|string|max:50',
            'bank_name' => 'required|string|max:50',
            'account_number' => 'required|string|max:200',
            'bank_identifier_code' => 'required|string|max:200',
            'branch_name' => 'required|string|max:200',
            'branch_location' => 'required|string|max:200',
        ]);

        $accounts = Hrm_employee_bank_accounts::find($id);
        $accounts->employee_id= $request->employee_id;
        $accounts->bank_name= $request->bank_name;
        $accounts->account_number= $request->account_number;
        $accounts->bank_identifier_code= $request->bank_identifier_code;
        $accounts->branch_name= $request->branch_name;
        $accounts->branch_location= $request->branch_location;

        if($accounts->save()){
            return redirect('hrm_employee_bank_accounts')->with('success', 'accounts has been updated successfully!');
         } ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_employee_bank_accounts $Hrm_employee_bank_accounts, $id)
    {

        $del = Hrm_employee_bank_accounts::destroy($id);
        if ($del) {
            return redirect('hrm_employee_bank_accounts')->with('success', "accounts has been Deleted");
        }
    }
}

