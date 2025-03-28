<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/SettingWhatsapp.php";
    //Tangkap Variabel
    if(empty($_POST['my_number'])){
        echo '<span class="text-danger">Nomor Akun WA Tidak Boleh Kosong</span>';
    }else{
        if(empty($_POST['you_number'])){
            echo '<span class="text-danger">Nomor Tujuan Tidak Boleh Kosong</span>';
        }else{
            $my_number=$_POST['my_number'];
            $you_number=$_POST['you_number'];
            //CHECK APAKAHA ADA PADA CHATBOX
            $arr = array(
                "api_key"=> "$api_key_Whatsapp",
                "me"=> "$my_number",
                "you"=> "$you_number"
            );
            $headers = array(
                'Content-Type:Application/x-www-form-urlencoded'
            );
            $json=json_encode($arr);
            //Kirim data CURL
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, "$url_chatbox_delete_youme");
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
            if($ambil_json["response"]["code"]==200){
                $_SESSION ["NotifikasiSwal"]="Hapus Chat Box Berhasil";
                echo '<span class="text-success" id="NotifikasiHapusChatBoxBerhasil">Berhasil</span>';
            }else{
                $pesan=$ambil_json["response"]["massage"];
                echo '<span class="text-danger">Hapus Chat Box Gagal</span><br>';
                echo '<span class="text-dark">Pesan: '.$pesan.'</span><br>';
            }
            
        }
    }
?>