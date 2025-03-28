<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_unit_kerja'])){
        echo '<small class="text-danger">ID unit kerja tidak boleh kosong</small>';
    }else{
        if(empty($_POST['nama_unit_kerja'])){
            echo '<small class="text-danger">Nama unit kerja tidak boleh kosong</small>';
        }else{
            if(empty($_POST['keterangan'])){
                echo '<small class="text-danger">Keterangan unit kerja tidak boleh kosong</small>';
            }else{
                if(empty($_POST['status'])){
                    echo '<small class="text-danger">Status unit kerja tidak boleh kosong</small>';
                }else{
                    $id_unit_kerja=$_POST['id_unit_kerja'];
                    $nama_unit_kerja=$_POST['nama_unit_kerja'];
                    $keterangan=$_POST['keterangan'];
                    $status=$_POST['status'];
                    //Edit Unti Kerja
                    $UpdateUnitKerja = mysqli_query($Conn,"UPDATE unit_kerja SET 
                        nama_unit_kerja='$nama_unit_kerja',
                        keterangan='$keterangan',
                        status='$status'
                    WHERE id_unit_kerja='$id_unit_kerja'") or die(mysqli_error($Conn)); 
                    if($UpdateUnitKerja){
                        $KategoriLog="Edit Unit Kerja";
                        $KeteranganLog="Edit Unit Kerja Berhasil";
                        include "../../_Config/InputLog.php";
                        echo '<small class="text-success" id="NotifikasiEditUnitKerjaBerhasil">Success</small>';
                    }else{
                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                    }
                }
            }
        }
    }
?>