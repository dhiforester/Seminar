<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_unit_kerja_anggota'])){
        echo '<span class="text-danger">ID Unit Kerja tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_unit_kerja_anggota=$_POST['id_unit_kerja_anggota'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM unit_kerja_anggota WHERE id_unit_kerja_anggota='$id_unit_kerja_anggota'") or die(mysqli_error($Conn));
        if ($query) {
            $_SESSION ["NotifikasiSwal"]="Hapus Anggota Unit Kerja Berhasil";
            echo '<span class="text-success" id="NotifikasiHapusAnggotaUnitKerjaBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>