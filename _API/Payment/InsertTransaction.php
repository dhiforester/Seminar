<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/SettingPayment.php";
    //Time Zone
    date_default_timezone_set("Asia/Jakarta");
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    $TanggalSekarang=date('Y-m-d');
    $datetime=strtotime($now);
    $sekarang=strtotime($now);
    $service_name="Insert Transaction";
    //Validasi Metode Pengiriman Data
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $id_setting_api_key=0;
        $api_key=0;
        $keterangan="Hanya diperbolehkan menggunakan metode POST";
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
            $keterangan="API Key Tidak boleh kosong";
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
                $keterangan="API Key tidak aktiv, silahkan hubungi admin untuk masalah ini";
                $code=201;
                $metadata = Array ();
            }else{
                //Validasi id_pasien tidak boleh kosong
                if(empty($Tangkap['id_pasien'])){
                    $id_pasien="0";
                    $ValidasiAkses="Valid";
                }else{
                    $id_pasien  = $Tangkap['id_pasien'];
                    //Validasi id_pasien harus ada sebagai member
                    $QryPasien = mysqli_query($Conn,"SELECT * FROM pasien WHERE id_pasien='$id_pasien'")or die(mysqli_error($Conn));
                    $DataPasien = mysqli_fetch_array($QryPasien);
                    if(empty($DataPasien['id_pasien'])){
                        $ValidasiPasien="ID Pasien Tidak Valid";
                    }else{
                        $ValidasiPasien="Valid";
                    }
                }
                if($ValidasiPasien!=="Valid"){
                    $id_setting_api_key=$id_setting_api_key;
                    $api_key=$api_key;
                    $keterangan=$ValidasiAkses;
                    $code=201;
                    $metadata = Array ();
                }else{
                    //Validasi id_kunjungan tidak boleh kosong
                    if(empty($Tangkap['id_kunjungan'])){
                        $id_setting_api_key=$id_setting_api_key;
                        $api_key=$api_key;
                        $keterangan="ID Kunjungan tidak boleh kosong";
                        $code=201;
                        $metadata = Array ();
                    }else{
                        if(empty($DataPasien['kontak_pasien'])){
                            $id_setting_api_key=$id_setting_api_key;
                            $api_key=$api_key;
                            $keterangan="Kontak pasien tidak boleh kosong";
                            $code=201;
                            $metadata = Array ();
                        }else{
                            if(empty($DataPasien['email_pasien'])){
                                $id_setting_api_key=$id_setting_api_key;
                                $api_key=$api_key;
                                $keterangan="Email pasien tidak boleh kosong";
                                $code=201;
                                $metadata = Array ();
                            }else{
                                $id_kunjungan=$Tangkap['id_kunjungan'];
                                //Validasi id_kunjungan
                                $QryKunjungan = mysqli_query($Conn,"SELECT * FROM pasien_kunjungan WHERE id_kunjungan='$id_kunjungan' AND status!='Dibatalkan'")or die(mysqli_error($Conn));
                                $DataKunjungan = mysqli_fetch_array($QryKunjungan);
                                if(empty($DataKunjungan['id_kunjungan'])){
                                    $id_setting_api_key=$id_setting_api_key;
                                    $api_key=$api_key;
                                    $keterangan="ID Kunjungan Tidak Valid";
                                    $code=201;
                                    $metadata = Array ();
                                }else{
                                    //Buka data pasien kunjuungan
                                    $id_mitra=$DataKunjungan['id_mitra'];
                                    $id_mitra_tindakan=$DataKunjungan['id_mitra_tindakan'];
                                    $nama_pasien=$DataKunjungan['nama_pasien'];
                                    $metode_pembayaran=$DataKunjungan['metode_pembayaran'];
                                    $order_id="KM-$id_mitra-$datetime";
                                    //Buka data tarif
                                    $QryTarif = mysqli_query($Conn,"SELECT * FROM mitra_tindakan WHERE id_mitra_tindakan='$id_mitra_tindakan'")or die(mysqli_error($Conn));
                                    $DataTarif = mysqli_fetch_array($QryTarif);
                                    $tarif_tindakan=$DataTarif['tarif_tindakan'];
                                    $nama_tindakan=$DataTarif['nama_tindakan'];
                                    //Membuat id_transaksi
                                    $QryTransaksi=mysqli_query($Conn, "SELECT max(id_transaksi) as id_transaksi FROM transaksi")or die(mysqli_error($Conn));
                                    while($HasilNilaiTransaksi=mysqli_fetch_array($QryTransaksi)){
                                        $id_transaksi_max=$HasilNilaiTransaksi['id_transaksi'];
                                    }
                                    $id_transaksi=$id_transaksi_max+1;
                                    //Membuat FirstName dan Lastname
                                    $explode = explode(" " , $nama_pasien);
                                    $FirstName=$explode[0];
                                    $LastName=$explode[1];
                                    //Buka data pasien
                                    $kontak_pasien=$DataPasien['kontak_pasien'];
                                    $email_pasien=$DataPasien['email_pasien'];
                                    //Simpan data transaksi
                                    $EntryDataTransaksi="INSERT INTO transaksi (
                                        id_transaksi,
                                        id_akses,
                                        id_mitra,
                                        id_pasien,
                                        id_kunjungan,
                                        id_supplier,
                                        tanggal,
                                        kategori,
                                        tagihan,
                                        pembayaran,
                                        metode,
                                        status
                                    ) VALUES (
                                        '$id_transaksi',
                                        '0',
                                        '$id_mitra',
                                        '$id_pasien',
                                        '$id_kunjungan',
                                        '0',
                                        '$TanggalSekarang',
                                        'Pendaftaran',
                                        '$tarif_tindakan',
                                        '$tarif_tindakan',
                                        '$metode_pembayaran',
                                        'Pending'
                                    )";
                                    $InputDataTransaksi=mysqli_query($Conn, $EntryDataTransaksi);
                                    if($InputDataTransaksi){
                                        //Tambah Rincian
                                        $EntryDataRincian="INSERT INTO transaksi_rincian (
                                            id_transaksi,
                                            id_akses,
                                            id_barang,
                                            id_barang_harga,
                                            id_barang_satuan,
                                            id_mitra,
                                            id_mitra_tindakan,
                                            nama_barang,
                                            nama_tindakan,
                                            harga,
                                            qty,
                                            jumlah,
                                            updatetime
                                        ) VALUES (
                                            '$id_transaksi',
                                            '0',
                                            '0',
                                            '0',
                                            '0',
                                            '$id_mitra',
                                            '$id_mitra_tindakan',
                                            '',
                                            '$nama_tindakan',
                                            '$tarif_tindakan',
                                            '1',
                                            '$tarif_tindakan',
                                            '$now'
                                        )";
                                        $InputDataRincian=mysqli_query($Conn, $EntryDataRincian);
                                        if($InputDataRincian){
                                            $EntryDataPembayaran="INSERT INTO transaksi_pembayaran (
                                                id_transaksi,
                                                id_akses,
                                                id_pasien,
                                                id_kunjungan,
                                                id_mitra,
                                                tanggal,
                                                metode,
                                                server_key,
                                                production,
                                                order_id,
                                                tagihan,
                                                first_name,
                                                last_name,
                                                email,
                                                kontak,
                                                snap_token,
                                                status
                                            ) VALUES (
                                                '$id_transaksi',
                                                '0',
                                                '$id_pasien',
                                                '$id_kunjungan',
                                                '$id_mitra',
                                                '$now',
                                                '$metode_pembayaran',
                                                '$server_key',
                                                '$production',
                                                '$order_id',
                                                '$tarif_tindakan',
                                                '$FirstName',
                                                '$LastName',
                                                '$email_pasien',
                                                '$kontak_pasien',
                                                '',
                                                'Pending'
                                            )";
                                            $InputDataPembayaran=mysqli_query($Conn, $EntryDataPembayaran);
                                            if($InputDataPembayaran){
                                                //Krim data dengan CURL
                                                $headers = array(
                                                    'Content-Type:Application/x-www-form-urlencoded',         
                                                );
                                                //CURL send data
                                                $arr = array(
                                                    "ServerKey" => "$server_key",
                                                    "Production" => "$production",
                                                    "order_id" => "$order_id",
                                                    "gross_amount" => "$tarif_tindakan",
                                                    "first_name" => "$FirstName",
                                                    "last_name" => "$LastName",
                                                    "email" => "$email_pasien",
                                                    "phone" => "$kontak_pasien",
                                                );
                                                $json = json_encode($arr);
                                                $curl = curl_init();
                                                curl_setopt($curl, CURLOPT_URL, "$api_payment_url/GetSnapToken.php");
                                                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                                                curl_setopt($curl, CURLOPT_TIMEOUT, 3); 
                                                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                                                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                                                curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
                                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                                $response = curl_exec($curl);
                                                $data =json_decode($response, true);
                                                $code=$data["code"];
                                                $pesan=$data["pesan"];
                                                $token=$data["token"];
                                                if($code=="200"){
                                                    //Update transaksi pembayaran
                                                    $UpdateTransaksiPembayaran = mysqli_query($Conn,"UPDATE transaksi_pembayaran SET 
                                                        snap_token='$token'
                                                    WHERE id_transaksi='$id_transaksi'") or die(mysqli_error($Conn));
                                                    if($UpdateTransaksiPembayaran){
                                                        $id_setting_api_key=$id_setting_api_key;
                                                        $api_key=$api_key;
                                                        $keterangan="success";
                                                        $code=200;
                                                        $metadata= Array (
                                                            "id_transaksi" => $id_transaksi,
                                                            "id_pasien" => $id_pasien,
                                                            "id_kunjungan" => $id_kunjungan,
                                                            "id_mitra" => $id_mitra,
                                                            "nama_pasien" => $nama_pasien,
                                                            "tanggal" => $now,
                                                            "metode_pembayaran" => $metode_pembayaran,
                                                            "server_key" => $server_key,
                                                            "production" => $production,
                                                            "order_id" => $order_id,
                                                            "tagihan" => $tarif_tindakan,
                                                            "first_name" => $FirstName,
                                                            "last_name" => $LastName,
                                                            "snap_token" => $token
                                                        );
                                                    }else{
                                                        $id_setting_api_key=$id_setting_api_key;
                                                        $api_key=$api_key;
                                                        $keterangan="Terjadi kesalahan pada saat menyimpan snap token";
                                                        $code=201;
                                                        $metadata = Array ();
                                                    }
                                                }else{
                                                    $id_setting_api_key=$id_setting_api_key;
                                                    $api_key=$api_key;
                                                    $keterangan="Snap Token Gagal Diminta Dari Payment Gateway ($pesan)";
                                                    $code=201;
                                                    $metadata = Array ();
                                                }
                                            }else{
                                                $id_setting_api_key=$id_setting_api_key;
                                                $api_key=$api_key;
                                                $keterangan="Terjadi kesalahan pada saat menyimpan data pembayaran";
                                                $code=201;
                                                $metadata = Array ();
                                            }
                                        }else{
                                            $id_setting_api_key=$id_setting_api_key;
                                            $api_key=$api_key;
                                            $keterangan="Terjadi kesalahan pada saat menyimpan data rincian";
                                            $code=201;
                                            $metadata = Array ();
                                        }
                                    }else{
                                        $id_setting_api_key=$id_setting_api_key;
                                        $api_key=$api_key;
                                        $keterangan="Terjadi kesalahan pada saat menyimpan data transaksi";
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