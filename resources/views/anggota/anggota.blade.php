<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota</title>
    
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
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Alamat</th>
                <th scope="col">No.Telepon</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <!-- Isi Tabel -->
            <tbody>
                @foreach ($data as $anggota)
                    <tr>
                    <th scope="row">{{$anggota->id_anggota}}</th>
                    <td>{{$anggota->username_anggota}}</td>
                    <td>{{$anggota->nama_anggota}}</td>
                    <td>{{$anggota->tanggal_lahir}}</td>
                    <td>{{$anggota->alamat}}</td>
                    <td>{{$anggota->nomor_telepon}}</td>
                    <td>
                        <form action="/admin/anggota/edit" method="POST">
                            @csrf
                            <input type="hidden" name="idAnggota" value="{{$anggota->id_anggota}}">
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