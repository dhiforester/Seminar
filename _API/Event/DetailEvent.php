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
            if(empty($Tangkap['id_event_setting'])){
                $id_setting_api_key=0;
                $api_key=0;
                $keterangan="id_event_setting cannot be empty";
                $response = Array (
                    "message" => $keterangan,
                    "code" => 201,
                );
                $metadata = Array ();
            }else{
                $api_key=$Tangkap['api_key'];
                $id_event_setting=$Tangkap['id_event_setting'];
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
                        "id_event_setting" => $id_event_setting,
                        "code" => 200,
                    );
                    //Detail Event
                    $QryEventDetail= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
                    $DataEventDetail= mysqli_fetch_array($QryEventDetail);
                    $tanggal_mulai= $DataEventDetail['tanggal_mulai'];
                    $tanggal_selesai= $DataEventDetail['tanggal_selesai'];
                    $mulai_pendaftaran= $DataEventDetail['mulai_pendaftaran'];
                    $selesai_pendaftaran= $DataEventDetail['selesai_pendaftaran'];
                    $nama_event= $DataEventDetail['nama_event'];
                    $KeteranganEvent= $DataEventDetail['keterangan'];
                    $StatusEvent= $DataEventDetail['status'];
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
                    //List Kategori
                    $QryEvent = "SELECT * FROM event_kategori WHERE id_event_setting='$id_event_setting'";
                    $DataEvent  =mysqli_query($Conn, $QryEvent);
                    $list = array();
                    while($x = mysqli_fetch_array($DataEvent)){
                        $id_event_kategori =$x["id_event_kategori"];
                        $kategori=$x["kategori"];
                        $keterangan=$x["keterangan"];
                        $harga_tiket=$x["harga_tiket"];
                        $kuota=$x["kuota"];
                        $h['id_event_kategori'] =$id_event_kategori ;
                        $h['kategori'] =$kategori;
                        $h['keterangan'] =$keterangan;
                        $h['harga_tiket'] =$harga_tiket;
                        $h['kuota'] =$kuota;
                        array_push($list, $h);
                    }
                    //List Sesi Absensi
                    $QrySesiAbsensi = "SELECT * FROM event_sesi_absen WHERE id_event_setting='$id_event_setting'";
                    $DataSesiAbsensi =mysqli_query($Conn, $QrySesiAbsensi);
                    $ListSesiAbsensi = array();
                    while($y = mysqli_fetch_array($DataSesiAbsensi)){
                        $timestamp5= strtotime($y["tanggal_mulai"]);
                        $timestamp6= strtotime($y["tanggal_selesai"]);
                        $TanggalMulaiAbsensi = $timestamp5 * 1000;
                        $TanggalSelesaiAbsensi = $timestamp6 * 1000;
                        $j['id_event_sesi_absen']=$y["id_event_sesi_absen"];
                        $j['label_sesi']=$y["label_sesi"];
                        $j['tanggal_mulai']=$TanggalMulaiAbsensi;
                        $j['tanggal_selesai']=$TanggalSelesaiAbsensi ;
                        array_push($ListSesiAbsensi, $j);
                    }
                    $metadata = Array (
                        "id_event_setting" => $id_event_setting,
                        "tanggal_mulai" => $TanggalMulai,
                        "tanggal_selesai" => $TanggalSelesai,
                        "mulai_pendaftaran" => $MulaiPendaftaran,
                        "selesai_pendaftaran" => $SelesaiPendaftaran,
                        "nama_event" => $nama_event,
                        "keterangan_event" => $KeteranganEvent,
                        "status_event" => $StatusEvent,
                        "ListSesiAbsensi" => $ListSesiAbsensi,
                        "list" => $list
                    );
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