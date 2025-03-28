<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_setting'])){
        echo '<span class="text-danger">ID Event Tidak Boleh Kosong!</span>';
    }else{
        $id_event_setting=$_POST['id_event_setting'];
        //Buka data event
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $tanggal_mulai= $DataEvent['tanggal_mulai'];
        $strtotime= strtotime($tanggal_mulai);
        $tanggal_mulai= date('Y-m-d',$strtotime);
?>
    <input type="hidden" name="id_event_setting" value="<?php echo "$id_event_setting"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo "$tanggal_mulai"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="waktu1">Jam Mulai</label>
            <input type="time" name="waktu1" id="waktu1" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label for="waktu2">Jam Berakhir</label>
            <input type="time" name="waktu2" id="waktu2" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="keterangan">Keterangan Jadwal</label>
            <textarea name="keterangan" id="keterangan" cols="30" rows="4" class="form-control"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="pengisi_acara">Pengisi Acara</label>
            <input type="text" name="pengisi_acara" id="pengisi_acara" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiTambahJadwal">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>