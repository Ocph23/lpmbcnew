<?php

namespace App\Http\Controllers\AdminLPM;

use App\Models\Periode;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class PeriodeController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Periode::query();

        if ($search) {
            $query->where('year', 'like', "%{$search}%")
                ->orWhere('semester', 'like', "%{$search}%");
        }

        $Periodes = $query->get();

        return Inertia::render('Periodes/Index', [
            'Periodes' => $Periodes,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Periodes/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'semester' => 'required|in:1,2',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        Periode::create([
            'year' => $request->year,
            'semester' => $request->semester,
            'description' => $request->description,
            'is_active' => $request->boolean('is_active'),
        ]);

        return to_route('periodes.index')->with('success', 'Periode berhasil ditambahkan.');
    }

    public function edit(Periode $periode)
    {
        return Inertia::render('Periodes/Edit', compact('periode'));
    }

    public function update(Request $request, Periode $Periode)
    {
        $request->validate([
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'semester' => 'required|in:1,2',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $Periode->update([
            'year' => $request->year,
            'semester' => $request->semester,
            'description' => $request->description,
            'is_active' => $request->boolean('is_active'),
        ]);

        return to_route('periodes.index')->with('success', 'Periode berhasil diperbarui.');
    }

    public function destroy(Periode $Periode)
    {
        $Periode->delete();
        return to_route('periodes.index')->with('success', 'Periode berhasil dihapus.');
    }
}
