<?php
    if(empty($_GET['Sub'])){
        include "_Page/Dukungan/DukunganHome.php";
    }else{
        include "_Page/Dukungan/DetailDukungan.php";
    }
?>