<?php

namespace App\Http\Controllers\AdminLPM;

use App\Http\Controllers\Controller;
use App\Models\Amilink;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AmilinkController extends Controller
{
    //
    public function index()
    {
        $amilink = Amilink::first();
        return Inertia::render('Auditis/Amilinks', compact('amilink'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'instrumenami' => 'nullable|string',
            'dokumenhasilami' => 'nullable|string',
            'link1' => 'nullable|string',
            'link2' => 'nullable|string',
            'link3' => 'nullable|string',
        ]);

        $amilink = Amilink::firstOrNew();
        $amilink->fill($request->only(['instrumenami', 'dokumenhasilami', 'link1', 'link2', 'link3']));
        $amilink->save();
        return to_route('amilinks.index')->with('success', 'Data  berhasil diperbarui.');
    }
}
