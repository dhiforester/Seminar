<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    $tanggal=date('Y-m-d');
    $jam=date('H:i:s');
?>
    <input type="hidden" name="id_akses" id="id_akses" value="<?php echo "$SessionIdAkses"; ?>">
    <div class="row">
        <div class="col-md-12">
            <label for="id_unit_kerja">Unit Kerja</label>
            <select name="id_unit_kerja" id="id_unit_kerja" class="form-control">
                <option value="">Pilih</option>
                <?php
                    $query = mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_akses='$SessionIdAkses'");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_unit_kerja = $data['id_unit_kerja'];
                        //Buka unit tujuan
                        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                        $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                        echo '<option value="'.$id_unit_kerja.'">'.$nama_unit_kerja.'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo "$tanggal"; ?>">
        </div>
        <div class="col-md-6 mt-3">
            <label for="jam">Jam</label>
            <input type="time" name="jam" id="jam" class="form-control" value="<?php echo "$jam"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="kategori_kerja">Kategori Kerja</label>
            <input type="text" name="kategori_kerja" id="kategori_kerja" class="form-control" list="ListKategoriKerja">
            <datalist id="ListKategoriKerja">
                <?php
                    $query = mysqli_query($Conn, "SELECT DISTINCT kategori_kerja FROM riwayat_kerja");
                    while ($data = mysqli_fetch_array($query)) {
                        $kategori_kerja = $data['kategori_kerja'];
                        echo '<option value="'.$kategori_kerja.'">';
                    }
                ?>
            </datalist>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="keterangan">Keterangan</label>
            <textarea id="keterangan" name="keterangan" class="form-control" cols="30" rows="4"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="gambar_kerja">Gambar Kegiatan Pekerjaan</label>
            <input type="file" name="gambar_kerja" id="gambar_kerja" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiTambahRiwayatKerja">
            <span class="text-primary">Pastikan Data Yang Anda Input Sudah Benar</span>
        </div>
    </div>
