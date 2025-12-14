@extends('layouts.app') {{-- Layout utama kamu --}}

@section('title', 'Rencana Kerja LPM - Universitas Muhammadiyah Papua')

@section('content')
    <div class="renker-container">
        <img src="{{ asset('images/UMPPapua.png') }}" alt="Logo Universitas Muhammadiyah Papua" class="renker-logo">

        <h2>LAPORAN BIDANG SPME</h2>


        <table class="table" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>File Unduhan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporans as $laporan)
                    <tr>
                        <td style="max-width: 60px">{{ $loop->index + 1 }}</td>
                        <td style="max-width: 100px">
                            {{ $laporan->kode }}
                        </td>
                        <td>
                            <a href="{{ $laporan->document_path }}" target="_blank" rel="noopener noreferrer">
                                <button
                                    style="cursor: pointer; width: 100%;color: white;background-color: rgb(65, 146, 253); border: transparent; padding: 10px">
                                    {{ $laporan->nama }}
                                </button>
                            </a>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
@endsection


<style>
    table {
        width: 100%
    }

    td,
    th {
        padding: 10px;
        border: 1px solid rgb(167, 167, 167)
    }
</style>
