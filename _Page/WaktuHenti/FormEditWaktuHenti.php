<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_waktu_henti
    if(empty($_POST['id_waktu_henti'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3">';
        echo '          ID Waktu Henti Tidak Ditemukan.';
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
        $id_waktu_henti=$_POST['id_waktu_henti'];
        //Buka data waktu_henti
        $QryWaktuHenti = mysqli_query($Conn,"SELECT * FROM waktu_henti WHERE id_waktu_henti='$id_waktu_henti'")or die(mysqli_error($Conn));
        $DataWaktuHenti = mysqli_fetch_array($QryWaktuHenti);
        $id_akses= $DataWaktuHenti['id_akses'];
        $nama_user= $DataWaktuHenti['nama_user'];
        $tanggal_mulai= $DataWaktuHenti['tanggal_mulai'];
        $tanggal_selesai= $DataWaktuHenti['tanggal_selesai'];
        $tanggal_catat= $DataWaktuHenti['tanggal_catat'];
        $kategori= $DataWaktuHenti['kategori'];
        $keterangan= $DataWaktuHenti['keterangan'];
        $status= $DataWaktuHenti['status'];
        if(!empty($DataWaktuHenti['tanggal_mulai'])){
            $explode1=explode(" " , $tanggal_mulai);
            $tanggal_mulai= $explode1[0];
            $waktu_mulai= $explode1[1];
        }else{
            $tanggal_mulai="";
            $waktu_mulai="";
        }
        if(!empty($DataWaktuHenti['tanggal_selesai'])){
            $explode2=explode(" " , $tanggal_selesai);
            $tanggal_selesai= $explode2[0];
            $waktu_selesai= $explode2[1];
        }else{
            $tanggal_selesai="";
            $waktu_selesai="";
        }
?>
    <input type="hidden" name="id_waktu_henti" id="id_waktu_henti" value="<?php echo "$id_waktu_henti"; ?>">
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="tanggal_mulai">Tanggal Kejadian</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="<?php echo "$tanggal_mulai"; ?>">
        </div>
        <div class="col-md-6 mt-3">
            <label for="waktu_mulai">Waktu Kejadian</label>
            <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" value="<?php echo "$waktu_mulai"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="<?php echo "$tanggal_selesai"; ?>">
        </div>
        <div class="col-md-6 mt-3">
            <label for="waktu_selesai">Waktu Kejadian</label>
            <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" value="<?php echo "$waktu_selesai"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" class="form-control">
                <option <?php if($kategori==""){echo "selected";} ?> value="">Pilih..</option>
                <option <?php if($kategori=="Direncanakan"){echo "selected";} ?> value="Direncanakan">Direncanakan</option>
                <option <?php if($kategori=="Tidak Direncanakan"){echo "selected";} ?> value="Tidak Direncanakan">Tidak Direncanakan</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control"><?php echo "$keterangan"; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option <?php if($status==""){echo "selected";} ?> value="">Pilih..</option>
                <option <?php if($status=="Pending"){echo "selected";} ?> value="Pending">Pending</option>
                <option <?php if($status=="Proses"){echo "selected";} ?> value="Proses">Proses</option>
                <option <?php if($status=="Selesai"){echo "selected";} ?> value="Selesai">Selesai</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditWaktuHenti">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>