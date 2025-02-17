<?php

namespace App\Http\Controllers;

use App\Models\Vetites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VetitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Vetites::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Vetites::create($request);
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

    public function vetitesekTeremSzerint($terem_id)
    {
        return Vetites::where('terem', $terem_id)->get();
    }

    public function szabadHelyek($vetites_id)
    {
        $vetites = Vetites::find($vetites_id);
        return $vetites ? $vetites->szabad_helyek_szama : response()->json(['error' => 'Nincs ilyen vetítés'], 404);
    }

    public function vetitesekIdoszakban($start, $end)
    {
        return Vetites::whereBetween('kezdes_ideje', [$start, $end])->get();
    }

    public function legnepszerubbVetites()
    {
        return Vetites::withCount('foglalasok')
                      ->orderBy('foglalasok_count', 'desc')
                      ->first();
    }

    public function vetitesekSzamaTeremSzerint()
    {
        return Vetites::select('terem', DB::raw('count(*) as vetitesek_szama'))
                      ->groupBy('terem')
                      ->get();
    }
}
