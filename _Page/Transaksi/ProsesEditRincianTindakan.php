<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_transaksi_rincian'])){
        echo '<span class="text-danger">ID Rincian Transaksi Tidak Boleh Kosong!</span>';
    }else{
        if(empty($_POST['id_mitra_tindakan'])){
            echo '<span class="text-danger">ID Tindakan Tidak Boleh Kosong!</span>';
        }else{
            if(empty($_POST['id_mitra'])){
                echo '<span class="text-danger">ID Mitra Tindakan Tidak Boleh Kosong!</span>';
            }else{
                if(empty($_POST['nama_tindakan'])){
                    echo '<span class="text-danger">Nama Tindakan Tidak Boleh Kosong!</span>';
                }else{
                    if(empty($_POST['qty'])){
                        echo '<span class="text-danger">Jumlah Rincian Tidak Boleh Kosong!</span>';
                    }else{
                        if(empty($_POST['harga'])){
                            echo '<span class="text-danger">Harga Rincian Tidak Boleh Kosong!</span>';
                        }else{
                            if(empty($_POST['jumlah'])){
                                echo '<span class="text-danger">Jumlah Rincian Tidak Boleh Kosong!</span>';
                            }else{
                                if(empty($_POST['id_barang_harga'])){
                                    $id_barang_harga=0;
                                }else{
                                    $id_barang_harga=$_POST['id_barang_harga'];
                                }
                                $id_transaksi_rincian=$_POST['id_transaksi_rincian'];
                                $id_mitra_tindakan=$_POST['id_mitra_tindakan'];
                                $id_mitra=$_POST['id_mitra'];
                                $nama_tindakan=$_POST['nama_tindakan'];
                                $qty_rincian=$_POST['qty'];
                                $harga_rincian=$_POST['harga'];
                                $jumlah_rincian=$_POST['jumlah'];
                                //Simpan data
                                $Update = mysqli_query($Conn,"UPDATE transaksi_rincian SET 
                                    harga='$harga_rincian',
                                    qty='$qty_rincian',
                                    jumlah='$jumlah_rincian'
                                WHERE id_transaksi_rincian='$id_transaksi_rincian'") or die(mysqli_error($Conn)); 
                                if($Update){
                                    //Mode edit transaksi
                                    if(!empty($_POST['GetIdTransaksi'])){
                                        $id_transaksi=$_POST['GetIdTransaksi'];
                                        //Hitung rincian transaksi
                                        $JumlahRincianTotal=0;
                                        $query = mysqli_query($Conn, "SELECT*FROM transaksi_rincian WHERE id_transaksi='$id_transaksi'");
                                        while ($data = mysqli_fetch_array($query)) {
                                            $jumlah= $data['jumlah'];
                                            $JumlahRincianTotal=$jumlah+$JumlahRincianTotal;
                                        }
                                        //Melakukan update transaksi
                                        $Update = mysqli_query($Conn,"UPDATE transaksi SET 
                                            tagihan='$JumlahRincianTotal'
                                        WHERE id_transaksi='$id_transaksi'") or die(mysqli_error($Conn)); 
                                        if($Update){
                                            $_SESSION ["NotifikasiSwal"]="Edit Rincian Berhasil";
                                            echo '<small class="text-success" id="NotifikasiEditRincianTindakanBerhasil">Success</small>';
                                        }else{
                                            echo '<span class="text-danger">Terjadi kesalahan pada saat mengupdate data Transaksi</span>';
                                        }
                                    }else{
                                        echo '<small class="text-success" id="NotifikasiEditRincianTindakanBerhasil">Success</small>';
                                    }
                                    
                                }else{
                                    echo '<span class="text-danger">Terjadi kesalahan pada saat menyimpan data rincian!</span>';
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>