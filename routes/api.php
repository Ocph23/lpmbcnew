<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/upload-image', function (Request $request) {
    $request->validate([
        'file' => 'required|image|max:5120',
    ]);
    $filename = $request->file('file')->store('uploads', 'public');

    return response()->json([
        'url' => asset('storage/' . $filename),
    ]);
});
