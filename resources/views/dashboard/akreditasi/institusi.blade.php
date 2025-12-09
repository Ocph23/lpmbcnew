@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <h2 class="mb-4 font-bold text-xl">Sertifikat Institusi</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('dashboard.akreditasidb.updateinstitusi') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="file">Pilih Sertifikat:</label>
                <input type="file" name="file" id="file" onchange="previewFile(event)">
            </div>

            <div id="preview-container" class="w-full min-h-[60%]" style=" margin-top:10px;">
                <img id="preview" class="h-full w-full" src="/storage/sertifikat/{{ $filename }}" alt="Preview"
                    style="">
            </div>

            <div style="margin-top: 20px; display:flex; justify-content: center">
                <button style="width: 150px" class="btn btn-primary text-center mt-10" type="submit">Upload</button>
            </div>
        </form>
    </div>
@endsection

<script>
    function previewFile(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
            preview.style.display = 'none';
        }
    }
</script>
