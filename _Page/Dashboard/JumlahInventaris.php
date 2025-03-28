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
            $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris"));
        }else{
            if($nilai=="Hari Ini"){
                $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE tanggal_input like '%$hari%'"));
            }else{
                if($nilai=="Bulan Ini"){
                    $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE tanggal_input like '%$bulan%'"));
                }else{
                    if($nilai=="Tahun Ini"){
                        $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE tanggal_input like '%$tahun%'"));
                    }else{
                        $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris"));
                    }
                }
            }
        }
    }
    echo "$Jumlah";
?>