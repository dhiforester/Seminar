<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_riwayat_kerja'])){
        echo '<span class="text-danger">ID Riwayat Kerja tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_riwayat_kerja=$_POST['id_riwayat_kerja'];
        //Buka Riwayat Kerja
        $QryDetailRiwayatKerja= mysqli_query($Conn,"SELECT * FROM riwayat_kerja WHERE id_riwayat_kerja='$id_riwayat_kerja'")or die(mysqli_error($Conn));
        $DataRiwayatKerja= mysqli_fetch_array($QryDetailRiwayatKerja);
        $gambar_kerja= $DataRiwayatKerja['gambar_kerja'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM riwayat_kerja WHERE id_riwayat_kerja='$id_riwayat_kerja'") or die(mysqli_error($Conn));
        if ($query) {
            if(!empty($DataRiwayatKerja['gambar_kerja'])){
                //Hapus Gambar
                $path = "../../assets/img/Kerja/".$gambar_kerja;
                unlink($path);
            }
            echo '<span class="text-success" id="NotifikasiHapusRiwayatKerjaBerhasil">Success</span>';
            $_SESSION ["NotifikasiSwal"]="Hapus Riwayat Kerja Berhasil";
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>