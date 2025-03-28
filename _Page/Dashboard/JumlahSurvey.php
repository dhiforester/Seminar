<?php
    include "../../_Config/Connection.php";
    date_default_timezone_set('Asia/Jakarta');
    $hari=date('Y-m-d');
    $bulan=date('Y-m');
    $tahun=date('Y');
    if(empty($_POST['nilai'])){
        $Jumlah="Error Value";
    }else{
        $nilai=$_POST['nilai'];
        if($nilai=="Semua"){
            $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM survey"));
        }else{
            if($nilai=="Hari Ini"){
                $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM survey WHERE mulai_survey like '%$hari%'"));
            }else{
                if($nilai=="Bulan Ini"){
                    $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM survey WHERE mulai_survey like '%$bulan%'"));
                }else{
                    if($nilai=="Tahun Ini"){
                        $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM survey WHERE mulai_survey like '%$tahun%'"));
                    }else{
                        $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM survey"));
                    }
                }
            }
        }
    }
    echo "$Jumlah";
?>