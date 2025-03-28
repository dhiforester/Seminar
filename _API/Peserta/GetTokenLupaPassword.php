<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/SettingEmail.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set("Asia/Jakarta");
    //Time Now Tmp
    $tanggal_daftar=date('Y-m-d H:i:');
    $now=date('Y-m-d H:i:s');
    $now=strtotime($now);
    $datetime=strtotime($now);
    $service_name="Generate Token Lupa Password";
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
                    $nama =getDataDetail($Conn,'event_peserta','email',$email,'nama');
                    if(empty($ValidasiEmail)){
                        $keterangan="Email Not Valid";
                        $code=201;
                        $metadata = Array ();
                    }else{
                        //Buat Kode Unik
                        $KodeUnik=generateRandomString(16);
                        //Buat Tanggal dan expired
                        $tanggal_dibuat=date('Y-m-d H:i:s');
                        $waktu_saat_ini = time();
                        // Menambahkan satu jam ke waktu saat ini
                        $waktu_satu_jam_ke_depan = $waktu_saat_ini + 3600; // 3600 detik = 1 jam
                        // Mengonversi waktu satu jam ke depan menjadi format tanggal dan waktu
                        $tanggal_waktu_satu_jam_ke_depan = date('Y-m-d H:i:s', $waktu_satu_jam_ke_depan);
                        //Mencari Kode Unik sebelumnya
                        $LupaPasswordSebelumnya =getDataDetail($Conn,'lupa_password','id_peserta',$id_peserta,'id_lupa_password');
                        //Apabila Belum Ada maka Insert
                        if(empty($LupaPasswordSebelumnya)){
                            //Simpan Data event_peserta
                            $EntryLupaPassword="INSERT INTO lupa_password (
                                id_peserta,
                                tanggal_dibuat,
                                tanggal_expired,
                                code_unik
                            ) VALUES (
                                '$id_peserta',
                                '$tanggal_dibuat',
                                '$tanggal_waktu_satu_jam_ke_depan',
                                '$KodeUnik'
                            )";
                            $ProsesLupaPassword=mysqli_query($Conn, $EntryLupaPassword);
                            if($ProsesLupaPassword){
                                $ValidasiProses="Berhasil";
                            }else{
                                $ValidasiProses="Terjadi Kesalahan Pada Saat Insert Data";
                            }
                        }else{
                            //Apabila Sudah Ada Maka Edit
                            $ProsesLupaPassword = mysqli_query($Conn,"UPDATE lupa_password SET 
                                tanggal_dibuat='$tanggal_dibuat',
                                tanggal_expired='$tanggal_waktu_satu_jam_ke_depan',
                                code_unik='$KodeUnik'
                            WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn));
                            if($ProsesLupaPassword){
                                $ValidasiProses="Berhasil";
                            }else{
                                $ValidasiProses="Terjadi Kesalahan Pada Saat Update Data";
                            } 
                        }
                        if($ValidasiProses=="Berhasil"){
                            //Kirim email
                            $Subjek="Lupa Password Simposium Nasional RSU El-Syifa";
                            $Pesan='
                            <b>Anda telah mengirimkan kode lupa password.</b><br>
                            Silahkan masukan kode berikut ini:<br>
                            ID Pendaftaran : <b>'.$id_peserta.'</b><br>
                            Alamat Email : <b>'.$email.'</b><br>
                            Kode : <b>'.$KodeUnik.'</b><br>
                            ';
                            $KirimEmail=SendEmail($nama,$email,$Subjek,$Pesan,$email_gateway,$password_gateway,$url_provider,$nama_pengirim,$port_gateway,$url_service);
                            $ValidasiProses="Valid";
                            $keterangan="success";
                            $code=200;
                            $metadata = Array (
                                "id_peserta" => $id_peserta,
                                "tanggal_dibuat" => $tanggal_dibuat,
                                "tanggal_expired" => $tanggal_waktu_satu_jam_ke_depan,
                                "code_unik" => $KodeUnik
                            );
                        }else{
                            $keterangan="$ValidasiProses";
                            $code=201;
                            $metadata = Array ();}
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