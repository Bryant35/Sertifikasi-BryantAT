<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</head>
<body>
    @include('navbar')
    <div class="container">
        @if(Session::has('admin'))
        <a class="btn btn-primary" href="/admin/koleksi/tambah">Tambah Buku</a>
        @endif
        <table class="table table-striped mt-3">
            <!-- Judul Tabel -->
            <thead>
                <tr>
                    @if(Session::has('admin'))
                        <th scope="col">ID</th>
                    @endif
                <th scope="col">Judul</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Tahun Terbit</th>
                <th scope="col">Rak</th>
                <th scope="col">Stok</th>
                <th scope="col">Foto Buku</th>
                @if(Session::has('admin'))
                <th scope="col"></th>
                @endif
            </tr>
            </thead>
            <!-- Isi Tabel -->
            <tbody>
                @foreach ($data as $buku)
                    <tr>
                    @if(Session::has('admin'))
                    <th scope="row">{{$buku->id_buku}}</th>
                    @endif
                    <td>{{$buku->judul}}</td>
                    <td>{{$buku->pengarang}}</td>
                    <td>{{$buku->penerbit}}</td>
                    <td>{{$buku->tahun_terbit}}</td>
                    <td>{{$buku->Rak}}</td>
                    <td>{{$buku->stok}}</td>
                    <td><img src="{{$buku->image_path}}"></img></td>
                    @if(Session::has('admin'))
                    <td>
                        <form action="/admin/koleksi/edit" method="POST">
                            @csrf
                            <input type="hidden" name="idBuku" value="{{$buku->id_buku}}">
                            <input type="submit" value="Update">
                        </form>
                    </td>
                    @endif
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>