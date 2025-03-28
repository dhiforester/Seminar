<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['id_dukungan'])){
        echo '<small class="text-danger">ID Dukungan tidak boleh kosong</small>';
    }else{
        //Validasi kategori_dukungan tidak boleh kosong
        if(empty($_POST['kategori_dukungan'])){
            echo '<small class="text-danger">Kategori Dukungan tidak boleh kosong</small>';
        }else{
            //Validasi keterangan_dukungan tidak boleh kosong
            if(empty($_POST['keterangan_dukungan'])){
                echo '<small class="text-danger">Keterangan Dukungan tidak boleh kosong</small>';
            }else{
                //Validasi judul_dukungan tidak boleh kosong
                if(empty($_POST['judul_dukungan'])){
                    echo '<small class="text-danger">Judul Dukungan tidak boleh kosong</small>';
                }else{
                    //Variabel Data
                    $id_dukungan=$_POST['id_dukungan'];
                    $judul_dukungan=$_POST['judul_dukungan'];
                    $kategori_dukungan=$_POST['kategori_dukungan'];
                    $keterangan_dukungan=$_POST['keterangan_dukungan'];
                    $UpdateDukungan = mysqli_query($Conn,"UPDATE dukungan SET 
                        judul_dukungan='$judul_dukungan',
                        kategori_dukungan='$kategori_dukungan',
                        keterangan_dukungan='$keterangan_dukungan'
                    WHERE id_dukungan='$id_dukungan'") or die(mysqli_error($Conn)); 
                    if($UpdateDukungan){
                        $id_unit_kerja="0";
                        $KategoriLog="Edit Data Dukungan";
                        $KeteranganLog="Edit Data Dukungan Berhasil";
                        include "../../_Config/InputLog.php";
                        $_SESSION ["NotifikasiSwal"]="Edit Data Dukungan Berhasil";
                        echo '<small class="text-success" id="NotifikasiEditDukunganBerhasil">Success</small>';
                    }else{
                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                    }
                }
            }
        }
    }
?>