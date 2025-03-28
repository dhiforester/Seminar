<?php
    if(empty($_GET['Sub'])){
        include "_Page/UnitKerja/UnitKerjaHome.php";
    }else{
        include "_Page/UnitKerja/DetailUnitKerja.php";
    }
?>