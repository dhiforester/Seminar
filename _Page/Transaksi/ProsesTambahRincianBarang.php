<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    date_default_timezone_set("Asia/Jakarta");
    $updatetime=date('Y-m-d H:i:s');
    if(empty($_POST['id_barang'])){
        echo '<span class="text-danger">ID Barang Tidak Boleh Kosong!</span>';
    }else{
        if(empty($_POST['id_mitra'])){
            echo '<span class="text-danger">ID Mitra Tidak Boleh Kosong!</span>';
        }else{
            if(empty($_POST['nama_barang'])){
                echo '<span class="text-danger">Nama Barang Tidak Boleh Kosong!</span>';
            }else{
                if(empty($_POST['qty'])){
                    echo '<span class="text-danger">Jumlah Rincian Tidak Boleh Kosong!</span>';
                }else{
                    if(empty($_POST['rincian_satuan_barang'])){
                        echo '<span class="text-danger">Satuan Barang Tidak Boleh Kosong!</span>';
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
                                //Khusus untuk mode edit
                                if(empty($_POST['id_transaksi'])){
                                    $id_transaksi="0";
                                    $id_supplier="0";
                                }else{
                                    $id_transaksi=$_POST['id_transaksi'];
                                    $QryTransaksi = mysqli_query($Conn,"SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'")or die(mysqli_error($Conn));
                                    $DataTransaksi = mysqli_fetch_array($QryTransaksi);
                                    if(!empty($DataTransaksi['id_transaksi'])){
                                        $id_supplier=$DataTransaksi['id_supplier'];
                                    }else{
                                        $id_supplier="0";
                                    }
                                }
                                $id_barang=$_POST['id_barang'];
                                $id_mitra=$_POST['id_mitra'];
                                $nama_barang=$_POST['nama_barang'];
                                $qty_rincian=$_POST['qty'];
                                $rincian_satuan_barang=$_POST['rincian_satuan_barang'];
                                $harga_rincian=$_POST['harga'];
                                $jumlah_rincian=$_POST['jumlah'];
                                //Cek Duplikasi data
                                $QryDuplikasiData = mysqli_query($Conn,"SELECT * FROM transaksi_rincian WHERE updatetime='$updatetime'")or die(mysqli_error($Conn));
                                $DataDuplikasi = mysqli_fetch_array($QryDuplikasiData);
                                if(!empty($DataDuplikasi['id_transaksi_rincian'])){
                                    echo '<span class="text-danger">Data Tidak Boleh Duplikat!</span>';
                                }else{
                                    //Mencari id_barang_satuan
                                    $Qrysatuan = mysqli_query($Conn,"SELECT * FROM barang_satuan WHERE id_barang='$id_barang' AND satuan_multi='$rincian_satuan_barang'")or die(mysqli_error($Conn));
                                    $DataSatuan = mysqli_fetch_array($Qrysatuan);
                                    if(empty($DataSatuan['id_barang_satuan'])){
                                        $id_barang_satuan=0;
                                    }else{
                                        $id_barang_satuan=$DataSatuan['id_barang_satuan'];
                                    }
                                    //Simpan data
                                    $EntryData="INSERT INTO transaksi_rincian (
                                        id_transaksi,
                                        id_akses,
                                        id_barang,
                                        id_barang_harga,
                                        id_barang_satuan,
                                        id_mitra,
                                        id_mitra_tindakan,
                                        id_supplier,
                                        nama_barang,
                                        nama_tindakan,
                                        harga,
                                        qty,
                                        jumlah,
                                        updatetime
                                    ) VALUES (
                                        '$id_transaksi',
                                        '$SessionIdAkses',
                                        '$id_barang',
                                        '$id_barang_harga',
                                        '$id_barang_satuan',
                                        '$id_mitra',
                                        '0',
                                        '$id_supplier',
                                        '$nama_barang',
                                        '',
                                        '$harga_rincian',
                                        '$qty_rincian',
                                        '$jumlah_rincian',
                                        '$updatetime'
                                    )";
                                    $InputData=mysqli_query($Conn, $EntryData);
                                    if($InputData){
                                        if(!empty($id_transaksi)){
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
                                                $_SESSION ["NotifikasiSwal"]="Tambah Rincian Berhasil";
                                                echo '<input type="hidden" name="UrlBack" id="UrlBack" value="index.php?Page=Transaksi&Sub=DetailTransaksi&id='.$id_transaksi .'">';
                                                echo '<small class="text-success" id="NotifikasiTambahRincianBarangBerhasil">Success</small>';
                                            }else{
                                                echo '<span class="text-danger">Terjadi kesalahan pada saat mengupdate data Transaksi</span>';
                                            }
                                        }else{
                                            $_SESSION ["NotifikasiSwal"]="Tambah Rincian Berhasil";
                                            echo '<input type="hidden" name="UrlBack" id="UrlBack" value="index.php?Page=Transaksi&Sub=TambahTransaksi&id_mitra='.$id_mitra .'&id_sup='.$id_mitra .'">';
                                            echo '<small class="text-success" id="NotifikasiTambahRincianBarangBerhasil">Success</small>';
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
    }
?>