<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_kupon'])){
        echo '<span class="text-danger">ID Kupon tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_kupon=$_POST['id_kupon'];
        $query = mysqli_query($Conn, "DELETE FROM event_kupon WHERE id_kupon='$id_kupon'") or die(mysqli_error($Conn));
        if ($query) {
            echo '<span class="text-success" id="NotifikasiHapusKuponBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>