<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/SettingEmail.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set("Asia/Jakarta");
    //Time Now Tmp
    $tanggal_sekarang=date('Y-m-d H:i:s');
    $now=date('Y-m-d H:i:s');
    $now=strtotime($now);
    $datetime=strtotime($now);
    $service_name="Ubah Password";
    //Validasi Metode Pengiriman Data
    if($_SERVER['REQUEST_METHOD'] !== 'POST') {
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
            $status_api_key =getDataDetail($Conn,'setting_api_key','api_key',$api_key,'status_api_key');
            $id_setting_api_key =getDataDetail($Conn,'setting_api_key','api_key',$api_key,'id_setting_api_key');
            if($status_api_key!=="Active"){
                $keterangan="API Key is not active, please contact the admin to activate it";
                $code=201;
                $metadata = Array ();
            }else{
                //Validasi email tidak boleh kosong
                if(empty($Tangkap['email'])){
                    $keterangan="Email Cannot Be Empty";
                    $code=201;
                    $metadata = Array ();
                }else{
                    $email=$Tangkap['email'];
                    $ValidasiEmail =getDataDetail($Conn,'event_peserta','email',$email,'id_peserta');
                    $id_peserta =getDataDetail($Conn,'event_peserta','email',$email,'id_peserta');
                    if(empty($ValidasiEmail)){
                        $keterangan="Email Not Valid";
                        $code=201;
                        $metadata = Array ();
                    }else{
                        //Validasi kode_unik tidak boleh kosong
                        if(empty($Tangkap['code_unik'])){
                            $keterangan="Code Cannot Be Empty";
                            $code=201;
                            $metadata = Array ();
                        }else{
                            //Validasi password_baru tidak boleh kosong
                            if(empty($Tangkap['password_baru'])){
                                $keterangan="New Password Cannot Be Empty";
                                $code=201;
                                $metadata = Array ();
                            }else{
                                $kode_unik=$Tangkap['code_unik'];
                                $password_baru=$Tangkap['password_baru'];
                                //Validasi Kombinasi Email Da Kode Unik
                                $QryLupaPassword = mysqli_query($Conn,"SELECT * FROM lupa_password WHERE code_unik='$kode_unik' AND id_peserta='$id_peserta'")or die(mysqli_error($Conn));
                                $DataLupaPassword = mysqli_fetch_array($QryLupaPassword);
                                if(empty($DataLupaPassword)){
                                    $keterangan="The combination of unique code and email does not match";
                                    $code=201;
                                    $metadata = Array ();
                                }else{
                                    //Jika Valid Maka Lanjutkan Untuk Melakukan Validasi Tanggal Expired
                                    $tanggal_expired=$DataLupaPassword['tanggal_expired'];
                                    if($tanggal_expired<$tanggal_sekarang){
                                        $keterangan="The unique code you used has expired";
                                        $code=201;
                                        $metadata = Array ();
                                    }else{
                                        //Update Password
                                        $PasswordBaru=MD5($password_baru);
                                        $ProsesUbahPassword = mysqli_query($Conn,"UPDATE event_peserta SET 
                                            password='$PasswordBaru'
                                        WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn));
                                        if($ProsesUbahPassword){
                                            //Hapus Kode Unik
                                            $HapusKodeUnik = mysqli_query($Conn, "DELETE FROM lupa_password WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn));
                                            if ($HapusKodeUnik) {
                                                $keterangan='success';
                                                $code=200;
                                                $metadata = Array (
                                                    "id_peserta" => "$id_peserta",
                                                    "email" => "$email",
                                                    "password_baru" => "$password_baru",
                                                    "code_unik" => $kode_unik,
                                                );
                                            }else{
                                                $keterangan="An error occurred while deleting the old unique code";
                                                $code=201;
                                                $metadata = Array ();
                                            }
                                        }else{
                                            $keterangan="An error occurred while updating the password";
                                            $code=201;
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
    }
    $response = Array (
        "message" => "$keterangan",
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