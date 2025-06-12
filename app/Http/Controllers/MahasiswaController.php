<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MahasiswaController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8080/mahasiswa');
        if ($response->successful()) {
            $data = $response->json();
            return view('mahasiswa.index', ['datas' => $data]);
        }
        return response()->json(['error' => 'gagal mengambil data'], 500);
    }

    public function create()
    {
        return view('mahasiswa.input');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required',
            'email' => 'required|email',
            'prodi' => 'required',
        ]);
        $response = Http::post('http://localhost:8080/mahasiswa', [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'prodi' => $request->prodi,
        ]);
        if ($response->successful()) {
            return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
        }
        return back()->with('error', 'Gagal menambahkan data mahasiswa.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $response = Http::get('http://localhost:8080/mahasiswa/' . $id);
        if ($response->successful()) {
            $data = $response->json();
            return view('mahasiswa.edit', ['data' => $data]);
        }
        return response()->json(['error' => 'gagal mengambil data'], 500);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required',
            'email' => 'required|email',
            'prodi' => 'required',
        ]);

        $response = Http::put('http://localhost:8080/mahasiswa/' . $id, $validated);

        if ($response->successful()) {
            return redirect()->route('mahasiswa.index')->with('success', 'Data dosen berhasil diperbarui.');
        } else {
            return back()->with('error', 'Gagal memperbarui data dosen.');
        }
    }

    public function destroy(string $id)
{
    $response = Http::delete("http://localhost:8080/mahasiswa/" . $id);

    if ($response->successful()) {
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
    return back()->with('error', 'Gagal menghapus data mahasiswa.');
}

}
