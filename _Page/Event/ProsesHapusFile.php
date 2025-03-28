<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_file'])){
        echo '<span class="text-danger">ID File tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_event_file=$_POST['id_event_file'];
        //Buka data file
        $QryFile= mysqli_query($Conn,"SELECT * FROM event_file WHERE id_event_file='$id_event_file'")or die(mysqli_error($Conn));
        $DataFile= mysqli_fetch_array($QryFile);
        $kategori= $DataFile['kategori'];
        $file_name= $DataFile['file_name'];
        if($kategori!=="URL"){
            $HapusFile = mysqli_query($Conn, "DELETE FROM event_file WHERE id_event_file='$id_event_file'") or die(mysqli_error($Conn));
            if($HapusFile){
                $id_unit_kerja="0";
                $KategoriLog="Hapus File Event";
                $KeteranganLog="Hapus File Event Berhasil";
                include "../../_Config/InputLog.php";
                echo '<span class="text-success" id="NotifikasiHapusFileBerhasil">Success</span>';
            }else{
                echo '<span class="text-danger">Hapus Data File Gagal</span>';
            }
        }else{
            $path = "../../assets/img/Dokumen/".$file_name;
            $HapusFile = mysqli_query($Conn, "DELETE FROM event_file WHERE id_event_file='$id_event_file'") or die(mysqli_error($Conn));
            if($HapusFile){
                //Hapus Gambar
                $path = "../../assets/img/Kerja/".$gambar_kerja;
                unlink($path);
                $id_unit_kerja="0";
                $KategoriLog="Hapus File Event";
                $KeteranganLog="Hapus File Event Berhasil";
                include "../../_Config/InputLog.php";
                echo '<span class="text-success" id="NotifikasiHapusFileBerhasil">Success</span>';
            }else{
                echo '<span class="text-danger">Hapus Data File Gagal</span>';
            }
        }
    }
?>