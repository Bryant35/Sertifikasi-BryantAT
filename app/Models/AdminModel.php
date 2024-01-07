<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class AdminModel extends Model
{
    use HasFactory;

    //Cek Login Admin
    public function isExistAdmin($usernameAdmin, $passwordAdmin){
        $cmd = "SELECT count(*) is_exist ".
                "FROM admin ".
                "WHERE username= :usernameAdmin AND password= :passwordAdmin;";
        $data = [
            'usernameAdmin'=> $usernameAdmin,
            'passwordAdmin'=> $passwordAdmin
        ];
        $res = DB::select($cmd,$data);

        if($res[0]->is_exist == 1){
            return true;
        }
        return false;

        // if(isset($res) && count($res) > 0){
        //     return $res;
        // }
        // return null;
    }

    //Cek login User
    public function isExistUser($username, $password){
        $cmd = "SELECT count(*) is_exist ".
                "FROM anggota ".
                "WHERE username_anggota= :username AND password_anggota= :password AND delete_anggota = 0;";
        $data = [
            'username'=> $username,
            'password'=> $password
        ];
        $res = DB::select($cmd,$data);

        if($res[0]->is_exist == 1){
            return true;
        }
        return false;
    }

    //query view home
    public function tabelView(){
        $view = "SELECT judul as `Judul`, pengarang as `Pengarang`, penerbit as `Penerbit`, tahun_terbit, stok as `Stok`, (COUNT(b.id_buku)) as `Popularitas` ". 
        "FROM `buku` as b JOIN `peminjaman` as p WHERE p.id_buku = b.id_buku AND delete_buku = 0 AND delete_pinjam = 0 ". 
        "GROUP BY p.id_buku, judul, pengarang, penerbit, tahun_terbit, stok ORDER BY `Popularitas` DESC;";
        $res = DB::select($view);

        return $res;
    }

    //input data baru anggota(Register)
    public function createAkunAnggota($nama, $username, $pass, $tgl_lahir, $alamat, $no_telp){
        $cmd = "INSERT INTO `anggota`(`id_anggota`, `nama_anggota`, `username_anggota`, `password_anggota`, `tanggal_lahir`, `alamat`, `nomor_telepon`, `delete_anggota`)". 
                "VALUES ('','".$nama."', '".$username."', '".$pass."', '".$tgl_lahir."', '".$alamat."', ".$no_telp.",0);";
        // $data = [
        //     'nama' -> $nama,
        //     'username' -> $username,
        //     'pass' -> $pass,
        //     'tgl_lahir' -> $tgl_lahir,
        //     'alamat' -> $alamat,
        //     'no_telp' -> $no_telp
        // ];
        $res = DB::insert($cmd);
        return $res;
    }



    //menampilkan view buku dengan delete 0
    public function bukuView(){
        $view = "SELECT * FROM `buku` WHERE delete_buku = 0;";
        $res = DB::select($view);
        return $res;
    }


    //KOLEKSI
    //Query unutk menambahkan Buku
    public function inputBuku($judulBuku, $Pengarang, $Penerbit, $tahunTerbit, $Rak, $stokBuku, $fotoBuku){
        $insert = "INSERT INTO `buku`(`id_buku`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `Rak`, `stok`, `image_path`, `delete_buku`)". 
                "VALUES ('','".$judulBuku."','".$Pengarang."','$Penerbit',".$tahunTerbit.",'".$Rak."',".$stokBuku.",'".$fotoBuku."',0);";
        $res = DB::insert($insert);

        return $res;
    }

    //Query Update Buku
    public function updateBuku($id_buku, $judulBuku, $pengarang, $penerbit, $tahunTerbit, $Rak, $stok, $images){
        $update = "UPDATE `buku` SET `judul`='".$judulBuku."',`pengarang`='".$pengarang."',`penerbit`='".$penerbit."',". 
                    "`tahun_terbit`=".$tahunTerbit.",`Rak`='".$Rak."',`stok`=".$stok.",`image_path`='".$images."' WHERE `id_buku` = '".$id_buku."';";
        $res = DB::update($update);
        return $res;
    }   

    //delete logical buku
    public function deleteBuku($id_buku){
        $update = "UPDATE `buku` SET `delete_buku`= 1 WHERE `id_buku` = '".$id_buku."';";
        $res = DB::update($update);
        return;
    }

    //Select 1 buku untuk di edit
    public function selectBuku($id_buku){
        $cmd = "SELECT * FROM `buku` WHERE id_buku = '".$id_buku."';";
        $res = DB::select($cmd);

        return $res;
    }

    //menampilkan data-data anggota dengan value delete 0
    public function anggotaView(){
        //Query anggota
        $view = "SELECT `id_anggota`, `username_anggota`, `nama_anggota`, `tanggal_lahir`, `alamat`, `nomor_telepon` FROM `anggota` WHERE `delete_anggota` = 0;";
        $data = DB::select($view);
        return $data;
    }

    //select specific anggota
    public function anggotaSelect($idAnggota){
        $select = "SELECT * FROM anggota WHERE `id_anggota` =  :idAnggota AND `delete_anggota` = 0;";
        $data = [
            'idAnggota' => $idAnggota
        ];
        $res = DB::select($select, $data);

        // if($res[0]->is_exist == 1){
            return $res;
        // }
        return false;
    }

    //update Anggota
    public function anggotaUpdate($idAnggota, $namaAnggota, $usernameAnggota,$tanggalLahirAnggota,$alamatAnggota,$nomorTelepon){
        
        $update = "UPDATE `anggota` SET `nama_anggota`='".$namaAnggota."',`username_anggota`='".$usernameAnggota."',`tanggal_lahir`= '".$tanggalLahirAnggota."' ,". 
                    "`nomor_telepon`='".$nomorTelepon."' WHERE `id_anggota` = '".$idAnggota."';";
        $res = DB::update($update);
        return $res;
    }

    //delete logical Anggota
    public function deleteAnggota($idAnggota){
        $update = "UPDATE `anggota` SET `delete_anggota`= 1 WHERE `id_anggota` = '".$idAnggota."';";
        $res = DB::update($update);
        return;
    }


    //Pengembalian
    //View Data untuk form
    public function daftarPengembalian(){
        $view = "SELECT id_peminjaman, p.id_anggota, nama_anggota, p.id_buku, judul, tanggal_peminjaman, tanggal_pengembalian, tanggal_harus_kembali, status_pengembalian ". 
                "FROM peminjaman as `p` JOIN buku as `b` JOIN anggota as `a` ". 
                "WHERE p.id_buku = b.id_buku && p.id_anggota = a.id_anggota && status_pengembalian = 'Belum Kembali' && delete_pinjam = 0 ORDER BY `p`.`tanggal_harus_kembali` ASC;";
        $res = DB::select($view);

        return $res;
    }
    //AutoFill Form
    public function dataFormPengembalian($id_peminjaman){
        $input = "SELECT id_peminjaman, p.id_anggota, nama_anggota, p.id_buku, judul, tanggal_peminjaman, tanggal_pengembalian, tanggal_harus_kembali, status_pengembalian ". 
                "FROM peminjaman as `p` JOIN buku as `b` JOIN anggota as `a` ". 
                "WHERE p.id_buku = b.id_buku && p.id_anggota = a.id_anggota && id_peminjaman = '".$id_peminjaman."';";
        $res = DB::select($input);

        return $res;
    }
    //Retur Buku pinjaman
    public function returBuku($id_peminjaman, $judul, $id_anggota, $tanggal_pengembalian, $status_pengembalian){
        $update = "UPDATE `peminjaman` SET `tanggal_pengembalian` = '".$tanggal_pengembalian."', `status_pengembalian` = '".$status_pengembalian."' WHERE `id_peminjaman` = '".$id_peminjaman."';";
        $res = DB::update($update);
        $stok = "UPDATE `peminjaman` as `p` JOIN `buku` as `b` SET `stok` = stok + 1 WHERE p.id_buku = b.id_buku AND `id_peminjaman` = '".$id_peminjaman."';";
        $res = DB::update($stok);

        return $res;
    }

    //Peminjaman
    //Cek Stok Buku
    public function cekStokBuku($id_buku){
        $cek = "SELECT stok FROM buku WHERE id_buku = '".$id_buku."';";
        $res = DB::select($cek);

        return $res;
    }

    //Add Peminjam
    public function addPeminjam($id_buku, $id_anggota, $date_pinjam, $date_tenggat){
        
        $insert = "INSERT INTO `peminjaman`(`id_peminjaman`, `id_anggota`, `id_buku`, `tanggal_peminjaman`, `tanggal_harus_kembali`) ". 
                    "VALUES ('','".$id_anggota."','".$id_buku."','".$date_pinjam."','".$date_tenggat."');";
        $res = DB::insert($insert);

        return true;
    }
    //minus stok kalau ada peminjam
    public function minusStok($id_buku){
        $update = "UPDATE `buku` SET `stok` = stok - 1 WHERE id_buku = '".$id_buku."'";
        $cmd = DB::update($update);

        return true;
    }


    //list status peminjaman
    public function listPeminjam(){
        $join = "SELECT id_peminjaman, p.id_anggota as `id_anggota`, nama_anggota, judul, tanggal_peminjaman, tanggal_pengembalian, tanggal_harus_kembali, status_pengembalian ". 
                "FROM peminjaman as `p` JOIN buku as `b` JOIN anggota as `a` WHERE p.id_buku = b.id_buku && p.id_anggota = a.id_anggota && delete_pinjam = 0 ". 
                "ORDER BY `p`.`tanggal_pengembalian` ASC, `p`.`tanggal_harus_kembali` ASC;";
        $res = DB::select($join);

        return $res;
    }

    //select 1 peminjaman berdasarkan button edit
    public function selectPeminjaman($idPeminjaman){
        $join = "SELECT id_peminjaman, p.id_anggota as `id_anggota`, nama_anggota, judul, tanggal_peminjaman, tanggal_pengembalian, tanggal_harus_kembali, status_pengembalian ". 
                "FROM peminjaman as `p` JOIN buku as `b` JOIN anggota as `a` WHERE p.id_buku = b.id_buku && p.id_anggota = a.id_anggota && id_peminjaman = '".$idPeminjaman."';";
        $res = DB::select($join);

        return $res;
    }

    //delete Logical peminjaman 
    public function deletePeminjaman($id_peminjaman, $tanggal_pengembalian, $statusPengembalian){
        if($tanggal_pengembalian == NULL && $status_pengembalian == "Belum Kembali"){
            $delete = "UPDATE `peminjaman` SET `delete_pinjam`= 1 WHERE `id_peminjaman` = '".$id_peminjaman."';";
            $restoreStok = "UPDATE `buku` as `b` JOIN `peminjaman` as `p` SET stok = stok + 1 WHERE `p`.`id_buku` = `b`.`id_buku` AND `id_peminjaman` = '".$id_peminjaman."';";
            $cmd = DB::update($delete);
            $cmd = DB::update($restoreStok);
        }else{
            $delete = "UPDATE `peminjaman` SET `delete_pinjam`= 1 WHERE `id_peminjaman` = '".$id_peminjaman."';";
            $res = DB::update($delete);
        }
        return;
    }
}
