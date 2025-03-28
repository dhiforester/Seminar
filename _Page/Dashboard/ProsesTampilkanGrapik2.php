<?php
    include "../../_Config/Connection.php";
    date_default_timezone_set('Asia/Jakarta');
    $Dataset="Pendaftaran Peserta";
    for ($countdown = 7; $countdown >= 1; $countdown--) {
        //Zero pading
        $tanggalSekarang = date('Y-m-d');
        $TanggalYangLalu = date('Y-m-d', strtotime('-'.$countdown.' days', strtotime($tanggalSekarang)));
        $Strtotime2=strtotime($TanggalYangLalu);
        $FormatTanggalYangLalu =date('d/m/Y',$Strtotime2);
        $Jumlah = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE tanggal_daftar like '%$TanggalYangLalu%'"));
        $data [] = array(
            'x' => $FormatTanggalYangLalu,
            'y' => $Jumlah
        );
    }
    $json = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + (10 * 60)));
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header('Content-Type: application/json');
	header('Pragma: no-chache');
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Credentials: true');
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
	header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, x-token, token"); 
	echo $json;
	exit();
?>