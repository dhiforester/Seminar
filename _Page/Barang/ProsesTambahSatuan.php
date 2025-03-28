<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap variabel
    if(empty($_POST['id_barang'])){
        echo '<span class="text-danger">ID Barang Tidak Boleh Kosong!</span>';
    }else{
        if(empty($_POST['kode_barang'])){
            echo '<span class="text-danger">Kode Barang Tidak Boleh Kosong!</span>';
        }else{
            if(empty($_POST['satuan_multi'])){
                echo '<span class="text-danger">Satuan Multi Tidak Boleh Kosong!</span>';
            }else{
                if(empty($_POST['konversi'])){
                    echo '<span class="text-danger">Konversi Tidak Boleh Kosong!</span>';
                }else{
                    if(empty($_POST['stok_multi'])){
                        echo '<span class="text-danger">Stok Multi Tidak Boleh Kosong!</span>';
                    }else{
                        $id_barang=$_POST['id_barang'];
                        $kode_barang=$_POST['kode_barang'];
                        $satuan_multi=$_POST['satuan_multi'];
                        $konversi=$_POST['konversi'];
                        $stok_multi=$_POST['stok_multi'];
                        //Simpan data
                        $EntrySatuanBarang="INSERT INTO barang_satuan (
                            id_barang,
                            kode_barang,
                            satuan_multi,
                            konversi_multi,
                            stok_multi
                        ) VALUES (
                            '$id_barang',
                            '$kode_barang',
                            '$satuan_multi',
                            '$konversi',
                            '$stok_multi'
                        )";
                        $InputSatuanHarga=mysqli_query($Conn, $EntrySatuanBarang);
                        if($InputSatuanHarga){
                            $_SESSION ["NotifikasiSwal"]="Tambah Satuan Berhasil";
                            echo '<small class="text-success" id="NotifikasiTambahSatuanBerhasil">Success</small>';
                        }else{
                            echo '<span class="text-danger">Terjadi kesalahan pada saat menyimpan data satuan!</span>';
                        }
                    }
                }
            }
        }
    }
?>