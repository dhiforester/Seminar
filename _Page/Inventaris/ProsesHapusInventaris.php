<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_inventaris'])){
        echo '<span class="text-danger">ID inventaris tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_inventaris=$_POST['id_inventaris'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM inventaris WHERE id_inventaris='$id_inventaris'") or die(mysqli_error($Conn));
        if ($query) {
            echo '<span class="text-success" id="NotifikasiHapusInventarisBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>