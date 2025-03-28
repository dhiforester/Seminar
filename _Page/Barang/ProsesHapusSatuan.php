<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_barang_satuan'])){
        echo '<span class="text-danger">ID Satuan Baraang Tidak Boleh Kosong</span>';
    }else{
        $id_barang_satuan=$_POST['id_barang_satuan'];
        //Proses hapus data
        $HapusBarangSatuan= mysqli_query($Conn, "DELETE FROM barang_satuan WHERE id_barang_satuan='$id_barang_satuan'") or die(mysqli_error($Conn));
        if($HapusBarangSatuan) {
            $_SESSION ["NotifikasiSwal"]="Hapus Satuan Berhasil";
            echo '<span class="text-success" id="NotifikasiHapusSatuanBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Harga Satuan gagal</span>';
        }
    }
?>