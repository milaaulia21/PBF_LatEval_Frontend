<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Dosen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Form Input Dosen</h2>

        {{-- Tampilkan pesan sukses atau error --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('dosen.store') }}" method="POST">
            @csrf
            <!-- <div class="form-group">
                <label for="idDosen">ID Dosen</label>
                <input type="text" class="form-control" id="idDosen" name="idDosen" required>
            </div> -->
            <div class="form-group">
                <label for="nama">Nama Dosen</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="nidn">NIDN</label>
                <input type="text" class="form-control" id="nidn" name="nidn" required>
            </div>
            <div class="form-group">
                <label for="prodi">Program Studi</label>
                <input type="text" class="form-control" id="prodi" name="prodi" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

    </div>
</body>
</html>
