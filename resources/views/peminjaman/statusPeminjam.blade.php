<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Peminjaman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</head>
<body>
    @include('navbar')    
    <div class="container">
        @if(Session::has('delete'))
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <!-- <svg class="bi flex-shrink-0 me-1" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg> -->
                <div>
                    {{Session::get('delete')}}
                </div>
            </div>
        @endif
        @if(Session::has('update'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <!-- <svg class="bi flex-shrink-0 me-1" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg> -->
                <div>
                    {{Session::get('update')}}
                </div>
            </div>
        @endif
        <table class="table table-striped mt-3">
            <!-- Judul Tabel -->
            <thead>
                <tr>
                <th scope="col">ID Peminjaman</th>
                <th scope="col">Nama Peminjam</th>
                <th scope="col">Judul peminjaman</th>
                <th scope="col">Tanggal Peminjaman</th>
                <th scope="col">Tanggal Pengembalian</th>
                <th scope="col">Batas Pengembalian</th>
                <th scope="col">Status Peminjaman</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <!-- Isi Tabel -->
            <tbody>
                @foreach ($data as $peminjaman)
                    <tr>
                    <th scope="row">{{$peminjaman->id_peminjaman}}</th>
                    <td>{{$peminjaman->nama_anggota}}</td>
                    <td>{{$peminjaman->judul}}</td>
                    <td>{{$peminjaman->tanggal_peminjaman}}</td>
                    <td>{{$peminjaman->tanggal_pengembalian}}</td>
                    <td>{{$peminjaman->tanggal_harus_kembali}}</td>
                    <td>{{$peminjaman->status_pengembalian}}</td>

                    <td>
                        <form action="/admin/peminjaman/editStatusPeminjaman" method="POST">
                            @csrf
                            <input type="hidden" name="idPeminjaman" value="{{$peminjaman->id_peminjaman}}">
                            <input type="submit" value="Update">
                        </form>
                    </td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>