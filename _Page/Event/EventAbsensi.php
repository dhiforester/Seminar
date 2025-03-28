<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['GetIdEvent'])){
        echo '<div class="card">';
        echo '  <div class="card-body">';
        echo '      <div class="row">';
        echo '          <div class="col-md-12">';
        echo '              <span class="text-danger">ID Event Tidak Boleh Kosong!!</span>';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_event=$_POST['GetIdEvent'];
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event WHERE id_event='$id_event'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $id_akses= $DataEvent['id_akses'];
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_absen WHERE id_event='$id_event'"));
?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <b class="card-title">Absensi Kegiatan</b>
                </div>
                <div class="col-md-2">
                    <div class="btn-group w-100">
                        <?php if($id_akses==$SessionIdAkses){ ?>
                            <button type="button" class="btn btn-md btn-primary w-100" data-bs-toggle="modal" data-bs-target="#ModalTambahAbsen" data-id="<?php echo "$id_event"; ?>">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </button>
                        <?php } ?>
                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#ModalCetakAbsensi" data-id="<?php echo "$id_event"; ?>">
                            <i class="bi bi-printer"></i> Cetak
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"><b>No</b></th>
                                <th class="text-center"><b>Nama</b></th>
                                <th class="text-center"><b>Unit/Instansi</b></th>
                                <th class="text-center"><b>Email/Kontak</b></th>
                                <th class="text-center"><b>In/Eks</b></th>
                                <th class="text-center"><b>Status</b></th>
                                <th class="text-center"><b>Opt</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(empty($jml_data)){
                                    echo '<tr>';
                                    echo '  <td class="text-center" colspan="7"><small class="text-danger">Belum Ada Data Absensi</small></td>';
                                    echo '</tr>';
                                }else{
                                    $no=1;
                                    $QryAbsen = mysqli_query($Conn, "SELECT*FROM event_absen WHERE id_event='$id_event' ORDER BY nama ASC");
                                    while ($DataAbsen = mysqli_fetch_array($QryAbsen)) {
                                        $id_event_absen= $DataAbsen['id_event_absen'];
                                        $id_event_undangan= $DataAbsen['id_event_undangan'];
                                        $id_akses= $DataAbsen['id_akses'];
                                        $id_unit_kerja= $DataAbsen['id_unit_kerja'];
                                        $ex_in= $DataAbsen['ex_in'];
                                        $nama= $DataAbsen['nama'];
                                        $unit_instansi= $DataAbsen['unit_instansi'];
                                        $kontak= $DataAbsen['kontak'];
                                        $email= $DataAbsen['email'];
                                        $tanggal_absen= $DataAbsen['tanggal_absen'];
                                        $status= $DataAbsen['status'];
                                        if($ex_in=="Internal"){
                                            $LabelExin='<span class="badge badge-success">Internal</span>';
                                        }else{
                                            if($ex_in=="Undangan"){
                                                $LabelExin='<span class="badge badge-info">Undangan</span>';
                                            }else{
                                                $LabelExin='<span class="badge badge-warning">Eksternal</span>';
                                            }
                                        }
                                        if($status=="Checkin"){
                                            $LabelAbses='<span class="text-warning">Checkin</span>';
                                        }else{
                                            if($status=="Hadir"){
                                                $LabelAbses='<span class="text-success">Hadir</span>';
                                            }else{
                                                $LabelAbses='<span class="text-danger">Invalid</span>';
                                            }
                                        }
                            ?>
                                <tr>
                                    <td align="center"><?php echo "$no"; ?></td>
                                    <td class="text-left">
                                        <a href="javascript:voi(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailAbsen" data-id="<?php echo "$id_event_absen"; ?>">
                                            <b><?php echo "$nama"; ?></b>
                                        </a><br>
                                        <small><?php echo "$tanggal_absen"; ?></small>
                                    </td>
                                    <td class="text-left"><?php echo "$unit_instansi"; ?></td>
                                    <td class="text-left"><?php echo "<b>$email</b><br><small>Kontak:$kontak</small>"; ?></td>
                                    <td class="text-center"><?php echo "$LabelExin"; ?></td>
                                    <td class="text-center"><?php echo "$LabelAbses"; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <?php if($id_akses==$SessionIdAkses){ ?>
                                                <button type="button" class="btn btn-sm btn-success" title="Edit Absensi Kegiatan" data-bs-toggle="modal" data-bs-target="#ModalEditAbsen" data-id="<?php echo "$id_event_absen"; ?>">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                <button type="button" class="btn btn-sm btn-danger" title="Hapus Absensi Kegiatan" data-bs-toggle="modal" data-bs-target="#ModalHapusAbsen" data-id="<?php echo "$id_event_absen"; ?>">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php $no++;}} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <b>Jumlah Absensi :</b><?php echo "$jml_data"; ?>
        </div>
    </div>
<?php } ?>