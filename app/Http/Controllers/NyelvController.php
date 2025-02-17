<?php

namespace App\Http\Controllers;

use App\Models\Nyelv;
use Illuminate\Http\Request;

class NyelvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Nyelv::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Nyelv::create($request);
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

    public function hasznaltNyelvek()
    {
        return Nyelv::whereHas('filmek')->get();
    }
}
