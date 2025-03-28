<?php
    //koneksi dan session
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/SettingWhatsapp.php";
    if(empty($_POST['clientId'])){
        echo '<span class="text-danger">Client ID Tidak Dapat Ditangkap Oleh Sistem</span>';
    }else{
        $clientId=$_POST['clientId'];
        //hapus juga di akun WA
        $HapusAkunWa=mysqli_query($Conn, "DELETE FROM whatsapp_client WHERE clientId='$clientId'") or die(mysqli_error($Conn));
        $arr = array(
            "api_key"=> "$api_key_Whatsapp",
            "clientId"=> "$clientId"
        );
        $headers = array(
            'Content-Type:Application/x-www-form-urlencoded'
        );
        $json=json_encode($arr);
        //Kirim data CURL
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, "$url_remove_client");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch,CURLOPT_TIMEOUT, 30);
        curl_setopt($ch,CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch,CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json))
        );
        $result = curl_exec($ch);
        curl_close($ch);
        $ambil_json =json_decode($result, true);
        if($ambil_json["response"]["code"]!==200){
            $massage=$ambil_json["response"]["massage"];
            echo '<span class="text-danger">'.$massage.'</span>';
        }else{
            echo '<span id="NotifikasiHapusAkunWaBerhasil">Success</span>';
        }
    }
?>