<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap variabel
    if(empty($_POST['GetIdTransaksiEdit'])){
        echo '<div class="alert alert-danger" role="alert">';
        echo '  ID Transaksi Tidak Boleh Kosong!';
        echo '</div>';
    }else{
        if(empty($_POST['id_mitra'])){
            echo '<div class="alert alert-danger" role="alert">';
            echo '  ID Mitra Tidak Boleh Kosong!';
            echo '</div>';
        }else{
            if(empty($_POST['tanggal'])){
                echo '<div class="alert alert-danger" role="alert">';
                echo '  Tanggal Tidak Boleh Kosong!';
                echo '</div>';
            }else{
                if(empty($_POST['kategori'])){
                    echo '<div class="alert alert-danger" role="alert">';
                    echo '  Kategori Transaksi Tidak Boleh Kosong!';
                    echo '</div>';
                }else{
                    if(empty($_POST['metode'])){
                        echo '<div class="alert alert-danger" role="alert">';
                        echo '  Metode Pembayaran Tidak Boleh Kosong!';
                        echo '</div>';
                    }else{
                        if(empty($_POST['status'])){
                            echo '<div class="alert alert-danger" role="alert">';
                            echo '  Status Transaksi Tidak Boleh Kosong!';
                            echo '</div>';
                        }else{
                            if(empty($_POST['tagihan'])){
                                echo '<div class="alert alert-danger" role="alert">';
                                echo '  Tagihan Transaksi Tidak Boleh Kosong!';
                                echo '</div>';
                            }else{
                                $id_transaksi=$_POST['GetIdTransaksiEdit'];
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
                                if(empty($_POST['tagihan'])){
                                    $tagihan="0";
                                }else{
                                    $tagihan=$_POST['tagihan'];
                                }
                                if(!preg_match("/^[0-9]*$/", $tagihan)){
                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo '  Jumlah Tagihan Hanya Boleh Angka';
                                    echo '</div>';
                                }else{
                                    if(!preg_match("/^[0-9]*$/", $pembayaran)){
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo '  Jumlah Pembayaran Hanya Boleh Angka';
                                        echo '</div>'; 
                                    }else{
                                        //Update Transaksi
                                        $UpdateTransaksi = mysqli_query($Conn,"UPDATE transaksi SET 
                                            id_pasien='$id_pasien',
                                            id_kunjungan='$id_kunjungan',
                                            id_supplier='$id_supplier',
                                            tanggal='$tanggal',
                                            kategori='$kategori',
                                            tagihan='$tagihan',
                                            pembayaran='$pembayaran',
                                            metode='$metode',
                                            keterangan='$keterangan',
                                            status='$status'
                                        WHERE id_transaksi='$id_transaksi'") or die(mysqli_error($Conn));
                                        if($UpdateTransaksi){
                                            $KategoriLog="Edit Transaksi";
                                            $KeteranganLog="Edit Transaksi  $id_transaksi Berhasil";
                                            include "../../_Config/InputLog.php";
                                            $_SESSION ["NotifikasiSwal"]="Edit Transaksi Berhasil";
                                            echo '<input type="hidden" id="UrlBack" value="index.php?Page=Transaksi&Sub=DetailTransaksi&id='.$id_transaksi.'">';
                                            echo '<small class="text-success" id="NotifikasiEditTransaksiBerhasil">Success</small>';
                                        }else{
                                            echo '<div class="alert alert-danger" role="alert">';
                                            echo '  Terjadi Kesalahan Pada Saat Melakukan Update Transaksi';
                                            echo '</div>'; 
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