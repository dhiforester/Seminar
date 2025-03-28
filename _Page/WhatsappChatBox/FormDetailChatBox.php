<div class="row mb-3">
    <div class="col-md-12" style="height: 300px; overflow-y: scroll;">
        <?php
            //koneksi dan session
            date_default_timezone_set('UTC');
            include "../../_Config/Connection.php";
            include "../../_Config/SettingWhatsapp.php";
            if(empty($_POST['my_number'])){
                echo '  <div class="row">';
                echo '      <div class="col col-md-12">';
                echo '          <span class="text-danger">My Number Tidak Dapat Ditangkap Oleh Sistem</span>';
                echo '      </div>';
                echo '  </div>';
            }else{
                if(empty($_POST['you_number'])){
                    echo '  <div class="row">';
                    echo '      <div class="col col-md-12">';
                    echo '          <span class="text-danger">Your Number Tidak Dapat Ditangkap Oleh Sistem</span>';
                    echo '      </div>';
                    echo '  </div>';
                }else{
                    $my_number=$_POST['my_number'];
                    $you_number=$_POST['you_number'];
                    $arr = array(
                        "api_key"=> "$api_key_Whatsapp",
                        "me"=> "$my_number",
                        "you"=> "$you_number",
                    );
                    $headers = array(
                        'Content-Type:Application/x-www-form-urlencoded'
                    );
                    $json=json_encode($arr);
                    //Kirim data CURL
                    $ch = curl_init();
                    curl_setopt($ch,CURLOPT_URL, "$url_chatbox_youme");
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
                        $list=$ambil_json["metadata"]["list"];
                        foreach($list as $list){
                            $id_chat_box=$list["id_chat_box"];
                            $kode_pesan=$list["kode_pesan"];
                            $datetime_chat=$list["datetime_chat"];
                            $nomor_pengirim=$list["nomor_pengirim"];
                            $nomor_tujuan=$list["nomor_tujuan"];
                            $pesan=$list["pesan"];
                            $media=$list["media"];
                            $status_baca=$list["status_baca"];
                            $status_pengiriman=$list["status_pengiriman"];
                            $datetime=date('Y-m-d H:i:s', $datetime_chat);
                            if($nomor_pengirim==$my_number){
                                echo '  <div class="row mb-3">';
                                echo '      <div class="col col-md-12">';
                                echo '          <div class="alert alert-primary" role="alert">';
                                echo '              <span class="text-dark"><b>'.$nomor_pengirim.' (You)</b></span><br>';
                                echo '              <small class="text-dark">'.$datetime.'</small><br>';
                                echo '              <small class="text-dark">'.$pesan.'</small><br>';
                                if($media!=='""'&&$media!==""){
                                    echo '          <a href="'.$media.'" class="text-dark" target="_blank"><i class="icofont-attachment"></i> File Lampiran</a><br>';
                                }
                                echo '          </div>';
                                echo '      </div>';
                                echo '  </div>';
                            }else{
                                echo '  <div class="row mb-3">';
                                echo '      <div class="col col-md-12">';
                                echo '          <div class="alert alert-success" role="alert">';
                                echo '              <span class="text-dark"><b>'.$nomor_pengirim.'</b></span><br>';
                                echo '              <small class="text-dark">'.$datetime.'</small><br>';
                                echo '              <small class="text-dark">'.$pesan.'</small><br>';
                                if($media!=='""'&&$media!==""){
                                    echo '          <a href="'.$media.'" class="text-dark" target="_blank"><i class="icofont-attachment"></i> File Lampiran</a><br>';
                                }
                                echo '          </div>';
                                echo '      </div>';
                                echo '  </div>';
                            }
                        }
                    }
                }
            }
        ?>
    </div>
</div>
<form action="javascript:void(0);" id="ProsesKirimPesan" autocomplete="off">
    <input type="hidden" name="pengirim" id="pengirim" value="<?php echo "$my_number"; ?>">
    <input type="hidden" name="tujuan" id="tujuan" value="<?php echo "$you_number"; ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="input-group input-group-outline">
                <input type="text" name="pesan" id="pesan" class="form-control">
            </div>
            <small class="text-success" id="NotifikasiKirimPesan">Isi Pesan Disini</small>
        </div>
        <div class="col-md-4">
            <div class="input-group input-group-outline">
                <input type="file" name="media" id="media" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-md btn-primary btn-block">
                <i class="bi bi-send"></i> Kirim
            </button>
        </div>
    </div>
</form>