<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/SettingWhatsapp.php";
    if(empty($_POST['id_mitra'])){
        $id_mitra="0";
        $nama_mitra="";
    }else{
        $id_mitra=$_POST['id_mitra'];
        //Buka nama mitra
        $QryMitra=mysqli_query($Conn,"SELECT * FROM mitra WHERE id_mitra='$id_mitra'")or die(mysqli_error($Conn));
        $DataMitra=mysqli_fetch_array($QryMitra);
        $nama_mitra=$DataMitra['nama_mitra'];
    }
    //Buat Akun WA
    $arr = array(
        "api_key"=> "$api_key_Whatsapp",
    );
    $headers = array(
        'Content-Type:Application/x-www-form-urlencoded'
    );
    $json=json_encode($arr);
    //Kirim data CURL
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$url_add_client");
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
        $clientId=$ambil_json["metadata"]["clientId"];
        $nomor_akun_wa=$ambil_json["metadata"]["nomor_akun_wa"];
        //Simpan data
        $entry="INSERT INTO whatsapp_client (
            clientId,
            id_mitra,
            nama_mitra,
            nomor_akun_wa
        ) VALUES (
            '$clientId',
            '$id_mitra',
            '$nama_mitra',
            '$nomor_akun_wa'
        )";
        $Input=mysqli_query($Conn, $entry);
        if($Input){
            echo '<small class="text-success" id="NotifikasiTambahAkunWaBerhasil">Success</small>';
        }else{
            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
        }
    }
?>
?>