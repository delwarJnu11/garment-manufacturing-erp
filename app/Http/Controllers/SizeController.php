<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::all();
        return view('pages.orders_&_Buyers.sizes.index', compact('sizes'));
    }
    // public function index()
    // {
    //     dd("SizeController@index method is being hit");
    // }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.orders_&_Buyers.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',


        ]);

        $size = new Size();

        $size->name  = $request->name;

        if ($size->save()) {
            return redirect('sizes')->with('success', 'size Added Successfully');
        }
        return  redirect('sizes')->with('error', 'Something went wrong. Please try again.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $size = Size::find($id);
        return view('pages.orders_&_Buyers.sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:4',

        ]);

        $size = Size::find($id);

        $size->name  = $request->name;

        if ($size->save()) {
            return redirect('sizes')->with('success', 'size Updated Successfully');
        }

        return redirect('sizes')->with('error', 'Update failed');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $size = size::findOrFail($id);
        $size->delete();

        return redirect('size')->with('success', 'size deleted successfully');
    }
}
