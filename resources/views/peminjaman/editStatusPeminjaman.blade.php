<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</head>
<body>
    @include('navbar')
    <div class="container">
        <form action="/admin/peminjaman/updatePeminjaman" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">ID Peminjaman</label>
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
                <label class="form-label">Tanggal Peminjaman</label>
                <input type="date" class="form-control" id="" name="tanggal_peminjaman" value="{{$data[0]->tanggal_peminjaman}}">
            </div>
            @if($data[0]->tanggal_pengembalian != NULL)
            <div class="mb-3">
                <label class="form-label">Tanggal Pengembalian</label>
                <input type="date" class="form-control" id="" name="tanggal_pengembalian" value="{{$data[0]->tanggal_pengembalian}}">
            </div>
            @endif
            <div class="mb-3">
                <label class="form-label">Batas Peminjaman</label>
                <input type="date" class="form-control" id="" name="tanggal_harus_kembali" value="{{$data[0]->tanggal_harus_kembali}}">
            </div>
            <div class="mb-3">
            <label for="" class="form-label">Status Pengembalian</label>
            <input type="text" name="statusPengembalian" style="background-color: #F4F9FF;" list="listStatus" id="id_buku" class="form-control dropbtn bg-body" placeholder="Cari Judul Buku" value="{{$data[0]->status_pengembalian}}" >
                <datalist id="listStatus">
                    <option value="Belum Kembali"></option>
                    <option value="Tepat Waktu"></option>
                    <option value="Telat"></option>
                    <option value="Batal Peminjaman"></option>
                </datalist>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="Save">Save</button>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete" value="Delete">Delete</button>
            <a href="/admin/peminjaman/statusPeminjaman" class="btn btn-outline-warning position-absolute end-0 me-5" style="">Cancel</a>
            <div class="modal fade" id="modalDelete" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>apakah yakin mau menghapus peminjaman ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="Submit" class="btn btn-danger" name="submit" value="Delete">Delete</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>
</html>