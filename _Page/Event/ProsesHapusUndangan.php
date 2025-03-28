<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_undangan'])){
        echo '<span class="text-danger">ID Jadwal Event tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_event_undangan=$_POST['id_event_undangan'];
        $query = mysqli_query($Conn, "DELETE FROM event_undangan WHERE id_event_undangan='$id_event_undangan'") or die(mysqli_error($Conn));
        if ($query) {
            echo '<span class="text-success" id="NotifikasiHapusUndanganBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>