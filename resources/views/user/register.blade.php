<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</head>
<body>
    @include('navbar')
    <div class="container">
        <div class="m-3">
        <form method="POST" action="/register/authenticate">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                <input type="name" class="form-control" id="UsernameInput" name="namaAnggota" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="name" class="form-control" id="UsernameInput" name="usernameInput" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="PasswordInput" name="passwordInput" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="BornInput" name="tanggalLahirAnggota" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nomor Telepon</label>
                <input type="number" class="form-control" id="UsernameInput" name="nomorTeleponAnggota" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="AddressInput" name="alamat" required>
            </div>
            <!-- <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div> -->
            @if(Session::has('error'))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <!-- <svg class="bi flex-shrink-0 me-1" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg> -->
                    <div>
                        Data cannot be empty !
                    </div>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Buat Akun</button>
        </form>
        </div>
    </div>
</body>
</html>