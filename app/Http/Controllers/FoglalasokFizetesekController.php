<?php

namespace App\Http\Controllers;

use App\Models\Foglalas_fizetes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FoglalasokFizetesekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Foglalas_fizetes::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Foglalas_fizetes::create($request);
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

    public function foglalasokVetitesSzerint()
    {
        return Foglalas_fizetes::select('vetites', DB::raw('count(*) as foglalasok_szama'))
                               ->groupBy('vetites')
                               ->get();
    }
}
