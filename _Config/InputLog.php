<?php
    //Zona Waktu
    date_default_timezone_set("Asia/Jakarta");
    $LogTime=date('Y-m-d H:i:s');
    $EntryLog="INSERT INTO log (
        id_akses,
        id_unit_kerja,
        datetime_log,
        kategori_log,
        deskripsi_log
    ) VALUES (
        '$SessionIdAkses',
        '$id_unit_kerja',
        '$LogTime',
        '$KategoriLog',
        '$KeteranganLog'
    )";
    $InputLog=mysqli_query($Conn, $EntryLog);
?>