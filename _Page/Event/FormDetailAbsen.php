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
?>
<div class="modal-body">
    <div class="row mt-2"> 
        <div class="col-md-4 text-center">
            <?php if(empty($foto)){ ?>
                <img src="assets/img/User/No-Image.png" alt="" width="70%" class="rounded">
            <?php }else{ ?>
                <img src="assets/img/Absen/<?php echo "$foto"; ?>" alt="" width="70%" class="rounded">
            <?php } ?>
        </div>
        <div class="col-md-8">
            <table class="">
                <tbody>
                    <tr>
                        <td>
                            <small><dt>Nama</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $nama; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Email</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $email; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Kontak</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $kontak; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Unit/Instansi</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $unit_instansi; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Tanggal Absen</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $tanggal_absen; ?></small>
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