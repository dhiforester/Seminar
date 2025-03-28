<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/SettingEmail.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set("Asia/Jakarta");
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    $now=strtotime($now);
    $datetime=strtotime($now);
    $service_name="Resend Email Validation";
    //Validasi Metode Pengiriman Data
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $id_setting_api_key=0;
        $api_key=0;
        $keterangan="Only POST data transmission method is allowed";
        $code=201;
        $metadata = Array ();
	}else{
        //Tangkap data dana decode
        $fp = fopen('php://input', 'r');
		$raw = stream_get_contents($fp);
		$Tangkap = json_decode($raw,true);
        //Validasi api_key tidak boleh kosong
		if(empty($Tangkap['api_key'])){
            $id_setting_api_key=0;
            $api_key=0;
            $keterangan="API Key cannot be empty";
            $code=201;
            $metadata = Array ();
        }else{
            //Validasi api_key Active
            $api_key=$Tangkap['api_key'];
            $QryValidasi = mysqli_query($Conn,"SELECT * FROM setting_api_key WHERE api_key='$api_key'")or die(mysqli_error($Conn));
            $DataValidasiApi = mysqli_fetch_array($QryValidasi);
            $id_setting_api_key = $DataValidasiApi['id_setting_api_key'];
            $status_api_key = $DataValidasiApi['status_api_key'];
            if($status_api_key!=="Active"){
                $id_setting_api_key=$id_setting_api_key;
                $api_key=$api_key;
                $keterangan="API Key is not active, please contact the admin to activate it";
                $code=201;
                $metadata = Array ();
            }else{
                //Validasi email tidak boleh kosong
                if(empty($Tangkap['email'])){
                    $id_setting_api_key=$id_setting_api_key;
                    $api_key=$api_key;
                    $keterangan="email Can not Be Empty";
                    $code=201;
                    $metadata = Array ();
                }else{
                    //Validasi email duplikat
                    $email=$Tangkap['email'];
                    $id_peserta =getDataDetail($Conn,'event_peserta','email',$email,'id_peserta');
                    if(empty($id_peserta)){
                        $id_setting_api_key=$id_setting_api_key;
                        $api_key=$api_key;
                        $keterangan="Email not found";
                        $code=201;
                        $metadata = Array ();
                    }else{
                        //Hapus token sebelumnya
                        $HapusTokenSebelumnya=DeleteData($Conn,'event_validasi','id_peserta',$id_peserta);
                        if($HapusTokenSebelumnya!=="Success"){
                            $id_setting_api_key=$id_setting_api_key;
                            $api_key=$api_key;
                            $keterangan="An error occurred while deleting the old token";
                            $code=201;
                            $metadata = Array ();
                        }else{
                            $Token=generateRandomString(6);
                            $DatetimeToken=date('Y-m-d H:i');
                            //Simpan Token
                            $SimpanToken="INSERT INTO event_validasi (
                                id_peserta,
                                token,
                                datetime,
                                status
                            ) VALUES (
                                '$id_peserta',
                                '$Token',
                                '$DatetimeToken',
                                'Belum Digunakan'
                            )";
                            $InputTokenValidasi=mysqli_query($Conn, $SimpanToken);
                            if($InputTokenValidasi){
                                //Profile Peserta
                                $nama =getDataDetail($Conn,'event_peserta','email',$email,'nama');
                                //Kirim email
                                $Subjek="Validasi Pendaftaran Simposium Nasional RSU El-Syifa";
                                $UrlVerifikasi=''.$base_url.'/VerifikasiEmail.php?email='.$email.'&kode='.$Token.'';
                                $Pesan='
                                <b>Terima kasih sudah melakukan pendaftaran.</b><br>
                                Untuk melanjutkan proses pendaftaran, silahkan kunjungai tautan berikut ini <a href="'.$UrlVerifikasi.'">berikut ini</a><br>
                                Uraian Informasi Pendaftaran<br>
                                ID Pendaftaran : <b>'.$id_peserta.'</b><br>
                                Alamat Email : <b>'.$email.'</b><br>
                                Kode Verifikasi : <b>'.$Token.'</b><br>
                                URL : <b>'.$UrlVerifikasi.'</b><br>
                                Apabila mengalamai kendala dalam proses pnedaftaran, silahkan hubungi admin kami<br>
                                No.Kontak : <b>'.$telepon_bisnis.'</b><br>
                                Email : <b>'.$email_bisnis.'</b><br>
                                Alamat : <b>'.$alamat_bisnis.'</b><br>
                                ';
                                $KirimEmail=SendEmail($nama,$email,$Subjek,$Pesan,$email_gateway,$password_gateway,$url_provider,$nama_pengirim,$port_gateway,$url_service);
                                $id_setting_api_key=$id_setting_api_key;
                                $api_key=$api_key;
                                $keterangan="success";
                                $code=200;
                                $metadata= Array (
                                    "id_peserta" => $id_peserta,
                                    "validation_code" => $Token
                                );
                            }else{
                                $id_setting_api_key=$id_setting_api_key;
                                $api_key=$api_key;
                                $keterangan="Terjadi Kesalahan Pada Saat Menyimpan Data Token";
                                $code=201;
                                $metadata = Array ();
                            }
                        }
                    }
                }
            }
        }
    }
    $response = Array (
        "message" => $keterangan,
        "code" => $code,
    );
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