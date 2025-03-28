<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_transaksi_rincian'])){
        echo '<span class="text-danger">ID Transaksi Tidak Boleh Kosong!</span>';
    }else{
        $id_transaksi_rincian=$_POST['id_transaksi_rincian'];
        $HapusRincian = mysqli_query($Conn, "DELETE FROM transaksi_rincian WHERE id_transaksi_rincian='$id_transaksi_rincian'") or die(mysqli_error($Conn));
        if($HapusRincian){
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
                    $_SESSION ["NotifikasiSwal"]="Hapus Rincian Berhasil";
                    echo '<span class="text-success" id="NotifikasiHapusRincianBerhasil">Success</span>';
                }else{
                    echo '<span class="text-danger">Terjadi kesalahan pada saat mengupdate data Transaksi</span>';
                }
            }else{
                echo '<span class="text-success" id="NotifikasiHapusRincianBerhasil">Success</span>';
            }
            
        }else{
            echo '<span class="text-danger">Hapus Rincian Transaksi Gagal</span>';
        }
    }
?>