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
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_panitia WHERE id_event='$id_event'"));
?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <b class="card-title">Panitia Kegiatan</b>
                </div>
                <div class="col-md-2">
                    <div class="btn-group w-100">
                        <?php if($id_akses==$SessionIdAkses){ ?>
                            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahPanitia" data-id="<?php echo "$id_event"; ?>">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </button>
                        <?php } ?>
                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#ModalCetakPanitia" data-id="<?php echo "$id_event"; ?>">
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
                                <th class="text-center"><b>Nama Panitia</b></th>
                                <th class="text-center"><b>Jabatan/Posisi</b></th>
                                <th class="text-center"><b>Internal/Eksternal</b></th>
                                <th class="text-center">Opt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(empty($jml_data)){
                                    echo '<tr>';
                                    echo '  <td class="text-center" colspan="4"><small class="text-danger">Belum Ada Data Panitia Kegiatan</small></td>';
                                    echo '</tr>';
                                }else{
                                    $no2=1;
                                    $QryPanitia = mysqli_query($Conn, "SELECT*FROM event_panitia WHERE id_event='$id_event' ORDER BY nama_panitia ASC");
                                    while ($DataPanitia = mysqli_fetch_array($QryPanitia)) {
                                        $id_event_panitia= $DataPanitia['id_event_panitia'];
                                        $id_akses= $DataPanitia['id_akses'];
                                        $in_ex= $DataPanitia['in_ex'];
                                        $nama_panitia= $DataPanitia['nama_panitia'];
                                        $jabatan= $DataPanitia['jabatan'];
                                        if(!empty($DataPanitia['id_akses'])){
                                            //Buka detail akses
                                            $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                            $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                            $nama_akses= $DataDetailAkses['nama_akses'];
                                        }else{
                                            $nama_akses=$nama_panitia;
                                        }
                                        if($in_ex=="Internal"){
                                            $LabelExin='<span class="badge badge-success">Internal</span>';
                                        }else{
                                            $LabelExin='<span class="badge badge-warning">Eksternal</span>';
                                        }
                            ?>
                                <tr>
                                    <td align="center"><?php echo "$no2"; ?></td>
                                    <td class="text-left"><?php echo "$nama_akses"; ?></td>
                                    <td class="text-left"><?php echo "$jabatan"; ?></td>
                                    <td class="text-center"><?php echo "$LabelExin"; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <?php if($id_akses==$SessionIdAkses){ ?>
                                                <button type="button" class="btn btn-sm btn-success" title="Edit Panitia Kegiatan" data-bs-toggle="modal" data-bs-target="#ModalEditPanitia" data-id="<?php echo "$id_event_panitia"; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" title="Hapus Panitia Kegiatan" data-bs-toggle="modal" data-bs-target="#ModalHapusPanitia" data-id="<?php echo "$id_event_panitia"; ?>">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php $no2++;}} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>