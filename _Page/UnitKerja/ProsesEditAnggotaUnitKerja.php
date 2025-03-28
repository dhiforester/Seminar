<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set("Asia/Jakarta");
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
     //Validasi id_unit_kerja_anggota tidak boleh kosong
    if(empty($_POST['id_unit_kerja_anggota'])){
        echo '<small class="text-danger">ID Anggota tidak boleh kosong</small>';
    }else{
        //Validasi jabatan tidak boleh kosong
        if(empty($_POST['jabatan'])){
            echo '<small class="text-danger">Jabatan tidak boleh kosong</small>';
        }else{
            //Validasi level tidak boleh kosong
            if(empty($_POST['level'])){
                echo '<small class="text-danger">Level tidak boleh kosong</small>';
            }else{
                //Variabel Lainnya
                $id_unit_kerja_anggota=$_POST['id_unit_kerja_anggota'];
                $jabatan=$_POST['jabatan'];
                $level=$_POST['level'];
                $UpdateAnggotaUnit = mysqli_query($Conn,"UPDATE unit_kerja_anggota SET 
                    jabatan='$jabatan',
                    level='$level'
                WHERE id_unit_kerja_anggota='$id_unit_kerja_anggota'") or die(mysqli_error($Conn)); 
                if($UpdateAnggotaUnit){
                    $id_unit_kerja=0;
                    $KategoriLog="Unit Kerja";
                    $KeteranganLog="Edit Anggota Unit Kerja Baru Berhasil";
                    include "../../_Config/InputLog.php";
                    $_SESSION ["NotifikasiSwal"]="Edit Anggota Unit Kerja Berhasil";
                    echo '<small class="text-success" id="NotifikasiEditAnggotaUnitKerjaBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                }
            }
        }
    }
?>