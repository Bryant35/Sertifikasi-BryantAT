<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Buku</title>

    <!-- Link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</head>
<body>
    @include('navbar')
    <div class="container">
        <table class="table table-striped mt-3">
            <!-- Judul Tabel -->
            <thead>
                <tr>
                <th scope="col">ID_Transaksi</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Peminjam</th>
                <th scope="col">Tanggal Peminjaman</th>
                <th scope="col">Tenggat Waktu</th>
                <th scope="col">Status Pengembalian</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <!-- Isi Tabel -->
            <tbody>
                @foreach ($data as $pengembalian)
                    <tr>
                    <th scope="row">{{$pengembalian->id_peminjaman}}</th>
                    <td>{{$pengembalian->judul}}</td>
                    <td>{{$pengembalian->nama_anggota}}</td>
                    <td>{{$pengembalian->tanggal_peminjaman}}</td>
                    <td>{{$pengembalian->tanggal_harus_kembali}}</td>
                    <td>{{$pengembalian->status_pengembalian}}</td>
                    <td>
                        <form action="/admin/peminjaman/formPengembalian" method="POST">
                            @csrf
                            <input type="hidden" name="idPeminjaman" value="{{$pengembalian->id_peminjaman}}">
                            <input type="submit" value="Retur" class="btn btn-outline-primary">
                        </form>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>