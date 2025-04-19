<?php

namespace App\Http\Controllers;

use App\Mail\supplierMail;
use App\Models\BankAccount;
use App\Models\inv_suppliers;
use App\Models\InvSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvSuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = InvSupplier::with('bankAccount')->paginate(4);
        // Mail::to('abc@gmail.com')->send(new supplierMail($suppliers));
        return view('pages.purchase_&_supliers.Suppliers.suppliers', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bankAccounts = BankAccount::where('account_for_id', 1)->get();
        return view('pages.purchase_&_supliers.Suppliers.create', compact('bankAccounts'));
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
            "email" => "required|email|unique:inv_suppliers,email|max:50",
            "phone" => "required|string|unique:inv_suppliers,phone|max:20",
            "address" => "required|string|max:100",
            "photo" => "required|image|mimes:jpg,jpeg,png|max:2048"
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email is already in use.',
            'email.max' => 'Email cannot be more than 50 characters.',
            'phone.required' => 'Phone number is required.',
            'phone.unique' => 'This phone number is already in use.',
            'phone.max' => 'Phone number cannot exceed 20 characters.',
            'address.required' => 'Address is required.',
            'address.max' => 'Address should not exceed 100 characters.',
            'photo.required' => 'Photo is required.',
            'photo.image' => 'The file must be an image.',
            'photo.mimes' => 'Photo must be a JPG, JPEG, or PNG file.',
            'photo.max' => 'Photo size should not exceed 2MB.'
        ]);


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            // Supplier name without spaces
            $supplierName = preg_replace('/\s+/', '', $request->first_name); // remove space
            $fileName = time() . $supplierName . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/suppliers'), $fileName);
        } else {
            $fileName = 'default.png';
        }

        InvSupplier::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'bank_account_id' => $request->bank_account_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $fileName
        ]);
        // AccountController function use

        return redirect('suppliers')->with('success', "Creted suppliers successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(InvSupplier $InvSupplier, $id)
    {
        $supplier = InvSupplier::findOrFail($id);
        return view('pages.purchase_&_supliers.Suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvSupplier $supplier)
    {

        return view('pages.purchase_&_supliers.Suppliers.edit', compact('supplier'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvSupplier $supplier)
    {
        $request->validate([
            "first_name" => "required|string|max:40",
            "last_name" => "required|string|max:40",
            "email" => "required|email|max:50|unique:InvSupplier,email," . $supplier->id,
            "phone" => "required|string|max:20|unique:InvSupplier,phone," . $supplier->id,
            "address" => "required|string|max:100",
            "photo" => "nullable|image|mimes:jpg,jpeg,png|max:2048"
        ]);

        if ($request->hasFile('photo')) {
            // পdelete old image
            if ($supplier->photo && $supplier->photo !== 'default.png') {
                $oldPhotoPath = public_path('uploads/suppliers/' . $supplier->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $file = $request->file('photo');
            $supplierName = preg_replace('/\s+/', '', $request->first_name); // স্পেস রিমুভ করা হলো
            $fileName = time() . $supplierName . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/suppliers'), $fileName);
        } else {
            $fileName = $supplier->photo; // পুরানো ছবিই থাকবে
        }

        $supplier->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $fileName
        ]);

        return redirect()->route('suppliers.index')->with('success', "Supplier updated successfully");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = InvSupplier::findOrFail($id);
        if ($supplier->photo && $supplier->photo !== 'default.png') {
            $photoPath = public_path('uploads/suppliers/' . $supplier->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }
        $supplier->delete();
        return redirect('suppliers')->with('success', 'Supplier deleted successfully');
    }
}
