<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_peserta
    if(empty($_POST['id_peserta'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3">';
        echo '          ID Akses Tidak Ditemukan.';
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
        $id_peserta=$_POST['id_peserta'];
        //Buka data Peserta
        $QryDetailPeserta = mysqli_query($Conn,"SELECT * FROM event_peserta WHERE id_peserta='$id_peserta'")or die(mysqli_error($Conn));
        $DataDetailPeserta = mysqli_fetch_array($QryDetailPeserta);
        $id_event_setting= $DataDetailPeserta['id_event_setting'];
        $id_event_kategori= $DataDetailPeserta['id_event_kategori'];
        $tanggal_daftar= $DataDetailPeserta['tanggal_daftar'];
        $nama= $DataDetailPeserta['nama'];
        $kontak= $DataDetailPeserta['kontak'];
        $email= $DataDetailPeserta['email'];
        $organization= $DataDetailPeserta['organization'];
        $status_validasi= $DataDetailPeserta['status_validasi'];
        $status_pembayaran= $DataDetailPeserta['status_pembayaran'];
        $strtotime=strtotime($tanggal_daftar);
        $TanggalDaftar=date('d/m/Y H:i T', $strtotime);
?>
    <input type="hidden" id="id_peserta" name="id_peserta" value="<?php echo "$id_peserta" ?>">
    <input type="hidden" id="id_event_setting" name="id_event_setting" value="<?php echo "$id_event_setting" ?>">
    <input type="hidden" id="id_event_kategori" name="id_event_kategori" value="<?php echo "$id_event_kategori" ?>">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="id_event_sesi_absen">Sesi Kehadiran</label>
        </div>
        <div class="col-md-8">
            <select name="id_event_sesi_absen" id="id_event_sesi_absen" class="form-control">
                <option value="">Pilih</option>
                <?php
                    //Buka Data Sesi
                    $QrySesi = mysqli_query($Conn, "SELECT*FROM event_sesi_absen WHERE id_event_setting='$id_event_setting'");
                    while ($DataSesi = mysqli_fetch_array($QrySesi)) {
                        $id_event_sesi_absen= $DataSesi['id_event_sesi_absen'];
                        $label_sesi= $DataSesi['label_sesi'];
                        echo '<option value="'.$id_event_sesi_absen.'">'.$label_sesi.'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="tanggal">Tanggal</label>
        </div>
        <div class="col-md-8">
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="jam">Jam</label>
        </div>
        <div class="col-md-8">
            <input type="time" name="jam" id="jam" class="form-control" value="<?php echo date('H:i'); ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="metode">Metode</label>
        </div>
        <div class="col-md-8">
            <select name="metode" id="metode" class="form-control">
                <option value="">Pilih</option>
                <option value="On-site">On-site</option>
                <option value="Online">Online</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiTambahKehadiran">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>