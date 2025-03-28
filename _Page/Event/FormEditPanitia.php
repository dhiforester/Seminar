<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_event_panitia'])){
        echo '<span class="text-danger">ID Panitia Tidak Boleh Kosong!</span>';
    }else{
        $id_event_panitia=$_POST['id_event_panitia'];
        //Buka data panitia
        $id_event_setting=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_event_panitia,'id_event_setting');
        $id_event_kategori=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_event_panitia,'id_event_kategori');
        $nama_panitia=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_event_panitia,'nama_panitia');
        $kategori=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_event_panitia,'kategori');
        $email=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_event_panitia,'email');
        $kontak=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_event_panitia,'kontak');
        $foto=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_event_panitia,'foto');
?>
    <input type="hidden" name="id_event_panitia" id="id_event_panitia" value="<?php echo "$id_event_panitia"; ?>">
    <input type="hidden" name="id_event_setting" id="id_event_setting" value="<?php echo "$id_event_setting"; ?>">
    <input type="hidden" name="id_event_kategori" id="id_event_kategori" value="<?php echo "$id_event_kategori"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kategori">Kategori/Jabatan</label>
            <input type="text" class="form-control" name="kategori" id="kategori" list="ListKategori" value="<?php echo "$kategori"; ?>">
            <datalist id="ListKategori">
                <option value="">
                    <?php
                        $query = mysqli_query($Conn, "SELECT DISTINCT kategori FROM event_panitia ORDER BY kategori ASC");
                        while ($data = mysqli_fetch_array($query)) {
                            $kategoriList= $data['kategori'];
                            echo '<option value="'.$kategoriList.'">'.$kategoriList.'</option>';
                        }
                    ?>
            </datalist>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="nama_panitia">Nama Panitia</label>
            <input type="text" name="nama_panitia" id="nama_panitia" class="form-control" value="<?php echo "$nama_panitia"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="email">Email Panitia</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo "$email"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kontak">Kontak Panitia</label>
            <input type="text" name="kontak" id="kontak" class="form-control" value="<?php echo "$kontak"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditPanitia">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>