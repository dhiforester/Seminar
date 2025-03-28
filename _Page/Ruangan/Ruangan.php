<?php
    if(empty($_GET['Sub'])){
        include "_Page/Ruangan/RuanganHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="DetailRuangan"){
            include "_Page/Ruangan/DetailRuangan.php";
        }else{
            include "_Page/Ruangan/RuanganHome.php";
        }
    }
?>
