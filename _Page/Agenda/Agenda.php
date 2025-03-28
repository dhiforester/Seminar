<?php
    if(empty($_GET['Sub'])){
        include "_Page/Agenda/AgendaHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="DetailAgenda"){
            include "_Page/Agenda/DetailAgenda.php";
        }
    }
?>