<?php
    //Menghitung Notifikasi Admin
    if($SessionAkses=="Admin"){
        $JumlahAksesPending=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE status='Pending'"));
        $JumlahNotifikasi=$JumlahAksesPending;
    }else{
        
    }
?>