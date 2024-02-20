<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompaniesRequest;
use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.index');
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
    public function store(CompaniesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Companies $companies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Companies $companies)
    {
        //
    }
}
