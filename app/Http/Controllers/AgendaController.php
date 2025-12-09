<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use Carbon\Carbon;

class AgendaController extends Controller
{
    /**
     * Halaman daftar agenda di dashboard (paginate)
     */
    public function index()
    {
        $agendas = Agenda::orderBy('start_date', 'asc')->paginate(3);
        return view('dashboard.calendar', compact('agendas'));
    }

    /**
     * Simpan agenda baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
        ]);

        Agenda::create($request->only('title', 'description', 'start_date', 'end_date'));

        return redirect()->back()->with('success', 'Agenda berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('dashboard.edit_agenda', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
        ]);

        $agenda->update($request->only('title', 'description', 'start_date', 'end_date'));

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus!');
    }

    /**
     * Untuk data ke Fullcalendar (JSON API)
     */
    public function list()
    {
        $events = Agenda::all()->map(fn($item) => [
            'id'    => $item->id,
            'title' => $item->title,
            'start' => Carbon::parse($item->start_date)->format('Y-m-d'),
            'end'   => Carbon::parse($item->end_date)->format('Y-m-d'),
        ]);

        return response()->json($events);
    }
}
