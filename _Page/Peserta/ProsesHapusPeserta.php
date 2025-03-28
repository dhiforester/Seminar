<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['PutIdPeserta'])){
        echo '<span class="text-danger">ID Peserta tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_peserta=$_POST['PutIdPeserta'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM event_peserta WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn));
        if ($query) {
            echo '<span class="text-success" id="NotifikasiHapusPesertaBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>