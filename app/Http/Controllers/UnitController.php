<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::with('parent', 'headUser')->get();
        return view('admin.units.index', compact('units'));
    }

    public function create()
    {
        $allUnits = Unit::orderBy('unit_name')->get();
        $users = User::orderBy('name')->get();
        return view('admin.units.create', compact('allUnits', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_code' => 'required|string|max:20|unique:units',
            'unit_name' => 'required|string|max:200',
            'unit_type' => 'required|in:fakultas,prodi,bureau,lab',
            'parent_unit_id' => 'nullable|exists:units,id',
            'head_user_id' => 'nullable|exists:users,id',
        ]);

        Unit::create($request->all());

        return redirect()->route('units.index')->with('success', 'Unit created successfully.');
    }

    public function show(Unit $unit)
    {
        $unit->load('parent', 'headUser');
        return view('admin.units.show', compact('unit'));
    }

    public function edit(Unit $unit)
    {
        $allUnits = Unit::where('id', '!=', $unit->id)->orderBy('unit_name')->get();
        $users = User::orderBy('name')->get();
        return view('admin.units.edit', compact('unit', 'allUnits', 'users'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'unit_code' => 'required|string|max:20|unique:units,unit_code,' . $unit->id,
            'unit_name' => 'required|string|max:200',
            'unit_type' => 'required|in:fakultas,prodi,bureau,lab',
            'parent_unit_id' => 'nullable|exists:units,id',
            'head_user_id' => 'nullable|exists:users,id',
        ]);

        $unit->update($request->all());

        return redirect()->route('units.index')->with('success', 'Unit updated successfully.');
    }

    public function destroy(Unit $unit)
    {
        // Optional: prevent deletion if it has children
        if ($unit->children()->exists()) {
            return redirect()->route('units.index')
                ->with('error', 'Cannot delete unit with child units.');
        }

        $unit->delete();
        return redirect()->route('units.index')->with('success', 'Unit deleted successfully.');
    }
}
