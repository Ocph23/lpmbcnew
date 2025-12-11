<?php

namespace App\Http\Controllers\AdminLPM;

use App\Http\Controllers\Controller;
use App\Models\Auditor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuditorController extends Controller
{
    //

    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Auditor::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        }

        $auditors = $query->get();

        return Inertia::render('Auditors/Index', [
            'auditors' => $auditors,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Auditors/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:auditors,email',
            'phone' => 'nullable|string|max:20',
            'kategori' => 'required|integer|in:1,2,3',
        ]);

        Auditor::create($request->only(['name', 'email', 'phone', 'kategori']));

        return to_route('auditors.index')->with('success', 'Auditor berhasil ditambahkan.');
    }

    public function edit(Auditor $auditor)
    {
        return Inertia::render('Auditors/Edit', compact('auditor'));
    }

    public function update(Request $request, Auditor $auditor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:auditors,email,' . $auditor->id,
            'phone' => 'nullable|string|max:20',
            'kategori' => 'required|integer|in:1,2,3',
        ]);

        $auditor->update($request->only(['name', 'email', 'phone', 'kategori']));

        return to_route('auditors.index')->with('success', 'Auditor berhasil diperbarui.');
    }

    public function destroy(Auditor $auditor)
    {
        $auditor->delete();
        return to_route('auditors.index')->with('success', 'Auditor berhasil dihapus.');
    }
}
