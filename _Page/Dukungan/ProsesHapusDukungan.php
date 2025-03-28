<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['GetIdDukungan'])){
        echo '<span class="text-danger">ID Dukungan tidak dapat ditangkap oleh sistem</span>';
    }else{
        $id_dukungan=$_POST['GetIdDukungan'];
        $query = mysqli_query($Conn, "DELETE FROM dukungan WHERE id_dukungan='$id_dukungan'") or die(mysqli_error($Conn));
        if ($query) {
            //Buka riwayat kerja
            $query2 = mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE id_dukungan='$id_dukungan'");
            while ($data = mysqli_fetch_array($query2)) {
                $id_riwayat_kerja = $data['id_riwayat_kerja'];
                //Buka Riwayat Kerja
                $QryDetailRiwayatKerja= mysqli_query($Conn,"SELECT * FROM riwayat_kerja WHERE id_riwayat_kerja='$id_riwayat_kerja'")or die(mysqli_error($Conn));
                $DataRiwayatKerja= mysqli_fetch_array($QryDetailRiwayatKerja);
                $gambar_kerja= $DataRiwayatKerja['gambar_kerja'];
                //Proses hapus data
                $query = mysqli_query($Conn, "DELETE FROM riwayat_kerja WHERE id_riwayat_kerja='$id_riwayat_kerja'") or die(mysqli_error($Conn));
                if ($query) {
                    if(!empty($gambar_kerja)){
                        if(!empty($gambar_kerja)){
                            //Hapus Gambar
                            $path = "../../assets/img/Kerja/".$gambar_kerja;
                            unlink($path);
                        }
                        echo '<span class="text-danger">Hapus Riwayat Kerja Berhasil</span><br>';
                    }
                }else{
                    echo '<span class="text-danger">Hapus Data Gagal</span>';
                }
            }
            $_SESSION ["NotifikasiSwal"]="Hapus Dukungan Berhasil";
            echo '<span class="text-success" id="NotifikasiHapusDukunganBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Hapus Data Gagal</span>';
        }
    }
?>