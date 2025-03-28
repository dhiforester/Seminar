<?php
    //Koneksi
    include "../../_Config/Connection.php";
    //Tangkap Data
    if(empty($_POST['id_barang'])){
        echo "0";
    }else{
        if(empty($_POST['rincian_satuan_barang'])){
            echo "0";
        }else{
            $id_barang=$_POST['id_barang'];
            $rincian_satuan_barang=$_POST['rincian_satuan_barang'];
            if(empty($_POST['id_barang_harga'])){
                $id_barang_harga=0;
            }else{
                $id_barang_harga=$_POST['id_barang_harga'];
            }
            if(empty($_POST['qty_rincian'])){
                $qty_rincian=0;
            }else{
                $qty_rincian=$_POST['qty_rincian'];
            }
            if(empty($_POST['harga_rincian'])){
                $harga_rincian=0;
            }else{
                $harga_rincian=$_POST['harga_rincian'];
            }
            if(empty($_POST['harga_rincian'])){
                $harga_rincian=0;
            }else{
                $harga_rincian=$_POST['harga_rincian'];
            }
            //Mencari id_barang_satuan
            $Qrysatuan = mysqli_query($Conn,"SELECT * FROM barang_satuan WHERE id_barang='$id_barang' AND satuan_multi='$rincian_satuan_barang'")or die(mysqli_error($Conn));
            $DataSatuan = mysqli_fetch_array($Qrysatuan);
            if(empty($DataSatuan['id_barang_satuan'])){
                $id_barang_satuan=0;
            }else{
                $id_barang_satuan=$DataSatuan['id_barang_satuan'];
            }
            //Mencari harga pada database barang_harga
            $QryHargaBarang = mysqli_query($Conn,"SELECT * FROM barang_harga WHERE id_barang='$id_barang' AND id_barang_satuan='$id_barang_satuan'")or die(mysqli_error($Conn));
            $DataBarang = mysqli_fetch_array($QryHargaBarang);
            if(empty($DataBarang['harga'])){
                $HargaBarang=$harga_rincian;
            }else{
                $HargaBarang=$DataBarang['harga'];
            }
            echo "$HargaBarang";
        }
    }
?>