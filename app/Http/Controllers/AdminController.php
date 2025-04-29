<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
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
        $validated = $request->validate([
            'felhasznalonev' => 'required|string|unique:admin,felhasznalonev',
            'jelszo' => 'required|string|min:6',
            'teljes_nev' => 'required|string',
            'szuletesi_datum' => 'required|date',
            'email' => 'required|email|unique:admin,email',
            'telefonszam' => 'nullable|string',
            'role' => 'required|in:admin,superadmin',
        ]);
    
        $admin = Admin::create([
            'felhasznalonev' => $validated['felhasznalonev'],
            'jelszo_hash' => bcrypt($validated['jelszo']),
            'teljes_nev' => $validated['teljes_nev'],
            'szuletesi_datum' => $validated['szuletesi_datum'],
            'email' => $validated['email'],
            'telefonszam' => $validated['telefonszam'] ?? null,
            'role' => $validated['role'],
        ]);
    
        return response()->json(['message' => 'Admin sikeresen létrehozva!', 'admin_id' => $admin->admin_id], 201);
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

    public function createAdmin(Request $request)
    {
        if (!$request->user() || !$request->user()->isSuperAdmin()) {
            return response()->json(['error' => 'Unauthorized - Only superadmins can create new admins'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,superadmin',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return response()->json($user, 201);
    }
}
