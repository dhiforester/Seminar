<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_tamplate'])){
        echo '<span class="text-danger">ID Form Tidak Dapat Ditangkap Oleh Sistem</span>';
    }else{
        $id_tamplate=$_POST['id_tamplate'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM tamplate WHERE id_tamplate='$id_tamplate'") or die(mysqli_error($Conn));
        if ($query) {
            $_SESSION ["NotifikasiSwal"]="Hapus Form Setting Berhasil";
            echo '<span class="text-success" id="NotifikasiHapusSettingFormBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal!</span>';
        }
    }
?>