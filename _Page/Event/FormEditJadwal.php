<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_jadwal'])){
        echo '<span class="text-danger">ID Jadwal Tidak Boleh Kosong!</span>';
    }else{
        $id_event_jadwal=$_POST['id_event_jadwal'];
        //Buka data jadwal event
        $QryJadwal= mysqli_query($Conn,"SELECT * FROM event_jadwal WHERE id_event_jadwal='$id_event_jadwal'")or die(mysqli_error($Conn));
        $DataJadwal= mysqli_fetch_array($QryJadwal);
        $id_event_setting= $DataJadwal['id_event_setting'];
        $tanggal= $DataJadwal['tanggal'];
        $waktu1= $DataJadwal['waktu1'];
        $waktu2= $DataJadwal['waktu2'];
        $keterangan= $DataJadwal['keterangan'];
        $pengisi_acara= $DataJadwal['pengisi_acara'];
?>
    <input type="hidden" name="id_event_jadwal" id="id_event_jadwal" value="<?php echo "$id_event_jadwal"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo "$tanggal"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="waktu1">Jam Mulai</label>
            <input type="time" name="waktu1" id="waktu1" class="form-control" value="<?php echo "$waktu1"; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="waktu2">Jam Berakhir</label>
            <input type="time" name="waktu2" id="waktu2" class="form-control" value="<?php echo "$waktu2"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="keterangan">Keterangan Jadwal</label>
            <textarea name="keterangan" id="keterangan" cols="30" rows="4" class="form-control"><?php echo "$keterangan"; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="pengisi_acara">Pengisi Acara</label>
            <input type="text" name="pengisi_acara" id="pengisi_acara" class="form-control" value="<?php echo "$pengisi_acara"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditJadwal">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>