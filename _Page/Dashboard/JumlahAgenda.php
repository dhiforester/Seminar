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
            $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda"));
        }else{
            if($nilai=="Hari Ini"){
                $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda WHERE tanggal like '%$hari%'"));
            }else{
                if($nilai=="Bulan Ini"){
                    $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda WHERE tanggal like '%$bulan%'"));
                }else{
                    if($nilai=="Tahun Ini"){
                        $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda WHERE tanggal like '%$tahun%'"));
                    }else{
                        $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda"));
                    }
                }
            }
        }
    }
    echo "$Jumlah";
?>