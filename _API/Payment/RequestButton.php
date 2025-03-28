<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingPayment.php";
    if(empty($_GET['snap_token'])){
        echo '<span>Snap Token Tidak Boleh Kosong</span>';
    }else{
        $snapToken=$_GET['snap_token'];
        //Krim data dengan CURL
        $headers = array(
            'Content-Type:Application/x-www-form-urlencoded',         
        );
        //CURL send data
        $arr = array(
            "snap_url" => "$snap_url",
            "client_id" => "$server_key",
            "snapToken" => "$snapToken"
        );
        $json = json_encode($arr);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "$api_payment_url/GenerateSnapButton.php");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_TIMEOUT, 3); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $data =json_decode($response, true);
        $code=$data["code"];
        $pesan=$data["pesan"];
        $token=$data["token"];
        echo $response;
    }
    header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + (10 * 60)));
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header('Content-Type: application/json');
	header('Pragma: no-chache');
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Credentials: true');
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
	header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, x-token, token"); 
?>