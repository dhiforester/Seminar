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
        //Buka Nama Event
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $nama_event= $DataEvent['nama_event'];
        //Nama Sub Event
        $QryEventKategori= mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
        $DataEventKategori= mysqli_fetch_array($QryEventKategori);
        $KategoriEvent= $DataEventKategori['kategori'];
        $harga_tiket= $DataEventKategori['harga_tiket'];
        if(empty( $DataEventKategori['biaya_adm'])){
            $biaya_adm=0;
        }else{
            $biaya_adm= $DataEventKategori['biaya_adm'];
        }
        
        //Buka Data Pembayaran
        $QryPembayaran= mysqli_query($Conn,"SELECT * FROM event_pembayaran WHERE id_peserta='$id_peserta'")or die(mysqli_error($Conn));
        $DataPembayaran= mysqli_fetch_array($QryPembayaran);
        if(!empty($DataPembayaran['id_event_pembayaran'])){
            $id_event_pembayaran= $DataPembayaran['id_event_pembayaran'];
            $kode_kupon= $DataPembayaran['kode_kupon'];
            $metode_pembayaran= $DataPembayaran['metode_pembayaran'];
            $HargaPembayaran= $DataPembayaran['harga'];
            $BiayaAdmin= $DataPembayaran['biaya_adm'];
            $diskon= $DataPembayaran['diskon'];
            $tagihan= $DataPembayaran['tagihan'];
            $StatusPembayaran= $DataPembayaran['status'];
        }else{
            $id_event_pembayaran="";
            $kode_kupon="";
            $metode_pembayaran="";
            $diskon="";
            $BiayaAdmin=$biaya_adm;
            $HargaPembayaran="$harga_tiket";
            $tagihan=$harga_tiket+$biaya_adm;
            $StatusPembayaran="$status_pembayaran";
        }
        
?>
    <input type="hidden" id="id_peserta" name="id_peserta" value="<?php echo "$id_peserta" ?>">
    <input type="hidden" id="id_event_setting" name="id_event_setting" value="<?php echo "$id_event_setting" ?>">
    <input type="hidden" id="id_event_kategori" name="id_event_kategori" value="<?php echo "$id_event_kategori" ?>">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="event">Event</label>
        </div>
        <div class="col-md-8">
            <input type="text" readonly name="event" id="event" class="form-control" value="<?php echo "$nama_event"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="kategori">Kategori</label>
        </div>
        <div class="col-md-8">
            <input type="text" readonly name="kategori" id="kategori" class="form-control" value="<?php echo "$KategoriEvent"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="kode_kupon">Kode Promo</label>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <input type="text" name="kode_kupon" id="kode_kupon" class="form-control" value="<?php echo "$kode_kupon"; ?>">
                <button type="button" class="btn btn-sm btn-rounded btn-primary" id="TerapkanKupon">
                    Gunakan
                </button>
            </div>
        </div>
    </div>
    <div id="NotifikasiMenerapkanKodePromo"></div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="metode_pembayaran">Metode Pembayaran</label>
        </div>
        <div class="col-md-8">
            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control">
                <option <?php if($metode_pembayaran==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($metode_pembayaran=="Online"){echo "selected";} ?> value="Online">Online</option>
                <option <?php if($metode_pembayaran=="Ofline"){echo "selected";} ?> value="Ofline">Ofline</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="harga">Harga Tiket</label>
        </div>
        <div class="col-md-8">
            <input type="number" readonly name="harga" id="harga" class="form-control" value="<?php echo "$HargaPembayaran"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="biaya_adm">Biaya Admin</label>
        </div>
        <div class="col-md-8">
            <input type="number" readonly name="biaya_adm" id="biaya_adm" class="form-control" value="<?php echo "$BiayaAdmin"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="diskon">Diskon</label>
        </div>
        <div class="col-md-8">
            <input type="number" readonly name="diskon" id="diskon" class="form-control" value="<?php echo "$diskon"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="tagihan">Tagihan</label>
        </div>
        <div class="col-md-8">
            <input type="number" readonly name="tagihan" id="tagihan" class="form-control" value="<?php echo "$tagihan"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="status_pembayaran">Status Pembayaran</label>
        </div>
        <div class="col-md-8">
            <select name="status_pembayaran" id="status_pembayaran" class="form-control">
                <option <?php if($StatusPembayaran==""){echo "selected";} ?> value="">Pilih..</option>
                <option <?php if($StatusPembayaran=="Pending"){echo "selected";} ?> value="Pending">Pending</option>
                <option <?php if($StatusPembayaran=="Lunas"){echo "selected";} ?> value="Lunas">Lunas</option>
                <option <?php if($StatusPembayaran=="Expired"){echo "selected";} ?> value="Expired">Expired</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiPembayaranPeserta">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>