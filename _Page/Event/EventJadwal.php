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
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_jadwal WHERE id_event='$id_event'"));
?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <b class="card-title">Jadwal Kegiatan</b>
                </div>
                <div class="col-md-2">
                    <div class="btn-group w-100">
                        <?php if($id_akses==$SessionIdAkses){ ?>
                            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahJadwal" data-id="<?php echo "$id_event"; ?>">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </button>
                        <?php } ?>
                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#ModalCetakJadwal" data-id="<?php echo "$id_event"; ?>">
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
                                <th class="text-center">Waktu</th>
                                <th class="text-center">Keterangan Kegiatan</th>
                                <th class="text-center">Opt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(empty($jml_data)){
                                    echo '<tr>';
                                    echo '  <td class="text-center" colspan="4"><small class="text-danger">Belum Ada Data Jadwal Kegiatan</small></td>';
                                    echo '</tr>';
                                }else{
                                    $QryTanggal = mysqli_query($Conn, "SELECT DISTINCT tanggal FROM event_jadwal WHERE id_event='$id_event' ORDER BY tanggal ASC");
                                    while ($DataTanggal = mysqli_fetch_array($QryTanggal)) {
                                        $ListTanggalAwal= $DataTanggal['tanggal'];
                                        $Strtotime= Strtotime($ListTanggalAwal);
                                        $ListTanggal=date('d F Y',$Strtotime);
                                        echo '<tr>';
                                        echo '  <td class="text-left" colspan="4"><b>'.$ListTanggal.'</b></td>';
                                        echo '</tr>';
                                        $no=1;
                                        $QryKegiatan = mysqli_query($Conn, "SELECT*FROM event_jadwal WHERE id_event='$id_event' AND tanggal='$ListTanggalAwal' ORDER BY waktu1 ASC");
                                        while ($DataKegiatan = mysqli_fetch_array($QryKegiatan)) {
                                            $id_event_jadwal= $DataKegiatan['id_event_jadwal'];
                                            $id_akses= $DataKegiatan['id_akses'];
                                            $waktu1= $DataKegiatan['waktu1'];
                                            $waktu2= $DataKegiatan['waktu2'];
                                            $keterangan= $DataKegiatan['keterangan'];
                                            //Buka detail akses
                                            $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                            $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                            $nama_akses= $DataDetailAkses['nama_akses'];
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo "$no"; ?></td>
                                    <td class="text-left"><?php echo "$waktu1 s/d $waktu2"; ?></td>
                                    <td class="text-left"><?php echo "<b>$keterangan</b><br><small class=''text-info>Input Oleh : $nama_akses</small>"; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <?php if($id_akses==$SessionIdAkses){ ?>
                                                <button type="button" class="btn btn-sm btn-success" title="Edit Jadwal Kegiatan" data-bs-toggle="modal" data-bs-target="#ModalEditJadwal" data-id="<?php echo "$id_event_jadwal"; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" title="Hapus Jadwal Kegiatan" data-bs-toggle="modal" data-bs-target="#ModalHapusJadwal" data-id="<?php echo "$id_event_jadwal"; ?>">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php $no++;}}} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <small>
                <b>Jumlah Data :</b> <?php echo "$jml_data"; ?>
            </small>
        </div>
    </div>
<?php } ?>