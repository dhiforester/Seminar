<?php
    //Menangkap seasson kemudian menampilkannya
    session_start();
    if(empty($_SESSION["id_akses"])){
        header("Location:Login.php");
    }else{
        $SessionIdAkses=$_SESSION ["id_akses"];
        //Inisiasi data akses dari database
        $QuerySessionAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$SessionIdAkses'")or die(mysqli_error($Conn));
        $DataSessionAkses = mysqli_fetch_array($QuerySessionAkses);
        //Apabila data akses ada
        if(!empty($DataSessionAkses['id_akses'])){
            $SessionNama= $DataSessionAkses['nama_akses'];
            $SessionEmail= $DataSessionAkses['email_akses'];
            $SessionKontak= $DataSessionAkses['kontak_akses'];
            $SessionPassword= $DataSessionAkses['password'];
            $SessionAkses= $DataSessionAkses['akses'];
            if(!empty($DataSessionAkses['image_akses'])){
                $SessionGambar= $DataSessionAkses['image_akses'];
            }else{
                $SessionGambar="No-Image.png";
            }
            $SessionStatus= $DataSessionAkses['status'];
            $SessionWaktuDaftar= $DataSessionAkses['datetime_daftar'];
            $SessionWaktuUpdate= $DataSessionAkses['datetime_update'];
            //Melakukan updatetime
            $WaktuUpdatetime=date('Y-m-d H:i:s');
            $UpdateOnline = mysqli_query($Conn,"UPDATE akses SET datetime_update='$WaktuUpdatetime' WHERE id_akses='$SessionIdAkses'") or die(mysqli_error($Conn));
        }else{
            header("Location:Login.php");
        }
    }
?>
