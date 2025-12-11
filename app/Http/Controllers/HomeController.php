<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akreditasi;
use App\Models\Agenda;   // <-- tambahkan ini
use App\Models\Document;
use App\Models\Identitas;
use App\Models\Laporan;
use App\Models\Standar;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {

        // Ambil data akreditasi
        $data = Akreditasi::first();

        // Ambil hanya 3 agenda terbaru
        $agendas = Agenda::orderBy('start_date', 'asc')->limit(3)->get();

        return view('home', compact('data', 'agendas'));
    }


    public function institusi()
    {
        $filename = "sertifikat_institusi.png";
        $data = ["filename" => $filename];
        return view('akreditasi.institusi', compact('filename'));
    }


    public function sejarah()
    {
        $identitas = Identitas::first();
        $sejarah = $identitas ? $identitas->sejarah : '';
        return view('sejarah', compact('sejarah'));
    }

    public function visi()
    {
        $identitas = Identitas::first();
        $visimisi = $identitas ? $identitas->visimisi : '';
        return view('visi', compact('visimisi'));
    }

    public function struktur()
    {
        $identitas = Identitas::first();
        $struktur = $identitas ? $identitas->struktur_organisasi_path : '';
        return view('struktur', compact('struktur'));
    }


    public function downloads()
    {
        $documents = Document::with('unit', 'standard', 'uploadedBy')
            ->latest()
            ->get();
        return view('downloads', compact('documents'));
    }


    public function spme()
    {
        $laporans = Laporan::where('document_type', 'spme')
            ->get();
        return view('laporanspme', compact('laporans'));
    }

    public function spmi()
    {
        $laporans = Laporan::where('document_type', 'spmi')
            ->get();
        return view('laporanspmi', compact('laporans'));
    }

    public function pusatdata()
    {
        $laporans = Laporan::where('document_type', 'pusatdata')
            ->get();
        return view('laporanpusatdata', compact('laporans'));
    }
}
