<?php
    if(empty($_GET['Sub'])){
        include "_Page/RencanaKirim/RencanaKirimHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="RencanaKirimByMitra"){
            include "_Page/RencanaKirim/RencanaKirimByMitra.php";
        }else{
            include "_Page/RencanaKirim/RencanaKirimHome.php";
        }
    }
?>