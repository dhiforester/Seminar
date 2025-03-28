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
            //Variabel Lainnya
            $nama_ruangan=$_POST['nama_ruangan'];
            $kategori=$_POST['kategori'];
            //Validasi data yang sama
            $ValidasiDataSama=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM list_ruangan WHERE nama_ruangan='$nama_ruangan' AND kategori='$kategori'"));
            if(!empty($ValidasiDataSama)){
                echo '<small class="text-danger">Data Yang Sama Sudah Ada</small>';
            }else{
                $entry="INSERT INTO list_ruangan (
                    nama_ruangan,
                    kategori
                ) VALUES (
                    '$nama_ruangan',
                    '$kategori'
                )";
                $Input=mysqli_query($Conn, $entry);
                if($Input){
                    $id_unit_kerja="";
                    $KategoriLog="Input Ruangan";
                    $KeteranganLog="Input Ruangan Berhasil";
                    include "../../_Config/InputLog.php";
                    $_SESSION ["NotifikasiSwal"]="Tambah Ruangan Berhasil";
                    echo '<small class="text-success" id="NotifikasiTambahRuanganBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                }
            }
        }
    }
?>
