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
            <label for="in_ex2">Internal/Eksternal</label>
            <select name="in_ex2" id="in_ex2" class="form-control">
                <option value="">Pilih</option>
                <option value="Internal">Internal</option>
                <option value="Eksternal">Eksternal</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3" id="FormIdAkses2">
            <label for="id_akses">ID User</label>
            <input type="text" readonly name="id_akses" id="id_akses" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="nama_undangan">Nama Undangan</label>
            <input type="text" name="nama_undangan" id="nama_undangan" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="unit_instansi">Unit/Instansi</label> 
            <input type="text" name="unit_instansi" id="unit_instansi" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="email_undangan">Email</label> 
            <input type="email" name="email_undangan" id="email_undangan" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label for="kontak_undangan">No.HP/Kontak</label> 
            <input type="text" name="kontak_undangan" id="kontak_undangan" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiTambahUndangan">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>