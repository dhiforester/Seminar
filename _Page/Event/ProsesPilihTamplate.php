<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event'])){
        echo '<span class="text-danger">ID Event Tidak Boleh Kosong!</span>';
    }else{
        if(empty($_POST['id_tamplate'])){
            $id_tamplate="0";
        }else{
            $id_tamplate=$_POST['id_tamplate'];
        }
        $id_event=$_POST['id_event'];
        $QryFormSetting = mysqli_query($Conn,"SELECT * FROM tamplate WHERE id_tamplate='$id_tamplate'")or die(mysqli_error($Conn));
        $DataFormSetting = mysqli_fetch_array($QryFormSetting);
        if(empty($DataFormSetting['id_tamplate'])){
            $id_tamplate ="0";
            $nama_tamplate="0";
            $kategori_tamplate="0";
            $deskripsi_tamplate="";
            $form_tamplate="";
        }else{
            $id_tamplate = $DataFormSetting['id_tamplate'];
            $nama_tamplate= $DataFormSetting['nama_tamplate'];
            $kategori_tamplate= $DataFormSetting['kategori_tamplate'];
            $deskripsi_tamplate= $DataFormSetting['deskripsi_tamplate'];
            $form_tamplate= $DataFormSetting['form_tamplate'];
        }
        //Buka data undangan
        $QryTamplate= mysqli_query($Conn,"SELECT * FROM event_tamplate WHERE id_event='$id_event'")or die(mysqli_error($Conn));
        $DataTamplate= mysqli_fetch_array($QryTamplate);
        if(!empty($DataTamplate['id_event_tamplate'])){
            $id_event_tamplate= $DataTamplate['id_event_tamplate'];
            $id_tamplate_event= $DataTamplate['id_tamplate'];
            $undangan= $DataTamplate['undangan'];
            $UpdateTamplate = mysqli_query($Conn,"UPDATE event_tamplate SET 
                id_tamplate='$id_tamplate',
                undangan='$form_tamplate'
            WHERE id_event_tamplate='$id_event_tamplate'") or die(mysqli_error($Conn)); 
            if($UpdateTamplate){
                $id_unit_kerja="0";
                $KategoriLog="Event";
                $KeteranganLog="Update Tamplate Event Berhasil";
                include "../../_Config/InputLog.php";
                echo '<small class="text-success" id="NotifikasiSimpanTamplateBerhasil">Success</small>';
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }else{
            //Input baru
            $entry="INSERT INTO event_tamplate (
                id_event,
                id_tamplate,
                undangan
            ) VALUES (
                '$id_event',
                '$id_tamplate',
                '$form_tamplate'
            )";
            $Input=mysqli_query($Conn, $entry);
            if($Input){
                $id_unit_kerja="0";
                $KategoriLog="Event";
                $KeteranganLog="Update Tamplate Event Berhasil";
                include "../../_Config/InputLog.php";
                echo '<small class="text-success" id="NotifikasiSimpanTamplateBerhasil">Success</small>';
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }
    }
?>