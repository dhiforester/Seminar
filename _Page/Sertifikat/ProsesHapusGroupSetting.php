<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_setting_sertifikat'])){
        echo '<span class="text-danger">ID Setting Sertifikat Tidak Boleh Kosong!</span>';
    }else{
        $id_setting_sertifikat=$_POST['id_setting_sertifikat'];
        //Buka File Background
        $img_bg=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'img_bg');
        //Proses hapus data
        $HapusEventSertifikat = mysqli_query($Conn, "DELETE FROM event_sertifikat WHERE id_setting_sertifikat='$id_setting_sertifikat'") or die(mysqli_error($Conn));
        if($HapusEventSertifikat) {
            $HapusSettingSertifikat = mysqli_query($Conn, "DELETE FROM setting_sertifikat WHERE id_setting_sertifikat='$id_setting_sertifikat'") or die(mysqli_error($Conn));
            if($HapusSettingSertifikat) {
                $UrlFileBc="../../assets/img/Sertifikat/$img_bg";
                //Hapus File
                unlink($UrlFileBc);
                echo '<span class="text-success" id="NotifikasiHapusGroupSettingBerhasil">Success</span>';
            }else{
                echo '<span class="text-danger">Terjadi Kesalahan pada saat menghapus Setting Sertifikat</span>';
            }
        }else{
            echo '<span class="text-danger">Terjadi Kesalahan pada saat menghapus Event Sertifikat</span>';
        }
    }
?>