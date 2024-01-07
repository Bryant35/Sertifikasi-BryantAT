<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</head>
<body style=" background-image: url('img/library-background.jpg')">
    @include('navbar')
    <!-- <img src="img/library-background.jpg" class="" style="width: 100%"> -->
    <div class="container bg-light" style="background-color=#fffff">
    <div class="text-center">
        <img src="img/contoh-logo.jpg" class="rounded" style="max-width: 25%" alt="Contoh Logo">
    </div>
        @if(Session::has('admin') || Session::has('user'))
        @else
        <div class="container text-center">
            <div class="row align-items-start">
                <div class="col">
                </div>
                <div class="col">
                <a class="btn btn-primary my-2" href="/login">Login/Register</a>
                </div>
                <div class="col">
                </div>
            </div>
        </div>
        @endif
        <table class="table table-striped mb-3 my-4">
            <!-- Judul Tabel -->
            <thead>
                <tr>
                <th scope="col">Judul</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Tahun Terbit</th>
                <th scope="col">Stok</th>
                <th scope="col">Popularitas</th>
            </tr>
            </thead>
            <!-- Isi Tabel -->
            <tbody>
                @foreach ($data as $buku)
                    <tr>
                    <td>{{$buku->Judul}}</td>
                    <td>{{$buku->Pengarang}}</td>
                    <td>{{$buku->Penerbit}}</td>
                    <td>{{$buku->tahun_terbit}}</td>
                    <td>{{$buku->Stok}}</td>
                    <td>{{$buku->Popularitas}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="">
            
        </div>
    </div>
</body>
</html>