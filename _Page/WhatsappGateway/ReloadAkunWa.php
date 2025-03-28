<?php
    //koneksi dan session
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/SettingWhatsapp.php";
    if(empty($_POST['clientId'])){
        echo '  <div class="row">';
        echo '      <div class="col col-md-12">';
        echo '          <span class="text-danger">ID Client Tidak Dapat Ditangkap Oleh Sistem</span>';
        echo '      </div>';
        echo '  </div>';
    }else{
        $clientId=$_POST['clientId'];
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
        curl_setopt($ch,CURLOPT_URL, "$url_status_client");
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
            echo '  <div class="row">';
            echo '      <div class="col col-md-12">';
            echo '          <span class="text-danger">'.$massage.'</span>';
            echo '      </div>';
            echo '  </div>';
        }else{
            $massage=$ambil_json["response"]["massage"];
            $code=$ambil_json["response"]["code"];
            $qr_code=$ambil_json["metadata"]["qr_code"];
            if(empty($ambil_json["metadata"]["nomor_akun_wa"])){
                $nomor_akun_wa="<span class='text-danger'>None</span>";
            }else{
                $nomor_akun_wa=$ambil_json["metadata"]["nomor_akun_wa"];
            }
            if(empty($ambil_json["metadata"]["status"])){
                $status="<span class='text-danger'>None</span>";
            }else{
                $status=$ambil_json["metadata"]["status"];
            }
            //Melakukan update
            $UpdateAkunWa = mysqli_query($Conn,"UPDATE whatsapp_client SET 
                nomor_akun_wa='$nomor_akun_wa'
            WHERE clientId='$clientId'") or die(mysqli_error($Conn)); 
            if($UpdateAkunWa){
                echo '<small class="text-success" id="NotifikasiUpdateAkunWaBerhasil">Success</small>';
            }else{
                echo '<span class="text-danger">Terjadi kesalahan pada saat menyimpan data akun wa!</span>';
            }
        }
    }
?>