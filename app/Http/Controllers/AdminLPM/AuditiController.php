<?php

namespace App\Http\Controllers\AdminLPM;

use App\Models\Auditi;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class AuditiController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Auditi::with('head');

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $auditis = $query->get();
        $users = User::all(['id', 'name']);

        return Inertia::render('Auditis/Index', [
            'auditis' => $auditis,
            'users' => $users,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        $users = User::all(['id', 'name']);
        return Inertia::render('Auditis/Create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'head_id' => 'nullable|exists:users,id',
        ]);

        Auditi::create($request->only(['name', 'head_id']));

        return to_route('auditis.index')->with('success', 'Auditi berhasil ditambahkan.');
    }

    public function edit(Auditi $auditi)
    {
        $users = User::all(['id', 'name']);
        return Inertia::render('Auditis/Edit', compact('auditi', 'users'));
    }

    public function update(Request $request, Auditi $auditi)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'head_id' => 'nullable|exists:users,id',
        ]);

        $auditi->update($request->only(['name', 'head_id']));

        return to_route('auditis.index')->with('success', 'Auditi berhasil diperbarui.');
    }

    public function destroy(Auditi $auditi)
    {
        $auditi->delete();
        return to_route('auditis.index')->with('success', 'Auditi berhasil dihapus.');
    }
}
