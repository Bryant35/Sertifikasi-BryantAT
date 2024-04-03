<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\AdminModel;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function adminLogin()
    {
        return view('login');
    }

    public function accountCheck(){
        if(Session::has('user')){
            $usernameUser = Session::get('user');
        }elseif(Session::has('admin')){
            $usernameAdmin = Session::get('admin');
        }else{
            $usernameUser = null;
        }
        $password = Session::get('pass');
        // dd($username, $password);
        if(Session::has('user') && Session::has('pass')){
            $res = Session::get('user');
            return $res;
        }elseif(Session::has('admin') && Session::has('pass')){
            $res = Session::get('admin');
            return $res;
        }else{
            return false;
        }
    }

    //Login
    public function adminAuthenticate(Request $req)
    {
        //ambil data dari textField login page
        
        $password = $req->input('PasswordInput');
        $username = $req->input('UsernameInput');

        //memanggil model berdasarkan nama model dan function
        $model = new AdminModel;
        $cekloginAdmin = $model->isExistAdmin($username, $password);
        $cekloginUser = $model->isExistUser($username, $password);
        //cek apakah data ada/valid
        if ($cekloginAdmin == true){
            //2.a. Jika KETEMU, maka session LOGIN dibuat(session untuk menyimpan data pada device)
            //flush untuk reset session(dihapus semua)
            Session::flush();
            //menyimpan session baru
            Session::put('admin', $username);
            Session::put('pass', $password);
            //untuk menampilkan pesan smentara
            Session::flash('success', 'Login Success!');
            return redirect('/welcome');
        }else if($cekloginUser == true){
            //2.a. Jika KETEMU, maka session LOGIN dibuat(session untuk menyimpan data pada device)
            Session::flush();
            $getIDuser = $model->getIDUser($username, $password);
            // dd($getIDuser);
            Session::put('user', $username);
            Session::put('id', $getIDuser[0]);
            Session::put('pass', $password);
            Session::flash('success', 'Login Success!');
            return redirect('/welcome');
        }else{
            //2.b. Jika TIDKA KETEMU, maka kembali ke LOGIN dan tampilkan PESAN
            Session::flash('error', 'Email or Password is Incorrect!');
            return redirect('/login');
        }
    }

    public function welcomeView(){
        $model = new AdminModel;
        $data = $model->tabelView();
        $idUser = Session::get('id');
        if(Session::has('user')){
            $reminder = $model->reminderUser($idUser);
            if($reminder != NULL){
                Session::put('reminder', $reminder);
            }
        }else{
            $reminder = NULL;
        }

        return view('overview.home', compact('data', 'reminder'));
    }

    //logout dari session
    public function logoutSession(){
        Session::flush();
        return redirect('/');
    }

    //Buat akun anggota baru
    public function registerAuthenticate(Request $req){
        $nama = $req->input('namaAnggota');
        $username = $req->input('usernameInput');
        $pass = $req->input('passwordInput');
        $tgl_lahir = $req->input('tanggalLahirAnggota');
        $alamat = $req->input('alamat');
        $no_telp = $req->input('nomorTeleponAnggota');

        if($nama != NULL && $username != NULL && $pass != NULL && $tgl_lahir != NULL && $alamat != NULL && $no_telp != NULL) {
            $model = new AdminModel;
            $data = $model->createAkunAnggota($nama, $username, $pass, $tgl_lahir, $alamat, $no_telp);
            Session::flush();
            Session::put('user', $username);
            Session::put('pass', $pass);
            return redirect('/welcome');
        }else{
            Session::put('empty', 'Data tidak boleh kosong !');
            return redirect('/register');
        }
    }

    //urutan berdasarkan Tab
    //View all Buku
    public function koleksiBuku(){
        $model = new AdminModel;
        $data = $model->bukuView();
        // dd($check);

        return view('koleksi.listBuku', compact('data'));
        

        //Compact untuk passing data dari $data ke view blade
    }

    //select edit buku yang diseleksi
    public function editBuku(Request $req, $id){
        $check = $this->accountCheck();
        if($check == 'admin'){
            // $id_buku = $req->input('idBuku');
            $model = new AdminModel;
            $data = $model->selectBuku($id);
            return view('koleksi.editBuku', compact('data'));
        }else{
            return redirect('/koleksi');
        }
    }

    //update-edit-delete buku
    public function updateBuku(Request $req){
        if($req->submit == "Save")
        {
            $id_buku = $req->Input('idBuku');
            $judulBuku = $req->Input('judulBuku');
            $pengarang = $req->Input('pengarang');
            $penerbit = $req->Input('penerbit');
            $tahunTerbit = $req->Input('tahun_Terbit');
            $Rak = $req->Input('Rak');
            $stok = $req->Input('stok');
            $images = $req->Input('images');

            $model = new AdminModel;
            $data = $model->updateBuku($id_buku, $judulBuku, $pengarang, $penerbit, $tahunTerbit, $Rak, $stok, $images);
            
        }elseif($req->submit == "Delete"){
            $id_buku = $req->Input('idBuku');

            $model = new AdminModel;
            $data = $model->deleteBuku($id_buku);

        }
        return redirect('/admin/koleksi');
    }


    //tambah buku baru
    public function tambahBuku(Request $req){
        $judulBuku = $req->input('judul');
        $Pengarang = $req->input('Pengarang');
        $Penerbit = $req->input('Penerbit');
        $tahunTerbit = $req->input('tahunTerbit');
        $Rak = $req->input('Rak');
        $stokBuku = $req->input('stokBuku');
        $fotoBuku = $req->input('fotoBuku');
        // dd($fotoBuku);
        
        if($stokBuku == NULL){
            $stokBuku = 0;
        }
        
        if($judulBuku != NULL){
            $req->file('fotoBuku')->store('fotoBuku');
            $model = new AdminModel;
            $model = $model->inputBuku($judulBuku, $Pengarang, $Penerbit, $tahunTerbit, $Rak, $stokBuku, $fotoBuku);
            // if($req->hasFile('fotoBuku')){
            //     $file= $request->file('fotoBuku');
            //     $filename= date('YmdHi').$file->getClientOriginalName();
            //     $file-> move(public_path('public/Image'), $filename);
            //     $data['fotoBuku']= $filename;
            //     // Save Data
            //     $data->save();
            // }
            
            
            return redirect('/admin/koleksi');
        }
        else{
            Session::flash('emptyDataBook', 'Judul Buku tidak boleh kosong !');
            Session::flash('judul', $judulBuku);
            Session::flash('Pengarang', $Pengarang);
            Session::flash('Penerbit', $Penerbit);
            Session::flash('tahunTerbit', $tahunTerbit);
            Session::flash('Rak', $Rak);
            Session::flash('stokBuku', $stokBuku);
            Session::flash('fotoBuku', $fotoBuku);
            return redirect('/admin/koleksi/tambah');
        }
    }


    //view anggota secara keseluruhan
    public function anggota(){
        //memanggil model
        $model = new AdminModel;
        $data = $model->anggotaView();
        return view('anggota.anggota', compact('data'));
    }
    
    //select anggota untuk ke Page Update
    public function selectAnggota(Request $req){
        //ambil data dari table anggota page
        $idAnggota = $req->input('idAnggota');
        //memanggil model
        $model = new AdminModel;
        $data = $model->anggotaSelect($idAnggota);
        return view('anggota.updateAnggota', compact('data'));
    }


    //update/remove anggota
    public function updateAnggota(Request $req){
        $idAnggota = $req->input('idAnggota');
        //kalau button Save diclick(update)
        if($req->submit == "Save")
        {
            $namaAnggota = $req->input('namaAnggota');
            $usernameAnggota = $req->input('usernameAnggota');
            $tanggalLahirAnggota = $req->input('tanggalLahirAnggota');
            // $tanggalLahirAnggota = date($tanggalLahirAnggota);
            // dd($tanggalLahirAnggota);
            // $newDate = Carbon::createFromFormat('dd/mm/YYYY', $tanggalLahirAnggota)
            //         ->format('Y-m-d');
            //         dd($newDate);
            $alamatAnggota = $req->input('alamatAnggota');
            $nomorTelepon = $req->input('nomorTelepon');

            //model update
            $model = new AdminModel;
            $data = $model->anggotaUpdate($idAnggota, $namaAnggota, $usernameAnggota,$tanggalLahirAnggota,$alamatAnggota,$nomorTelepon);

            return redirect('/admin/anggota');
        }
        //kalau button delete diklik(untuk delete logical)
        else if($req->submit == "Delete")
        {
            $model = new AdminModel;
            $data = $model->deleteAnggota($idAnggota);

            return redirect('/admin/anggota');
        }


    }
    //Peminjaman
    //Daftar Peminjam
    public function daftarPeminjam(){
        $model = new AdminModel;
        $dataAnggota = $model->anggotaView();//Menggunakan query sebelumnya pada page anggota
        $dataBuku = $model->bukuView();//menggunakan query sebelumnya di page koleksi
        // dd($dataAnggota, $dataBuku);
        return view('peminjaman.pinjam', compact(['dataAnggota', 'dataBuku']));
    }

    public function pinjamBuku(Request $req){
        $id_buku = substr($req->Input('JudulBuku'), 0, 5);
        $id_anggota = substr($req->Input('id_Anggota'), 0, 5);
        $date_pinjam = $req->Input('tanggalPinjam');
        //Auto + 7 hari tenggat
        $pinjam = Carbon::parse($date_pinjam);
        $date_tenggat = $pinjam->addDays(7);
        $date_tenggat = $date_tenggat->toDateString();

        $model = new AdminModel;
        $cekStokBuku = $model->cekStokBuku($id_buku);
        $totalStokBuku = $cekStokBuku[0]->stok;

        if($id_buku != NULL && $date_pinjam != NULL && $id_anggota != NULL && $totalStokBuku > 0){
            $data = $model->addPeminjam($id_buku, $id_anggota, $date_pinjam, $date_tenggat);

            if($data = true){
                $minusStok = $model->minusStok($id_buku);
            }
            Session::flash('success', 'Data pinjam buku berhasil tersimpan !');
        }elseif($id_buku != NULL && $date_pinjam != NULL && $id_anggota != NULL && $totalStokBuku == 0){
            Session::flash('kosong', 'Stok Buku Kosong !');
        }
        else{
            Session::flash('empty', 'Data Tidak Boleh Kosong !');
        }
        return redirect('/admin/peminjaman/pinjam');
    }


    //Daftar pengembalian
    public function daftarPengembalian(){
        $model = new AdminModel;
        $data = $model->daftarPengembalian();

        return view('peminjaman.pengembalian', compact('data'));
    }

    //autoFill form pengembalian
    public function formPengembalian(Request $req){
        $id_peminjaman = $req->Input('idPeminjaman');
        
        $model = new AdminModel;
        $data = $model->dataFormPengembalian($id_peminjaman);
        $dateCheck = $data[0]->tanggal_harus_kembali;
        $dateToday = now();
        if($dateCheck >= $dateToday)
        {
            $result = 'Tepat Waktu';
        }else{
            $result = 'Telat';
        }
        return view('peminjaman.formPengembalian', compact('data', 'result'));
    }

    //Update Pengembalian Buku
    public function returBuku(Request $req){
        $id_peminjaman = $req->Input('id_peminjaman');
        $judul = $req->Input('judul');
        $id_anggota = $req->Input('id_anggota');
        $tanggal_pengembalian = $req->Input('tanggal_pengembalian');
        $status_pengembalian = $req->Input('statusPengembalian');

        $model = new AdminModel;
        $data = $model->returBuku($id_peminjaman, $judul, $id_anggota, $tanggal_pengembalian, $status_pengembalian);

        return redirect('/admin/peminjaman/pengembalian');
    }


    //View status pengembalian
    public function statusPengembalian(){
        $model = new AdminModel;
        $data = $model->listPeminjam();

        return view('peminjaman.statusPeminjam', compact('data'));
    }

    //edit status peminjaman
    public function editStatusPeminjaman(Request $req){
        $idPeminjaman = $req->Input('idPeminjaman');

        $model = new AdminModel;
        $data = $model->selectPeminjaman($idPeminjaman);

        return view('peminjaman.editStatusPeminjaman', compact('data'));
    }

    //save update Status peminjaman
    public function updateStatusPeminjaman(Request $req){
        $id_peminjaman = $req->Input('id_peminjaman');
        $tanggal_pengembalian = $req->Input('tanggal_pengembalian');
        $statusPengembalian = $req->Input('statusPengembalian');

        if($req->submit == "Save")
        {
            $judul = $req->Input('judul');
            $id_anggota = $req->Input('id_anggota');
            $tanggal_peminjaman = $req->Input('tanggal_peminjaman');
            $tanggal_harus_kembali = $req->Input('tanggal_harus_kembali');

            $model = new AdminModel;
            $data = $model->updatePeminjaman($id_peminjaman, $tanggal_peminjaman, $tanggal_harus_kembali, $statusPengembalian);
            
            Session::flash('update','Update Pada ID "' . $id_peminjaman . '" telah berhasil');
        }
        else if($req->submit == "Delete")
        {
            $model = new AdminModel;
            $data = $model->deletePeminjaman($id_peminjaman, $tanggal_pengembalian, $statusPengembalian);

            Session::flash('delete', 'Data berhasil dihapus !');
        }
        Return redirect('/admin/peminjaman/statusPeminjaman');
    }
}
