<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_absen'])){
        echo '<span class="text-danger">ID Absen Event tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_event_absen=$_POST['id_event_absen'];
        $query = mysqli_query($Conn, "DELETE FROM event_absen WHERE id_event_absen='$id_event_absen'") or die(mysqli_error($Conn));
        if ($query) {
            echo '<span class="text-success" id="NotifikasiHapusAbsenBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>