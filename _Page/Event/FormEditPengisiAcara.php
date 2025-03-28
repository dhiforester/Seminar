<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_event_pengisi_acara'])){
        echo '<div class="row"> ';
        echo '  <div class="col-md-12 text-danger text-center">';
        echo '      ID Pengisi Acara Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_event_pengisi_acara=$_POST['id_event_pengisi_acara'];
        $nama=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_event_pengisi_acara,'nama');
        $kontak=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_event_pengisi_acara,'kontak');
        $email=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_event_pengisi_acara,'email');
        $kategori=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_event_pengisi_acara,'kategori');
        $organization=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_event_pengisi_acara,'organization');
?>
    <input type="hidden" name="id_event_pengisi_acara" id="id_event_pengisi_acara" value="<?php echo "$id_event_pengisi_acara"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="nama">Nama Pengisi Acara</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?php echo "$nama"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo "$email"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kontak">Kontak</label>
            <input type="text" name="kontak" id="kontak" class="form-control" value="<?php echo "$kontak"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="organization">Organization</label>
            <input type="text" name="organization" id="organization" class="form-control" value="<?php echo "$organization"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" id="kategori" list="ListKategori" class="form-control" value="<?php echo "$kategori"; ?>">
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