<?php

namespace App\Http\Controllers;

use App\Models\Terem;
use Illuminate\Http\Request;

class TeremController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Terem::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Terem::create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
