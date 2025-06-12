<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class DashboardController extends Controller
{
    //
    public function index()
    {
        $jumlahMahasiswa = count(Http::get('http://localhost:8080/mahasiswa')->json());
        $jumlahDosen = count(Http::get('http://localhost:8080/dosen')->json());
        
        return view('welcome', [
            'jumlahMahasiswa' => $jumlahMahasiswa,
            'jumlahDosen' => $jumlahDosen,
        ]);
    }
}

