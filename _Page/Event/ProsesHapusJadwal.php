<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_jadwal'])){
        echo '<span class="text-danger">ID Jadwal Event tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_event_jadwal=$_POST['id_event_jadwal'];
        $query = mysqli_query($Conn, "DELETE FROM event_jadwal WHERE id_event_jadwal='$id_event_jadwal'") or die(mysqli_error($Conn));
        if ($query) {
            echo '<span class="text-success" id="NotifikasiHapusJadwalBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>