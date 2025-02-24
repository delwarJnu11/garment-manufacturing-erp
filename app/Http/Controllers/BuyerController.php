<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = Buyer::paginate(5);
        return view('pages.orders_&_buyers.buyers.buyers', compact('buyers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.orders_&_buyers.buyers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "first_name" => "required|string|max:40",
            "last_name" => "required|string|max:40",
            "email" => "required|email|unique:buyers,email|max:50",
            "phone" => "required|string|unique:buyers,phone|max:20",
            "country" => "required|string|max:100",
            "shipping_address" => "required|string|max:100",
            "billing_address" => "nullable|string|max:100",
            "photo" => "nullable|image|mimes:jpg,jpeg,png|max:2048"
        ]);

        // Handle file upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $buyerName = str_replace(' ', '', $request->first_name);
            $file_name = time() . '_' . $buyerName . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/buyers'), $file_name);
        } else {
            $file_name = 'default.png';
        }

        // Store buyer
        Buyer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email, // ✅ Fixed typo
            'phone' => $request->phone,
            'country' => $request->country,
            'shipping_address' => $request->shipping_address,
            'billing_address' => $request->billing_address,
            'photo' => $file_name,
        ]);

        return redirect()->route('buyers.index')->with('success', "Created buyer successfully");
    }


    /**
     * Display the specified resource.
     */
    public function show(Buyer $buyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buyer $buyer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buyer $buyer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buyer $buyer)
    {
        //
    }
}
