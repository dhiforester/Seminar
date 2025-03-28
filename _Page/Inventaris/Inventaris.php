<?php
    if(empty($_GET['Sub'])){
        include "_Page/Inventaris/InventarisHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="DetailInventaris"){
            include "_Page/Inventaris/DetailInventaris.php";
        }else{
            include "_Page/Inventaris/InventarisHome.php";
        }
    }
?>