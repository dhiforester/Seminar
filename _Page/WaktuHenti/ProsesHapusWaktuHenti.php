<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_waktu_henti'])){
        echo '<span class="text-danger">ID Waktu Henti tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_waktu_henti=$_POST['id_waktu_henti'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM waktu_henti WHERE id_waktu_henti='$id_waktu_henti'") or die(mysqli_error($Conn));
        if ($query) {
            echo '<span class="text-success" id="NotifikasiHapusWaktuHentiBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>