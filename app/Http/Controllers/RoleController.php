<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $roles = Role::paginate(4);
        return view('pages.user.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.user.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name',
        ], [
            'required' => 'Role name is required!',
        ]);

        // Create a new role
        $result = Role::create([
            'name' => $request->name,
        ]);
        if ($result) {
            return redirect('/users/roles')->with('success', 'Role has been added successfully!');
        } else {
            return redirect()->back()->with('error', 'Role created failed!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role) {
        //
    }
}
