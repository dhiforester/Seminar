<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    date_default_timezone_set('Asia/Jakarta');
    if(empty($_POST['id_event_sertifikat'])){
        echo '<code class="text-danger">ID Sertifikat Tidak Boleh Kosong!</code>';
    }else{
        if(empty($_POST['id_setting_sertifikat'])){
            echo '<code class="text-danger">ID Setting Sertifikat Tidak Boleh Kosong!</code>';
        }else{
            if(empty($_POST['nama'])){
                echo '<code class="text-danger">Nama Sponsor Tidak Boleh Kosong!</code>';
            }else{
                if(empty($_POST['GenerateUlang'])){
                    echo '<code class="text-danger">Informasi Generate Ulang Tidak Boleh Kosong!</code>';
                }else{
                    $id_event_sertifikat=$_POST['id_event_sertifikat'];
                    $id_setting_sertifikat=$_POST['id_setting_sertifikat'];
                    $nama=$_POST['nama'];
                    $GenerateUlang=$_POST['GenerateUlang'];
                    $kategori_sertifikat="Sponsor";
                    $DatetimeNow=date('Y-m-d H:i:s');
                    $DatetimeNow=strtotime($DatetimeNow);
                    $id_event_setting=getDataDetail($Conn,'event_sertifikat','id_event_sertifikat',$id_event_sertifikat,'id_event_setting');
                    $TokenBaru="$id_event_setting-$kategori_sertifikat-$DatetimeNow";
                    $TokenBaru=md5($TokenBaru);
                    $TokenLama=getDataDetail($Conn,'event_sertifikat','id_event_sertifikat',$id_event_sertifikat,'token');
                    if($GenerateUlang=="Ya"){
                        $token=$TokenBaru;
                    }else{
                        $token=$TokenLama;
                    }
                    $group_name=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'group_name');
                    //Update
                    $ProsesUpdateSertifikat = mysqli_query($Conn,"UPDATE event_sertifikat SET 
                        id_setting_sertifikat='$id_setting_sertifikat',
                        nama='$nama',
                        group_name='$group_name',
                        token='$token'
                    WHERE id_event_sertifikat='$id_event_sertifikat'") or die(mysqli_error($Conn)); 
                    if($ProsesUpdateSertifikat){
                        echo '<code id="NotifikasiEditSponsorBerhasil">Success</code>';
                    }else{
                        echo '<code class="text-danger">Terjadi kesalahan pada saat menambah data sponsor!</code>';
                    }
                }
            }
        }
    }
?>