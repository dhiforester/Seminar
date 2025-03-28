<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_unit_kerja_anggota
    if(empty($_POST['id_unit_kerja_anggota'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          ID Unit Kerja Tidak Dapat Ditangkap Oleh Sistem.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_unit_kerja_anggota=$_POST['id_unit_kerja_anggota'];
        //Buka data unit kerja
        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja_anggota WHERE id_unit_kerja_anggota='$id_unit_kerja_anggota'")or die(mysqli_error($Conn));
        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
        $jabatan = $DataUnitKerja['jabatan'];
        $level= $DataUnitKerja['level'];
?>
    <input type="hidden" name="id_unit_kerja_anggota" id="id_unit_kerja_anggota" value="<?php echo "$id_unit_kerja_anggota"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="jabatan">Jabatan/Posisi</label>
            <input type="text" name="jabatan" id="jabatan" list="ListJabatan" class="form-control" value="<?php echo "$jabatan"; ?>">
            <datalist id="ListJabatan">
                <?php
                    $QryAkses = mysqli_query($Conn, "SELECT DISTINCT jabatan FROM unit_kerja_anggota ORDER BY jabatan ASC");
                    while ($DataAkses = mysqli_fetch_array($QryAkses)) {
                        $jabatan_list= $DataAkses['jabatan'];
                        echo '<option value="'.$jabatan_list.'">';
                    }
                ?>
            </datalist>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="level">Level</label>
            <select name="level" id="level" class="form-control">
                <option <?php if($level==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($level=="Admin"){echo "selected";} ?> value="Admin">Admin</option>
                <option <?php if($level=="Anggota"){echo "selected";} ?> value="Anggota">Anggota</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditAnggotaUnitKerja">
            <small class="text-primary">Pastikan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>