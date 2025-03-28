<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_undangan'])){
        echo '<span class="text-danger">ID Undangan Tidak Boleh Kosong!</span>';
    }else{
        $id_event_undangan=$_POST['id_event_undangan'];
        //Buka detail undangan
        $QryUndangan= mysqli_query($Conn,"SELECT * FROM event_undangan WHERE id_event_undangan='$id_event_undangan'")or die(mysqli_error($Conn));
        $DataUndangan= mysqli_fetch_array($QryUndangan);
        $id_event= $DataUndangan['id_event'];
        $id_akses= $DataUndangan['id_akses'];
        $id_unit_kerja= $DataUndangan['id_unit_kerja'];
        $in_ex= $DataUndangan['in_ex'];
        $nama= $DataUndangan['nama'];
        $unit_instansi= $DataUndangan['unit_instansi'];
        $kontak= $DataUndangan['kontak'];
        $email= $DataUndangan['email'];
?>
    <input type="hidden" name="id_event_undangan" id="id_event_undangan" value="<?php echo "$id_event_undangan"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="in_ex3">Internal/Eksternal</label>
            <input type="text" readonly name="in_ex3" id="in_ex3" class="form-control" value="<?php echo $in_ex;?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="id_akses">ID User</label>
            <?php
                if($in_ex=="Internal"){
                    echo '<select name="id_akses" id="id_akses" class="form-control">';
                    echo '  <option value="">Pilih</option>';
                    $query = mysqli_query($Conn, "SELECT*FROM akses ORDER BY nama_akses ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $IdAkses= $data['id_akses'];
                        $nama_akses= $data['nama_akses'];
                        if($IdAkses==$id_akses){
                            echo '<option selected value="'.$IdAkses.'">'.$nama_akses.'</option>';
                        }else{
                            echo '<option value="'.$IdAkses.'">'.$nama_akses.'</option>';
                        }
                    }
                    echo '</select>';
                }else{
                    echo '<input type="text" readonly name="id_akses" id="id_akses" class="form-control">';
                }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="nama_undangan">Nama Undangan</label>
            <input type="text" <?php if($in_ex=="Internal"){echo "readonly";} ?> name="nama_undangan" id="nama_undangan" class="form-control" value="<?php echo "$nama"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="unit_instansi">Unit/Instansi</label> 
            <input type="text" <?php if($in_ex=="Internal"){echo "readonly";} ?> name="unit_instansi" id="unit_instansi" class="form-control" value="<?php echo "$unit_instansi"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="email_undangan">Email</label> 
            <input type="email" <?php if($in_ex=="Internal"){echo "readonly";} ?> name="email_undangan" id="email_undangan" class="form-control" value="<?php echo "$email"; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="kontak_undangan">No.HP/Kontak</label> 
            <input type="text" <?php if($in_ex=="Internal"){echo "readonly";} ?> name="kontak_undangan" id="kontak_undangan" class="form-control" value="<?php echo "$kontak"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditUndangan">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>