<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_setting'])){
        echo '<span class="text-danger">ID Event Tidak Boleh Kosong!</span>';
    }else{
        $id_event_setting=$_POST['id_event_setting'];
?>
    <input type="hidden" name="id_event_setting" id="id_event_setting" value="<?php echo "$id_event_setting"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kategori">Nama Kategori/Tipe Peserta</label>
            <input type="text" name="kategori" id="kategori" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="harga_tiket">Harga Tiket</label>
            <input type="number" name="harga_tiket" id="harga_tiket" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="biaya_adm">Biaya Adm</label>
            <input type="number" name="biaya_adm" id="biaya_adm" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kuota">Kuota</label>
            <input type="number" name="kuota" id="kuota" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiTambahKategoriEvent">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>