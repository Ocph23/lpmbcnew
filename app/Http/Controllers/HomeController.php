<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akreditasi;
use App\Models\Agenda;   // <-- tambahkan ini
use App\Models\Amilink;
use App\Models\Document;
use App\Models\DokumenMutu;
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
        $spmes = ['borang_akreditasi', 'hasil_akreditasi',  'tindaklanjut_akreditasi'];

        $laporans = DokumenMutu::whereIn('kategori', $spmes)->where('sasaran', 'Eksternal')
            ->get();
        return view('laporanspme', compact('laporans'));
    }

    public function spmi()
    {
        $spmis = [
            'kebijakan_spmi',
            'manual_mutu',
            'standar_spmi',
            'prosedur_mutu',
            'formulir_spmi',
            'prosedur_kerja',
            'standar_upps_unit'
        ];

        $laporans = DokumenMutu::whereIn('kategori', $spmis)->where('sasaran', 'Eksternal')
            ->get();
        return view('laporanspmi', compact('laporans'));
    }

    public function pusatdata()
    {
        $laporans = Laporan::where('document_type', 'pusatdata')
            ->get();
        return view('laporanpusatdata', compact('laporans'));
    }
    public function pengolahanmutu($param)
    {

        $documents = collect([
            ['kode' => 'spmi', 'kategori' => 'kebijakan_spmi', 'title' => 'Kebijakan SPMI', 'unit' => false],
            ['kode' => 'spmi', 'kategori' => 'manual_mutu', 'title' => 'Manual Mutu', 'unit' => false],
            ['kode' => 'spmi', 'kategori' => 'standar_spmi', 'title' => 'Standar SPMI', 'unit' => false],
            ['kode' => 'spmi', 'kategori' => 'prosedur_mutu', 'title' => 'Prosedur Mutu', 'unit' => false],
            ['kode' => 'spme', 'kategori' => 'borang_akreditasi', 'title' => 'Borang Akreditasi', 'unit' => false],
            ['kode' => 'spme', 'kategori' => 'hasil_akreditasi', 'title' => 'Hasil Akreditasi', 'unit' => false],
            ['kode' => 'spme', 'kategori' => 'tindaklanjut_akreditasi', 'title' => 'Tindaklanjut Akreditasi', 'unit' => false],
            ['kode' => 'spmi', 'kategori' => 'formulir_spmi', 'title' => 'Formulir SPMI', 'unit' => true],
            ['kode' => 'spmi', 'kategori' => 'prosedur_kerja', 'title' => 'Prosedur Kerja', 'unit' => true],
            ['kode' => 'spmi', 'kategori' => 'standar_upps_unit', 'title' => 'Standar UPPS|Unit', 'unit' => true],
        ]);

        $document = $documents->firstWhere('kategori', $param);

        $title = $document['title'];
        $laporans = DokumenMutu::where('kategori', $param)
            ->get();
        return view('pengolahanmutu', compact('laporans', 'title'));
    }


    public function instrumentami()
    {
        $amilink = Amilink::first();
        return response()->json(['url' => $amilink->instrumenami]);
    }
    public function hasilami()
    {
        $amilink = Amilink::first();
        return response()->json(['url' => $amilink->dokumenhasilami]);
    }
}
