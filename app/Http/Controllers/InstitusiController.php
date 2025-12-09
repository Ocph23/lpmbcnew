<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akreditasi;

class InstitusiController extends Controller
{
    public function index()
    {
        return view('akreditasi.institusi');
    }
}
