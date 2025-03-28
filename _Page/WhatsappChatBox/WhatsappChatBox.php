<?php
    if(empty($_GET['Sub'])){
        include "_Page/WhatsappChatBox/WhatsappChatBoxHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="DetailChatBox"){
            include "_Page/WhatsappChatBox/DetailChatBox.php";
        }
    }
?>