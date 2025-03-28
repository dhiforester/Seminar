<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama_ruangan tidak boleh kosong
    if(empty($_POST['nama_ruangan'])){
        echo '<small class="text-danger">Nama Ruangan tidak boleh kosong</small>';
    }else{
        //Validasi Kategori tidak boleh kosong
        if(empty($_POST['kategori'])){
            echo '<small class="text-danger">Kategori ruangan tidak boleh kosong</small>';
        }else{
            //Validasi ruangan tidak boleh kosong
            if(empty($_POST['id_ruangan'])){
                echo '<small class="text-danger">ID Ruangan ruangan tidak boleh kosong</small>';
            }else{
                //Variabel Lainnya
                $id_ruangan=$_POST['id_ruangan'];
                $nama_ruangan=$_POST['nama_ruangan'];
                $kategori=$_POST['kategori'];
                $UpdateRuangan = mysqli_query($Conn,"UPDATE list_ruangan SET 
                    nama_ruangan='$nama_ruangan',
                    kategori='$kategori'
                WHERE id_ruangan='$id_ruangan'") or die(mysqli_error($Conn)); 
                if($UpdateRuangan){
                    $id_unit_kerja="";
                    $KategoriLog="Edit Ruangan";
                    $KeteranganLog="Edit Ruangan Berhasil";
                    include "../../_Config/InputLog.php";
                    echo '<small class="text-success" id="NotifikasiEditRuanganBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                }
            }
        }
    }
?>
