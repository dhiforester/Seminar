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
    $service_name="Pendaftaran Peserta";
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
                //Validasi id_peserta tidak boleh kosong
                if(empty($Tangkap['id_peserta'])){
                    $id_setting_api_key=$id_setting_api_key;
                    $api_key=$api_key;
                    $keterangan="ID Peserta Cannot Be Empty";
                    $code=201;
                    $metadata = Array ();
                }else{
                    //Validasi id_event_setting tidak boleh kosong
                    if(empty($Tangkap['id_event_setting'])){
                        $id_setting_api_key=$id_setting_api_key;
                        $api_key=$api_key;
                        $keterangan="ID Event Cannot Be Empty";
                        $code=201;
                        $metadata = Array ();
                    }else{
                        //Validasi id_event_kategori tidak boleh kosong
                        if(empty($Tangkap['id_event_kategori'])){
                            $id_setting_api_key=$id_setting_api_key;
                            $api_key=$api_key;
                            $keterangan="ID Kategori Event Cannot Be Empty";
                            $code=201;
                            $metadata = Array ();
                        }else{
                            //Validasi nama tidak boleh kosong
                            if(empty($Tangkap['nama'])){
                                $id_setting_api_key=$id_setting_api_key;
                                $api_key=$api_key;
                                $keterangan="Name Can not Be Empty";
                                $code=201;
                                $metadata = Array ();
                            }else{
                                //Validasi kontak tidak boleh kosong
                                if(empty($Tangkap['kontak'])){
                                    $id_setting_api_key=$id_setting_api_key;
                                    $api_key=$api_key;
                                    $keterangan="Contact Can not Be Empty";
                                    $code=201;
                                    $metadata = Array ();
                                }else{
                                    //Validasi email tidak boleh kosong
                                    if(empty($Tangkap['email'])){
                                        $id_setting_api_key=$id_setting_api_key;
                                        $api_key=$api_key;
                                        $keterangan="Member Email Cannot Be Empty";
                                        $code=201;
                                        $metadata = Array ();
                                    }else{
                                        //Validasi organization tidak boleh kosong
                                        if(empty($Tangkap['organization'])){
                                            $id_setting_api_key=$id_setting_api_key;
                                            $api_key=$api_key;
                                            $keterangan="Organization Cannot Be Empty";
                                            $code=201;
                                            $metadata = Array ();
                                        }else{
                                            //Variabel Lainnya
                                            $id_peserta=$Tangkap['id_peserta'];
                                            //Validasi Data Peserta
                                            $QryPeserta= mysqli_query($Conn,"SELECT * FROM event_peserta WHERE id_peserta='$id_peserta'")or die(mysqli_error($Conn));
                                            $DataDetailPeserta= mysqli_fetch_array($QryPeserta);
                                            if(empty($DataDetailPeserta['status_validasi'])){
                                                $keterangan="Invalid Participant ID";
                                                $response = Array (
                                                    "message" => $keterangan,
                                                    "code" => 201,
                                                );
                                                $metadata = Array ();
                                            }else{
                                                // Buka Data Peserta Lama
                                                $IdPesertaLama= $DataDetailPeserta['id_peserta'];
                                                $IdEventSettingLama= $DataDetailPeserta['id_event_setting'];
                                                $IdEventKategoriLama= $DataDetailPeserta['id_event_kategori'];
                                                $EmailLama= $DataDetailPeserta['email'];
                                                $StatusPembayaranLama= $DataDetailPeserta['status_pembayaran'];
                                                $StatusValidasiLama= $DataDetailPeserta['status_validasi'];
                                                //Inisiasi Variabel Yang Sudah Ditangkap
                                                $id_event_setting=$Tangkap['id_event_setting'];
                                                $id_event_kategori=$Tangkap['id_event_kategori'];
                                                $organization=$Tangkap['organization'];
                                                $nama=$Tangkap['nama'];
                                                $kontak=$Tangkap['kontak'];
                                                $email=$Tangkap['email'];
                                                //Variabel tidak wajib
                                                if(empty($Tangkap['alamat'])){
                                                    $alamat="";
                                                }else{
                                                    $alamat=$Tangkap['alamat'];
                                                }
                                                if(empty($Tangkap['kota'])){
                                                    $kota="";
                                                }else{
                                                    $kota=$Tangkap['kota'];
                                                }
                                                if(empty($Tangkap['kode_pos'])){
                                                    $kode_pos="";
                                                }else{
                                                    $kode_pos=$Tangkap['kode_pos'];
                                                }
                                                if(empty($Tangkap['link_validasi'])){
                                                    $link_validasi="";
                                                }else{
                                                    $link_validasi=$Tangkap['link_validasi'];
                                                }
                                                if(empty($Tangkap['link_payment'])){
                                                    $link_payment="";
                                                }else{
                                                    $link_payment=$Tangkap['link_payment'];
                                                }
                                                //Validasi Event
                                                $QryEvent = mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
                                                $DataEvent = mysqli_fetch_array($QryEvent);
                                                if(empty($DataEvent['id_event_setting'])){
                                                    $id_setting_api_key=$id_setting_api_key;
                                                    $api_key=$api_key;
                                                    $keterangan="ID Event Not Valid";
                                                    $code=201;
                                                    $metadata = Array ();
                                                }else{
                                                    //Validasi Event Kategori
                                                    $QryEventKategori = mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_setting='$id_event_setting' AND id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
                                                    $DataEventKategori = mysqli_fetch_array($QryEventKategori);
                                                    if(empty($DataEventKategori['id_event_kategori'])){
                                                        $id_setting_api_key=$id_setting_api_key;
                                                        $api_key=$api_key;
                                                        $keterangan="ID Event Category Not Valid";
                                                        $code=201;
                                                        $metadata = Array ();
                                                    }else{
                                                        //Validasi email duplikat
                                                        if($EmailLama==$email){
                                                            $status_validasi=$StatusValidasiLama;
                                                            $ValidasiEmailDuplikat="";
                                                        }else{
                                                            if($validasi_email=="Yes"){
                                                                $status_validasi="Pending";
                                                            }else{
                                                                $status_validasi="Valid";
                                                            }
                                                            $ValidasiEmailDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE email='$email'"));
                                                        }
                                                        if(!empty($ValidasiEmailDuplikat)){
                                                            $id_setting_api_key=$id_setting_api_key;
                                                            $api_key=$api_key;
                                                            $keterangan="The new email you use has been previously registered";
                                                            $code=201;
                                                            $metadata = Array ();
                                                        }else{
                                                            //Apabila Pembayaran lunas dan peserta merubah event
                                                            if($StatusPembayaranLama=="Lunas"){
                                                                if($IdEventKategoriLama==$id_event_kategori){
                                                                    $ValidasiPembayaranLunas="Valid";
                                                                }else{
                                                                    $ValidasiPembayaranLunas="You cannot change the package because the payment has already been paid in full";
                                                                }
                                                            }else{
                                                                $ValidasiPembayaranLunas="Valid";
                                                                //Apabila status pembayaran belum lunas dan peserta mengganti paket maka 
                                                                if($IdEventKategoriLama!==$id_event_kategori){
                                                                    //Hapus Data Pembayaran Peserta Sebelumnya
                                                                    $HapusPembayaranPeserta = mysqli_query($Conn, "DELETE FROM event_pembayaran WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn));
                                                                }
                                                            }
                                                            if($ValidasiPembayaranLunas!=="Valid"){
                                                                $id_setting_api_key=$id_setting_api_key;
                                                                $api_key=$api_key;
                                                                $keterangan=$ValidasiPembayaranLunas;
                                                                $code=201;
                                                                $metadata = Array ();
                                                            }else{
                                                                //Simpan Data event_peserta
                                                                $UpdatePeserta = mysqli_query($Conn,"UPDATE event_peserta SET 
                                                                    id_event_setting='$id_event_setting',
                                                                    id_event_kategori='$id_event_kategori',
                                                                    nama='$nama',
                                                                    kontak='$kontak',
                                                                    email='$email',
                                                                    organization='$organization',
                                                                    status_validasi='$status_validasi',
                                                                    alamat='$alamat',
                                                                    kota='$kota',
                                                                    kode_pos='$kode_pos',
                                                                    link_validasi='$link_validasi',
                                                                    link_payment='$link_payment'
                                                                WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn)); 
                                                                if($UpdatePeserta){
                                                                    //Buka Pengaturan Validasi Email
                                                                    if($validasi_email=="Yes"){
                                                                        if($EmailLama==$email){
                                                                            $KirimEmail="";
                                                                            $ValidasiProses="Valid";
                                                                        }else{
                                                                            //Buat Token Validasi Email
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
                                                                                //Kirim email
                                                                                $Subjek="Validasi Pendaftaran Simposium Nasional RSU El-Syifa";
                                                                                $Pesan="Beriku ini adalah kode validasi akun anda : $Token";
                                                                                $KirimEmail=SendEmail($nama,$email,$Subjek,$Pesan,$email_gateway,$password_gateway,$url_provider,$nama_pengirim,$port_gateway,$url_service);
                                                                                $ValidasiProses="Valid";
                                                                            }else{
                                                                                $ValidasiProses="Terjadi Kesalahan Pada Saat Menyimpan Data Token";
                                                                                $KirimEmail="";
                                                                            }
                                                                        }
                                                                    }else{
                                                                        $KirimEmail="";
                                                                        $ValidasiProses="Valid";
                                                                    }
                                                                    if($ValidasiProses=="Valid"){
                                                                        $id_setting_api_key=$id_setting_api_key;
                                                                        $api_key=$api_key;
                                                                        $keterangan="success";
                                                                        $code=200;
                                                                        $metadata= Array (
                                                                            "id_peserta" => $id_peserta,
                                                                            "id_event_setting" => $id_event_setting,
                                                                            "id_event_kategori" => $id_event_kategori,
                                                                            "tanggal_daftar" => $tanggal_daftar,
                                                                            "nama" => $nama,
                                                                            "kontak" => $kontak,
                                                                            "email" => $email,
                                                                            "alamat" => $alamat,
                                                                            "kota" => $kota,
                                                                            "kode_pos" => $kode_pos,
                                                                            "link_validasi" => $link_validasi,
                                                                            "link_payment" => $link_payment,
                                                                            "organization" => $organization,
                                                                            "status_validasi" => $status_validasi,
                                                                            "status_pembayaran" => $StatusPembayaranLama,
                                                                            "resume_validation" => $KirimEmail
                                                                        );
                                                                    }else{
                                                                        $id_setting_api_key=$id_setting_api_key;
                                                                        $api_key=$api_key;
                                                                        $keterangan="$ValidasiProses";
                                                                        $code=201;
                                                                        $metadata = Array ();
                                                                    }
                                                                }else{
                                                                    $id_setting_api_key=$id_setting_api_key;
                                                                    $api_key=$api_key;
                                                                    $keterangan="An error occurred while updating participant data";
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