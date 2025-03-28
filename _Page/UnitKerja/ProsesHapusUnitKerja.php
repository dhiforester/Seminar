<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_unit_kerja'])){
        echo '<span class="text-danger">ID Unit Kerja tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_unit_kerja=$_POST['id_unit_kerja'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'") or die(mysqli_error($Conn));
        if ($query) {
            echo '<span class="text-success" id="NotifikasiHapusUnitKerjaBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>