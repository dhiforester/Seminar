<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap variabel
    if(empty($_POST['id_barang_harga'])){
        echo '<span class="text-danger">ID Harga Barang Tidak Boleh Kosong!</span>';
    }else{
        if(empty($_POST['harga_multi'])){
            echo '<span class="text-danger">Harga Barang Tidak Boleh Kosong!</span>';
        }else{
            if(empty($_POST['kategori_harga'])){
                echo '<span class="text-danger">Kategori Harga Tidak Boleh Kosong!</span>';
            }else{
                if(empty($_POST['id_barang_satuan'])){
                    $id_barang_satuan=0;
                }else{
                    $id_barang_satuan=$_POST['id_barang_satuan'];
                }
                $id_barang_harga=$_POST['id_barang_harga'];
                $harga_multi=$_POST['harga_multi'];
                $kategori_harga=$_POST['kategori_harga'];
                //Validasi duplikasi data
                $UpdateKategoriHargaBarang = mysqli_query($Conn,"UPDATE barang_harga SET 
                    id_barang_satuan='$id_barang_satuan',
                    kategori_harga='$kategori_harga',
                    harga='$harga_multi'
                WHERE id_barang_harga='$id_barang_harga'") or die(mysqli_error($Conn)); 
                if($UpdateKategoriHargaBarang){
                    $_SESSION ["NotifikasiSwal"]="Update Kategori Harga Berhasil";
                    echo '<small class="text-success" id="NotifikasiEditKategoriHargaBerhasil">Success</small>';
                }else{
                    echo '<span class="text-danger">Terjadi kesalahan pada saat menyimpan data satuan!</span>';
                }
            }
        }
    }
?>