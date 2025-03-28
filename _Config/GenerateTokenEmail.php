<?php
    date_default_timezone_set("Asia/Jakarta");
    $Datetime_generate=date('Y-m-d H:i:s');
    $TokenValidasi=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
    //Apakah id_akses sudah ada token?
    $CekToken=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_validasi WHERE id_akses='$id_akses'"));
    if(empty($CekToken)){
        //Insert Token
        $EntryTokenAkses="INSERT INTO akses_validasi (
            id_akses,
            token,
            datetime
        ) VALUES (
            '$id_akses',
            '$TokenValidasi',
            '$Datetime_generate'
        )";
        $GenerateToken=mysqli_query($Conn, $EntryTokenAkses);
    }else{
        $GenerateToken = mysqli_query($Conn,"UPDATE akses_validasi SET 
            id_akses='$id_akses',
            token='$TokenValidasi',
            datetime='$Datetime_generate'
        WHERE id_akses='$id_akses'") or die(mysqli_error($Conn)); 
    }
?>