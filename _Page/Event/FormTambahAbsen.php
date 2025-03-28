<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event'])){
        echo '<span class="text-danger">ID Event Tidak Boleh Kosong!</span>';
    }else{
        $id_event=$_POST['id_event'];
?>
    <input type="hidden" name="id_event" id="id_event" value="<?php echo "$id_event"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kategori_absen">Kategori Absensi</label>
            <select name="kategori_absen" id="kategori_absen" class="form-control">
                <option value="">Pilih</option>
                <option value="Undangan">Undangan</option>
                <option value="Akses">Akses User</option>
                <option value="Eksternal">Eksternal</option>
            </select>
        </div>
    </div>
    <div id="FormTambahAbsen2">
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiTambahAbsen">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>