<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/SettingWhatsapp.php";
    include "../../_Config/SettingFilemanager.php";
    //Menangkap data
    if(empty($_POST['pengirim'])){
        echo '<span class="text-danger">Nomor Pengirim Tidak Boleh Kosong</span>';
    }else{
        if(empty($_POST['tujuan'])){
            echo '<span class="text-danger">Nomor Tujuan Tidak Boleh Kosong</span>';
        }else{
            if(empty($_POST['pesan'])){
                echo '<span class="text-danger">Isi Pesan Tidak Boleh Kosong</span>';
            }else{
                $pengirim=$_POST['pengirim'];
                $tujuan=$_POST['tujuan'];
                $pesan=$_POST['pesan'];
                if(!empty($_FILES['media']['name'])){
                    $media=$_FILES['media']['name'];
                    $tmp_name=$_FILES['media']['tmp_name'];
                    $filetype=$_FILES['media']['type'];
                    $filesize=$_FILES['media']['size'];
                    //ext
                    $ext=pathinfo($media,PATHINFO_EXTENSION);
                    //milisecond
                    $rand = rand(10, 100);
                    $milisecond=round(microtime(true));
                    //nama file baru
                    $new_name="$rand$milisecond.$ext";
                    //base64
                    $data=file_get_contents($tmp_name);
                    $base64=base64_encode($data);
                    //Kirim data ke filemanager
                    $arr = array(
                        "api_key"=> "$api_key_filemanager",
                        "filename"=> "$new_name",
                        "filetype"=> "$filetype",
                        "filesize"=> "$filesize",
                        "base64"=> "$base64"
                    );
                    $headers = array(
                        'Content-Type:Application/x-www-form-urlencoded'
                    );
                    $json=json_encode($arr);
                    //Kirim data CURL
                    $ch = curl_init();
                    curl_setopt($ch,CURLOPT_URL, "$url_add_file");
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
                        $pesan=$ambil_json["response"]["massage"];
                        echo '<span class="text-danger">'.$pesan.'</span>';
                    }else{
                        $media=$ambil_json["metadata"]["url_file"];
                        $arr = array(
                            "api_key" => "$api_key_Whatsapp",
                            "nomor_akun_wa" => "$pengirim",
                            "nomor_tujuan" => "$tujuan",
                            "pesan" => "$pesan",
                            "media" => "$media",
                            "mimetype" => "$filetype",
                            "fileName" => "$new_name"
                        );
                        $headers = array(
                            'Content-Type:Application/x-www-form-urlencoded'
                        );
                        $json=json_encode($arr);
                        //Kirim data CURL
                        $ch = curl_init();
                        curl_setopt($ch,CURLOPT_URL, "$url_send_message");
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
                            $pesan=$ambil_json["response"]["massage"];
                            echo '<span class="text-danger">'.$pesan.'</span>';
                        }else{
                            echo '<span class="text-success" id="NotifikasiKirimPesanBerhasil">Pesan Berhasil Terkirim!</span>';
                        }
                    }
                }else{
                    $media="";
                    $mimetype="";
                    $fileName="";
                    $arr = array(
                        "api_key" => "$api_key_Whatsapp",
                        "nomor_akun_wa" => "$pengirim",
                        "nomor_tujuan" => "$tujuan",
                        "pesan" => "$pesan",
                        "media" => "$media",
                        "mimetype" => "$mimetype",
                        "fileName" => "$fileName"
                    );
                    $arr = array(
                        "api_key" => "$api_key_Whatsapp",
                        "nomor_akun_wa" => "$pengirim",
                        "nomor_tujuan" => "$tujuan",
                        "pesan" => "$pesan",
                        "media" => "$media",
                        "mimetype" => "$mimetype",
                        "fileName" => "$fileName"
                    );
                    $headers = array(
                        'Content-Type:Application/x-www-form-urlencoded'
                    );
                    $json=json_encode($arr);
                    //Kirim data CURL
                    $ch = curl_init();
                    curl_setopt($ch,CURLOPT_URL, "$url_send_message");
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
                        $pesan=$ambil_json["response"]["massage"];
                        echo '<span class="text-danger">'.$pesan.'</span>';
                    }else{
                        echo '<span class="text-success" id="NotifikasiKirimPesanBerhasil">Pesan Berhasil Terkirim!</span>';
                    }
                }
                
            }
        }
    }
?>