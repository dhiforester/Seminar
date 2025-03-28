<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_event_setting'])){
        echo '<span class="text-danger">ID Event Tidak Boleh Kosong!</span>';
    }else{
        $id_event_setting=$_POST['id_event_setting'];
?>
    <input type="hidden" name="id_event_setting" id="id_event_setting" value="<?php echo "$id_event_setting"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="nama">Nama Pengisi Acara</label>
            <input type="text" name="nama" id="nama" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kontak">Kontak</label>
            <input type="text" name="kontak" id="kontak" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="organization">Organization</label>
            <input type="text" name="organization" id="organization" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" id="kategori" list="ListKategori" class="form-control">
            <datalist id="ListKategori">
                <option value="Moderator">
                <option value="Pemateri">
            </datalist>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>
    </div>
<?php } ?>