<?php

namespace App\Http\Controllers;

use App\Models\Sweing;
use Illuminate\Http\Request;

class SweingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sweings = Sweing::paginate(4);
        return view('pages.production.sweing.index', compact('sweings'));
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
    public function show(Sweing $sweing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sweing $sweing)
    {
        return view('pages.production.sweing.edit', compact('sweing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sweing $sweing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sweing $sweing)
    {
        //
    }
}
