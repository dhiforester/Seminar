<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/SettingEmail.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set("Asia/Jakarta");
    //Time Now Tmp
    $tanggal_daftar=date('Y-m-d H:i');
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
                                    //Validasi email duplikat
                                    $email=$Tangkap['email'];
                                    $ValidasiEmailDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE email='$email'"));
                                    if(!empty($ValidasiEmailDuplikat)){
                                        $id_setting_api_key=$id_setting_api_key;
                                        $api_key=$api_key;
                                        $keterangan="Member Email Already Used";
                                        $code=201;
                                        $metadata = Array ();
                                    }else{
                                        //Validasi Password tidak boleh kosong
                                        if(empty($Tangkap['password1'])){
                                            $id_setting_api_key=$id_setting_api_key;
                                            $api_key=$api_key;
                                            $keterangan="Password Cannot Be Empty";
                                            $code=201;
                                            $metadata = Array ();
                                        }else{
                                            if($Tangkap['password1']!==$Tangkap['password2']){
                                                $id_setting_api_key=$id_setting_api_key;
                                                $api_key=$api_key;
                                                $keterangan="Password doesnt match";
                                                $code=201;
                                                $metadata = Array ();
                                            }else{
                                                //Validasi jumlah dan jenis karakter password
                                                $JumlahKarakterPassword=strlen($Tangkap['password1']);
                                                if($JumlahKarakterPassword>20||$JumlahKarakterPassword<6||!preg_match("/^[a-zA-Z0-9]*$/", $Tangkap['password1'])){
                                                    $id_setting_api_key=$id_setting_api_key;
                                                    $api_key=$api_key;
                                                    $keterangan="Password can only have 6-20 numeric characters";
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
                                                        $id_event_setting=$Tangkap['id_event_setting'];
                                                        $id_event_kategori=$Tangkap['id_event_kategori'];
                                                        $organization=$Tangkap['organization'];
                                                        $nama=$Tangkap['nama'];
                                                        $kontak=$Tangkap['kontak'];
                                                        $email=$Tangkap['email'];
                                                        $password1=$Tangkap['password1'];
                                                        $password1=MD5($password1);
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
                                                                $KuotaPeserta=$DataEventKategori['kuota'];
                                                                //Validasi Waktu pendaftaran
                                                                $mulai_pendaftaran=$DataEvent['mulai_pendaftaran'];
                                                                $selesai_pendaftaran=$DataEvent['selesai_pendaftaran'];
                                                                if($tanggal_daftar<$mulai_pendaftaran){
                                                                    $id_setting_api_key=$id_setting_api_key;
                                                                    $api_key=$api_key;
                                                                    $keterangan="Registration is not yet open";
                                                                    $code=201;
                                                                    $metadata = Array ();
                                                                }else{
                                                                    if($tanggal_daftar>$selesai_pendaftaran){
                                                                        $id_setting_api_key=$id_setting_api_key;
                                                                        $api_key=$api_key;
                                                                        $keterangan="Registration is now closed";
                                                                        $code=201;
                                                                        $metadata = Array ();
                                                                    }else{
                                                                        //Melihat Jumlah Peserta Sekarang
                                                                        $JumlahPesertaSekarang = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE id_event_kategori='$id_event_kategori'"));
                                                                        $JumlahPesertaSekarang=$JumlahPesertaSekarang+1;
                                                                        //Validasi Kuota Pendaftaran
                                                                        if($JumlahPesertaSekarang>$KuotaPeserta){
                                                                            $id_setting_api_key=$id_setting_api_key;
                                                                            $api_key=$api_key;
                                                                            $keterangan="The registration quota is full";
                                                                            $code=201;
                                                                            $metadata = Array ();
                                                                        }else{
                                                                            if($validasi_email=="Yes"){
                                                                                $status_validasi="Pending";
                                                                            }else{
                                                                                $status_validasi="Valid";
                                                                            }
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
                                                                            //Simpan Data event_peserta
                                                                            $EntryPeserta="INSERT INTO event_peserta (
                                                                                id_event_setting,
                                                                                id_event_kategori,
                                                                                tanggal_daftar,
                                                                                nama,
                                                                                kontak,
                                                                                email,
                                                                                organization,
                                                                                password,
                                                                                status_validasi,
                                                                                status_pembayaran,
                                                                                alamat,
                                                                                kota,
                                                                                kode_pos,
                                                                                link_validasi,
                                                                                link_payment
                                                                            ) VALUES (
                                                                                '$id_event_setting',
                                                                                '$id_event_kategori',
                                                                                '$tanggal_daftar',
                                                                                '$nama',
                                                                                '$kontak',
                                                                                '$email',
                                                                                '$organization',
                                                                                '$password1',
                                                                                '$status_validasi',
                                                                                'Pending',
                                                                                '$alamat',
                                                                                '$kota',
                                                                                '$kode_pos',
                                                                                '$link_validasi',
                                                                                '$link_payment'
                                                                            )";
                                                                            $InputPeserta=mysqli_query($Conn, $EntryPeserta);
                                                                            if($InputPeserta){
                                                                                $id_peserta =getDataDetail($Conn,'event_peserta','email',$email,'id_peserta');
                                                                                //Buka Pengaturan Validasi Email
                                                                                if($validasi_email=="Yes"){
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
                                                                                        $ValidasiProses="Valid";
                                                                                    }else{
                                                                                        $ValidasiProses="Terjadi Kesalahan Pada Saat Menyimpan Data Token";
                                                                                        $KirimEmail="";
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
                                                                                        "status_validasi" => "Pending",
                                                                                        "status_pembayaran" => "Pending",
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
                                                                                $keterangan="An error occurred while saving partner data";
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