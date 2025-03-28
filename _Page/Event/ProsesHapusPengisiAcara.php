<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_event_pengisi_acara'])){
        echo '<span class="text-danger">ID Pengisi Acara tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_event_pengisi_acara=$_POST['id_event_pengisi_acara'];
        $foto=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_event_pengisi_acara,'foto');
        $query = mysqli_query($Conn, "DELETE FROM event_pengisi_acara WHERE id_event_pengisi_acara='$id_event_pengisi_acara'") or die(mysqli_error($Conn));
        if ($query) {
            //Hapus file
            if(!empty($foto)){
                $path = "../../assets/img/pengisi_acara/".$foto;
                unlink($path);
            }
            echo '<span class="text-success" id="NotifikasiHapusPengisiAcaraBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>