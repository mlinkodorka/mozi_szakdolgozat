<?php

namespace App\Http\Controllers;

use App\Models\Foglalas_fizetes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FoglalasokFizetesekController extends Controller
{
    public function index()
    {
        return Foglalas_fizetes::all();
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'vetites' => 'required|exists:vetitesek,vetites_id',
            'vasarlo_email' => 'required|email',
            'lefoglalt_jegyek_szama' => 'required|integer|min:1',
            'vasarlo_foglalt_e' => 'required|boolean',
            'lejar' => 'required|date',
            'fizetve_van_e' => 'required|boolean',
            'kifizetes_ideje' => 'nullable|date',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => 'Hibás adatok',
                'errors' => $validated->errors()
            ], 422);
        }

        $foglalas = Foglalas_fizetes::create($validated->validated());

        return response()->json($foglalas, 201);
    }

    public function show(string $id)
    {
        return Foglalas_fizetes::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $foglalas = Foglalas_fizetes::findOrFail($id);
        $foglalas->update($request->all());
        return response()->json($foglalas);
    }

    public function destroy(string $id)
    {
        $foglalas = Foglalas_fizetes::findOrFail($id);
        $foglalas->delete();
        return response()->json(['message' => 'Törölve']);
    }

    public function foglalasokVetitesSzerint()
    {
        return Foglalas_fizetes::select('vetites', DB::raw('count(*) as foglalasok_szama'))
                               ->groupBy('vetites')
                               ->get();
    }
}
