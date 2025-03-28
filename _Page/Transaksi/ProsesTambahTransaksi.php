<?php
    //Koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_mitra'])){
        echo '<span class="text-danger">ID Mitra Tidak Boleh Kosong</span>';
    }else{
        if(empty($_POST['tanggal'])){
            echo '<span class="text-danger">Tanggal Tidak Boleh Kosong</span>';
        }else{
            if(empty($_POST['kategori'])){
                echo '<span class="text-danger">Kategori Tidak Boleh Kosong</span>';
            }else{
                if(empty($_POST['metode'])){
                    echo '<span class="text-danger">Metode Pembayaran Tidak Boleh Kosong</span>';
                }else{
                    if(empty($_POST['status'])){
                        echo '<span class="text-danger">Status Transaksi Tidak Boleh Kosong</span>';
                    }else{
                        $id_mitra=$_POST['id_mitra'];
                        if(empty($_POST['id_pasien'])){
                            $id_pasien=0;
                        }else{
                            $id_pasien=$_POST['id_pasien'];
                        }
                        if(empty($_POST['id_kunjungan'])){
                            $id_kunjungan=0;
                        }else{
                            $id_kunjungan=$_POST['id_kunjungan'];
                        }
                        $tanggal=$_POST['tanggal'];
                        $kategori=$_POST['kategori'];
                        $metode=$_POST['metode'];
                        $status=$_POST['status'];
                        if(empty($_POST['pembayaran'])){
                            $pembayaran="0";
                        }else{
                            $pembayaran=$_POST['pembayaran'];
                        }
                        if(empty($_POST['keterangan'])){
                            $keterangan="";
                        }else{
                            $keterangan=$_POST['keterangan'];
                        }
                        if(empty($_POST['id_supplier'])){
                            $id_supplier="0";
                        }else{
                            $id_supplier=$_POST['id_supplier'];
                        }
                        if(empty($_POST['jumlah_transaksi'])){
                            $JumlahTagihan="0";
                        }else{
                            $JumlahTagihan=$_POST['jumlah_transaksi'];
                        }
                        if(!preg_match("/^[0-9]*$/", $JumlahTagihan)){
                            echo "Jumlah Tagihan Hanya Boleh Angka";   
                        }else{
                            if(!preg_match("/^[0-9]*$/", $pembayaran)){
                                echo "Jumlah Pembayaran Hanya Boleh Angka";   
                            }else{
                                //Buat id_transaksi
                                $QryTransaksi=mysqli_query($Conn, "SELECT max(id_transaksi) as id_transaksi FROM transaksi")or die(mysqli_error($Conn));
                                while($HasilNilaiTransaksi=mysqli_fetch_array($QryTransaksi)){
                                    $id_transaksi_max=$HasilNilaiTransaksi['id_transaksi'];
                                }
                                $id_transaksi=$id_transaksi_max+1;
                                //Cek keberadaan Auto Jurnal
                                $QryAutoJurnal = mysqli_query($Conn,"SELECT * FROM setting_autojurnal WHERE id_akses='$SessionIdAkses' AND id_mitra='$SessionIdMitra'")or die(mysqli_error($Conn));
                                $DataAutoJurnal = mysqli_fetch_array($QryAutoJurnal);
                                if(!empty($DataAutoJurnal['id_setting_autojurnal'])){
                                    $id_setting_autojurnal = $DataAutoJurnal['id_setting_autojurnal'];
                                    $trans_account1 = $DataAutoJurnal['trans_account1'];
                                    $cash_account1 = $DataAutoJurnal['cash_account1'];
                                    $debt_account1 = $DataAutoJurnal['debt_account1'];
                                    $receivables_account1 = $DataAutoJurnal['receivables_account1'];
                                    $trans_account2 = $DataAutoJurnal['trans_account2'];
                                    $cash_account2 = $DataAutoJurnal['cash_account2'];
                                    $debt_account2 = $DataAutoJurnal['debt_account2'];
                                    $receivables_account2 = $DataAutoJurnal['receivables_account2'];
                                    $trans_account3 = $DataAutoJurnal['trans_account3'];
                                    $cash_account3 = $DataAutoJurnal['cash_account3'];
                                    $debt_account3 = $DataAutoJurnal['debt_account3'];
                                    $receivables_account3 = $DataAutoJurnal['receivables_account3'];
                                    //Inisiasi utang piutang
                                    if($kategori=="Pembelian"){
                                        if($JumlahTagihan==$pembayaran){
                                            $UtangPiutang="Lunas";
                                            $Selisih="0";
                                            //Simpan ke jurnal Pembelian Lunas
                                            include "../../_Page/Transaksi/JurnalPembelianLunas.php";
                                        }else{
                                            if($JumlahTagihan>$pembayaran){
                                                $UtangPiutang="Utang";
                                                $Selisih=$JumlahTagihan-$pembayaran;
                                                include "../../_Page/Transaksi/JurnalPembelianUtang.php";
                                            }else{
                                                $UtangPiutang="Piutang";
                                                $Selisih=$pembayaran-$JumlahTagihan;
                                                include "../../_Page/Transaksi/JurnalPembelianPiutang.php";
                                            }
                                        }
                                    }else{
                                        if($kategori=="Penjualan"){
                                            if($JumlahTagihan==$pembayaran){
                                                $UtangPiutang="Lunas";
                                                $Selisih="0";
                                                include "../../_Page/Transaksi/JurnalPenjualanLunas.php";
                                            }else{
                                                if($JumlahTagihan>$pembayaran){
                                                    $UtangPiutang="Piutang";
                                                    $Selisih=$JumlahTagihan-$pembayaran;
                                                    include "../../_Page/Transaksi/JurnalPenjualanPiutang.php";
                                                }else{
                                                    $UtangPiutang="Utang";
                                                    $Selisih=$pembayaran-$JumlahTagihan;
                                                    include "../../_Page/Transaksi/JurnalPenjualanUtang.php";
                                                }
                                            }
                                        }else{
                                            if($kategori=="Pendaftaran"){
                                                if($JumlahTagihan==$pembayaran){
                                                    $UtangPiutang="Lunas";
                                                    $Selisih="0";
                                                    include "../../_Page/Transaksi/JurnalPendaftaranLunas.php";
                                                }else{
                                                    if($JumlahTagihan>$pembayaran){
                                                        $UtangPiutang="Piutang";
                                                        $Selisih=$JumlahTagihan-$pembayaran;
                                                        include "../../_Page/Transaksi/JurnalPendaftaranPiutang.php";
                                                    }else{
                                                        $UtangPiutang="Utang";
                                                        $Selisih=$pembayaran-$JumlahTagihan;
                                                        include "../../_Page/Transaksi/JurnalPendaftaranUtang.php";
                                                    }
                                                }
                                            }else{
                                                $UtangPiutang="";
                                                $Selisih="";
                                                $ValidasiAutoJurnal="Valid";
                                            }
                                        }
                                    }
                                }else{
                                    $ValidasiAutoJurnal="Valid";
                                }
                                if($ValidasiAutoJurnal=="Valid"){
                                    //Simpan data
                                    $EntryData="INSERT INTO transaksi (
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
                                        keterangan,
                                        status
                                    ) VALUES (
                                        '$id_transaksi',
                                        '$SessionIdAkses',
                                        '$id_mitra',
                                        '$id_pasien',
                                        '$id_kunjungan',
                                        '$id_supplier',
                                        '$tanggal',
                                        '$kategori',
                                        '$JumlahTagihan',
                                        '$pembayaran',
                                        '$metode',
                                        '$keterangan',
                                        '$status'
                                    )";
                                    $InputData=mysqli_query($Conn, $EntryData);
                                    if($InputData){
                                        //Update Transaksi rincian
                                        $UpdateRincian = mysqli_query($Conn,"UPDATE transaksi_rincian SET 
                                            id_transaksi='$id_transaksi',
                                            id_supplier='$id_supplier'
                                        WHERE id_akses='$SessionIdAkses' AND id_transaksi='0' AND id_mitra='$id_mitra'") or die(mysqli_error($Conn));
                                        if($UpdateRincian){
                                            //Hapus data transaksi sementara
                                            $HapusTransaksiSementara = mysqli_query($Conn, "DELETE FROM transaksi_sementara WHERE id_akses='$SessionIdAkses'") or die(mysqli_error($Conn));
                                            if($HapusTransaksiSementara){
                                                echo '<small class="text-success" id="NotifikasiTambahTransaksiBerhasil">Success</small>';
                                                $KategoriLog="Input Transaksi";
                                                $KeteranganLog="Input Transaksi  $id_transaksi Berhasil";
                                                include "../../_Config/InputLog.php";
                                            }else{
                                                echo '<span class="text-danger">Terjadi Kesalahan Pada Saat Menghapus Transaksi Sementara</span>';
                                            }
                                        }else{
                                            echo '<span class="text-danger">Terjadi kesalahan pada saat menyimpan data rincian!</span>';
                                        }
                                    }else{
                                        echo '<span class="text-danger">Terjadi kesalahan pada saat menyimpan data transaksi!</span>';
                                    }
                                }else{
                                    echo '<span class="text-danger">'.$ValidasiAutoJurnal.'</span>';
                                    echo '<span class="text-danger">'.$JumlahTagihan.'</span><br>';
                                    echo '<span class="text-danger">'.$pembayaran.'</span><br>';
                                    echo '<span class="text-danger">'.$UtangPiutang.'</span><br>';
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>