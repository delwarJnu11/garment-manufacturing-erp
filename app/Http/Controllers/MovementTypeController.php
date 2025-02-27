<?php

namespace App\Http\Controllers;

use App\Models\MovementType;
use Illuminate\Http\Request;

class MovementTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $movementTypes=  MovementType::all();
       return view();
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
    public function show(MovementType $movementType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MovementType $movementType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MovementType $movementType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovementType $movementType)
    {
        //
    }
}
