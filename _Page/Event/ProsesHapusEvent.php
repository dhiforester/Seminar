<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_setting'])){
        echo '<span class="text-danger">ID Riwayat Kerja tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_event_setting=$_POST['id_event_setting'];
        $query = mysqli_query($Conn, "DELETE FROM event_setting WHERE id_event_setting='$id_event_setting'") or die(mysqli_error($Conn));
        if ($query) {
            $_SESSION ["NotifikasiSwal"]="Hapus Event Berhasil";
            echo '<span class="text-success" id="NotifikasiHapusEventBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>