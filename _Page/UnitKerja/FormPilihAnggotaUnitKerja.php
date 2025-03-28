<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_akses
    if(empty($_POST['id_akses'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3">';
        echo '          ID Akses Tidak Boleh Kosong.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_akses=$_POST['id_akses'];
        //Buka data askes
        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
        if(empty($DataDetailAkses['nama_akses'])){
            echo '  <div class="row">';
            echo '      <div class="col-md-12 mb-3">';
            echo '          ID Akses Tidak Ditemukan.';
            echo '      </div>';
            echo '  </div>';
        }else{
             //Tangkap id_unit_kerja
            if(empty($_POST['id_unit_kerja'])){
                echo '  <div class="row">';
                echo '      <div class="col-md-12 mb-3">';
                echo '          ID Unit kerja Tidak Boleh Kosong.';
                echo '      </div>';
                echo '  </div>';
            }else{
                $id_unit_kerja=$_POST['id_unit_kerja'];
                //Buka data unit kerja
                $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                if(empty($DataUnitKerja['id_unit_kerja'])){
                    echo '  <div class="row">';
                    echo '      <div class="col-md-12 mb-3">';
                    echo '          ID Unit kerja Tidak Ditemukan.';
                    echo '      </div>';
                    echo '  </div>';
                }else{
                    $id_unit_kerja = $DataUnitKerja['id_unit_kerja'];
                    $nama_unit_kerja = $DataUnitKerja['nama_unit_kerja'];
                    $nama_akses= $DataDetailAkses['nama_akses'];
?>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="id_akses">ID Akses</label>
            <input type="text" readonly name="id_akses" id="id_akses" class="form-control" value="<?php echo "$id_akses"; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="id_unit_kerja">ID Unit</label>
            <input type="text" readonly name="id_unit_kerja" id="id_unit_kerja" class="form-control" value="<?php echo "$id_unit_kerja"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="nama_unit_kerja">Nama Unit Kerja</label>
            <input type="text" readonly name="nama_unit_kerja" id="nama_unit_kerja" class="form-control" value="<?php echo "$nama_unit_kerja"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="nama_akses">Nama Anggota</label>
            <input type="text" readonly name="nama_akses" id="nama_akses" class="form-control" value="<?php echo "$nama_akses"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="jabatan">Jabatan/Posisi</label>
            <input type="text" name="jabatan" id="jabatan" list="ListJabatan" class="form-control">
            <datalist id="ListJabatan">
                <?php
                    $QryAkses = mysqli_query($Conn, "SELECT DISTINCT jabatan FROM unit_kerja_anggota ORDER BY jabatan ASC");
                    while ($DataAkses = mysqli_fetch_array($QryAkses)) {
                        $jabatan= $DataAkses['jabatan'];
                        echo '<option value="'.$jabatan.'">';
                    }
                ?>
            </datalist>
        </div>
        <div class="col-md-6 mb-3">
            <label for="level">Level</label>
            <select name="level" id="level" class="form-control">
                <option value="">Pilih</option>
                <option value="Admin">Admin</option>
                <option value="Anggota">Anggota</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3" id="NotifikasiTambahAnggotaUnitKerja">
            <span class="text-primary">Pastikan Data Anggota Unit Sudah Terisi Dengan Benar</span>
        </div>
    </div>
<?php }}}}?>