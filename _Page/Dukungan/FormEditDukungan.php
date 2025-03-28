<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(!empty($_POST['GetIdDukungan'])){
        $GetIdDukungan=$_POST['GetIdDukungan'];
        //Buka data askes
        $QryDetailDukungan= mysqli_query($Conn,"SELECT * FROM dukungan WHERE id_dukungan='$GetIdDukungan'")or die(mysqli_error($Conn));
        $DataDetailDukungan= mysqli_fetch_array($QryDetailDukungan);
        $id_akses= $DataDetailDukungan['id_akses'];
        $id_unit_kerja= $DataDetailDukungan['id_unit_kerja'];
        $tanggal_request= $DataDetailDukungan['tanggal_request'];
        $tanggal_response= $DataDetailDukungan['tanggal_response'];
        $tanggal_selesai= $DataDetailDukungan['tanggal_selesai'];
        $judul_dukungan= $DataDetailDukungan['judul_dukungan'];
        $kategori_dukungan= $DataDetailDukungan['kategori_dukungan'];
        $keterangan_dukungan= $DataDetailDukungan['keterangan_dukungan'];
        $status_dukungan= $DataDetailDukungan['status_dukungan'];
?>
    <input type="hidden" name="id_dukungan" value="<?php echo "$GetIdDukungan"; ?>">
    <div class="row">
        <div class="col col-md-12 mt-2">
            <label for="judul_dukungan">Nama/Judul Dukungan</label>
            <input type="text" name="judul_dukungan" id="judul_dukungan" class="form-control" value="<?php echo "$judul_dukungan"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col col-md-12 mt-2">
            <label for="kategori_dukungan">Kategori Dukungan</label>
            <input type="text" name="kategori_dukungan" id="kategori_dukungan" class="form-control" value="<?php echo "$kategori_dukungan"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="keterangan_dukungan">Keterangan Dukungan</label>
            <textarea name="keterangan_dukungan" id="keterangan_dukungan" cols="30" rows="4" class="form-control"><?php echo "$keterangan_dukungan"; ?></textarea>
            <small>
                Jelaskan dukungan yang anda butuhkan
            </small>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-12 mb-3">
            <small class="text-primary" id="NotifikasiEditDukungan">Pastikan data dukungan sudah terisi dengan benar!</small>
        </div>
    </div>
<?php 
    }else{
        $GetIdDukungan="";
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col col-md-12 text-center">';
        echo '          <small class="modal-title my-3">Sorry, No data selected.</small>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }
?>