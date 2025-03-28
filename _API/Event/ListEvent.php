<?php
    //Connection
    date_default_timezone_set("Asia/Jakarta");
    $datetime=date('Y-m-d H:i:s');
    $datetime=strtotime($datetime);
    $service_name="Referensi Jadwal Praktek";
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    //Tangkap Data
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $id_setting_api_key=0;
        $api_key=0;
        $keterangan="Only POST data transmission method is allowed";
        $response = Array (
            "message" => $keterangan,
            "code" => 201,
        );
        $metadata = Array ();
	}else{
        //Tangkap data dana decode
        $fp = fopen('php://input', 'r');
		$raw = stream_get_contents($fp);
		$Tangkap = json_decode($raw,true);
		if(empty($Tangkap['api_key'])){
            $id_setting_api_key=0;
            $api_key=0;
            $keterangan="api_key cannot be empty";
            $response = Array (
                "message" => $keterangan,
                "code" => 201,
            );
            $metadata = Array ();
        }else{
            $api_key=$Tangkap['api_key'];
            $QryValidasi = mysqli_query($Conn,"SELECT * FROM setting_api_key WHERE api_key='$api_key'")or die(mysqli_error($Conn));
            $DataValidasiApi = mysqli_fetch_array($QryValidasi);
            $id_setting_api_key = $DataValidasiApi['id_setting_api_key'];
            $status_api_key = $DataValidasiApi['status_api_key'];
            if($status_api_key!=="Active"){
                $id_setting_api_key=0;
                $api_key=0;
                $keterangan="api_key is not active, please contact the admin to activate it";
                $response = Array (
                    "message" => $keterangan,
                    "code" => 201,
                );
                $metadata = Array ();
            }else{
                $id_setting_api_key=$id_setting_api_key;
                $api_key=$api_key;
                $keterangan="success";
                $response = Array (
                    "message" => $keterangan,
                    "code" => 200,
                );
                $QryEvent = "SELECT * FROM event_setting";
                $DataEvent  =mysqli_query($Conn, $QryEvent);
                $metadata = array();
                while($x = mysqli_fetch_array($DataEvent)){
                    $id_event_setting=$x["id_event_setting"];
                    $tanggal_mulai=$x["tanggal_mulai"];
                    $tanggal_selesai=$x["tanggal_selesai"];
                    $mulai_pendaftaran=$x["mulai_pendaftaran"];
                    $selesai_pendaftaran=$x["selesai_pendaftaran"];
                    $nama_event=$x["nama_event"];
                    $keterangan=$x["keterangan"];
                    $status=$x["status"];
                    //Format Tanggal
                    $timestamp1= strtotime($tanggal_mulai);
                    $timestamp2= strtotime($tanggal_selesai);
                    $timestamp3= strtotime($mulai_pendaftaran);
                    $timestamp4= strtotime($selesai_pendaftaran);
                    //Milisecond
                    $TanggalMulai = $timestamp1 * 1000;
                    $TanggalSelesai = $timestamp2 * 1000;
                    $MulaiPendaftaran = $timestamp3 * 1000;
                    $SelesaiPendaftaran = $timestamp4 * 1000;

                    $h['id_event_setting'] =$id_event_setting ;
                    $h['tanggal_mulai'] =$TanggalMulai;
                    $h['tanggal_selesai'] =$TanggalSelesai;
                    $h['mulai_pendaftaran'] =$MulaiPendaftaran;
                    $h['selesai_pendaftaran'] =$SelesaiPendaftaran;
                    $h['nama_event'] =$nama_event;
                    $h['keterangan'] =$keterangan;
                    $h['status'] =$status;
                    array_push($metadata, $h);
                }
            }
        }
    }
    include "../../_Config/InputLogApi.php";
    $Array = Array (
        "response" => $response,
        "metadata" => $metadata
    );
    $json = json_encode($Array, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
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