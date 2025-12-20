<?php

namespace App\Http\Controllers\AdminLPM;

use App\Http\Controllers\Controller;
use App\Models\CalendarAcademic;
use App\Rules\HexColor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CalendarAcademicController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $query = CalendarAcademic::query();

        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        // Filter berdasarkan bulan/tahun
        $query->whereYear('start_time', $year)
            ->whereMonth('start_time', $month);

        $calendars = $query->get();

        // Siapkan data kalender
        $calendarData = [];
        foreach ($calendars as $calendar) {
            $dateKey = $calendar->start_time->toDateString();
            if (!isset($calendarData[$dateKey])) {
                $calendarData[$dateKey] = [];
            }
            $calendarData[$dateKey][] = $calendar;
        }

        // Hitung hari pertama dan terakhir bulan ini
        $firstDayOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $lastDayOfMonth = Carbon::createFromDate($year, $month, 1)->endOfMonth();

        // Buat array hari dalam bulan
        $daysInMonth = [];
        for ($day = 1; $day <= $lastDayOfMonth->day; $day++) {
            $date = Carbon::createFromDate($year, $month, $day);
            $daysInMonth[] = [
                'day' => $day,
                'date' => $date,
                'calendars' => $calendarData[$date->toDateString()] ?? [],
            ];
        }

        // Hitung hari minggu sebelumnya (untuk menampilkan akhir bulan sebelumnya)
        $daysBefore = [];
        $firstDayOfWeek = $firstDayOfMonth->dayOfWeek; // 0=Sun, 1=Mon, ..., 6=Sat
        for ($i = 0; $i < $firstDayOfWeek; $i++) {
            $prevDate = $firstDayOfMonth->copy()->subDays($firstDayOfWeek - $i);
            $daysBefore[] = [
                'day' => $prevDate->day,
                'date' => $prevDate,
                'isCurrentMonth' => false,
                'calendars' => [],
            ];
        }

        // Gabungkan
        $calendarDays = array_merge($daysBefore, $daysInMonth);

        // Kelompokkan per minggu
        $weeks = [];
        foreach (array_chunk($calendarDays, 7) as $week) {
            $weeks[] = $week;
        }

        return Inertia::render('Calendars/Index', [
            'calendars' => $calendars,
            'calendarDays' => $calendarDays,
            'weeks' => $weeks,
            'currentMonth' => $firstDayOfMonth->format('F Y'),
            'month' => $month,
            'year' => $year,
            'filters' => $request->only(['search', 'month', 'year']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Calendars/Create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date_format:Y-m-d\TH:i',
            'end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
            'color' => ['required', new \App\Rules\HexColor],
        ]);

        CalendarAcademic::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'color' => $request->color ?: '#60A5FA',
        ]);

        return to_route('calendars.index')->with('success', 'Acara berhasil ditambahkan.');
    }

    public function edit(CalendarAcademic $calendar)
    {
        return Inertia::render('Calendars/Edit', compact('calendar'));
    }

    public function update(Request $request, CalendarAcademic $calendar)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date_format:Y-m-d H:i',
            'end_time' => 'required|date_format:Y-m-d H:i|after:start_time',
            'color' => 'nullable|regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
        ]);

        $calendar->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'color' => $request->color ?: '#60A5FA',
        ]);

        return to_route('calendars.index')->with('success', 'Acara berhasil diperbarui.');
    }

    public function destroy(CalendarAcademic $calendar)
    {
        $calendar->delete();
        return to_route('calendars.index')->with('success', 'Acara berhasil dihapus.');
    }
}
