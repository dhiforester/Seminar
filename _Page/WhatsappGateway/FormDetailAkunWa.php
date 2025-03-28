<?php
    //koneksi dan session
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/SettingWhatsapp.php";
    include "../../assets/phpqrcode/qrlib.php";
    if(empty($_POST['clientId'])){
        echo '  <div class="row">';
        echo '      <div class="col col-md-12">';
        echo '          <span class="text-danger">ID Client Tidak Dapat Ditangkap Oleh Sistem</span>';
        echo '      </div>';
        echo '  </div>';
    }else{
        $clientId=$_POST['clientId'];
        //Detail Akun Wa
        $QryAkunWa = mysqli_query($Conn,"SELECT * FROM whatsapp_client WHERE clientId ='$clientId'")or die(mysqli_error($Conn));
        $DataAKunWa = mysqli_fetch_array($QryAkunWa);
        $id_whatsapp_client = $DataAKunWa['id_whatsapp_client'];
        $id_mitra = $DataAKunWa['id_mitra'];
        $nama_mitra = $DataAKunWa['nama_mitra'];
        $NomorAkunWa = $DataAKunWa['nomor_akun_wa'];
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
            if(!empty($qr_code)){
                $tempdir = "../../assets/img/qrcode/"; 
                if(!file_exists($tempdir)){
                    mkdir($tempdir);
                }    
                //decode base64
                $datetime=date('YmdHis');
                $tanggal=date('Y-m-d');
                $teks_qrcode    ="$qr_code";
                $namafile       ="$datetime.png";
                // ini ada 4 pilihan yaitu L (Low), M(Medium), Q(Good), H(High)
                $quality="H";
                // 1 adalah yang terkecil, 10 paling besar
                $ukuran=10; 
                $padding=1;
                QRCode::png($qr_code, $tempdir.$namafile, $quality, $ukuran, $padding);
                $tempdir2 = "assets/img/qrcode/";
                //Dimpan data di database
                echo '  <div class="row">';
                echo '      <div class="col-md-12"><img src="'.$tempdir2.''.$namafile.'" width="95%"/></div>';
                echo '  </div>';
                echo '  <div class="row">';
                echo '      <div class="col col-md-12 text-center">';
                echo '          <span class="text-info">Silahkan Scan QR Code Ini</span>';
                echo '      </div>';
                echo '  </div>';
                echo '  <div class="row mt-3">';
                echo '      <div class="col-md-12" id="NotifikasiDetailClient"></div>';
                echo '  </div>';
            }else{

                echo '  <div class="row">';
                echo '      <div class="col-md-6"><b>Client ID </b></div>';
                echo '      <div class="col-md-6" id="GetclientIdForm">'.$clientId.'</div>';
                echo '  </div>';
                echo '  <div class="row">';
                echo '      <div class="col-md-6"><b>Nomor WA</b></div>';
                echo '      <div class="col-md-6" id="GetNomorAkunWa">'.$nomor_akun_wa.'</div>';
                echo '  </div>';
                echo '  <div class="row">';
                echo '      <div class="col-md-6"><b>Status Koneksi</b></div>';
                echo '      <div class="col-md-6">'.$status.'</div>';
                echo '  </div>';
                echo '  <div class="row">';
                echo '      <div class="col-md-6"><b>Akun Akses/User</b></div>';
                echo '      <div class="col-md-6">'.$nama_mitra.'</div>';
                echo '  </div>';
            } 
            echo '  <div class="row">';
            echo '      <div class="col-md-12" id="NotifikasiUpdateAkunWa"><small>Lakukan Update Akun WA untuk menyimpan Nomor</small></div>';
            echo '  </div>'; 
        }
    }
?>