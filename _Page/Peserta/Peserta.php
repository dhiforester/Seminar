<?php
    if(empty($_GET['Sub'])){
        include "_Page/Peserta/PesertaHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="DetailPeserta"){
            include "_Page/Peserta/DetailPeserta.php";
        }else{
            include "_Page/Peserta/PesertaHome.php";
        }
    }
?>