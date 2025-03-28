<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_agenda'])){
        echo '<span class="text-danger">ID Agenda tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_agenda=$_POST['id_agenda'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM agenda WHERE id_agenda='$id_agenda'") or die(mysqli_error($Conn));
        if ($query) {
            $_SESSION ["NotifikasiSwal"]="Hapus Agenda Berhasil";
            echo '<span class="text-success" id="NotifikasiHapusAgendaBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>