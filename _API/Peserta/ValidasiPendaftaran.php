<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/SettingEmail.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    $datetime=date('Y-m-d H:i:s');
    $now=strtotime($datetime);
    $datetime=strtotime($datetime);
    $service_name="Validation Email";
    //Validasi Metode Pengiriman Data
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
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
            $id_setting_api_key =getDataDetail($Conn,'setting_api_key','api_key',$api_key,'id_setting_api_key');
            $status_api_key =getDataDetail($Conn,'setting_api_key','api_key',$api_key,'status_api_key');
            if($status_api_key!=="Active"){
                $id_setting_api_key=$id_setting_api_key;
                $api_key=$api_key;
                $keterangan="API Key is not active, please contact the admin to activate it";
                $code=201;
                $metadata = Array ();
            }else{
                //Validasi email tidak boleh kosong
                if(empty($Tangkap['email'])){
                    $id_setting_api_key=$id_setting_api_key;
                    $api_key=$api_key;
                    $keterangan="Email Can not Be Empty";
                    $code=201;
                    $metadata = Array ();
                }else{
                     //Validasi email tidak boleh kosong
                    if(empty($Tangkap['validation_code'])){
                        $id_setting_api_key=$id_setting_api_key;
                        $api_key=$api_key;
                        $keterangan="Validation Code Can not Be Empty";
                        $code=201;
                        $metadata = Array ();
                    }else{
                        $validation_code=$Tangkap['validation_code'];
                        $email=$Tangkap['email'];
                        //Buka id_peserta berdasarkan email
                        $id_peserta =getDataDetail($Conn,'event_peserta','email',$email,'id_peserta');
                        if(empty($id_peserta)){
                            $id_setting_api_key=$id_setting_api_key;
                            $api_key=$api_key;
                            $keterangan="Email not registered";
                            $code=201;
                            $metadata = Array ();
                        }else{
                            //Validasi Token ada atau tidak berdasarkan id_peserta yang diinput
                            $QryValidasi = mysqli_query($Conn,"SELECT * FROM event_validasi WHERE id_peserta='$id_peserta' AND token='$validation_code' AND status='Belum Digunakan'")or die(mysqli_error($Conn));
                            $DataValidasi = mysqli_fetch_array($QryValidasi);
                            //Apabila data token akses tidak ada
                            if(empty($DataValidasi['id_event_validasi'])){
                                $id_setting_api_key=$id_setting_api_key;
                                $api_key=$api_key;
                                $keterangan="The token you are using is invalid";
                                $code=201;
                                $metadata = Array ();
                            }else{
                                $id_event_validasi= $DataValidasi['id_event_validasi'];
                                //Lakukan update status peserta
                                $UpdatePeserta = mysqli_query($Conn,"UPDATE event_peserta SET 
                                    status_validasi='Valid'
                                WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn)); 
                                if($UpdatePeserta){
                                    $UpdateToken = mysqli_query($Conn,"UPDATE event_validasi SET 
                                        status='Digunakan'
                                    WHERE id_event_validasi='$id_event_validasi'") or die(mysqli_error($Conn)); 
                                    if($UpdateToken){
                                        $id_setting_api_key=$id_setting_api_key;
                                        $api_key=$api_key;
                                        $keterangan="success";
                                        $code=200;
                                        $metadata = Array (
                                            "id_peserta" => $id_peserta,
                                            "status_validasi" => 'Valid',
                                            "email" => $email
                                        );
                                    }else{
                                        $id_setting_api_key=$id_setting_api_key;
                                        $api_key=$api_key;
                                        $keterangan="Update Validation Data Invalid";
                                        $code=201;
                                        $metadata = Array ();
                                    }
                                }else{
                                    $id_setting_api_key=$id_setting_api_key;
                                    $api_key=$api_key;
                                    $keterangan="Update Validation Status Invalid";
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
    $response = Array (
        "message" => $keterangan,
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