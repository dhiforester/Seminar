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
        //Buka Nama Event
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $nama_event= $DataEvent['nama_event'];
        //Nama Sub Event
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $KategoriEvent= $DataEvent['kategori'];
?>
    <div class="row mb-3">
        <div class="col-md-4"><b>Nama</b></div>
        <div class="col-md-8"><code class="text-dark"><?php echo "$nama"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><b>Kontak</b></div>
        <div class="col-md-8"><code class="text-dark"><?php echo "$kontak"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><b>Email</b></div>
        <div class="col-md-8"><code class="text-dark"><?php echo "$email"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><b>Alamat</b></div>
        <div class="col-md-8"><code class="text-dark"><?php echo "$alamat"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><b>Kota</b></div>
        <div class="col-md-8"><code class="text-dark"><?php echo "$kota"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><b>Kode Pos</b></div>
        <div class="col-md-8"><code class="text-dark"><?php echo "$kode_pos"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><b>Organization</b></div>
        <div class="col-md-8"><code class="text-dark"><?php echo "$organization"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><b>Event</b></div>
        <div class="col-md-8"><code class="text-dark"><?php echo "$nama_event"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><b>Kategori</b></div>
        <div class="col-md-8"><code class="text-dark"><?php echo "$KategoriEvent"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><b>Validasi</b></div>
        <div class="col-md-8"><code class="text-dark"><?php echo "$status_validasi"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><b>Pembayaran</b></div>
        <div class="col-md-8"><code class="text-dark"><?php echo "$status_pembayaran"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <a href="index.php?Page=Peserta&Sub=DetailPeserta&id_peserta=<?php echo "$id_peserta"; ?>" class="btn btn-outline-dark btn-rounded btn-block">
                Selengkapnya
            </a>
        </div>
    </div>
<?php } ?>