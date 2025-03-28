<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    date_default_timezone_set("Asia/Jakarta");
    $tanggal=date('Y-m-d');
    $jam=date('H:i:s');
?>
<input type="hidden" name="id_akses" id="id_akses" value="<?php echo $SessionIdAkses;?>">
<div class="row">
    <div class="col-md-6 mt-3">
        <label for="tanggal_request">Tanggal Request</label>
        <input type="date" name="tanggal_request" id="tanggal_request" class="form-control" value="<?php echo $tanggal;?>">
    </div>
    <div class="col-md-6 mt-3">
        <label for="waktu_request">Waktu Request</label>
        <input type="time" name="waktu_request" id="waktu_request" class="form-control" value="<?php echo $jam;?>">
    </div>
</div>
<!-- <div class="row">
    <div class="col-md-6 mt-3">
        <label for="tanggal_response">Tanggal Response</label>
        <input type="date" name="tanggal_response" id="tanggal_response" class="form-control">
    </div>
    <div class="col-md-6 mt-3">
        <label for="waktu_response">Waktu Response</label>
        <input type="time" name="waktu_response" id="waktu_response" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mt-3">
        <label for="tanggal_selesai">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control">
    </div>
    <div class="col-md-6 mt-3">
        <label for="waktu_selesai">Waktu Selesai</label>
        <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control">
    </div>
</div> -->
<div class="row">
    <div class="col-md-12 mt-3">
        <label for="id_unit_kerja">Unit/Tujuan</label>
        <select name="id_unit_kerja" id="id_unit_kerja" class="form-control">
            <option value="">Pilih</option>
            <?php
                $QryUnit = mysqli_query($Conn, "SELECT*FROM unit_kerja ORDER BY nama_unit_kerja ASC");
                while ($DataUnit = mysqli_fetch_array($QryUnit)) {
                    $id_unit_kerja= $DataUnit['id_unit_kerja'];
                    $nama_unit_kerja= $DataUnit['nama_unit_kerja'];
                    echo '<option value="'.$id_unit_kerja.'">'.$nama_unit_kerja.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3">
        <label for="kategori_dukungan">Kategori Dukungan</label>
        <input type="text" name="kategori_dukungan" id="kategori_dukungan" list="ListKategoriDukungan" class="form-control">
        <datalist id="ListKategoriDukungan">
            <?php
                $QryDukungan = mysqli_query($Conn, "SELECT DISTINCT kategori_dukungan FROM dukungan ORDER BY kategori_dukungan ASC");
                while ($DataDukungan = mysqli_fetch_array($QryDukungan)) {
                    $kategori_dukungan= $DataDukungan['kategori_dukungan'];
                    echo '<option value="'.$kategori_dukungan.'">';
                }
            ?>
        </datalist>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3">
        <label for="judul_dukungan">Judul Dukungan</label>
        <input type="text" name="judul_dukungan" id="judul_dukungan" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3">
        <label for="keterangan_dukungan">Keterangan Dukungan</label>
        <textarea name="keterangan_dukungan" id="keterangan_dukungan" cols="30" rows="4" class="form-control"></textarea>
        <small>
            Jelaskan dukungan yang anda butuhkan
        </small>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3" id="NotifikasiTambahDukungan">
        <small class="text-primary">Pastkan data yang anda input sudah benar</small>
    </div>
</div>