<?php
    if(empty($_GET['Sub'])){
        include "_Page/WhatsappGateway/AkunWa.php";
    }else{
        if($_GET['Sub']=="AkunWa"){
            include "_Page/WhatsappGateway/AkunWa.php";
        }else{
            if($_GET['Sub']=="ChatBox"){
                include "_Page/WhatsappGateway/ChatBox.php";
            }else{
                include "_Page/WhatsappGateway/AkunWa.php";
            }
        }
    }
?>