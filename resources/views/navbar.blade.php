<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            @if(Session::has('admin') || Session::has('user'))
                <a class="navbar-brand" href="/welcome">Perpustakaan Indah</a>
            @else
                <a class="navbar-brand" href="/">Perpustakaan Indah</a>
            @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/koleksi">Koleksi</a>
                    </li>
                    @if(Session::has('admin'))
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/anggota">Anggota</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Peminjaman
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/admin/peminjaman/pinjam">Pinjam</a></li>
                            <li><a class="dropdown-item" href="/admin/peminjaman/pengembalian">Pengembalian</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/admin/peminjaman/statusPeminjaman">Status Peminjaman</a></li>
                        </ul>
                    </li>
                </ul>
                    <a class="btn btn-outline-success" href="/logout">Logout</a>
                    @elseif(Session::has('user'))
                </ul>
                    <a class="btn btn-outline-success" href="/logout">Logout</a>
                    @else
                </ul>   
                    <a class="btn btn-success" href="/login">Login</a>
                    @endif
            </div>
        </div>
    </nav>
</body>
</html>