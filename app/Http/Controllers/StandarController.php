<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Standar;

class StandarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $standars = Standar::all();
        return view('admin.standars.index', compact('standars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.standars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'standar_code' => 'required|string|max:20|unique:standars',
            'standar_name' => 'required|string|max:200',
            'description' => 'nullable|string',
            'category' => 'required|in:akademik,non-akademik',
            'weight' => 'required|numeric|min:0',
        ]);

        Standar::create($request->all());

        return redirect()->route('standars.index')
            ->with('success', 'Standar created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Standar $standar)
    {
        return view('admin.standars.show', compact('standar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Standar $standar)
    {
        return view('admin.standars.edit', compact('standar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Standar $standar)
    {
        $request->validate([
            'standar_code' => 'required|string|max:20|unique:standars,standar_code,' . $standar->id,
            'standar_name' => 'required|string|max:200',
            'description' => 'nullable|string',
            'category' => 'required|in:akademik,non-akademik',
            'weight' => 'required|numeric|min:0',
        ]);

        $standar->update($request->all());

        return redirect()->route('standars.index')
            ->with('success', 'Standar updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Standar $standar)
    {
        $standar->delete();

        return redirect()->route('standars.index')
            ->with('success', 'Standar deleted successfully.');
    }
}
