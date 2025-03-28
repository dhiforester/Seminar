<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['PutIdEventAbsen'])){
        echo '<span class="text-danger">ID Absensi tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_event_absen=$_POST['PutIdEventAbsen'];
        //Proses hapus data
        $query=mysqli_query($Conn, "DELETE FROM event_absen WHERE id_event_absen='$id_event_absen'") or die(mysqli_error($Conn));
        if($query) {
            $_SESSION ["NotifikasiSwal"]="Hapus Kehadiran Peserta Berhasil";
            echo '<span class="text-success" id="NotifikasiHapusKehadiranBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>