<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    $TanggalDaftar=date('Y-m-d H:i');
    //Validasi id_peserta tidak boleh kosong
    if(empty($_POST['id_peserta'])){
        echo '<small class="text-danger">Participant ID cannot be empty</small>';
    }else{
        //Validasi id_event_setting tidak boleh kosong
        if(empty($_POST['id_event_setting'])){
            echo '<small class="text-danger">Event ID cannot be empty</small>';
        }else{
            //Validasi id_event_kategori tidak boleh kosong
            if(empty($_POST['id_event_kategori'])){
                echo '<small class="text-danger">Category Event ID cannot be empty</small>';
            }else{
                //Variabel Lainnya
                $IdPeserta=$_POST['id_peserta'];
                $IdEventSetting=$_POST['id_event_setting'];
                $IdEventKategori=$_POST['id_event_kategori'];
                $id_peserta=getDataDetail($Conn,'event_peserta','id_peserta',$IdPeserta,'id_peserta');
                $id_event_setting=getDataDetail($Conn,'event_peserta','id_peserta',$IdPeserta,'id_event_setting');
                $id_event_kategori=getDataDetail($Conn,'event_peserta','id_peserta',$IdPeserta,'id_event_kategori');
                if(empty($id_peserta)){
                    echo '<small class="text-danger">Participant ID not valid!</small>';
                }else{
                    //Buka Data Harga Kategori Event
                    $HargaTiket=getDataDetail($Conn,'event_kategori','id_event_kategori',$id_event_kategori,'harga_tiket');
                    $BiayaAdm=getDataDetail($Conn,'event_kategori','id_event_kategori',$id_event_kategori,'biaya_adm');
                    //validasi kode_kupon tidak boleh kosong
                    if(!empty($_POST['kode_kupon'])){
                        $kode_kupon=$_POST['kode_kupon'];
                        $IdKategoriEventKupon=getDataDetail($Conn,'event_kupon','kode_kupon',$kode_kupon,'id_event_kategori');
                        $StatusKupon=getDataDetail($Conn,'event_kupon','kode_kupon',$kode_kupon,'status');
                        $id_kupon=getDataDetail($Conn,'event_kupon','kode_kupon',$kode_kupon,'id_kupon');
                        $diskon=getDataDetail($Conn,'event_kupon','kode_kupon',$kode_kupon,'diskon');
                        //Validasi Kategori Kupon
                        if(empty($IdKategoriEventKupon)){
                            $ValidasiKupon="Invalid Coupon Code";
                            $Tagihan=$HargaTiket;
                        }else{
                            //Validasi Event Kategori Kupon dengan Event Kategori Peserta
                            if($IdKategoriEventKupon!==$id_event_kategori){
                                $ValidasiKupon="The coupon does not match the participant's order";
                                $Tagihan=$HargaTiket;
                            }else{
                                if($StatusKupon=="Sudah Digunakan"){
                                    $ValidasiKupon="Coupon Code Already Used";
                                    $Tagihan=$HargaTiket;
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
                        echo '<small class="text-danger">'.$ValidasiKupon.'</small>';
                    }else{
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
                                //Update Status Pembayaran Peserta
                                $ProsesUpdatePeserta = mysqli_query($Conn,"UPDATE event_peserta SET 
                                    status_pembayaran='Pending'
                                WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn)); 
                                if($ProsesUpdatePeserta){
                                    if(!empty($kode_kupon)){
                                        //Update Kupon Sudah Dipakai
                                        $ProsesUpdateKupon = mysqli_query($Conn,"UPDATE event_kupon SET 
                                            status='Sudah Digunakan'
                                        WHERE kode_kupon='$kode_kupon'") or die(mysqli_error($Conn)); 
                                    }
                                    echo '<small class="text-success" id="NotifikasiPembayaranPesertaBerhasil">Success</small>';
                                }else{
                                    echo '<small class="text-danger">An error occurred while updating participant data</small>';
                                }
                            }else{
                                echo '<small class="text-danger">An error occurred while saving data</small>';
                            }
                        }else{
                            echo '<small class="text-danger">Payment is in place, please return to the previous page</small>';
                        }
                    }
                }
            }
        }
    }
?>