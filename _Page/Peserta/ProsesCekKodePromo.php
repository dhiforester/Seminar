<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['id_event_kategori'])){
        echo '<div class="row mb-3">';
        echo '  <div class="col-md-12 text-center text-danger">ID Kategori tidak boleh kosong</div>';
        echo '</div>';
    }else{
        if(empty($_POST['kode_kupon'])){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-12 text-center text-danger">Kode Kupon tidak boleh kosong</div>';
            echo '</div>';
        }else{
            $id_event_kategori=$_POST['id_event_kategori'];
            $kode_kupon=$_POST['kode_kupon'];
            //Buka harga
            $QryEvent= mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
            $DataEvent= mysqli_fetch_array($QryEvent);
            $harga_tiket= $DataEvent['harga_tiket'];
            //Buka Kupon
            $QryKupon= mysqli_query($Conn,"SELECT * FROM event_kupon WHERE kode_kupon='$kode_kupon' AND id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
            $DataKupon= mysqli_fetch_array($QryKupon);
            if(empty($DataKupon['status'])){
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-12 text-center text-danger">Kode Kupon Tidak Valid</div>';
                echo '</div>';
            }else{
                if($DataKupon['status']!=="Belum Digunakan"){
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12 text-center text-danger">Kode Kupon Sudah Digunakan</div>';
                    echo '</div>';
                }else{
                    $id_kupon=$DataKupon['id_kupon'];
                    $NilaiDiskon=$DataKupon['diskon'];
                    $NilaiPotongan=($NilaiDiskon/100)*$harga_tiket;
                    $PembulatanPotongan = round($NilaiPotongan);
                    $NilaiTagihan=$harga_tiket-$PembulatanPotongan;
                    //Format Rupiah
                    $HargaTiketRp = "Rp " . number_format($harga_tiket, 0, ',', '.');
                    $PembulatanPotonganRp = "Rp " . number_format($PembulatanPotongan, 0, ',', '.');
                    $NilaiTagihanRp = "Rp " . number_format($NilaiTagihan, 0, ',', '.');
                    echo '<input type="hidden" id="ValidasiDiskon" value="Valid">';
                    echo '<input type="hidden" id="NilaiDikon" value="'.$NilaiDiskon.'">';
                    echo '<input type="hidden" id="NilaiTagihan" value="'.$NilaiTagihan.'">';
                    echo '<div class="row">';
                    echo '  <div class="col-md-12 text-success text-center">';
                    echo '      <small>Kode kupon valid!! <br>Anda berpotensi memperoleh potongan sebesar '.$PembulatanPotonganRp.' ('.$NilaiDiskon.' %) </small>';
                    echo '  </div>';
                    echo '</div>';
                }
            }
            
        }
    }
?>