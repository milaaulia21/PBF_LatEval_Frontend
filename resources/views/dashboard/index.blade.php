<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container m-4">
        <h2>Dashboard</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Jumlah Mahasiswa</th>
                    <th>Jumlah Dosen</th>
                </tr>
            </thead>
            <tbody id="data-table-body">
                <tr>
                    <td id="jumlah-mahasiswa">{{$jumlahMahasiswa}}</td>
                    <td id="jumlah-dosen">{{$jumlahDosen}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        const jumlahMahasiswaElement = document.getElementById('jumlah-mahasiswa');
        const jumlahDosenElement = document.getElementById('jumlah-dosen');

        async function ambilDataDashboard() {
            try {
                // Ini adalah simulasi permintaan ke backend
                const response = await fetch('/api/dashboard-data'); // Ganti dengan URL API yang sebenarnya
                const data = await response.json();

                jumlahMahasiswaElement.textContent = data.jumlahMahasiswa;
                jumlahDosenElement.textContent = data.jumlahDosen;
            } catch (error) {
                console.error('Gagal mengambil data dashboard:', error);
            }
        }

        // Ambil data dashboard saat halaman dimuat
        ambilDataDashboard();

        // Anda bisa menambahkan interval untuk memperbarui data secara periodik
        // setInterval(ambilDataDashboard, 5000); // Perbarui setiap 5 detik
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>