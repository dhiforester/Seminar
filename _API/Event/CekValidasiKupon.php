<?php
    //Connection
    date_default_timezone_set("Asia/Jakarta");
    $datetime=date('Y-m-d H:i:s');
    $datetime=strtotime($datetime);
    $service_name="Referensi Jadwal Praktek";
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Function.php";
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
        //Tangkap data Data dan decode
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
            //validasi id_peserta tidak boleh kosong
            if(empty($Tangkap['id_peserta'])){
                $id_setting_api_key=0;
                $api_key=0;
                $keterangan="ID Peserta cannot be empty";
                $response = Array (
                    "message" => $keterangan,
                    "code" => 201,
                );
                $metadata = Array ();
            }else{
                 //validasi kode_kupon tidak boleh kosong
                if(empty($Tangkap['kode_kupon'])){
                    $id_setting_api_key=0;
                    $api_key=0;
                    $keterangan="Kode Kupon cannot be empty";
                    $response = Array (
                        "message" => $keterangan,
                        "code" => 201,
                    );
                    $metadata = Array ();
                }else{
                    //Buat Variabel
                    $api_key=$Tangkap['api_key'];
                    $id_peserta=$Tangkap['id_peserta'];
                    $kode_kupon=$Tangkap['kode_kupon'];
                    $id_setting_api_key=getDataDetail($Conn,'setting_api_key','api_key',$api_key,'id_setting_api_key');
                    //validasi id_setting_api_key dari database
                    if(empty($id_setting_api_key)){
                        $id_setting_api_key=0;
                        $api_key=0;
                        $keterangan="The API Key you are using is invalid";
                        $response = Array (
                            "message" => $keterangan,
                            "code" => 201,
                        );
                        $metadata = Array ();
                    }else{
                        //validasi status_api_key (Active)
                        $status_api_key=getDataDetail($Conn,'setting_api_key','api_key',$api_key,'status_api_key');
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
                            //Validasi ID Event Peserta
                            $id_event_setting=getDataDetail($Conn,'event_peserta','id_peserta',$id_peserta,'id_event_setting');
                            if(empty($id_event_setting)){
                                $id_setting_api_key=0;
                                $api_key=0;
                                $keterangan="Invalid Participant ID";
                                $response = Array (
                                    "message" => $keterangan,
                                    "code" => 201,
                                );
                                $metadata = Array ();
                            }else{
                                //Validasi ID Kategori Event Peserta
                                $id_event_kategori=getDataDetail($Conn,'event_peserta','id_peserta',$id_peserta,'id_event_kategori');
                                if(empty($id_event_kategori)){
                                    $id_setting_api_key=0;
                                    $api_key=0;
                                    $keterangan="Invalid Category ID";
                                    $response = Array (
                                        "message" => $keterangan,
                                        "code" => 201,
                                    );
                                    $metadata = Array ();
                                }else{
                                    //Validasi ID Event Kupon
                                    $IdKategoriEventKupon=getDataDetail($Conn,'event_kupon','kode_kupon',$kode_kupon,'id_event_kategori');
                                    if(empty($IdKategoriEventKupon)){
                                        $id_setting_api_key=0;
                                        $api_key=0;
                                        $keterangan="Invalid Coupon Code";
                                        $response = Array (
                                            "message" => $keterangan,
                                            "code" => 201,
                                        );
                                        $metadata = Array ();
                                    }else{
                                        if($IdKategoriEventKupon!==$id_event_kategori){
                                            $id_setting_api_key=0;
                                            $api_key=0;
                                            $keterangan="The coupon does not match the participant's order";
                                            $response = Array (
                                                "message" => $keterangan,
                                                "code" => 201,
                                            );
                                            $metadata = Array ();
                                        }else{
                                            $StatusKupon=getDataDetail($Conn,'event_kupon','kode_kupon',$kode_kupon,'status');
                                            if($StatusKupon=="Sudah Digunakan"){
                                                $id_setting_api_key=0;
                                                $api_key=0;
                                                $keterangan="Coupon Code Already Used";
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
                                                $id_kupon=getDataDetail($Conn,'event_kupon','kode_kupon',$kode_kupon,'id_kupon');
                                                $diskon=getDataDetail($Conn,'event_kupon','kode_kupon',$kode_kupon,'diskon');
                                                $status=getDataDetail($Conn,'event_kupon','kode_kupon',$kode_kupon,'status');
                                                $metadata = Array (
                                                    "kode_kupon" => $kode_kupon,
                                                    "diskon" => $diskon,
                                                    "status" => $status
                                                );
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