<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Id Akses
    if(empty($_POST['GetIdDukungan'])){
        echo '<small class="text-danger">ID Dukungan tidak boleh kosong</small>';
    }else{
        if(empty($_POST['tanggal'])){
            echo '<small class="text-danger">Tanggal selesai tidak boleh kosong</small>';
        }else{
            if(empty($_POST['jam'])){
                echo '<small class="text-danger">Jam selesai tidak boleh kosong</small>';
            }else{
                $GetIdDukungan=$_POST['GetIdDukungan'];
                $tanggal=$_POST['tanggal'];
                $jam=$_POST['jam'];
                $tanggal_selesai="$tanggal $jam";
                $UpdateDukungan = mysqli_query($Conn,"UPDATE dukungan SET 
                    tanggal_selesai='$tanggal_selesai',
                    status_dukungan='Done'
                WHERE id_dukungan='$GetIdDukungan'") or die(mysqli_error($Conn)); 
                if($UpdateDukungan){
                    $id_unit_kerja="0";
                    $KategoriLog="Update Dukungan Selesai";
                    $KeteranganLog="Update Dukungan Selesai Berhasil";
                    include "../../_Config/InputLog.php";
                    echo '<small class="text-success" id="NotifikasiDukunganSelesaiBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                }
            }
        }
    }
?>