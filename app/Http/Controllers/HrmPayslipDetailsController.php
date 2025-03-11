<?php

namespace App\Http\Controllers;

use App\Models\Hrm_payslip_details;
use Illuminate\Http\Request;

class HrmPayslipDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payslipDetails=Hrm_payslip_details::all();
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Hrm_payslip_details $hrm_payslip_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hrm_payslip_details $hrm_payslip_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hrm_payslip_details $hrm_payslip_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hrm_payslip_details $hrm_payslip_details)
    {
        //
    }
}
