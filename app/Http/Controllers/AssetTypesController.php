<?php

namespace App\Http\Controllers;

use App\Models\AssetTypes;
use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = AssetTypes::all();
        return view("pages.accounts.assetsType.index", compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.accounts.assetsType.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $type = new AssetTypes();
        $type->name = $request->name;
        $type->description = $request->description;
        $type->created_at = null;
        $type->updated_at = null;

        $type->save();
        redirect("/assetTypes/");
    }

    /**
     * Display the specified resource.
     */
    public function show(AssetTypes $assetTypes, $id)
    {
        $types = AssetTypes::find($id);

        // echo "<pre>";
        // print_r($types['name']);
        // echo "</pre>";
        // print_r($types);
        return view("pages.accounts.assetsType.show", compact('types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $data = new AssetTypes();
        // $data->find($id);
        $data = DB::table('asset_types')->find($id);
        // echo "<pre>";
        // print_r($info);
        // echo "</pre>";
        return view("pages.accounts.assetsType.update", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssetTypes $assetTypes)
    {
        $type = new AssetTypes();
        $type->name = $request->name;
        $type->description = $request->description;
        $type->created_at = null;
        $type->updated_at = null;

        $type->update();
        redirect("/assetTypes/");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssetTypes $assetTypes, $id)
    {
        $type = new AssetTypes();
        $type->delete($id);
        return back();
        // echo $id;
    }
}
