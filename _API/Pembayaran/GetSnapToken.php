<?php
    //Connection
    date_default_timezone_set("Asia/Jakarta");
    $datetime=date('Y-m-d H:i:s');
    $datetime=strtotime($datetime);
    $service_name="Referensi Jadwal Praktek";
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/SettingPayment.php";
    include "../../_Config/Function.php";
    $TanggalDaftar=date('Y-m-d H:i');
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
            //validasi kode_transaksi tidak boleh kosong
            if(empty($Tangkap['kode_transaksi'])){
                $id_setting_api_key=0;
                $api_key=0;
                $keterangan="Code Transaction cannot be empty";
                $response = Array (
                    "message" => $keterangan,
                    "code" => 201,
                );
                $metadata = Array ();
            }else{
                $api_key=$Tangkap['api_key'];
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
                        //Buat Variabel
                        $kode_transaksi=$Tangkap['kode_transaksi'];
                        $StatusPembayaran=getDataDetail($Conn,'event_pembayaran','kode_transaksi',$kode_transaksi,'status');
                        if($StatusPembayaran=="Lunas"){
                            $id_setting_api_key=0;
                            $api_key=0;
                            $keterangan="Transaksi sudah lunas, tidak bisa membuat snap token baru";
                            $response = Array (
                                "message" => $keterangan,
                                "code" => 201,
                            );
                            $metadata = Array ();
                        }else{
                            $id_peserta=getDataDetail($Conn,'event_pembayaran','kode_transaksi',$kode_transaksi,'id_peserta');
                            if(empty($id_peserta)){
                                $id_setting_api_key=0;
                                $api_key=0;
                                $keterangan="Kode Transaksi Tidak Valid, Atau Tidak Ditemukan Pada Database";
                                $response = Array (
                                    "message" => $keterangan,
                                    "code" => 201,
                                );
                                $metadata = Array ();
                            }else{
                                $tagihan=getDataDetail($Conn,'event_pembayaran','kode_transaksi',$kode_transaksi,'tagihan');
                                $order_id ="ORDID-$id_peserta-$datetime";
                                $NamaPeserta=getDataDetail($Conn,'event_peserta','id_peserta',$id_peserta,'nama');
                                $Explode = explode(" " , $NamaPeserta);
                                $first_name =$Explode[0];
                                if(empty($Explode[1])){
                                    $last_name ="";
                                }else{
                                    $last_name =$Explode[1];
                                }
                                
                                $email=getDataDetail($Conn,'event_peserta','id_peserta',$id_peserta,'email');
                                $phone=getDataDetail($Conn,'event_peserta','id_peserta',$id_peserta,'kontak');
                                //Krim data dengan CURL
                                $headers = array(
                                    'Content-Type:Application/x-www-form-urlencoded',         
                                );
                                //CURL send data
                                $arr = array(
                                    "ServerKey" => "$server_key",
                                    "Production" => "$production",
                                    "kode_transaksi" => "$kode_transaksi",
                                    "order_id" => "$order_id",
                                    "gross_amount" => "$tagihan",
                                    "first_name" => "$first_name",
                                    "last_name" => "$last_name",
                                    "email" => "$email",
                                    "phone" => "$phone"
                                );
                                $json = json_encode($arr);
                                $curl = curl_init();
                                curl_setopt($curl, CURLOPT_URL, "$api_payment_url/GetSnapToken.php");
                                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                                curl_setopt($curl, CURLOPT_TIMEOUT, 3); 
                                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                                curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($curl);
                                if(empty($response)){
                                    $pesan=$response_decode["pesan"];
                                    $id_setting_api_key=0;
                                    $api_key=0;
                                    $keterangan="$curl";
                                    $response = Array (
                                        "message" => "$keterangan",
                                        "code" => 201,
                                    );
                                    $metadata = Array ();
                                }else{
                                    $response_decode =json_decode($response, true);
                                    if($response_decode["code"]==200){
                                        $code=$response_decode["code"];
                                        $pesan=$response_decode["pesan"];
                                        $token=$response_decode["token"];
                                        $id_setting_api_key=$id_setting_api_key;
                                        $api_key=$api_key;
                                        $keterangan="success";
                                        $response = Array (
                                            "message" => $keterangan,
                                            "code" => 200,
                                        );
                                        $metadata = Array (
                                            "kode_transaksi" => $kode_transaksi,
                                            "first_name" => $first_name,
                                            "last_name" => $last_name,
                                            "email" => $email,
                                            "phone" => "$phone",
                                            "tagihan" => $tagihan,
                                            "order_id" => $order_id,
                                            "token" => $token
                                        );
                                    }else{
                                        $pesan=$response_decode["pesan"];
                                        $id_setting_api_key=0;
                                        $api_key=0;
                                        $keterangan="$pesan";
                                        $response = Array (
                                            "message" => "$keterangan",
                                            "code" => 201,
                                        );
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