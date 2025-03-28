<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_kategori'])){
        echo '<span class="text-danger">ID Riwayat Kerja tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_event_kategori=$_POST['id_event_kategori'];
        $query = mysqli_query($Conn, "DELETE FROM event_kategori WHERE id_event_kategori='$id_event_kategori'") or die(mysqli_error($Conn));
        if ($query) {
            $_SESSION ["NotifikasiSwal"]="Hapus Kategori Event Berhasil";
            echo '<span class="text-success" id="NotifikasiHapusEventKategoriBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>