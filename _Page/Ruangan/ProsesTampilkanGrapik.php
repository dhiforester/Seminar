<?php
    include "../../_Config/Connection.php";
    date_default_timezone_set('Asia/Jakarta');
    if(!empty($_POST['PeriodeTahun'])){
        if(!empty($_POST['id_ruangan'])){
            $PeriodeTahun=$_POST['PeriodeTahun'];
            $id_ruangan=$_POST['id_ruangan'];
            $FileName="Laporan.json";
            $Dataset=="Log Kunjungan";
            $a=1;
            $b=12;
            for ( $i =$a; $i<=$b; $i++ ){
                //Zero pading
                $i=sprintf("%02d", $i);
                $WaktuPencarian="$PeriodeTahun-$i";
                $WaktuFormating="$PeriodeTahun-$i-01";
                $Waktu = strtotime($WaktuFormating);
                $Waktu = date('F Y', $Waktu);
                $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM list_kunjungan WHERE id_ruangan='$id_ruangan' AND datetime like '%$WaktuPencarian%'"));
                $data [] = array(
                    'x' => $Waktu,
                    'y' => $Jumlah
                );
            }
        }
    }
    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($FileName, $jsonfile);
?>