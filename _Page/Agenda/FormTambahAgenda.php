<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_akses
    if(empty($_POST['tanggal'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          Tanggal Agenda Tidak Boleh Kosong.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $tanggal=$_POST['tanggal'];
?>
    <input type="hidden" name="id_akses" id="id_akses" value="<?php echo "$SessionIdAkses"; ?>">
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo "$tanggal"; ?>">
        </div>
        <div class="col-md-6 mt-3">
            <label for="jam">Jam</label>
            <input type="time" name="jam" id="jam" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="id_unit_kerja">Unit Kerja</label>
            <select name="id_unit_kerja" id="id_unit_kerja" class="form-control">
                <option value="">Pilih</option>
                <?php
                    $QryUnitKerjaAnggota = mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_akses='$SessionIdAkses' ORDER BY id_unit_kerja ASC");
                    while ($DataUnitKerjaAnggota = mysqli_fetch_array($QryUnitKerjaAnggota)) {
                        $id_unit_kerja= $DataUnitKerjaAnggota['id_unit_kerja'];
                        //Buka data unit kerja
                        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                        $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                        echo '<option value="'.$id_unit_kerja.'">'.$nama_unit_kerja.'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="col-md-6 mt-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="">Pilih</option>
                <option value="Rencana">Rencana</option>
                <option value="Ditunda">Ditunda</option>
                <option value="Batal">Batal</option>
                <option value="Selesai">Selesai</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="kategori">Kategori Kegiatan</label>
            <input type="text" name="kategori" id="kategori" list="ListKategori" class="form-control">
            <datalist id="ListKategori">
                <?php
                    $QryKategori = mysqli_query($Conn, "SELECT DISTINCT kategori FROM agenda ORDER BY kategori ASC");
                    while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                        $kategori= $DataKategori['kategori'];
                        echo '<option value="'.$kategori.'">';
                    }
                ?>
            </datalist>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="agenda">Agenda Kerja</label>
            <textarea name="agenda" id="agenda" cols="30" rows="4" class="form-control"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiTambahAgenda">
            <small class="text-primary">Pastikan data yang anda input sudah sesuai</small>
        </div>
    </div>
<?php } ?>