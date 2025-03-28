<?php
    if(empty($_GET['Sub'])){
        include "_Page/TamplateWa/TamplateWaHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="FormTamplate"){
            include "_Page/TamplateWa/FormTamplate.php";
        }else{
            include "_Page/TamplateWa/TamplateWaHome.php";
        }
    }
?>