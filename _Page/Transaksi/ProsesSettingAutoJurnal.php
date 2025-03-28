<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //menangkap parameter data pembelian
    if(empty($_POST['trans_account1'])){
        echo '<span class="text-danger">';
        echo '  Maaf, akun transaksi pembelian tidak boleh kosong!';
        echo '</span>';
    }else{
        if(empty($_POST['cash_account1'])){
            echo '<span class="text-danger">';
            echo '  Maaf, akun kas pembelian tidak boleh kosong!';
            echo '</span>';
        }else{
            if(empty($_POST['debt_account1'])){
                echo '<span class="text-danger">';
                echo '  Maaf, akun utang pembelian tidak boleh kosong!';
                echo '</span>';
            }else{
                if(empty($_POST['receivables_account1'])){
                    echo '<span class="text-danger">';
                    echo '  Maaf, akun piutang pembelian tidak boleh kosong!';
                    echo '</span>';
                }else{
                    //menangkap parameter data penjualan
                    if(empty($_POST['trans_account2'])){
                        echo '<span class="text-danger">';
                        echo '  Maaf, akun transaksi penjualan tidak boleh kosong!';
                        echo '</span>';
                    }else{
                        if(empty($_POST['cash_account2'])){
                            echo '<span class="text-danger">';
                            echo '  Maaf, akun kas penjualan tidak boleh kosong!';
                            echo '</span>';
                        }else{
                            if(empty($_POST['debt_account2'])){
                                echo '<span class="text-danger">';
                                echo '  Maaf, akun utang penjualan tidak boleh kosong!';
                                echo '</span>';
                            }else{
                                if(empty($_POST['receivables_account2'])){
                                    echo '<span class="text-danger">';
                                    echo '  Maaf, akun piutang penjualan tidak boleh kosong!';
                                    echo '</span>';
                                }else{
                                    //menangkap parameter data pendaftaran
                                    if(empty($_POST['trans_account3'])){
                                        echo '<span class="text-danger">';
                                        echo '  Maaf, akun transaksi pendaftaran tidak boleh kosong!';
                                        echo '</span>';
                                    }else{
                                        if(empty($_POST['cash_account3'])){
                                            echo '<span class="text-danger">';
                                            echo '  Maaf, akun kas pendaftaran tidak boleh kosong!';
                                            echo '</span>';
                                        }else{
                                            if(empty($_POST['debt_account3'])){
                                                echo '<span class="text-danger">';
                                                echo '  Maaf, akun utang pendaftaran tidak boleh kosong!';
                                                echo '</span>';
                                            }else{
                                                if(empty($_POST['receivables_account3'])){
                                                    echo '<span class="text-danger">';
                                                    echo '  Maaf, akun piutang pendaftaran tidak boleh kosong!';
                                                    echo '</span>';
                                                }else{
                                                    //Pembelian
                                                    $trans_account1=$_POST['trans_account1'];
                                                    $cash_account1=$_POST['cash_account1'];
                                                    $debt_account1=$_POST['debt_account1'];
                                                    $receivables_account1=$_POST['receivables_account1'];
                                                    //Penjualan
                                                    $trans_account2=$_POST['trans_account2'];
                                                    $cash_account2=$_POST['cash_account2'];
                                                    $debt_account2=$_POST['debt_account2'];
                                                    $receivables_account2=$_POST['receivables_account2'];
                                                    //Pendaftaran
                                                    $trans_account3=$_POST['trans_account3'];
                                                    $cash_account3=$_POST['cash_account3'];
                                                    $debt_account3=$_POST['debt_account3'];
                                                    $receivables_account3=$_POST['receivables_account3'];
                                                    //Cek apakah data ada atau tidak
                                                    $CekSettingPembelian = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM setting_autojurnal WHERE id_akses='$SessionIdAkses' AND id_mitra='$SessionIdMitra'"));
                                                    //Simpan Data Pembelian
                                                    if(empty($CekSettingPembelian)){
                                                        $EntryDataPembelian="INSERT INTO setting_autojurnal (
                                                            id_akses,
                                                            id_mitra,
                                                            trans_account1,
                                                            cash_account1,
                                                            debt_account1,
                                                            receivables_account1,
                                                            trans_account2,
                                                            cash_account2,
                                                            debt_account2,
                                                            receivables_account2,
                                                            trans_account3,
                                                            cash_account3,
                                                            debt_account3,
                                                            receivables_account3
                                                        ) VALUES (
                                                            '$SessionIdAkses',
                                                            '$SessionIdMitra',
                                                            '$trans_account1',
                                                            '$cash_account1',
                                                            '$debt_account1',
                                                            '$receivables_account1',
                                                            '$trans_account2',
                                                            '$cash_account2',
                                                            '$debt_account2',
                                                            '$receivables_account2',
                                                            '$trans_account3',
                                                            '$cash_account3',
                                                            '$debt_account3',
                                                            '$receivables_account3'
                                                        )";
                                                        $InputDataPembelian=mysqli_query($Conn, $EntryDataPembelian);
                                                        if($InputDataPembelian){
                                                            echo '<small class="text-success" id="NotifikasiSettingAutoJurnalBerhasil">Success</small>';
                                                        }else{
                                                            echo '<small class="text-danger">Terjadi Kesalahan Pada Saat Menyimpan Pengaturan Auto Jurnal</small>';
                                                        }
                                                    }else{
                                                        $Update = mysqli_query($Conn,"UPDATE setting_autojurnal SET 
                                                            id_akses='$SessionIdAkses',
                                                            id_mitra='$SessionIdMitra',
                                                            trans_account1='$trans_account1',
                                                            cash_account1='$cash_account1',
                                                            debt_account1='$debt_account1',
                                                            receivables_account1='$receivables_account1',
                                                            trans_account2='$trans_account2',
                                                            cash_account2='$cash_account2',
                                                            debt_account2='$debt_account2',
                                                            receivables_account2='$receivables_account2',
                                                            trans_account3='$trans_account3',
                                                            cash_account3='$cash_account3',
                                                            debt_account3='$debt_account3',
                                                            receivables_account3='$receivables_account3'
                                                        WHERE id_akses='$SessionIdAkses' AND id_mitra='$SessionIdMitra'") or die(mysqli_error($Conn)); 
                                                        if($Update){
                                                            echo '<small class="text-success" id="NotifikasiSettingAutoJurnalBerhasil">Success</small>';
                                                        }else{
                                                            echo '<small class="text-danger">Terjadi Kesalahan Pada Saat Menyimpan Pengaturan Auto Jurnal</small>';
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
?>