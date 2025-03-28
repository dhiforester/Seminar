<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_sesi_absen'])){
        echo '<span class="text-danger">ID Event Setting Tidak Boleh Kosong!</span>';
    }else{
        $id_event_sesi_absen=$_POST['id_event_sesi_absen'];
        //Buka data sesi absensi
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_sesi_absen WHERE id_event_sesi_absen='$id_event_sesi_absen'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $id_event_sesi_absen= $DataEvent['id_event_sesi_absen'];
        $label_sesi= $DataEvent['label_sesi'];
        $tanggal_mulai= $DataEvent['tanggal_mulai'];
        $tanggal_selesai= $DataEvent['tanggal_selesai'];
        $tanggal_mulai=strtotime($tanggal_mulai);
        $tanggal_selesai=strtotime($tanggal_selesai);
        //Karena memiliki format strtotime tinggal ubah
        $TanggalMulai=date('Y-m-d',$tanggal_mulai);
        $JamMulai=date('H:i',$tanggal_mulai);
        $TanggalSelesai=date('Y-m-d',$tanggal_selesai);
        $JamSelesai=date('H:i',$tanggal_selesai);
        //Jumlah Peserta Yang Sudah Absen
        $JumlAhPesertaAbsen = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_absen WHERE id_event_sesi_absen='$id_event_sesi_absen'"));
?>
    <input type="hidden" name="id_event_sesi_absen" value="<?php echo "$id_event_sesi_absen"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="label_sesi">Label Sesi</label>
            <input type="text" name="label_sesi" id="label_sesi" class="form-control" value="<?php echo "$label_sesi"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="tanggal_mulai">Tanggal Mulai</label>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="<?php echo "$TanggalMulai"; ?>">
            <small>Tanggal</small>
        </div>
        <div class="col-md-6">
            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="<?php echo "$JamMulai"; ?>">
            <small>Jam</small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="tanggal_selesai">Tanggal Selesai</label>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="<?php echo "$TanggalSelesai"; ?>">
            <small>Tanggal</small>
        </div>
        <div class="col-md-6">
            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="<?php echo "$JamSelesai"; ?>">
            <small>Jam</small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditSesiAbsen">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>