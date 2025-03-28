<?php
    // $nama_tujuan="";
    // $email_tujuan="";
    // $subjek_email="";
    // $isi_email="";
    // $datetime_email="";
    $datetime_email2=date('Y-m-d H:i:s');
    $EntryLogEmail="INSERT INTO log_email (
        nama,
        email,
        subjek,
        pesan,
        datetime
    ) VALUES (
        '$nama_tujuan',
        '$email_tujuan',
        '$subjek_email',
        '$isi_email',
        '$datetime_email2'
    )";
    $InputLogEmail=mysqli_query($Conn, $EntryLogEmail);
    // if($InputLogEmail){
?>