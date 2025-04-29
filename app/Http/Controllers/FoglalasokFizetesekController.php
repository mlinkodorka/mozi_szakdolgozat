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

    public function fizetesVegrehajtasa($id)
{
    $foglalas = Foglalas_fizetes::find($id);
    if (!$foglalas) {
        return response()->json(['message' => 'Foglalás nem található'], 404);
    }

    $foglalas->fizetve_van_e = true;
    $foglalas->kifizetes_ideje = now();
    $foglalas->save();

    return response()->json(['message' => 'Fizetés rögzítve', 'foglalas' => $foglalas]);
}

public function eladas(Request $request)
{
    $request->validate([
        'vetites_id' => 'required|exists:vetitesek,vetites_id',
        'darab' => 'required|integer|min:1',
        'vasarlo_email' => 'nullable|email'
    ]);

    $vetites = \App\Models\Vetites::findOrFail($request->vetites_id);

    if ($vetites->szabad_helyek_szama < $request->darab) {
        return response()->json(['error' => 'Nincs elég szabad hely'], 400);
    }

    $foglalas = Foglalas_fizetes::create([
        'vetites' => $vetites->vetites_id,
        'lefoglalt_jegyek_szama' => $request->darab,
        'vasarlo_foglalt_e' => false,
        'vasarlo_email' => $request->vasarlo_email ?? 'admin@mozi.hu',
        'lejar' => now(),
        'fizetve_van_e' => true,
        'kifizetes_ideje' => now()
    ]);

    $vetites->increment('foglalt_helyek_szama', $request->darab);
    $vetites->decrement('szabad_helyek_szama', $request->darab);

    return response()->json(['message' => 'Jegyek eladva', 'foglalas' => $foglalas], 201);
}

}
