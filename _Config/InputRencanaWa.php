<?php
    //Diasumsikan koneksi sudah diinisiasi
    //Diasumsikan SettingGeneral.php diiniiasi
    //Diasumsikan variabel id_mitra sudah diinisiasi
    //Diasumsikan variabel id_kunjungan sudah diinisiasi
    date_default_timezone_set("Asia/Jakarta");
    //1. Buka ClientId Berdasarkan id_mitra
    $QryAkunWa = mysqli_query($Conn,"SELECT * FROM whatsapp_client WHERE id_mitra ='$id_mitra'")or die(mysqli_error($Conn));
    $DataAKunWa = mysqli_fetch_array($QryAkunWa);
    $id_whatsapp_client = $DataAKunWa['id_whatsapp_client'];
    $clientId = $DataAKunWa['clientId'];
    $nama_mitra = $DataAKunWa['nama_mitra'];
    $NomorAkunWa = $DataAKunWa['nomor_akun_wa'];
    //2. Buka id_kunjungan
    $QryKunjungan = mysqli_query($Conn,"SELECT * FROM pasien_kunjungan WHERE id_kunjungan='$id_kunjungan'")or die(mysqli_error($Conn));
    $DataKunjungan = mysqli_fetch_array($QryKunjungan);
    $id_pasien= $DataKunjungan['id_pasien'];
    $id_kunjungan= $DataKunjungan['id_kunjungan'];
    $id_dokter= $DataKunjungan['id_dokter'];
    $id_jadwal_dokter= $DataKunjungan['id_jadwal_dokter'];
    $id_mitra_tindakan= $DataKunjungan['id_mitra_tindakan'];
    $antrian= $DataKunjungan['antrian'];
    $estimasi_antrian= $DataKunjungan['estimasi_antrian'];
    $nama_pasien= $DataKunjungan['nama_pasien'];
    $datetime_kunjungan= $DataKunjungan['datetime_kunjungan'];
    //URL pDF invoice
    $UrlInvoice="$base_url/_Page/CetakInvoice/CetakInvoice.php?id_kunjungan=$id_kunjungan";
    //Buat tanggal rencana kirim
    $StrtotimeRencanaKirim=strtotime($medical_treatment_date_strtotime);
    $TanggalKunjungan=date('Y-m-d', $StrtotimeRencanaKirim);
    //Buka data pasien
    $QryPasien = mysqli_query($Conn,"SELECT * FROM pasien WHERE id_pasien='$id_pasien'")or die(mysqli_error($Conn));
    $DataPasien = mysqli_fetch_array($QryPasien);
    $kontak_pasien= $DataPasien['kontak_pasien'];
    if(!empty($kontak_pasien)){
        //Buka data tamplate berdasarkan id_mitra
        $QryTamplate = mysqli_query($Conn, "SELECT*FROM whatsapp_tamplate WHERE id_mitra='$id_mitra' AND status='Aktiv'");
        while ($DataTamplate = mysqli_fetch_array($QryTamplate)) {
            $id_whatsapp_tamplate = $DataTamplate['id_whatsapp_tamplate'];
            $nama_tamplate = $DataTamplate['nama_tamplate'];
            $pesan_tamplate = $DataTamplate['pesan_tamplate'];
            $lampiran_invoice = $DataTamplate['lampiran_invoice'];
            //Tentukan tanggal kirim pesan
            if($nama_tamplate=="Aktual"){
                $TanggalKirimPesan=date('Y-m-d');
            }else{
                if($nama_tamplate=="WA H-3"){
                    $TanggalKirimPesan=date('Y-m-d', strtotime('-3 day', $medical_treatment_date_strtotime));
                }else{
                    if($nama_tamplate=="WA H-1"){
                        $TanggalKirimPesan=date('Y-m-d', strtotime('-1 day', $medical_treatment_date_strtotime));
                    }else{
                        if($nama_tamplate=="WA H3"){
                            $TanggalKirimPesan=date('Y-m-d', strtotime('+3 day',$medical_treatment_date_strtotime));
                        }else{
                            $TanggalKirimPesan=date('Y-m-d');
                        }
                    }
                }
            }
            //Apakah perlu lampiran invoice?
            if($lampiran_invoice=="Ya"){
                $pesan="$pesan_tamplate $UrlInvoice";
            }else{
                $pesan="$pesan_tamplate";
            }
            //Simpan data rencana kirim
            $EntryRencanaKirim="INSERT INTO whatsapp_rencana_kirim (
                id_mitra,
                clientId,
                tanggal_kirim,
                no_tujuan,
                pesan,
                status
            ) VALUES (
                '$id_mitra',
                '$clientId',
                '$TanggalKirimPesan',
                '$kontak_pasien',
                '$pesan',
                'None'
            )";
            $InputRencanaKirim=mysqli_query($Conn, $EntryRencanaKirim);
        }
    }
?>