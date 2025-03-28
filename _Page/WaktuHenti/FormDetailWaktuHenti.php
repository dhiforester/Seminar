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
        //Menghitung Durasi
        $datetime1 = new DateTime($tanggal_mulai);//start time
        $datetime2 = new DateTime($tanggal_selesai);//end time
        $durasi = $datetime1->diff($datetime2);
        $durasi=$durasi->format('%H Jam');
?>
<div class="modal-body">
    <div class="row mt-2"> 
        <div class="col-md-12">
            <table class="">
                <tbody>
                    <tr>
                        <td>
                            <small><dt>Nama User</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $nama_user; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Waktu Mulai</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $tanggal_mulai; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Waktu Selesai</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $tanggal_selesai; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Durasi</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $durasi; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Waktu Pencatatan</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $tanggal_catat; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Kategori</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $kategori; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Keterangan</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $keterangan; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Status</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $status; ?></small>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer bg-info">
    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
        <i class="bi bi-x-circle"></i> Tutup
    </button>
</div>
<?php } ?>