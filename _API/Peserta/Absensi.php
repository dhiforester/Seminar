<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/SettingEmail.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set("Asia/Jakarta");
    //Time Now Tmp
    $TanggalSekarang=date('Y-m-d H:i');
    $now=date('Y-m-d H:i:s');
    $now=strtotime($now);
    $datetime=strtotime($now);
    $service_name="Absensi On Site";
    //Validasi Metode Pengiriman Data
    if($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $id_setting_api_key=0;
        $api_key=0;
        $keterangan="Only POST data transmission method is allowed";
        $code=201;
        $metadata = Array ();
	}else{
        //Tangkap data dana decode
        $fp = fopen('php://input', 'r');
		$raw = stream_get_contents($fp);
		$Tangkap = json_decode($raw,true);
        //Validasi api_key tidak boleh kosong
		if(empty($Tangkap['api_key'])){
            $id_setting_api_key=0;
            $api_key=0;
            $keterangan="API Key cannot be empty";
            $code=201;
            $metadata = Array ();
        }else{
            //Validasi api_key Active
            $api_key=$Tangkap['api_key'];
            $status_api_key =getDataDetail($Conn,'setting_api_key','api_key',$api_key,'status_api_key');
            $id_setting_api_key =getDataDetail($Conn,'setting_api_key','api_key',$api_key,'id_setting_api_key');
            if($status_api_key!=="Active"){
                $keterangan="API Key is not active, please contact the admin to activate it";
                $code=201;
                $metadata = Array ();
            }else{
                //Validasi id_peserta tidak boleh kosong
                if(empty($Tangkap['id_peserta'])){
                    $keterangan="Participant ID Cannot Be Empty";
                    $code=201;
                    $metadata = Array ();
                }else{
                    //Validasi id_event_sesi_absen tidak boleh kosong
                    if(empty($Tangkap['id_event_sesi_absen'])){
                        $keterangan="Event Session ID Cannot Be Empty";
                        $code=201;
                        $metadata = Array ();
                    }else{
                        //Validasi metode tidak boleh kosong
                        if(empty($Tangkap['metode'])){
                            $keterangan="Method Cannot Be Empty";
                            $code=201;
                            $metadata = Array ();
                        }else{
                            $metode=$Tangkap['metode'];
                            $id_peserta=$Tangkap['id_peserta'];
                            $id_event_sesi_absen=$Tangkap['id_event_sesi_absen'];
                            $id_event_setting =getDataDetail($Conn,'event_peserta','id_peserta',$id_peserta,'id_event_setting');
                            $id_event_kategori =getDataDetail($Conn,'event_peserta','id_peserta',$id_peserta,'id_event_kategori');
                            $IdEventSetting =getDataDetail($Conn,'event_sesi_absen','id_event_sesi_absen',$id_event_sesi_absen,'id_event_setting');
                            //Validasi Metode
                            if($metode!=="On-Site"&&$metode!=="Online"){
                                $keterangan="Invalid attendance method";
                                $code=201;
                                $metadata = Array ();
                            }else{
                                //Validasi ID Peserta
                                if(empty($id_event_setting)){
                                    $keterangan="Participant ID Not Valid";
                                    $code=201;
                                    $metadata = Array ();
                                }else{
                                    //Validasi ID Sesi Absensi
                                    if(empty($IdEventSetting)){
                                        $keterangan="Event Session ID";
                                        $code=201;
                                        $metadata = Array ();
                                    }else{
                                        if($id_event_setting!==$IdEventSetting){
                                            $keterangan="Participant Event ID and Event Session ID Do not Match";
                                            $code=201;
                                            $metadata = Array ();
                                        }else{
                                            //Buka Tanggal Mulai Dan Selesai
                                            $tanggal_mulai =getDataDetail($Conn,'event_sesi_absen','id_event_sesi_absen',$id_event_sesi_absen,'tanggal_mulai');
                                            $tanggal_selesai =getDataDetail($Conn,'event_sesi_absen','id_event_sesi_absen',$id_event_sesi_absen,'tanggal_selesai');
                                            if($TanggalSekarang<$tanggal_mulai){
                                                $keterangan="Attendance Session Hasn't Started Yet";
                                                $code=201;
                                                $metadata = Array ();
                                            }else{
                                                if($TanggalSekarang>$tanggal_selesai){
                                                    $keterangan="Attendance Session is Over";
                                                    $code=201;
                                                    $metadata = Array ();
                                                }else{
                                                    if($TanggalSekarang<$tanggal_selesai&&$TanggalSekarang>$tanggal_mulai){
                                                        //Cek Duplikat Data
                                                        $QryKehadiran = mysqli_query($Conn,"SELECT * FROM event_absen WHERE id_peserta='$id_peserta' AND id_event_sesi_absen='$id_event_sesi_absen'")or die(mysqli_error($Conn));
                                                        $DataKehadiran = mysqli_fetch_array($QryKehadiran);
                                                        if(!empty($DataKehadiran['id_event_absen'])){
                                                            $keterangan="Participants Have Filled in Absences!";
                                                            $code=201;
                                                            $metadata = Array ();
                                                        }else{
                                                            $entry="INSERT INTO event_absen (
                                                                id_event_sesi_absen,
                                                                id_event_setting,
                                                                id_event_kategori,
                                                                id_peserta,
                                                                tanggal,
                                                                metode
                                                            ) VALUES (
                                                                '$id_event_sesi_absen',
                                                                '$id_event_setting',
                                                                '$id_event_kategori',
                                                                '$id_peserta',
                                                                '$TanggalSekarang',
                                                                '$metode'
                                                            )";
                                                            $ProsesAbsen=mysqli_query($Conn, $entry);
                                                            if($ProsesAbsen){
                                                                $keterangan="success";
                                                                $code=200;
                                                                $metadata = Array (
                                                                    "id_event_setting" => $id_event_setting,
                                                                    "id_event_kategori" => $id_event_kategori,
                                                                    "id_event_sesi_absen" => $id_event_sesi_absen,
                                                                    "id_peserta" => $id_peserta,
                                                                    "tanggal" => $TanggalSekarang,
                                                                    "metode" => $metode
                                                                );
                                                            }else{
                                                                $keterangan="An error occurred while saving data to the database";
                                                                $code=201;
                                                                $metadata = Array ();
                                                            }
                                                        }
                                                    }else{
                                                        $keterangan="An error occurred while checking the attendance time";
                                                        $code=201;
                                                        $metadata = Array ();
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    $response = Array (
        "message" => "$keterangan",
        "code" => $code,
    );
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