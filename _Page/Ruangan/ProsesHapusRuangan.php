<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_ruangan'])){
        echo '<span class="text-danger">ID Ruangan tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_ruangan=$_POST['id_ruangan'];
        //Proses hapus data Ruangan
        $HapusRuangan = mysqli_query($Conn, "DELETE FROM list_ruangan WHERE id_ruangan='$id_ruangan'") or die(mysqli_error($Conn));
        if ($HapusRuangan) {
            $HapusKunjungan = mysqli_query($Conn, "DELETE FROM list_kunjungan WHERE id_ruangan='$id_ruangan'") or die(mysqli_error($Conn));
            if($HapusKunjungan){
                echo '<span class="text-success" id="NotifikasiHapusRuanganBerhasil">Success</span>';
            }else{
                echo '<span class="text-danger">Hapus Data Kunjungan Gagal</span>';
            }
        }else{
            echo '<span class="text-danger">Hapus Data Ruangan Gagal</span>';
        }
    }
?>