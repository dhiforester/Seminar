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
        $alamat= $DataDetailPeserta['alamat'];
        $kota= $DataDetailPeserta['kota'];
        $kode_pos= $DataDetailPeserta['kode_pos'];
        $link_validasi= $DataDetailPeserta['link_validasi'];
        $link_payment= $DataDetailPeserta['link_payment'];
        $strtotime=strtotime($tanggal_daftar);
        $TanggalDaftar=date('d/m/Y H:i T', $strtotime);
?>
    <input type="hidden" id="id_peserta" name="id_peserta" value="<?php echo "$id_peserta" ?>">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="id_event_setting">Pilih Event</label>
        </div>
        <div class="col-md-8">
            <select name="id_event_setting" id="id_event_setting" class="form-control">
                <option value="">Pilih..</option>
                <?php
                    $QryEventPeserta = mysqli_query($Conn, "SELECT*FROM event_setting ORDER BY nama_event ASC");
                    while ($DataEventPeserta = mysqli_fetch_array($QryEventPeserta)) {
                        $IdEventSettingList= $DataEventPeserta['id_event_setting'];
                        $NamaEvent= $DataEventPeserta['nama_event'];
                        if($IdEventSettingList==$id_event_setting){
                            echo '<option selected value="'.$IdEventSettingList.'">'.$NamaEvent.'</option>';
                        }else{
                            echo '<option value="'.$IdEventSettingList.'">'.$NamaEvent.'</option>';
                        }
                        
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="id_event_kategori">Pilih Kategori Event</label>
        </div>
        <div class="col-md-8">
            <select name="id_event_kategori" id="id_event_kategori" class="form-control">
                <option value="">Pilih..</option>
                <?php
                    $QryKategoriPeserta = mysqli_query($Conn, "SELECT*FROM event_kategori WHERE id_event_setting='$id_event_setting'");
                    while ($DataKategoriPeserta = mysqli_fetch_array($QryKategoriPeserta)) {
                        $IdEventKategoriList= $DataKategoriPeserta['id_event_kategori'];
                        $KategoriList= $DataKategoriPeserta['kategori'];
                        if($IdEventKategoriList==$id_event_kategori){
                            echo '<option selected value="'.$IdEventKategoriList.'">'.$KategoriList.'</option>';
                        }else{
                            echo '<option value="'.$IdEventKategoriList.'">'.$KategoriList.'</option>';
                        }
                        
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="nama">Nama Lengkap</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="nama" id="nama" class="form-control" value="<?php echo "$nama"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="kontak">Kontak HP/WA</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="kontak" id="kontak" class="form-control" placeholder="62" value="<?php echo "$kontak"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="email">Email</label>
        </div>
        <div class="col-md-8">
            <input type="email" name="email" id="email" class="form-control" value="<?php echo "$email"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="alamat">Alamat</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="alamat" id="alamat" class="form-control" value="<?php echo "$alamat"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="kota">Kota</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="kota" id="kota" class="form-control" value="<?php echo "$kota"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="kode_pos">Kode Pos</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="kode_pos" id="kode_pos" class="form-control" value="<?php echo "$kode_pos"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="organization">Organisasi/Instansi</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="organization" id="organization" class="form-control" value="<?php echo "$organization"; ?>">
            <small class="credit">Informasi organisasi/Instansi/Kampus</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="status_validasi">Status Validasi</label>
        </div>
        <div class="col-md-8">
            <select name="status_validasi" id="status_validasi" class="form-control">
                <option <?php if($status_validasi==""){echo "selected";} ?> value="">Pilih..</option>
                <option <?php if($status_validasi=="Pending"){echo "selected";} ?> value="Pending">Pending</option>
                <option <?php if($status_validasi=="Valid"){echo "selected";} ?> value="Valid">Valid</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditPeserta">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>