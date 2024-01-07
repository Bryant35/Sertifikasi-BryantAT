<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengembalian</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</head>
<body>
    @include('navbar')
    <div class="container">
         <form action="/admin/peminjaman/returBuku" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">ID Transaksi</label>
                <input type="text" class="form-control" name="id_peminjaman" readonly="readonly" value="{{$data[0]->id_peminjaman}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="name" class="form-control" id="" name="judul" value="{{$data[0]->judul}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Peminjam</label>
                <input type="name" class="form-control" id="" name="id_anggota" value="{{$data[0]->id_anggota}} - {{$data[0]->nama_anggota}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Pengembalian</label>
                <input type="date" class="form-control" id="" name="tanggal_pengembalian" value="{{now()->toDateString()}}">
            </div>
            <div class="mb-3">
            <label for="" class="form-label">Status Pengembalian</label>
            <input type="text" name="statusPengembalian" style="background-color: #F4F9FF;" list="listStatus" id="id_buku" class="form-control dropbtn bg-body" placeholder="Cari Judul Buku" value="{{$result}}" >
                <datalist id="listStatus">
                    <option value="Tepat Waktu"></option>
                    <option value="Telat"></option>
                    <option value="Batal Peminjaman"></option>
                </datalist>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="Save">Save</button>
            <a href="/admin/peminjaman/pengembalian" class="btn btn-outline-warning">Cancel</a>
        </form>
    </div>
</body>
</html>