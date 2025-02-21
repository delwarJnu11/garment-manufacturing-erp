<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;

use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyProfile = CompanyProfile::first();
        return view('pages.companyProfile.index', compact('companyProfile'));
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
    public function show(CompanyProfile $CompanyProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyProfile $CompanyProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $companyProfile = CompanyProfile::findOrFail($id);

        $request->validate([
            'company_name' => 'required|string|max:255',
            'established_year' => 'required|numeric',
            'company_type' => 'required|string|max:255',
            'business_address' => 'nullable|string',
            'head_office' => 'nullable|string',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url',
            'factory_size' => 'nullable|string|max:255',
            'production_capacity' => 'nullable|string|max:255',
            'number_of_employees' => 'nullable|numeric',
            'machinery_equipment' => 'nullable|string',
            'product_categories' => 'nullable|string',
            'export_markets' => 'nullable|string',
            'major_buyers' => 'nullable|string',
            'certifications' => 'nullable|string',
            'sustainability_initiatives' => 'nullable|string',
            'compliance_standards' => 'nullable|string',
            'lead_time' => 'nullable|string',
            'shipping_logistics' => 'nullable|string',
            'payment_terms' => 'nullable|string',
        ]);

        $companyProfile->update($request->all());

        return redirect()->route('companyProfile.index')->with('success', 'Company profile updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyProfile $CompanyProfile)
    {
        //
    }
}
