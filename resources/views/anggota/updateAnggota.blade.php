<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Anggota</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</head>
<body>
    @include('navbar')
    <div class="container">
        <form action="/admin/anggota/cekUpdate" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ID Anggota</label>
                <input type="text" class="form-control" style="color:grey;" id="" readonly="readonly" name="idAnggota" onfocus="this.blur()" value="{{$data[0]->id_anggota}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nama Anggota</label>
                <input type="name" class="form-control" id="" name="namaAnggota" value="{{$data[0]->nama_anggota}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Username</label>
                <input type="name" class="form-control" id="" name="usernameAnggota" value="{{$data[0]->username_anggota}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="" name="tanggalLahirAnggota" value="{{$data[0]->tanggal_lahir}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="" name="alamatAnggota" value="{{$data[0]->alamat}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nomor Telepon</label>
                <input type="number" class="form-control" id="" name="nomorTelepon" maxlength="15" value="{{$data[0]->nomor_telepon}}">
            </div>
            <!-- <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <button type="submit" class="btn btn-primary" name="submit" value="Save">Save</button>
            <button type="submit" class="btn btn-outline-danger" name="submit" value="Delete">Delete</button>
        </form>
    </div>

</body>
</html>