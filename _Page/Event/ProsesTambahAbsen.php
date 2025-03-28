<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['id_event'])){
        echo '<small class="text-danger">ID Event tidak boleh kosong</small>';
    }else{
        //Validasi in_ex tidak boleh kosong
        if(empty($_POST['kategori_absen'])){
            echo '<small class="text-danger">Kategori Absensi tidak boleh kosong</small>';
        }else{
            $id_event= $_POST['id_event'];
            $kategori_absen= $_POST['kategori_absen'];
            if($kategori_absen=="Undangan"){
                include "ProsesTambahAbsenUndangan.php";
            }else{
                if($kategori_absen=="Akses"){
                    include "ProsesTambahAbsenAkses.php";
                }else{
                    if($kategori_absen=="Eksternal"){
                        include "ProsesTambahAbsenEksternal.php";
                    }else{
                        echo '<small class="text-danger">Kategori Tidak valid</small>';
                    }
                }
            }
        }
    }
?>