<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        return Admin::all();
    }

    public function store(Request $request)
    {
        return Admin::create($request);
    }

    public function show(string $id)
    {
        return Admin::where('admin_id', $id)->firstOrFail();
    }

    public function update(Request $request, string $id)
    {
        // fejlesztés alatt
    }

    public function destroy(string $id)
    {
        // fejlesztés alatt
    }

    public function adminListaABC()
    {
        return Admin::orderBy('teljes_nev')->get();
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'jelszo' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Hiányzó vagy hibás mezők'], 400);
        }

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->jelszo, $admin->jelszo_hash)) {
            return response()->json(['error' => 'Hibás email vagy jelszó'], 401);
        }

        return response()->json(['success' => true]);
    }
}
