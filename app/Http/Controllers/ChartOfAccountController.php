<?php

namespace App\Http\Controllers;

use App\Models\AccountGroup;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use PDF;

class ChartOfAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = AccountGroup::whereNull('parent_id')->with('children', 'accounts')->get();

        // echo  json_encode( $groups[0]->children);

        return View('pages.accounts.reports.chartofaccountpdf', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function printPdf()
    {
        $groups = AccountGroup::whereNull('parent_id')->with('children', 'accounts')->get();

        // echo  json_encode( $groups[0]->children);

        $pdf = PDF::loadView('pages.accounts.reports.chartofaccountpdf', compact('groups') );

        return $pdf->download('chartofaccount.pdf');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
