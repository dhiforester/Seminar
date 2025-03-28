<?php
    //Koneksi
    include "../../_Config/Connection.php";
    //Tangkap id_mitra
    if(empty($_POST['GetKunjunganPasien'])){
        echo '<label for="id_kunjungan">Kujungan</label>';
        echo '  <select name="id_kunjungan" id="id_kunjungan" class="form-control" data-bs-toggle="modal" data-bs-target="#ModalCariPasien">';
        echo '      <option value="">Pilih</option>';
        echo '  </select>';
    }else{
        $id_kunjungan=$_POST['GetKunjunganPasien'];
        //Buka data kunjungan
        $QryKunjungan = mysqli_query($Conn,"SELECT * FROM pasien_kunjungan WHERE id_kunjungan='$id_kunjungan'")or die(mysqli_error($Conn));
        $DataKunjungan = mysqli_fetch_array($QryKunjungan);
        $datetime_kunjungan= $DataKunjungan['datetime_kunjungan'];
        echo '<label for="id_kunjungan">Kunjungan</label>';
        echo '  <select name="id_kunjungan" id="id_kunjungan" class="form-control" data-bs-toggle="modal" data-bs-target="#ModalCariPasien">';
        echo '      <option value="'.$id_kunjungan.'">'.$datetime_kunjungan.'</option>';
        echo '  </select>';
    }
?>