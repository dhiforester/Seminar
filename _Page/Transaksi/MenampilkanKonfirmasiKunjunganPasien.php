<div class="modal-body">
    <?php
        //Koneksi
        include "../../_Config/Connection.php";
        if(empty($_POST['id_kunjungan'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Kunjungan Tidak Boleh Kosong!';
            echo '  </div>';
            echo '</div>';
        }else{
            if(empty($_POST['id_pasien'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID Pasien Tidak Boleh Kosong!';
                echo '  </div>';
                echo '</div>';
            }else{
                $id_kunjungan=$_POST['id_kunjungan'];
                $id_pasien=$_POST['id_pasien'];
                //Buka detail pasien
                $QryPasien = mysqli_query($Conn,"SELECT * FROM pasien WHERE id_pasien='$id_pasien'")or die(mysqli_error($Conn));
                $DataPasien = mysqli_fetch_array($QryPasien);
                $nama_pasien= $DataPasien['nama_pasien'];
                //Buka data kunjungan
                $QryKunjungan = mysqli_query($Conn,"SELECT * FROM pasien_kunjungan WHERE id_kunjungan='$id_kunjungan'")or die(mysqli_error($Conn));
                $DataKunjungan = mysqli_fetch_array($QryKunjungan);
                $datetime_kunjungan= $DataKunjungan['datetime_kunjungan'];
                echo '<div class="row">';
                echo '  <div class="col-md-6">';
                echo '      <b>ID Pasien</b>';
                echo '  </div>';
                echo '  <div class="col-md-6" id="GetIdPasien">';
                echo '      '.$id_pasien.'';
                echo '  </div>';
                echo '</div>';
                echo '<div class="row">';
                echo '  <div class="col-md-6">';
                echo '      <b>ID Kunjungan</b>';
                echo '  </div>';
                echo '  <div class="col-md-6" id="GetKunjunganPasien">';
                echo '      '.$id_kunjungan.'';
                echo '  </div>';
                echo '</div>';
                echo '<div class="row">';
                echo '  <div class="col-md-6">';
                echo '      <b>Nama Pasien</b>';
                echo '  </div>';
                echo '  <div class="col-md-6">';
                echo '      '.$nama_pasien.'';
                echo '  </div>';
                echo '</div>';
                echo '<div class="row">';
                echo '  <div class="col-md-6">';
                echo '      <b>Tanggal Kunjungan</b>';
                echo '  </div>';
                echo '  <div class="col-md-6">';
                echo '      '.$datetime_kunjungan.'';
                echo '  </div>';
                echo '</div>';
                echo '<div class="row">';
                echo '  <div class="col-md-12">';
                echo '      Apakah anda yakin akan memilih data pasien ini?';
                echo '  </div>';
                echo '</div>';
            }
        }
    ?>
</div>
<div class="modal-footer bg-info">
    <button type="button" class="btn btn-success btn-rounded" id="KonfirmasiPilihPasienPut">
        <i class="bi bi-check-circle"></i> Konfirmasi
    </button>
    <button type="button" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalPilihKunjungan" data-id="<?php echo "$id_pasien";?>">
        <i class="bi bi-arrow-left-circle"></i> Kembali
    </button>
    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
        <i class="bi bi-x-circle"></i> Tutup
    </button>
</div>