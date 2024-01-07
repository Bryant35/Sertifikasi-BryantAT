<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</head>
<body>
    @include('navbar')
    <div class="container">
        <form action="/admin/koleksi/tambahBuku" method="POST">
            @csrf
            <div class="mb-3">
                <label for="inputJudul" class="form-label">Judul Buku</label>
                <input type="text" class="form-control"  id="inputJudul" name="judul" value="{{Session::get('judul')}}">
            </div>
            <div class="mb-3">
                <label for="inputPengarang" class="form-label">Pengarang</label>
                <input type="name" class="form-control" id="inputPengarang" name="Pengarang" value="{{Session::get('Pengarang')}}">
            </div>
            <div class="mb-3">
                <label for="inputPenerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="inputPenerbit" name="Penerbit" value="{{Session::get('Penerbit')}}">
            </div>
            <div class="mb-3">
                <label for="tahunTerbit" class="form-label">Tahun Terbit</label>
                <input type="number" id="tahunTerbit" min="1900" max="2099" step="1" value="2016" name="tahunTerbit" value="{{Session::get('tahunTerbit')}}">
            </div>
            <div class="mb-3">
                <label for="Rak" class="form-label">Posisi Rak</label>
                <input type="text" class="form-control" id="Rak" name="Rak" value="{{Session::get('Rak')}}">
            </div>
            <div class="mb-3">
                <label for="stokBuku" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stokBuku" name="stokBuku" value="{{Session::get('stokBuku')}}">
            </div>
            <div class="mb-3">
                <label for="fotoBuku" class="form-label">Foto Buku</label>
                <input type="file" class="form-control" accept=".gif,.jpg,.jpeg,.png" id="fotoBuku" name="fotoBuku">
            </div>
            <!-- <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            @if(Session::has('emptyDataBook'))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                        {{Session::get('emptyDataBook')}}
                    </div>
                </div>
            @endif
            <button type="submit" class="btn btn-primary" name="submit" value="Save">Simpan</button>
            <a href="/admin/koleksi/tambah" class="btn btn-outline-danger">Reset</a>
        </form>
    </div>
    </div>
</body>
</html>