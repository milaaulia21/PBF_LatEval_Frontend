<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DosenController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8080/dosen');
        if ($response->successful()) {
            $data = collect($response->json())->sortBy('id');
            return view('dosen.index', ['data' => $data]);
        }
        return response()->json(['error' => 'gagal mengambil data'], 500);
    }


    public function create()
    {
        return view('dosen.input');
    }



    public function store(Request $request)
    {
        $response = Http::post('http://localhost:8080/dosen', [
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'email' => $request->email,
            'prodi' => $request->prodi,
        ]);
        return redirect('/');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $response = Http::get('http://localhost:8080/dosen/' . $id);
        if ($response->successful()) {
            $data = $response->json();
            return view('dosen.edit', ['data' => $data]);
        }
        return response()->json(['error' => 'gagal mengambil data'], 500);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nidn' => 'required',
            'email' => 'required|email',
            'prodi' => 'required',
        ]);

        $response = Http::put('http://localhost:8080/dosen/' . $id, $validated);

        if ($response->successful()) {
            return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
        } else {
            return back()->with('error', 'Gagal memperbarui data dosen.');
        }
    }


    public function destroy(string $id)
    {
        $response = Http::delete('http://localhost:8080/dosen/' . $id);
        if ($response->successful()) {
            return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus.');
        }
        return back()->with('error', 'Gagal menghapus data dosen.');
    }
}
