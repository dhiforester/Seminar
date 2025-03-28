<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_unit_kerja
    if(empty($_POST['id_unit_kerja'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          ID Unit Kerja Tidak Dapat Ditangkap Oleh Sistem.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_unit_kerja=$_POST['id_unit_kerja'];
        //Buka data unit kerja
        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
        $id_unit_kerja = $DataUnitKerja['id_unit_kerja'];
        $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
        $keterangan= $DataUnitKerja['keterangan'];
        $status= $DataUnitKerja['status'];
?>
    <input type="hidden" name="id_unit_kerja" id="id_unit_kerja" value="<?php echo "$id_unit_kerja"; ?>">
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="nama_unit_kerja">Nama Unit Kerja</label>
            <input type="text" name="nama_unit_kerja" id="nama_unit_kerja" class="form-control" value="<?php echo "$nama_unit_kerja"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control"><?php echo "$keterangan"; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="status">Status Unit</label>
            <select name="status" id="status" class="form-control">
                <option <?php if($status==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($status=="Active"){echo "selected";} ?> value="Active">Active</option>
                <option <?php if($status=="Non Active"){echo "selected";} ?> value="Non Active">Non Active</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditUnitKerja">
            <small class="text-primary">Pastikan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>