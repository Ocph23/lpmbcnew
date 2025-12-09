<?php

// app/Http/Resources/DokumenMutuResource.php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DokumenMutuResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'kode' => $this->kode,
            'nama' => $this->nama,
            'kategori' => $this->kategori,
            'sasaran' => $this->sasaran,
            'auth' => auth()->check(),
            'document_path' => (auth()->check() && $this->sasaran == 'Internal') || $this->sasaran != 'Internal' ? $this->document_path : null,
            'unit' => $this->unit,
            // ... field lainnya ...
        ];
    }
}
