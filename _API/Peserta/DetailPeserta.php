<?php
    //Connection
    date_default_timezone_set("Asia/Jakarta");
    $datetime=date('Y-m-d H:i:s');
    $datetime=strtotime($datetime);
    $service_name="Referensi Jadwal Praktek";
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Function.php";
    //Tangkap Data
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $id_setting_api_key=0;
        $api_key=0;
        $keterangan="Only POST data transmission method is allowed";
        $response = Array (
            "message" => $keterangan,
            "code" => 201,
        );
        $metadata = Array ();
	}else{
        $fp = fopen('php://input', 'r');
		$raw = stream_get_contents($fp);
		$Tangkap = json_decode($raw,true);
        //Tangkap api_key
		if(empty($Tangkap['api_key'])){
            $id_setting_api_key=0;
            $api_key=0;
            $keterangan="api_key cannot be empty";
            $response = Array (
                "message" => $keterangan,
                "code" => 201,
            );
            $metadata = Array ();
        }else{
            //Tangkap email
            if(empty($Tangkap['email'])){
                $id_setting_api_key=0;
                $api_key=0;
                $keterangan="Email cannot be empty";
                $response = Array (
                    "message" => $keterangan,
                    "code" => 201,
                );
                $metadata = Array ();
            }else{
                //Tangkap password
                if(empty($Tangkap['password'])){
                    $id_setting_api_key=0;
                    $api_key=0;
                    $keterangan="Password cannot be empty";
                    $response = Array (
                        "message" => $keterangan,
                        "code" => 201,
                    );
                    $metadata = Array ();
                }else{
                    $api_key=$Tangkap['api_key'];
                    $email=$Tangkap['email'];
                    $password=$Tangkap['password'];
                    //md5
                    $passwordMd5=md5($password);
                    //Validasi API Key
                    $status_api_key=getDataDetail($Conn,'setting_api_key','api_key',$api_key,'status_api_key');
                    if($status_api_key!=="Active"){
                        $id_setting_api_key=0;
                        $api_key=0;
                        $keterangan="api_key is not active, please contact the admin to activate it";
                        $response = Array (
                            "message" => $keterangan,
                            "code" => 201,
                        );
                        $metadata = Array ();
                    }else{
                        $id_setting_api_key=getDataDetail($Conn,'setting_api_key','api_key',$api_key,'id_setting_api_key');
                        //Validasi Akun Peserta
                        $QryPeserta= mysqli_query($Conn,"SELECT * FROM event_peserta WHERE email='$email' AND password='$passwordMd5'")or die(mysqli_error($Conn));
                        $DataDetailPeserta= mysqli_fetch_array($QryPeserta);
                        if(empty($DataDetailPeserta['status_validasi'])){
                            $keterangan="Incorrect email and password combination";
                            $response = Array (
                                "message" => $keterangan,
                                "code" => 201,
                            );
                            $metadata = Array ();
                        }else{
                            if($DataDetailPeserta['status_validasi']!=="Valid"){
                                $keterangan="Participant accounts have not been validated";
                                $response = Array (
                                    "message" => $keterangan,
                                    "code" => 201,
                                );
                                $metadata = Array ();
                            }else{
                                $keterangan="success";
                                $response = Array (
                                    "message" => $keterangan,
                                    "code" => 200,
                                );
                                //Buka Data Peserta
                                $id_peserta= $DataDetailPeserta['id_peserta'];
                                $id_event_setting= $DataDetailPeserta['id_event_setting'];
                                $id_event_kategori= $DataDetailPeserta['id_event_kategori'];
                                $tanggal_daftar= $DataDetailPeserta['tanggal_daftar'];
                                $nama= $DataDetailPeserta['nama'];
                                $kontak= $DataDetailPeserta['kontak'];
                                $email= $DataDetailPeserta['email'];
                                $alamat= $DataDetailPeserta['alamat'];
                                $kota= $DataDetailPeserta['kota'];
                                $kode_pos= $DataDetailPeserta['kode_pos'];
                                $link_validasi= $DataDetailPeserta['link_validasi'];
                                $link_payment= $DataDetailPeserta['link_payment'];
                                $organization= $DataDetailPeserta['organization'];
                                $status_validasi= $DataDetailPeserta['status_validasi'];
                                $status_pembayaran= $DataDetailPeserta['status_pembayaran'];
                                $strtotime=strtotime($tanggal_daftar);
                                $TanggalDaftar = $strtotime * 1000;
                                //Buka Nama Event
                                $QryEvent= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
                                $DataEvent= mysqli_fetch_array($QryEvent);
                                $nama_event= $DataEvent['nama_event'];
                                $keterangan_event= $DataEvent['keterangan'];
                                $status_event= $DataEvent['status'];
                                $tanggal_mulai= $DataEvent['tanggal_mulai'];
                                $tanggal_selesai= $DataEvent['tanggal_selesai'];
                                $mulai_pendaftaran= $DataEvent['mulai_pendaftaran'];
                                $selesai_pendaftaran= $DataEvent['selesai_pendaftaran'];
                                //Format Tanggal
                                $timestamp1= strtotime($tanggal_mulai);
                                $timestamp2= strtotime($tanggal_selesai);
                                $timestamp3= strtotime($mulai_pendaftaran);
                                $timestamp4= strtotime($selesai_pendaftaran);
                                //Milisecond
                                $TanggalMulai = $timestamp1 * 1000;
                                $TanggalSelesai = $timestamp2 * 1000;
                                $MulaiPendaftaran = $timestamp3 * 1000;
                                $SelesaiPendaftaran = $timestamp4 * 1000;
                                //Nama Sub Event
                                $QryEvent= mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
                                $DataEvent= mysqli_fetch_array($QryEvent);
                                $KategoriEvent= $DataEvent['kategori'];
                                $keterangan_kategori= $DataEvent['keterangan'];
                                $harga_tiket= $DataEvent['harga_tiket'];
                                $kuota= $DataEvent['kuota'];
                                //Buka Pembayaran
                                $id_event_pembayaran=getDataDetail($Conn,'event_pembayaran','id_peserta',$id_peserta,'id_event_pembayaran');
                                $kode_transaksi=getDataDetail($Conn,'event_pembayaran','id_peserta',$id_peserta,'kode_transaksi');
                                //Buat Metadata
                                $event = Array (
                                    "id_event_setting" => $id_event_setting,
                                    "nama_event" => $nama_event,
                                    "keterangan_event" => $keterangan_event,
                                    "tanggal_mulai" => $TanggalMulai,
                                    "tanggal_selesai" => $TanggalSelesai,
                                    "mulai_pendaftaran" => $MulaiPendaftaran,
                                    "selesai_pendaftaran" => $SelesaiPendaftaran,
                                    "status_event" => $status_event,
                                );
                                $kategori_event = Array (
                                    "id_event_kategori" => $id_event_kategori,
                                    "KategoriEvent" => $KategoriEvent,
                                    "KeteranganKategoriEvent" => $keterangan_kategori,
                                    "harga_tiket" => $harga_tiket,
                                    "kuota" => $kuota,
                                );
                                if(empty($id_event_pembayaran)){
                                    $pembayaran = Array ();
                                }else{
                                    $tanggal=getDataDetail($Conn,'event_pembayaran','id_peserta',$id_peserta,'tanggal');
                                    $kode_kupon=getDataDetail($Conn,'event_pembayaran','id_peserta',$id_peserta,'kode_kupon');
                                    $metode_pembayaran=getDataDetail($Conn,'event_pembayaran','id_peserta',$id_peserta,'metode_pembayaran');
                                    $harga=getDataDetail($Conn,'event_pembayaran','id_peserta',$id_peserta,'harga');
                                    $diskon=getDataDetail($Conn,'event_pembayaran','id_peserta',$id_peserta,'diskon');
                                    $tagihan=getDataDetail($Conn,'event_pembayaran','id_peserta',$id_peserta,'tagihan');
                                    $status=getDataDetail($Conn,'event_pembayaran','id_peserta',$id_peserta,'status');
                                    $pembayaran = Array (
                                        "id_event_pembayaran" => $id_event_pembayaran,
                                        "tanggal" => $tanggal,
                                        "kode_kupon" => $kode_kupon,
                                        "metode_pembayaran" => $metode_pembayaran,
                                        "harga" => $harga,
                                        "diskon" => $diskon,
                                        "tagihan" => $tagihan,
                                        "status" => $status,
                                        "kode_transaksi" => $kode_transaksi,
                                    );
                                }
                                
                                $metadata = Array (
                                    "id_peserta" => $id_peserta,
                                    "event" => $event,
                                    "kategori_event" => $kategori_event,
                                    "tanggal_daftar" => $TanggalDaftar,
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
                                    "status_pembayaran" => $status_pembayaran,
                                    "pembayaran" => $pembayaran
                                );
                            }
                        }
                    }
                }
            }
        }
    }
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