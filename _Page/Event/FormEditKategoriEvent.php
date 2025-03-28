<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(!empty($_POST['id_event_kategori'])){
        $id_event_kategori=$_POST['id_event_kategori'];
        //Buka data event
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $id_event_kategori= $DataEvent['id_event_kategori'];
        $kategori= $DataEvent['kategori'];
        $KeteranganKategori= $DataEvent['keterangan'];
        $harga_tiket= $DataEvent['harga_tiket'];
        $biaya_adm= $DataEvent['biaya_adm'];
        $kuota= $DataEvent['kuota'];
?>
    <input type="hidden" name="id_event_kategori" id="id_event_kategori" value="<?php echo "$id_event_kategori"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kategori">Nama Kategori/Tipe Peserta</label>
            <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo "$kategori"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="harga_tiket">Harga Tiket</label>
            <input type="number" name="harga_tiket" id="harga_tiket" class="form-control" value="<?php echo "$harga_tiket"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="biaya_adm">Biaya Adm</label>
            <input type="number" name="biaya_adm" id="biaya_adm" class="form-control" value="<?php echo "$biaya_adm"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kuota">Kuota</label>
            <input type="number" name="kuota" id="kuota" class="form-control" value="<?php echo "$kuota"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control"><?php echo "$KeteranganKategori"; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditKategoriEvent">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>