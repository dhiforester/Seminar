<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_kategori'])){
        echo '<div class="row mb-3">';
        echo '  <div class="col-md-4 text-center text-danger"></div>';
        echo '  <div class="col-md-8 text-center text-danger">ID Kategori tidak boleh kosong</div>';
        echo '</div>';
    }else{
        if(empty($_POST['kode_kupon'])){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-4 text-center text-danger"></div>';
            echo '  <div class="col-md-8 text-center text-danger">Kode Kupon tidak boleh kosong</div>';
            echo '</div>';
        }else{
            $id_event_kategori=$_POST['id_event_kategori'];
            $kode_kupon=$_POST['kode_kupon'];
            //Buka harga
            $QryEvent= mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
            $DataEvent= mysqli_fetch_array($QryEvent);
            $harga_tiket= $DataEvent['harga_tiket'];
            if(empty($DataEvent['biaya_adm'])){
                $biaya_adm=0;
            }else{
                $biaya_adm= $DataEvent['biaya_adm'];
            }
            
            //Buka Kupon
            $QryKupon= mysqli_query($Conn,"SELECT * FROM event_kupon WHERE kode_kupon='$kode_kupon' AND id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
            $DataKupon= mysqli_fetch_array($QryKupon);
            if(empty($DataKupon['status'])){
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-4 text-center text-danger"></div>';
                echo '  <div class="col-md-8 text-center text-danger">Kode Kupon Tidak Valid</div>';
                echo '</div>';
            }else{
                if($DataKupon['status']!=="Belum Digunakan"){
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-4 text-center text-danger"></div>';
                    echo '  <div class="col-md-8 text-center text-danger">Kode Kupon Sudah Digunakan</div>';
                    echo '</div>';
                }else{
                    $id_kupon=$DataKupon['id_kupon'];
                    $NilaiDiskon=$DataKupon['diskon'];
                    $NilaiPotongan=($NilaiDiskon/100)*$harga_tiket;
                    $PembulatanPotongan = round($NilaiPotongan);
                    $NilaiTagihan1=($harga_tiket-$PembulatanPotongan);
                    $NilaiTagihan=$biaya_adm+($harga_tiket-$PembulatanPotongan);
                    //Format Rupiah
                    $HargaTiketRp = "Rp " . number_format($harga_tiket, 0, ',', '.');
                    $PembulatanPotonganRp = "Rp " . number_format($PembulatanPotongan, 0, ',', '.');
                    $NilaiTagihanRp1 = "Rp " . number_format($NilaiTagihan1, 0, ',', '.');
                    $NilaiTagihanRp = "Rp " . number_format($NilaiTagihan, 0, ',', '.');
                    $BiayaAdmRp = "Rp " . number_format($biaya_adm, 0, ',', '.');
                    echo '<input type="hidden" id="ValidasiDiskon" value="Valid">';
                    echo '<input type="hidden" id="NilaiDikon" value="'.$NilaiDiskon.'">';
                    echo '<input type="hidden" id="NilaiTagihan" value="'.$NilaiTagihan.'">';
                    echo '<div class="row">';
                    echo '  <div class="col-md-4 text-center text-danger"></div>';
                    echo '  <div class="col-md-8 text-success">';
                    echo '      <b>Kupon Valid</b><br>';
                    echo '      <small></small>';
                    echo '          <ul>';
                    echo '              <li>+ Harga : '.$HargaTiketRp.'</li>';
                    echo '              <li>- Diskon ('.$NilaiDiskon.'%) : '.$PembulatanPotonganRp.'</li>';
                    echo '              <li>Subtotal : '.$NilaiTagihanRp1.'</li>';
                    echo '              <li>+ Biaya Admin : '.$BiayaAdmRp.'</li>';
                    echo '              <li>Jumlah : '.$NilaiTagihanRp.'</li>';
                    echo '          </ul>';
                    echo '      </small>';
                    echo '  </div>';
                    echo '</div>';
                }
            }
            
        }
    }
?>