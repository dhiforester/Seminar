<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_event_Panitia'])){
        echo '<span class="text-danger">ID Jadwal Event tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_event_Panitia=$_POST['id_event_Panitia'];
        $foto=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_event_Panitia,'foto');
        $query = mysqli_query($Conn, "DELETE FROM event_panitia WHERE id_event_panitia='$id_event_Panitia'") or die(mysqli_error($Conn));
        if ($query) {
            //Hapus file
            if(!empty($foto)){
                $path = "../../assets/img/Panitia/".$foto;
                unlink($path);
            }
            echo '<span class="text-success" id="NotifikasiHapusPanitiaBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>