<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_mitra'])){
        echo '0';
    }else{
        $id_mitra=$_POST['id_mitra'];
        $JumlahRincianTotal=0;
        $query = mysqli_query($Conn, "SELECT*FROM transaksi_rincian WHERE id_akses='$SessionIdAkses' AND id_transaksi='0' AND id_mitra='$id_mitra'");
        while ($data = mysqli_fetch_array($query)) {
            $id_transaksi_rincian= $data['id_transaksi_rincian'];
            $id_barang= $data['id_barang'];
            $id_barang_harga= $data['id_barang_harga'];
            $id_barang_satuan= $data['id_barang_satuan'];
            $id_mitra= $data['id_mitra'];
            $id_mitra_tindakan=$data['id_mitra_tindakan'];
            $nama_barang= $data['nama_barang'];
            $nama_tindakan= $data['nama_tindakan'];
            $harga= $data['harga'];
            $qty= $data['qty'];
            $jumlah= $data['jumlah'];
            $JumlahRincianTotal=$jumlah+$JumlahRincianTotal;
        }
        echo $JumlahRincianTotal;
    }
?>