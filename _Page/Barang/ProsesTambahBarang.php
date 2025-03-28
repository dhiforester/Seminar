<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Get Data
    if(empty($_POST['id_mitra'])){
        echo '<span class="text-danger">Mitra Tidak Boleh Kosong!</span>';
    }else{
        if(empty($_POST['kode_barang'])){
            echo '<span class="text-danger">Kode Barang Tidak Boleh Kosong!</span>';
        }else{
            if(empty($_POST['nama_barang'])){
                echo '<span class="text-danger">Nama barang Tidak Boleh Kosong!</span>';
            }else{
                if(empty($_POST['kategori_barang'])){
                    echo '<span class="text-danger">Kategori Barang Tidak Boleh Kosong!</span>';
                }else{
                    if(empty($_POST['satuan_barang'])){
                        echo '<span class="text-danger">Satuan Tidak Boleh Kosong!</span>';
                    }else{
                        if(empty($_POST['konversi'])){
                            echo '<span class="text-danger">Konversi Satuan Tidak Boleh Kosong!</span>';
                        }else{
                            if(empty($_POST['jumlah_kategori_harga'])){
                                echo '<span class="text-danger">Jumlah Kategori Harga Tidak Boleh Kosong!</span>';
                            }else{
                                $id_mitra=$_POST['id_mitra'];
                                $kode_barang=$_POST['kode_barang'];
                                $nama_barang=$_POST['nama_barang'];
                                $kategori_barang=$_POST['kategori_barang'];
                                $satuan_barang=$_POST['satuan_barang'];
                                $konversi=$_POST['konversi'];
                                $jumlah_kategori_harga=$_POST['jumlah_kategori_harga'];
                                if(empty($_POST['stok_barang'])){
                                    $stok_barang=0;
                                }else{
                                    $stok_barang=$_POST['stok_barang'];
                                }
                                if(empty($_POST['harga_beli'])){
                                    $harga_beli=0;
                                }else{
                                    $harga_beli=$_POST['harga_beli'];
                                }
                                //Validasi data duplikat
                                $ValidasiDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM barang WHERE kode_barang='$kode_barang' AND id_mitra='$id_mitra'"));
                                if(!empty($ValidasiDuplikat)){
                                    echo '<small class="text-danger">Data Tersebut sudah ada</small>';
                                }else{
                                    //Buat id_barang
                                    $QryBarang=mysqli_query($Conn, "SELECT max(id_barang) as id_barang FROM barang")or die(mysqli_error($Conn));
                                    while($HasilBarang=mysqli_fetch_array($QryBarang)){
                                        $id_barang=$HasilBarang['id_barang'];
                                    }
                                    $id_barang=$id_barang+1;
                                    //Simpan data
                                    $entry="INSERT INTO barang (
                                        id_barang,
                                        id_mitra,
                                        kode_barang,
                                        nama_barang,
                                        kategori_barang,
                                        satuan_barang,
                                        konversi,
                                        harga_beli,
                                        stok_barang
                                    ) VALUES (
                                        '$id_barang',
                                        '$id_mitra',
                                        '$kode_barang',
                                        '$nama_barang',
                                        '$kategori_barang',
                                        '$satuan_barang',
                                        '$konversi',
                                        '$harga_beli',
                                        '$stok_barang'
                                    )";
                                    $Input=mysqli_query($Conn, $entry);
                                    if($Input){
                                        //Lakukan looping sesuai banyaknya data
                                        $a=1;
                                        $b=$jumlah_kategori_harga;
                                        for ( $i=$a; $i<=$b; $i++ ){
                                            if(!empty($_POST["kategori_harga$i"])){
                                                $kategori_harga=$_POST["kategori_harga$i"];
                                            }else{
                                                $kategori_harga="";
                                            }
                                            if(!empty($_POST["harga_jual$i"])){
                                                $harga_jual=$_POST["harga_jual$i"];
                                            }else{
                                                $harga_jual="";
                                            }
                                            $ValidasiDuplikatHarga=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM barang_harga WHERE id_barang='$id_barang' AND kategori_harga='$kategori_harga'"));
                                            if(empty($ValidasiDuplikatHarga)){
                                                //Simpan Harga
                                                $EntriHargaBarang="INSERT INTO barang_harga (
                                                    id_barang,
                                                    id_barang_satuan,
                                                    kategori_harga,
                                                    harga
                                                ) VALUES (
                                                    '$id_barang',
                                                    '0',
                                                    '$kategori_harga',
                                                    '$harga_jual'
                                                )";
                                                $InputHargaBarang=mysqli_query($Conn, $EntriHargaBarang);
                                            }
                                        }
                                        $KategoriLog="Input Barang Baru";
                                        $KeteranganLog="Input Barang Berhasil";
                                        include "../../_Config/InputLog.php";
                                        $_SESSION ["NotifikasiSwal"]="Tambah Barang Berhasil";
                                        echo '<small class="text-success" id="NotifikasiTambahBarangBerhasil">Success</small>';
                                    }else{
                                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
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