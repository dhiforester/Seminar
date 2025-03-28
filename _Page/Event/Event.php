<?php
    if(empty($_GET['Sub'])){
        include "_Page/Event/EventHome.php";
    }else{
        include "_Page/Event/DetailEvent.php";
    }
?>