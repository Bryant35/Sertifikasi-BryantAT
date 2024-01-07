<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>

    @include('linkBootstrap')
</head>
<body>
    @include('navbar')
    <div class="container">
        <form action="/admin/koleksi/updateBuku" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ID Buku</label>
                <input type="text" class="form-control" style="color:grey;" id="" readonly="readonly" name="idBuku" onfocus="this.blur()" value="{{$data[0]->id_buku}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Judul Buku</label>
                <input type="name" class="form-control" id="" name="judulBuku" value="{{$data[0]->judul}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Pengarang</label>
                <input type="name" class="form-control" id="" name="pengarang" value="{{$data[0]->pengarang}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="" name="penerbit" value="{{$data[0]->penerbit}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tahun Terbit</label>
               <input type="number" id="tahunTerbit" min="1900" max="2099" step="1" name="tahun_Terbit" value="{{$data[0]->tahun_terbit}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Rak</label>
                <input type="text" class="form-control" id="" name="Rak" value="{{$data[0]->Rak}}">
            </div> 
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Stok</label>
                <input type="number" class="form-control" id="" name="stok" value="{{$data[0]->stok}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Foto buku</label>
                <input type="file" class="form-control" accept=".gif,.jpg,.jpeg,.png" id="" name="images" value="{{$data[0]->image_path}}">
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