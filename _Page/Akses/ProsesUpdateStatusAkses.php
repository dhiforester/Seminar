<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Id Akses
    if(empty($_POST['id_akses'])){
        echo '<small class="text-danger">ID Akses tidak boleh kosong</small>';
    }else{
        $id_akses=$_POST['id_akses'];
        //Validasi nama tidak boleh kosong
        if(empty($_POST['status'])){
            echo '<small class="text-danger">Nama tidak boleh kosong</small>';
        }else{
            $status=$_POST['status'];
            $UpdateAkses = mysqli_query($Conn,"UPDATE akses SET 
                status='$status'
            WHERE id_akses='$id_akses'") or die(mysqli_error($Conn)); 
            if($UpdateAkses){
                $id_unit_kerja="0";
                $KategoriLog="Akses";
                $KeteranganLog="Update Akses Berhasil";
                include "../../_Config/InputLog.php";
                echo '<small class="text-success" id="NotifikasiUpdateStatusAksesBerhasil">Success</small>';
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }
    }
?>