<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['PutIdPeserta2'])){
        echo '<span class="text-danger">ID Peserta tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_peserta=$_POST['PutIdPeserta2'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM event_pembayaran WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn));
        if ($query) {
            //Update Pembayaran Peserta
            $ProsesUpdatePeserta = mysqli_query($Conn,"UPDATE event_peserta SET 
                status_pembayaran='Pending'
            WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn)); 
            if($ProsesUpdatePeserta){
                echo '<span class="text-success" id="NotifikasiHapusPembayaranBerhasil">Success</span>';
            }else{
                echo '<span class="text-danger">Terjadi kesalahan pada saat melakukan update status pembayaran peserta</span>';
            }
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>