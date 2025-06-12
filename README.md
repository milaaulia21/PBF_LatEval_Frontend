## 🔧 1. Inisialisasi Proyek Laravel
```
laravel new frontend-laravel
cd frontend-laravel
```
Atau jika menggunakan Composer:
```
composer create-project laravel/laravel frontend-laravel
```

## 📦 2. Install Inertia + React (opsional)
Jika ingin menggunakan React + Inertia:
```
composer require inertiajs/inertia-laravel
php artisan inertia:middleware

npm install @inertiajs/inertia @inertiajs/inertia-react react react-dom
npm install
```
Atau tetap gunakan Blade jika tidak perlu React.

## ⚙️ 3. Setup Routing Dasar
routes/web.php
```
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('/mahasiswa', MahasiswaController::class);
Route::resource('/dosen', DosenController::class);
```

## 🧩 4. Buat Controller
```
php artisan make:controller DashboardController
php artisan make:controller MahasiswaController --resource
php artisan make:controller DosenController --resource
```

## 📝 5. Contoh DashboardController
```
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
👤 6. CRUD Mahasiswa dan Dosen
MahasiswaController (cuplikan)
php
Copy
Edit
use Illuminate\Support\Facades\Http;

public function index()
{
    $response = Http::get('http://localhost:8000/api/mahasiswa'); // URL backend CI4
    $mahasiswa = $response->json();
    return view('mahasiswa.index', compact('mahasiswa'));
}

public function create()
{
    return view('mahasiswa.create');
}

public function store(Request $request)
{
    Http::post('http://localhost:8000/api/mahasiswa', $request->all());
    return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa Ditambahkan');
}
```
DosenController (sama seperti MahasiswaController, ubah endpoint API-nya)

## 🖼️ 7. View Mahasiswa (Blade)
resources/views/mahasiswa/create.blade.php
```
@extends('layouts.app')

@section('content')
<h2>Tambah Mahasiswa</h2>
<form action="{{ route('mahasiswa.store') }}" method="POST">
    @csrf
    <label>Nama:</label>
    <input type="text" name="nama" required>
    
    <label>NIM:</label>
    <input type="text" name="nim" required>
    
    <label>Alamat:</label>
    <textarea name="alamat" required></textarea>
    
    <button type="submit">Simpan</button>
</form>
@endsection
```

resources/views/mahasiswa/index.blade.php
```
@extends('layouts.app')

@section('content')
<h2>Daftar Mahasiswa</h2>
<a href="{{ route('mahasiswa.create') }}">Tambah Mahasiswa</a>
<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mahasiswa as $mhs)
        <tr>
            <td>{{ $mhs['nama'] }}</td>
            <td>{{ $mhs['nim'] }}</td>
            <td>{{ $mhs['alamat'] }}</td>
            <td>
                <a href="#">Edit</a> |
                <form method="POST" action="#">
                    @csrf
                    @method('DELETE')
                    <button>Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
```

## 📂 Struktur Folder Views
```
resources/views/
├── layouts/
│   └── app.blade.php
├── dashboard.blade.php
├── mahasiswa/
│   ├── index.blade.php
│   └── create.blade.php
└── dosen/
    ├── index.blade.php
    └── create.blade.php
```

## 🔗 Koneksi API Backend CI4
Pastikan backend CI4 aktif dan API dapat diakses dari frontend Laravel. Contoh endpoint:

- GET /api/mahasiswa

- POST /api/mahasiswa

- GET /api/dosen

- POST /api/dosen
