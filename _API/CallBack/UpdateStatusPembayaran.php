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
        //validasi api_key tidak boleh kosong
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
                //validasi status tidak boleh kosong
                if(empty($Tangkap['status'])){
                    $id_setting_api_key=0;
                    $api_key=0;
                    $keterangan="The transaction status cannot be empty";
                    $response = Array (
                        "message" => $keterangan,
                        "code" => 201,
                    );
                    $metadata = Array ();
                }else{
                    $kode_transaksi=$Tangkap['kode_transaksi'];
                    $api_key=$Tangkap['api_key'];
                    $status=$Tangkap['status'];
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
                            //Validasi Pembayaran Lunas Tidak Bisa Diubah
                            $StatusPembayaran=getDataDetail($Conn,'event_pembayaran','kode_transaksi',$kode_transaksi,'status');
                            $id_peserta=getDataDetail($Conn,'event_pembayaran','kode_transaksi',$kode_transaksi,'id_peserta');
                            if($StatusPembayaran=="Lunas"){
                                $id_setting_api_key=0;
                                $api_key=0;
                                $keterangan="The transaction has been paid in full, you cannot delete a transaction that has been paid in full";
                                $response = Array (
                                    "message" => $keterangan,
                                    "code" => 201,
                                );
                                $metadata = Array ();
                            }else{
                                if($status!=="Lunas"&&$status!=="Pending"&&$status!=="Expired"){
                                    $id_setting_api_key=0;
                                    $api_key=0;
                                    $keterangan="Transaction status can only be Lunas, Pending and Expired";
                                    $response = Array (
                                        "message" => $keterangan,
                                        "code" => 201,
                                    );
                                    $metadata = Array ();
                                }else{
                                    //Update Status Transaksi
                                    $UpdatePembayaran = mysqli_query($Conn,"UPDATE event_pembayaran SET 
                                        status='$status'
                                    WHERE kode_transaksi='$kode_transaksi'") or die(mysqli_error($Conn)); 
                                    if($UpdatePembayaran){
                                        //Update Status Pembayaran Peserta
                                        $UpdateStatusPembayaranPeserta = mysqli_query($Conn,"UPDATE event_peserta SET 
                                            status_pembayaran='$status'
                                        WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn)); 
                                        if($UpdateStatusPembayaranPeserta){
                                            $id_setting_api_key=$id_setting_api_key;
                                            $api_key=$api_key;
                                            $keterangan="success";
                                            $response = Array (
                                                "message" => $keterangan,
                                                "code" => 200
                                            );
                                            $metadata = Array (
                                                "kode_transaksi" => $kode_transaksi,
                                                "status" => $status
                                            );
                                        }else{
                                            $id_setting_api_key=0;
                                            $api_key=0;
                                            $keterangan="Update Data Peserta Gagal";
                                            $response = Array (
                                                "message" => "$keterangan",
                                                "code" => 201
                                            );
                                            $metadata = Array ();
                                        }
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