<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_event_sertifikat'])){
        echo '<span class="text-danger">ID Sertifikat Tidak Boleh Kosong!</span>';
    }else{
        $id_event_sertifikat=$_POST['id_event_sertifikat'];
        $HapusSertifikat = mysqli_query($Conn, "DELETE FROM event_sertifikat WHERE id_event_sertifikat='$id_event_sertifikat'") or die(mysqli_error($Conn));
        if($HapusSertifikat) {
            echo '<span class="text-success" id="NotifikasiHapusSponsorBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Terjadi Kesalahan pada saat menghapus Sertifikat Sponsor</span>';
        }
    }
?>