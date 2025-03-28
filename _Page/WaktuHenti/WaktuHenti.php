<?php
    if(empty($_GET['Sub'])){
        include "_Page/WaktuHenti/WaktuHentiHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="Laporan"){
            include "_Page/WaktuHenti/WaktuHentiLaporan.php";
        }else{
            include "_Page/WaktuHenti/WaktuHentiHome.php";
        }
    }
?>