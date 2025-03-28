<?php
    date_default_timezone_set("Asia/Jakarta");
    $TanggalWaktuSekarang=date('Y-m-d H:i:s');
    $EntryLog="INSERT INTO log_api (
        id_setting_api_key,
        api_key,
        service_name,
        response,
        datetime
    ) VALUES (
        '$id_setting_api_key',
        '$api_key',
        '$service_name',
        '$keterangan',
        '$TanggalWaktuSekarang'
    )";
    $InputLog=mysqli_query($Conn, $EntryLog);
?>