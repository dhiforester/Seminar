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
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE id_event='$id_event'"));
?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <b class="card-title">Riwayat Kegiatan</b>
                </div>
                <div class="col-md-2">
                    <div class="btn-group w-100">
                        <?php if($id_akses==$SessionIdAkses){ ?>
                            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahRiwayat" data-id="<?php echo "$id_event"; ?>">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </button>
                        <?php } ?>
                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#ModalCetakRiwayat" data-id="<?php echo "$id_event"; ?>">
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
                                <th class="text-center"><b>Image</b></th>
                                <th class="text-center"><b>Tanggal/Waktu</b></th>
                                <th class="text-center"><b>Nama User</b></th>
                                <th class="text-center"><b>Keterangan</b></th>
                                <th class="text-center"><b>Opt</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(empty($jml_data)){
                                    echo '<tr>';
                                    echo '  <td class="text-center" colspan="6"><small class="text-danger">Belum Ada Data Riwayat</small></td>';
                                    echo '</tr>';
                                }else{
                                    $no=1;
                                    $QryRiwayat = mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE id_event='$id_event' ORDER BY id_riwayat_kerja ASC");
                                    while ($DataRiwayat = mysqli_fetch_array($QryRiwayat)) {
                                        $id_riwayat_kerja = $DataRiwayat['id_riwayat_kerja'];
                                        $id_akses= $DataRiwayat['id_akses'];
                                        $id_unit_kerja= $DataRiwayat['id_unit_kerja'];
                                        $tanggal= $DataRiwayat['tanggal'];
                                        $kategori_kerja= $DataRiwayat['kategori_kerja'];
                                        $keterangan= $DataRiwayat['keterangan'];
                                        $gambar_kerja= $DataRiwayat['gambar_kerja'];
                                        //Buka data akses
                                        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                        $nama_akses= $DataDetailAkses['nama_akses'];
                                        //Buka unit tujuan
                                        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                                        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                                        if(!empty($DataUnitKerja['nama_unit_kerja'])){
                                            $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                                        }else{
                                            $nama_unit_kerja="";
                                        }
                                        
                                        //Pecah Tanggal
                                        $StrTanggal=strtotime($tanggal);
                                        $Tanggal=date('d/m/Y',$StrTanggal);
                                        $Waktu=date('H:i:s',$StrTanggal);
                            ?>
                                <tr>
                                    <td align="center"><?php echo "$no"; ?></td>
                                    <td class="text-center">
                                        <?php 
                                            if(empty($gambar_kerja)){
                                                echo '<img src="assets/img/Kerja/No-Image" alt="No image" width="100px">';
                                            }else{
                                                echo '<img src="assets/img/Kerja/'.$gambar_kerja.'" alt="No image" width="100px">';
                                            }
                                        ?>
                                    </td>
                                    <td class="text-left"><?php echo "$Tanggal <br> <small>$Waktu</small>"; ?></td>
                                    <td class="text-left"><?php echo "$nama_akses"; ?></td>
                                    <td class="text-left">
                                        <?php 
                                            echo "<b>$kategori_kerja</b><br>"; 
                                            echo "$keterangan"; 
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <?php if($id_akses==$SessionIdAkses){ ?>
                                                <button type="button" class="btn btn-sm btn-danger" title="Hapus Riwayat Kegiatan" data-bs-toggle="modal" data-bs-target="#ModalHapusRiwayat" data-id="<?php echo "$id_riwayat_kerja"; ?>">
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
            <b>Jumlah Riwayatsi :</b><?php echo "$jml_data"; ?>
        </div>
    </div>
<?php } ?>