<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_barang_harga'])){
        echo '<span class="text-danger">ID Satuan Baraang Tidak Boleh Kosong</span>';
    }else{
        $id_barang_harga=$_POST['id_barang_harga'];
        //Proses hapus data
        $HapusKategoriHarga= mysqli_query($Conn, "DELETE FROM barang_harga WHERE id_barang_harga='$id_barang_harga'") or die(mysqli_error($Conn));
        if($HapusKategoriHarga) {
            $_SESSION ["NotifikasiSwal"]="Hapus Kategori Harga Berhasil";
            echo '<span class="text-success" id="NotifikasiHapusKategoriHargaBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Kategori Harga gagal</span>';
        }
    }
?>