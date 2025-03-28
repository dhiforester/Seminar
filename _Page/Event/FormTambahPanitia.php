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
        $id_event_kategori=getDataDetail($Conn,'event_kategori','id_event_setting',$id_event_setting,'id_event_kategori');
?>
    <input type="hidden" name="id_event_setting" id="id_event_setting" value="<?php echo "$id_event_setting"; ?>">
    <input type="hidden" name="id_event_kategori" id="id_event_kategori" value="<?php echo "$id_event_kategori"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kategori">Kategori/Jabatan</label>
            <input type="text" class="form-control" name="kategori" id="kategori" list="ListKategori">
            <datalist id="ListKategori">
                <option value="">
                    <?php
                        $query = mysqli_query($Conn, "SELECT DISTINCT kategori FROM event_panitia ORDER BY kategori ASC");
                        while ($data = mysqli_fetch_array($query)) {
                            $kategori= $data['kategori'];
                            echo '<option value="'.$kategori.'">'.$kategori.'</option>';
                        }
                    ?>
            </datalist>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="nama_panitia">Nama Panitia</label>
            <input type="text" name="nama_panitia" id="nama_panitia" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="email">Email Panitia</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kontak">Kontak Panitia</label>
            <input type="text" name="kontak" id="kontak" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiTambahPanitia">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>