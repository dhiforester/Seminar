<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    $TanggalDaftar=date('Y-m-d H:i');
    //Validasi id_peserta tidak boleh kosong
    if(empty($_POST['id_peserta'])){
        echo '<small class="text-danger">ID Peserta tidak boleh kosong</small>';
    }else{
        //Validasi id_event_kategori tidak boleh kosong
        if(empty($_POST['id_event_kategori'])){
            echo '<small class="text-danger">ID Kategori tidak boleh kosong</small>';
        }else{
            //Validasi metode_pembayaran tidak boleh kosong
            if(empty($_POST['metode_pembayaran'])){
                echo '<small class="text-danger">Metode Pembayaran tidak boleh kosong</small>';
            }else{
                //Validasi status_pembayaran tidak boleh kosong
                if(empty($_POST['status_pembayaran'])){
                    echo '<small class="text-danger">Status Pembayaran tidak boleh kosong</small>';
                }else{
                    //Variabel Lainnya
                    $id_peserta=$_POST['id_peserta'];
                    $id_event_kategori=$_POST['id_event_kategori'];
                    $metode_pembayaran=$_POST['metode_pembayaran'];
                    $status_pembayaran=$_POST['status_pembayaran'];
                    if(empty($_POST['kode_kupon'])){
                        $kode_kupon="";
                    }else{
                        $kode_kupon=$_POST['kode_kupon'];
                    }
                    if(empty($_POST['harga'])){
                        $harga="0";
                    }else{
                        $harga=$_POST['harga'];
                    }
                    if(empty($_POST['diskon'])){
                        $diskon="0";
                    }else{
                        $diskon=$_POST['diskon'];
                    }
                    if(empty($_POST['tagihan'])){
                        $tagihan="0";
                    }else{
                        $tagihan=$_POST['tagihan'];
                    }
                    if(empty($_POST['biaya_adm'])){
                        $biaya_adm="0";
                    }else{
                        $biaya_adm=$_POST['biaya_adm'];
                    }
                    //Buka Detail Peserta
                    $QryDetailPeserta = mysqli_query($Conn,"SELECT * FROM event_peserta WHERE id_peserta='$id_peserta'")or die(mysqli_error($Conn));
                    $DataDetailPeserta = mysqli_fetch_array($QryDetailPeserta);
                    $id_event_setting= $DataDetailPeserta['id_event_setting'];
                    //Cek apakah pembayaran sudah ada sebelumnya
                    $QryPembayaran= mysqli_query($Conn,"SELECT * FROM event_pembayaran WHERE id_peserta='$id_peserta'")or die(mysqli_error($Conn));
                    $DataPembayaran= mysqli_fetch_array($QryPembayaran);
                    if(empty($DataPembayaran['id_event_pembayaran'])){
                        //Generate Kode Transaksi
                        $KodeTransaksi="KDT-$id_peserta-$id_event_setting-$id_event_kategori";
                        //Apabila Belum ADa Lakukan Insert
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
                            '$metode_pembayaran',
                            '$harga',
                            '$biaya_adm',
                            '$diskon',
                            '$tagihan',
                            '$status_pembayaran',
                            '$KodeTransaksi'
                        )";
                        $ProsesPembayaran=mysqli_query($Conn, $entry);
                    }else{
                        $ProsesPembayaran = mysqli_query($Conn,"UPDATE event_pembayaran SET 
                            id_event_setting='$id_event_setting',
                            id_event_kategori='$id_event_kategori',
                            tanggal='$TanggalDaftar',
                            kode_kupon='$kode_kupon',
                            metode_pembayaran='$metode_pembayaran',
                            harga='$harga',
                            biaya_adm='$biaya_adm',
                            diskon='$diskon',
                            tagihan='$tagihan',
                            status='$status_pembayaran'
                        WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn)); 
                    }
                    if($ProsesPembayaran){
                        //Update Status Pembayaran Peserta
                        $ProsesUpdatePeserta = mysqli_query($Conn,"UPDATE event_peserta SET 
                            status_pembayaran='$status_pembayaran'
                        WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn)); 
                        if($ProsesUpdatePeserta){
                            if(!empty($kode_kupon)){
                                //Update Kupon Sudah Dipakai
                                $ProsesUpdateKupon = mysqli_query($Conn,"UPDATE event_kupon SET 
                                    status='Sudah Digunakan'
                                WHERE kode_kupon='$kode_kupon'") or die(mysqli_error($Conn)); 
                            }
                            $KategoriLog="Pembayaran";
                            $KeteranganLog="Pembayaran Berhasil";
                            $id_unit_kerja="";
                            include "../../_Config/InputLog.php";
                            $_SESSION ["NotifikasiSwal"]="Simpan Pembayaran Berhasil";
                            echo '<small class="text-success" id="NotifikasiPembayaranPesertaBerhasil">Success</small>';
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat update data peserta</small>';
                        }
                    }else{
                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                    }
                }
            }
        }
    }
?>