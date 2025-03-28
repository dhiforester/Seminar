<?php
    //Connection
    date_default_timezone_set("Asia/Jakarta");
    $datetime=date('Y-m-d H:i:s');
    $datetime=strtotime($datetime);
    $service_name="Referensi Jadwal Praktek";
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Function.php";
    $TanggalDaftar=date('Y-m-d H:i');
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
        //Tangkap data Data dan decode
        $fp = fopen('php://input', 'r');
		$raw = stream_get_contents($fp);
		$Tangkap = json_decode($raw,true);
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
            //validasi id_peserta tidak boleh kosong
            if(empty($Tangkap['id_peserta'])){
                $id_setting_api_key=0;
                $api_key=0;
                $keterangan="ID Peserta cannot be empty";
                $response = Array (
                    "message" => $keterangan,
                    "code" => 201,
                );
                $metadata = Array ();
            }else{
                $api_key=$Tangkap['api_key'];
                $id_setting_api_key=getDataDetail($Conn,'setting_api_key','api_key',$api_key,'id_setting_api_key');
                //validasi id_setting_api_key dari database
                if(empty($id_setting_api_key)){
                    $id_setting_api_key=0;
                    $api_key=0;
                    $keterangan="The API Key you are using is invalid";
                    $response = Array (
                        "message" => $keterangan,
                        "code" => 201,
                    );
                    $metadata = Array ();
                }else{
                    //validasi status_api_key (Active)
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
                        //Buat Variabel
                        $id_peserta=$Tangkap['id_peserta'];
                        $id_event_setting=getDataDetail($Conn,'event_peserta','id_peserta',$id_peserta,'id_event_setting');
                        $id_event_kategori=getDataDetail($Conn,'event_peserta','id_peserta',$id_peserta,'id_event_kategori');
                        //Buka Data Harga Kategori Event
                        $HargaTiket=getDataDetail($Conn,'event_kategori','id_event_kategori',$id_event_kategori,'harga_tiket');
                        $BiayaAdm=getDataDetail($Conn,'event_kategori','id_event_kategori',$id_event_kategori,'biaya_adm');
                         //validasi kode_kupon Jika ada
                        if(!empty($Tangkap['kode_kupon'])){
                            $kode_kupon=$Tangkap['kode_kupon'];
                            $IdKategoriEventKupon=getDataDetail($Conn,'event_kupon','kode_kupon',$kode_kupon,'id_event_kategori');
                            $StatusKupon=getDataDetail($Conn,'event_kupon','kode_kupon',$kode_kupon,'status');
                            $id_kupon=getDataDetail($Conn,'event_kupon','kode_kupon',$kode_kupon,'id_kupon');
                            $diskon=getDataDetail($Conn,'event_kupon','kode_kupon',$kode_kupon,'diskon');
                            //Validasi Kategori Kupon
                            if(empty($IdKategoriEventKupon)){
                                $ValidasiKupon="Invalid Coupon Code";
                            }else{
                                //Validasi Event Kategori Kupon dengan Event Kategori Peserta
                                if($IdKategoriEventKupon!==$id_event_kategori){
                                    $ValidasiKupon="The coupon does not match the participant's order";
                                }else{
                                    if($StatusKupon=="Sudah Digunakan"){
                                        $ValidasiKupon="Coupon Code Already Used";
                                    }else{
                                        $ValidasiKupon="Valid";
                                        //Menghitung Dikon
                                        $Potongan=($diskon/100)*$HargaTiket;
                                        $Tagihan=($HargaTiket-$Potongan)+$BiayaAdm;
                                    }
                                }
                            }
                        }else{
                            $kode_kupon="";
                            $ValidasiKupon="Valid";
                            $diskon="";
                            $Tagihan=$HargaTiket+$BiayaAdm;
                        }
                        if($ValidasiKupon!=="Valid"){
                            $id_setting_api_key=0;
                                $api_key=0;
                                $keterangan="$ValidasiKupon";
                                $response = Array (
                                    "message" => $keterangan,
                                    "code" => 201,
                                );
                                $metadata = Array ();
                        }else{
                            //Validasi ID Event Peserta
                            if(empty($id_event_setting)){
                                $id_setting_api_key=0;
                                $api_key=0;
                                $keterangan="Invalid Participant ID";
                                $response = Array (
                                    "message" => $keterangan,
                                    "code" => 201,
                                );
                                $metadata = Array ();
                            }else{
                                //Validasi ID Kategori Event Peserta
                                if(empty($id_event_kategori)){
                                    $id_setting_api_key=0;
                                    $api_key=0;
                                    $keterangan="Invalid Category ID";
                                    $response = Array (
                                        "message" => $keterangan,
                                        "code" => 201,
                                    );
                                    $metadata = Array ();
                                }else{
                                    //Validasi Apakah Data Pembayaran Ada Atau Tidak
                                    $id_event_pembayaran=getDataDetail($Conn,'event_pembayaran','id_peserta',$id_peserta,'id_event_pembayaran');
                                    if(!empty($id_event_pembayaran)){
                                        $ValidasiProsesSimpan="Kode Transaksi Sudah Ada";
                                    }else{
                                        //Simpan Data Pembayaran
                                        $KodeTransaksi="KDT-$id_peserta-$id_event_setting-$id_event_kategori";
                                        $entry="INSERT INTO event_pembayaran (
                                            id_event_setting,
                                            id_event_kategori,
                                            id_peserta,
                                            tanggal,
                                            kode_kupon,
                                            metode_pembayaran,
                                            harga,
                                            biaya_adm,
                                            diskon,
                                            tagihan,
                                            status,
                                            kode_transaksi
                                        ) VALUES (
                                            '$id_event_setting',
                                            '$id_event_kategori',
                                            '$id_peserta',
                                            '$TanggalDaftar',
                                            '$kode_kupon',
                                            'Online',
                                            '$HargaTiket',
                                            '$BiayaAdm',
                                            '$diskon',
                                            '$Tagihan',
                                            'Pending',
                                            '$KodeTransaksi'
                                        )";
                                        $ProsesPembayaran=mysqli_query($Conn, $entry);
                                        if($ProsesPembayaran){
                                            $ValidasiProsesSimpan="Valid";
                                        }else{
                                            $ValidasiProsesSimpan="Terjadi Kesalahan Pada Saat Insert Data Pembayaran";
                                        }
                                    }
                                    if($ValidasiProsesSimpan=="Valid"){
                                        $StatusPembayaran2=getDataDetail($Conn,'event_pembayaran','id_peserta',$id_peserta,'status');
                                        $KodeTransaksi2=getDataDetail($Conn,'event_pembayaran','id_peserta',$id_peserta,'kode_transaksi');
                                        $id_setting_api_key=$id_setting_api_key;
                                        $api_key=$api_key;
                                        $keterangan="success";
                                        $response = Array (
                                            "message" => $keterangan,
                                            "code" => 200,
                                        );
                                        $metadata = Array (
                                            "id_event_setting" => $id_event_setting,
                                            "id_event_kategori" => $id_event_kategori,
                                            "id_peserta" => $id_peserta,
                                            "tanggal" => $TanggalDaftar,
                                            "kode_kupon" => $kode_kupon,
                                            "metode_pembayaran" => 'Online',
                                            "harga" => $HargaTiket,
                                            "biaya_adm" => $BiayaAdm,
                                            "diskon" => $diskon,
                                            "tagihan" => $Tagihan,
                                            "status" => $StatusPembayaran2,
                                            "kode_transaksi" => $KodeTransaksi2
                                        );
                                    }else{
                                        $id_setting_api_key=0;
                                        $api_key=0;
                                        $keterangan="$ValidasiProsesSimpan";
                                        $response = Array (
                                            "message" => $keterangan,
                                            "code" => 201,
                                        );
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