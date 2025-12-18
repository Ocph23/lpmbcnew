<?php

// app/Http/Resources/InstrumenAkreditasiResource.php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstrumenAkreditasiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'kode' => $this->kode,
            'nama' => $this->nama,
            'sasaran' => $this->sasaran,
            'auth' => auth()->check(),
            'document_path' => $this->jenis_document == 'Upload' ? '/storage/' . $this->document_path : $this->document_path,
        ];
    }
}
