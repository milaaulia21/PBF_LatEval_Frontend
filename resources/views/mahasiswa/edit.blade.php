<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Dosen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 40px;
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Data Mahasiswa</h2>

        <form action="{{ route('mahasiswa.update',$data['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">NAMA</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{$data['nama'] }}" required>
            </div>

            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="{{$data['nim'] }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$data['email'] }}" required>
            </div>

            <div class="form-group">
                <label for="prodi">PRODI</label>
                <input type="text" class="form-control" id="prodi" name="prodi" value="{{$data['prodi'] }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
