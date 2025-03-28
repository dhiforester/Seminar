<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_rencana_kirim'])){
        echo '<span class="text-danger">ID Rencana Kirim tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_rencana_kirim=$_POST['id_rencana_kirim'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM whatsapp_rencana_kirim WHERE id_rencana_kirim='$id_rencana_kirim'") or die(mysqli_error($Conn));
        if ($query) {
            echo '<span class="text-success" id="NotifikasiHapusRencanaKirimPesanBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>