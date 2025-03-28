<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    //Tangkap id_akses
    if(empty($_POST['id_event_absen'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3">';
        echo '          ID Absen Tidak Ditemukan.';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo ' <div class="modal-footer bg-info">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3">';
        echo '          <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">';
        echo '              <i class="bi bi-x-circle"></i> Tutup';
        echo '          </button>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_event_absen=$_POST['id_event_absen'];
        //Buka data askes
        $QryAbsen = mysqli_query($Conn,"SELECT * FROM event_absen WHERE id_event_absen='$id_event_absen'")or die(mysqli_error($Conn));
        $DataAbsen = mysqli_fetch_array($QryAbsen);
        $id_event= $DataAbsen['id_event'];
        $id_akses= $DataAbsen['id_akses'];
        $id_unit_kerja= $DataAbsen['id_unit_kerja'];
        $id_event_undangan= $DataAbsen['id_event_undangan'];
        $ex_in= $DataAbsen['ex_in'];
        $nama= $DataAbsen['nama'];
        $unit_instansi= $DataAbsen['unit_instansi'];
        $kontak= $DataAbsen['kontak'];
        $email= $DataAbsen['email'];
        $tanggal_absen= $DataAbsen['tanggal_absen'];
        $foto= $DataAbsen['foto'];
        $status= $DataAbsen['status'];
        $strtotime=strtotime($tanggal_absen);
        $tanggal=date('Y-m-d',$strtotime);
        $waktu=date('H:i',$strtotime);
?>
    <input type="hidden" name="id_event_absen" value="<?php echo "$id_event_absen"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?php echo "$nama"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="unit_instansi">Unit/Instansi</label>
            <input type="text" name="unit_instansi" id="unit_instansi" class="form-control" value="<?php echo "$unit_instansi"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="kontak">Kontak</label>
            <input type="text" name="kontak" id="kontak" class="form-control" value="<?php echo "$kontak"; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo "$email"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo "$tanggal"; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="waktu">Waktu</label>
            <input type="time" name="waktu" id="waktu" class="form-control" value="<?php echo "$waktu"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="foto">File Foto</label>
            <input type="file" name="foto" id="foto" class="form-control">
            <small>File max 2 mb</small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="status">Status Absensi</label>
            <select name="status" id="status" class="form-control">
                <option <?php if($status==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($status=="Checkin"){echo "selected";} ?> value="Checkin">Checkin</option>
                <option <?php if($status=="Hadir"){echo "selected";} ?> value="Hadir">Hadir</option>
                <option <?php if($status=="Invalid"){echo "selected";} ?> value="Invalid">Invalid</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditAbsen">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>