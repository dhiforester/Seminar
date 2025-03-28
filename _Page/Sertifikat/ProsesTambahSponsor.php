<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    date_default_timezone_set('Asia/Jakarta');
    if(empty($_POST['id_event_setting'])){
        echo '<code class="text-danger">ID Event Tidak Boleh Kosong!</code>';
    }else{
        if(empty($_POST['id_setting_sertifikat'])){
            echo '<code class="text-danger">ID Setting Sertifikat Tidak Boleh Kosong!</code>';
        }else{
            if(empty($_POST['nama'])){
                echo '<code class="text-danger">Nama Sponsor Tidak Boleh Kosong!</code>';
            }else{
                $DatetimeNow=date('Y-m-d H:i:s');
                $DatetimeNow=strtotime($DatetimeNow);
                $id_event_setting=$_POST['id_event_setting'];
                $id_setting_sertifikat=$_POST['id_setting_sertifikat'];
                $nama=$_POST['nama'];
                $kategori_sertifikat="Sponsor";
                $group_name=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'group_name');
                $token="$id_event_setting-$kategori_sertifikat-$DatetimeNow";
                $token=md5($token);
                //Insert
                $EntrySertifikat="INSERT INTO event_sertifikat (
                    id_event_setting,
                    id_setting_sertifikat,
                    id_person,
                    nama,
                    kategori_sertifikat,
                    group_name,
                    kode_idi,
                    token
                ) VALUES (
                    '$id_event_setting',
                    '$id_setting_sertifikat',
                    '0',
                    '$nama',
                    '$kategori_sertifikat',
                    '$group_name',
                    '',
                    '$token'
                )";
                $ProsesGenerate=mysqli_query($Conn, $EntrySertifikat);
                if($ProsesGenerate){
                    echo '<code id="NotifikasiTambahSponsorBerhasil">Success</code>';
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan pada saat menambah data sponsor!</code>';
                }
            }
        }
    }
?>