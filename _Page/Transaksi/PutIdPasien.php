<?php
    //Koneksi
    include "../../_Config/Connection.php";
    //Tangkap id_mitra
    if(empty($_POST['GetIdPasien'])){
        echo '<label for="id_pasien">Pasien</label>';
        echo '  <select name="id_pasien" id="id_pasien" class="form-control" data-bs-toggle="modal" data-bs-target="#ModalCariPasien">';
        echo '      <option value="">Pilih</option>';
        echo '  </select>';
    }else{
        $id_pasien=$_POST['GetIdPasien'];
        //Buka data pasien
        $QryPasien = mysqli_query($Conn,"SELECT * FROM pasien WHERE id_pasien='$id_pasien'")or die(mysqli_error($Conn));
        $DataPasien = mysqli_fetch_array($QryPasien);
        $nama_pasien= $DataPasien['nama_pasien'];
        echo '<label for="id_pasien">Pasien</label>';
        echo '  <select name="id_pasien" id="id_pasien" class="form-control" data-bs-toggle="modal" data-bs-target="#ModalCariPasien">';
        echo '      <option value="'.$id_pasien.'">'.$nama_pasien.'</option>';
        echo '  </select>';
    }
?>