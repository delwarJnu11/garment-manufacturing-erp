<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = Buyer::with('bankAccount')->paginate(5);
        return view('pages.orders_&_buyers.buyers.buyers', compact('buyers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bankAccounts = BankAccount::where('account_for_id', 2)->get();
        return view('pages.orders_&_buyers.buyers.create', compact('bankAccounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "first_name" => "required|string|max:40",
            "last_name" => "required|string|max:40",
            "bank_account_id" => "nullable",
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
            'bank_account_id' => $request->bank_account_id,
            'email' => $request->email,
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
        return view('pages.orders_&_buyers.buyers.show', compact('buyer'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Buyer $buyer)
    // {
    //     return view('pages.orders_&_buyers.buyers.edit',compact( 'buyer'));
    // }

    public function edit($id)
    {
        $buyer = Buyer::findOrFail($id);
        $bankAccounts = bankAccount::where('account_for_id', 2)->get();
        return view('pages.orders_&_buyers.buyers.edit', compact('buyer', 'bankAccounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buyer $buyer)
    {
        $request->validate([
            "first_name" => "required|string|max:40",
            "last_name" => "required|string|max:40",
            "bank_account_id" => "nullable",
            "email" => "required|email|max:50|unique:buyers,email," . $buyer->id,
            "phone" => "required|string|max:20|unique:buyers,phone," . $buyer->id,
            "country" => "required|string|max:100",
            "shipping_address" => "required|string|max:100",
            "billing_address" => "nullable|string|max:100",
            "photo" => "nullable|image|mimes:jpg,jpeg,png|max:2048"
        ]);

        // Handle Photo Upload
        if ($request->hasFile('photo')) {
            // Delete old image if exists
            if ($buyer->photo && $buyer->photo !== 'default.png') {
                $oldPhotoPath = public_path('uploads/buyers/' . $buyer->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $file = $request->file('photo');
            $buyerName = preg_replace('/\s+/', '', $request->first_name);
            $fileName = time() . $buyerName . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/buyers'), $fileName);
        } else {
            $fileName = $buyer->photo;
        }

        // Update Buyer
        $buyer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            "bank_account_id" => "nullable",
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'shipping_address' => $request->shipping_address,
            'billing_address' => $request->billing_address,
            'photo' => $fileName
        ]);

        return redirect()->route('buyers.index')->with('success', "Buyer updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buyer $buyer)
    {
        if ($buyer->photo && $buyer->photo !== 'default.png') {
            $photoPath = public_path('uploads/buyers/' . $buyer->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }
        $buyer->delete();
        return redirect()->route('buyers.index')->with('success', 'Buyer deleted successfully');
    }
}
