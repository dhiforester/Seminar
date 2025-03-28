<?php
    //Koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap Variabel
    if(empty($_POST['id_akses'])){
        echo '<span class="text-danger">ID Akses Tidak Boleh Kosong!</span>';
    }else{
        $id_akses=$_POST['id_akses'];
        //Variabel Akses
        if(empty($_POST['acc_akses1'])){
            $acc_akses1="Tidak";
        }else{
            $acc_akses1=$_POST['acc_akses1'];
        }
        if(empty($_POST['acc_akses2'])){
            $acc_akses2="Tidak";
        }else{
            $acc_akses2=$_POST['acc_akses2'];
        }
        if(empty($_POST['acc_akses3'])){
            $acc_akses3="Tidak";
        }else{
            $acc_akses3=$_POST['acc_akses3'];
        }
        if(empty($_POST['acc_akses4'])){
            $acc_akses4="Tidak";
        }else{
            $acc_akses4=$_POST['acc_akses4'];
        }
        if(empty($_POST['acc_akses5'])){
            $acc_akses5="Tidak";
        }else{
            $acc_akses5=$_POST['acc_akses5'];
        }
        //Cek Keberadaan data
        $CekAccAkses = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM acc_akses WHERE id_akses='$id_akses'"));
        if(empty($CekAccAkses)){
            //Tambah Data
            $entry="INSERT INTO acc_akses (
                id_akses,
                acc_akses1,
                acc_akses2,
                acc_akses3,
                acc_akses4,
                acc_akses5
            ) VALUES (
                '$id_akses',
                '$acc_akses1',
                '$acc_akses2',
                '$acc_akses3',
                '$acc_akses4',
                '$acc_akses5'
            )";
            $Input=mysqli_query($Conn, $entry);
            if($Input){
                $_SESSION ["NotifikasiSwal"]="Atur Akses Berhasil";
                echo '<small class="text-success" id="NotifikasiAturIjinAksesBerhasil">Success</small>';
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }else{
            $UpdateIjinAkses = mysqli_query($Conn,"UPDATE acc_akses SET 
                acc_akses1='$acc_akses1',
                acc_akses2='$acc_akses2',
                acc_akses3='$acc_akses3',
                acc_akses4='$acc_akses4',
                acc_akses5='$acc_akses5'
            WHERE id_akses='$id_akses'") or die(mysqli_error($Conn)); 
            if($UpdateIjinAkses){
                $_SESSION ["NotifikasiSwal"]="Atur Akses Berhasil";
                echo '<small class="text-success" id="NotifikasiAturIjinAksesBerhasil">Success</small>';
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }
    }
?>