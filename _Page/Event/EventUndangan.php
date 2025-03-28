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
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_undangan WHERE id_event='$id_event'"));
        //Cek ada tamplate undangan tidak
        //Buka data undangan
        $QryTamplate= mysqli_query($Conn,"SELECT * FROM event_tamplate WHERE id_event='$id_event'")or die(mysqli_error($Conn));
        $DataTamplate= mysqli_fetch_array($QryTamplate);
        if(!empty($DataTamplate['id_event_tamplate'])){
            $id_event_tamplate= $DataTamplate['id_event_tamplate'];
            $id_tamplate_event= $DataTamplate['id_tamplate'];
            $undangan= $DataTamplate['undangan'];
        }else{
            $id_event_tamplate="";
            $id_tamplate_event="";
            $undangan="";
        }
?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <b class="card-title">Undangan Kegiatan</b>
                </div>
                <div class="col-md-4">
                    <div class="btn-group w-100">
                        <?php if($id_akses==$SessionIdAkses||$SessionAkses=="Admin"){ ?>
                            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUndangan" data-id="<?php echo "$id_event"; ?>">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </button>
                            <button type="button" class="btn btn-md btn-secondary" data-bs-toggle="modal" data-bs-target="#ModalPilihTamplate" data-id="<?php echo "$id_event"; ?>">
                                <i class="bi bi-clipboard-check"></i> Tamplate
                            </button>
                        <?php } ?>
                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#ModalCetakUndangan" data-id="<?php echo "$id_event"; ?>">
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
                                <th class="text-center"><b>Email</b></th>
                                <th class="text-center"><b>Kontak</b></th>
                                <th class="text-center"><b>In/Eks</b></th>
                                <?php if($id_akses==$SessionIdAkses||$SessionAkses=="Admin"){ ?>
                                    <th class="text-center">Opt</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(empty($jml_data)){
                                    echo '<tr>';
                                    echo '  <td class="text-center" colspan="7"><small class="text-danger">Belum Ada Data Undangan</small></td>';
                                    echo '</tr>';
                                }else{
                                    $no=1;
                                    $QryUndangan = mysqli_query($Conn, "SELECT*FROM event_undangan WHERE id_event='$id_event' ORDER BY nama ASC");
                                    while ($DataUndangan = mysqli_fetch_array($QryUndangan)) {
                                        $id_event_undangan= $DataUndangan['id_event_undangan'];
                                        $id_akses= $DataUndangan['id_akses'];
                                        $id_unit_kerja= $DataUndangan['id_unit_kerja'];
                                        $in_ex= $DataUndangan['in_ex'];
                                        $nama= $DataUndangan['nama'];
                                        $unit_instansi= $DataUndangan['unit_instansi'];
                                        $kontak= $DataUndangan['kontak'];
                                        $email= $DataUndangan['email'];
                                        $status= $DataUndangan['status'];
                                        if(!empty($DataUndangan['id_akses'])){
                                            //Buka detail akses
                                            $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                            $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                            $nama_akses= $DataDetailAkses['nama_akses'];
                                        }else{
                                            $nama_akses=$nama;
                                        }
                                        if($in_ex=="Internal"){
                                            $LabelExin='<span class="badge badge-success">Internal</span>';
                                        }else{
                                            $LabelExin='<span class="badge badge-warning">Eksternal</span>';
                                        }
                            ?>
                                <tr>
                                    <td align="center"><?php echo "$no"; ?></td>
                                    <td class="text-left"><?php echo "$nama_akses<br><small class='text-warning'>ID Undangan: $id_event_undangan</small>"; ?></td>
                                    <td class="text-left"><?php echo "$unit_instansi"; ?></td>
                                    <td class="text-left"><?php echo "$email"; ?></td>
                                    <td class="text-left"><?php echo "$kontak"; ?></td>
                                    <td class="text-center"><?php echo "$LabelExin"; ?></td>
                                    <?php if($id_akses==$SessionIdAkses||$SessionAkses=="Admin"){ ?>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <?php  if(!empty($DataTamplate['id_event_tamplate'])){ ?>
                                                    <button type="button" class="btn btn-sm btn-info" title="Lampiran Undangan Kegiatan" data-bs-toggle="modal" data-bs-target="#ModalDetailUndangan" data-id="<?php echo "$id_event_undangan"; ?>">
                                                        <i class="bi bi-info-circle"></i>
                                                    </button>
                                                <?php } ?>
                                                <button type="button" class="btn btn-sm btn-success" title="Edit Undangan Kegiatan" data-bs-toggle="modal" data-bs-target="#ModalEditUndangan" data-id="<?php echo "$id_event_undangan"; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" title="Hapus Undangan Kegiatan" data-bs-toggle="modal" data-bs-target="#ModalHapusUndangan" data-id="<?php echo "$id_event_undangan"; ?>">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </div>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php $no++;}} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <b>Jumlah Undangan :</b><?php echo "$jml_data"; ?>
        </div>
    </div>
<?php } ?>