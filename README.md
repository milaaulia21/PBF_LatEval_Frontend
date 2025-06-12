## File Backend
1. Clone
2. Rename env jd .env, sesuaikan dg database
3. Buat database, insert tabel
4. Ubah folder app/config/routes sesuaikan dg tabel
```
   <?php

use CodeIgniter\Router\RouteController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('mahasiswa', function($routes) {
    $routes->get('/', 'MahasiswaController::index');
    $routes->get('(:num)', 'MahasiswaController::show/$1');
    $routes->post('/', 'MahasiswaController::create');
    $routes->put('(:num)', 'MahasiswaController::update/$1');
    $routes->delete('(:num)', 'MahasiswaController::delete/$1');
});

$routes->group('mahasiswa', function($routes) {
    $routes->get('/', 'DosenController::index');
    $routes->get('(:num)', 'DosenController::show/$1');
    $routes->post('/', 'DosenController::create');
    $routes->put('(:num)', 'DosenController::update/$1');
    $routes->delete('(:num)', 'DosenController::delete/$1');
});
```

5. Ubah app/config/controller sesuaikan dg tabel
File Dosen.php atau DosenController.php
  ```
  <?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class Dosen extends ResourceController
{
       protected $modelName = 'App\Models\DosenModel';
    protected $format    = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
            $data = $this->model->findAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
          $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        }
        return $this->failNotFound('Dosen tidak ditemukan');
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
         $input = $this->request->getJSON(true);
        $this->model->insert($input);
        return $this->respondCreated($input);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $input = $this->request->getJSON(true);
        $this->model->update($id, $input);
        return $this->respond(['status' => 'updated']);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $this->model->delete($id);
        return $this->respondDeleted(['status' => 'deleted']);
    }
}
```

File Mahasiswa.php atau MahasiswaController.php
```
<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class Mahasiswa extends ResourceController
{
      protected $modelName = 'App\Models\MahasiswaModel';
    protected $format    = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
           $data = $this->model
            ->select('mahasiswa.*, dosen.nama as dosen_wali')
            ->join('dosen', 'dosen.id = mahasiswa.dosen_wali_id')
            ->findAll();

        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
         $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        }
        return $this->failNotFound('Mahasiswa tidak ditemukan');
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $input = $this->request->getJSON(true);
        $this->model->insert($input);
        return $this->respondCreated($input);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
       $input = $this->request->getJSON(true);
        $this->model->update($id, $input);
        return $this->respond(['status' => 'updated']);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
         $this->model->delete($id);
        return $this->respondDeleted(['status' => 'deleted']);
    }
}
```

6. Ubah app/config/model sesuaikan dg tabel
File DosenModel.php
```
<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table            = 'dosen';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'nama',
        'nidn',
        'email',
        'prodi'
    ];
}
```
File MahasiswaModel.php
```
<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'nim',
        'email',
        'prodi'
    ];
}
```

## 🛠️ EVALUASI PBF
### 1. Clone Repository
Clone repositori backend ke dalam direktori lokal:
```
git clone https://github.com/abdau88/eval_pbf_backend.git eval_pbf_backend
cd eval_pbf_backend
```

### 2. Install Dependensi
Install semua dependensi yang dibutuhkan menggunakan Composer:
```
composer install
```

### 3. Konfigurasi Environment
Salin file .env.example menjadi .env dan atur konfigurasi database:
```
cp env .env
```

Edit file .env dan sesuaikan dengan koneksi database lokal kamu:
```
database.default.hostname = localhost
database.default.database = nama_database_anda
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

### 4. Buat Database dan Import Dummy Data
Buat database baru di MySQL, misalnya: evaluasi_pbf
Import file SQL berikut ke dalam database tersebut:
```
CREATE TABLE `dosen` (
  `nama` varchar(100) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  PRIMARY KEY (`nidn`)
);

INSERT INTO `dosens` (`nama`, `nidn`, `email`, `prodi`) VALUES
('Dr. Bambang', '12345678', 'bambang@kampus.ac.id', 'Teknik Informatika'),
('Dr. Siti', '87654321', 'siti@kampus.ac.id', 'Sistem Informasi');

CREATE TABLE `mahasiswa` (
  `nama` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  PRIMARY KEY (`npm`)
);

INSERT INTO `mahasiswas` (`nama`, `nim`, `email`, `prodi`) VALUES
('Andi Saputra', '210001', 'andi@kampus.ac.id', 'Teknik Informatika'),
('Rina Melati', '210002', 'rina@kampus.ac.id', 'Sistem Informasi');
```

### 5. Jalankan Server Development
```
php spark serve
```
Server akan berjalan di http://localhost:8080

### 6. Cek Endpoint API Menggunakan Postman
Gunakan Postman untuk mengetes endpoint berikut:

1. Dosen
- GET → http://localhost:8080/dosen
- POST → http://localhost:8080/dosen
- PUT → http://localhost:8080/dosen/{id}
- DELETE → http://localhost:8080/dosen/{id}
2. Mahasiswa
- GET → http://localhost:8080/mahasiswa
- POST → http://localhost:8080/mahasiswa
- PUT → http://localhost:8080/mahasiswa/{id}
- DELETE → http://localhost:8080/mahasiswa/{id}
  
### 7. Tugas Mahasiswa (Frontend Laravel)
Buatlah tampilan frontend menggunakan Laravel yang dapat melakukan CRUD data Dosen dan Mahasiswa dengan mengonsumsi API di atas.




## File Frontend
1. Buat file di cmd (composer create-project laravel/laravel namaprojek) 
2. Sesuaikan routes/web.php sesuaikan dg tabel
3. Buka terminal (php artisan make:controller DosenController)
4. Buat folder dosen di views
create. blade. php
edit. blade. php
index. blade. php
5. download bootstrap
pindah file bootstrap ke folder fe bagian public


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
