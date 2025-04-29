<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Film::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'szinkronos-e' => filter_var($request->input('szinkronos-e'), FILTER_VALIDATE_BOOLEAN),
            'hagyományos-e' => filter_var($request->input('hagyományos-e'), FILTER_VALIDATE_BOOLEAN),
        ]);
    
        $validated = $request->validate([
            'film_cime' => 'required|string|max:255',
            'film_evszam' => 'required|integer',
            'szinkronos-e' => 'required|boolean',
            'hagyományos-e' => 'required|boolean',
            'film_nyelve' => 'required|string',
            'film_hossza' => 'required|integer',
            'boritokep' => 'nullable|image|max:2048',
        ]);
    
        if ($request->hasFile('boritokep')) {
            $path = $request->file('boritokep')->store('boritokepek', 'public');
            $validated['boritokep'] = $path;
        }
    
        $film = Film::create($validated);
    
        return response()->json($film, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $film = Film::find($id);

        if (!$film) {
            return response()->json(['message' => 'Film nem található'], 404);
        }

        return response()->json($film);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $film = Film::find($id);

        if (!$film) {
            return response()->json(['message' => 'Film nem található'], 404);
        }

        $validated = $request->validate([
            'film_cime' => 'required|string|max:255',
            'film_evszam' => 'required|integer',
            'film_hossza' => 'required|integer|min:1',
            'szinkronos-e' => 'required|boolean',
            'hagyományos-e' => 'required|boolean',
            'film_nyelve' => 'required|string|exists:nyelvek,nyelvkod',
        ]);
    
        $film->update($validated);
    
        return response()->json($film);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $film = Film::find($id);

        if (!$film) {
            return response()->json(['message' => 'Film nem található'], 404);
        }

        $film->delete();
        return response()->json(['message' => 'Film törölve sikeresen']);
    }

    public function filmekNyelvSzerint($nyelvkod)
    {
        return Film::where('film_nyelve', $nyelvkod)->get();
    }

    public function filmekEvSzerint($ev)
    {
        return Film::where('film_evszam', $ev)->get();
    }
}
