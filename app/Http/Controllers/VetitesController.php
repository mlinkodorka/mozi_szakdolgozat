<?php

namespace App\Http\Controllers;

use App\Models\Vetites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VetitesController extends Controller
{
    public function index()
    {
        return Vetites::with('film')->get(); 
        }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'film' => 'required|exists:filmek,film_id',
            'terem' => 'required|exists:termek,terem_id',
            'kezdes_ideje' => 'required|date',
            'publikus_e' => 'required|boolean',
            'jegy_ara' => 'required|integer|min:0',
            'szabad_helyek_szama' => 'required|integer|min:0',
            'foglalt_helyek_szama' => 'required|integer|min:0',
        ]);
    
        return Vetites::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    $vetites = Vetites::with('film')->find($id);

    if (!$vetites) {
        return response()->json(['error' => 'Vetítés nem található'], 404);
    }

    return response()->json($vetites);
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
