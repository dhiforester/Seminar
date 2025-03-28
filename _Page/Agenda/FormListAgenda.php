<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_akses
    if(empty($_POST['tanggal'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3 text-danger">';
        echo '          Tanggal Agenda Tidak Boleh Kosong.';
        echo '      </div>';
        echo '  </div>';
    }else{
        if(empty($_POST['id_unit_kerja'])){
            $id_unit_kerja="";
        }else{
            $id_unit_kerja=$_POST['id_unit_kerja'];
        }
        $GetTanggal=$_POST['tanggal'];
?>
<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <b>Periode :</b> <?php echo "$GetTanggal"; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 table table-responsive">
            <table class="table table-bordered">
                <thead class="bg bg-dark text-light">
                    <tr>
                        <th class="text-center">Waktu</th>
                        <th class="text-center">Staf/Petugas</th>
                        <th class="text-center">Unit</th>
                        <th class="text-center">Kegiatan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Opt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(empty($id_unit_kerja)){
                            $JumlahAgenda=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda WHERE tanggal like '%$GetTanggal%'"));
                        }else{
                            $JumlahAgenda=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda WHERE id_unit_kerja='$id_unit_kerja' AND tanggal like '%$GetTanggal%'"));
                        }
                        if(empty($JumlahAgenda)){
                            echo '<tr>';
                            echo '  <td colspan="6" class="text-center">Belum Ada Agenda Kegaiatan Untuk Periode Ini</td>';
                            echo '</tr>';
                        }else{
                            //Menampilkan data kegiatan
                            $no=1;
                            if(empty($id_unit_kerja)){
                                $QryKegiatan = mysqli_query($Conn, "SELECT*FROM agenda WHERE tanggal like '%$GetTanggal%' ORDER BY id_agenda ASC");
                            }else{
                                $QryKegiatan = mysqli_query($Conn, "SELECT*FROM agenda WHERE id_unit_kerja='$id_unit_kerja' AND tanggal like '%$GetTanggal%' ORDER BY id_agenda ASC");
                            }
                            while ($DataKegiatan = mysqli_fetch_array($QryKegiatan)) {
                                $id_agenda= $DataKegiatan['id_agenda'];
                                $ListIdAkses= $DataKegiatan['id_akses'];
                                $ListIdUnitKerja= $DataKegiatan['id_unit_kerja'];
                                $tanggal= $DataKegiatan['tanggal'];
                                $kategori= $DataKegiatan['kategori'];
                                $agenda= $DataKegiatan['agenda'];
                                $status= $DataKegiatan['status'];
                                $strtotime=strtotime($tanggal);
                                $TanggalKegiatan=date('d/m/Y',$strtotime);
                                $JamKegiatan=date('H:i',$strtotime);
                                 //Buka data askes
                                $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$ListIdAkses'")or die(mysqli_error($Conn));
                                $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                $nama_akses= $DataDetailAkses['nama_akses'];
                                $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$ListIdUnitKerja'")or die(mysqli_error($Conn));
                                $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                                $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                                if($status=="Rencana"){
                                    $LabelStatus='<span class="badge badge-info">Rencana</span>';
                                }else{
                                    if($status=="Ditunda"){
                                        $LabelStatus='<span class="badge badge-warning">Ditunda</span>';
                                    }else{
                                        if($status=="Batal"){
                                            $LabelStatus='<span class="badge badge-danger">Batal</span>';
                                        }else{
                                            if($status=="Selesai"){
                                                $LabelStatus='<span class="badge badge-success">Selesai</span>';
                                            }else{
                                                $LabelStatus='<span class="badge badge-dark">None</span>';
                                            }
                                        }
                                    }
                                }
                                if($ListIdAkses==$SessionIdAkses){
                                    echo '<tr class="bg-warning">';
                                }else{
                                    echo '<tr>';
                                }
                                echo '  <td class="text-left"><small>'.$TanggalKegiatan.'<br> Jam '.$JamKegiatan.'</small></td>';
                                echo '  <td class="text-left"><small>'.$nama_akses.'</small></td>';
                                echo '  <td class="text-left"><small>'.$nama_unit_kerja.'</small></td>';
                                echo '  <td class="text-left"><b>'.$kategori.'</b><br><small>'.$agenda.'</small></td>';
                                echo '  <td class="text-center"><b>'.$LabelStatus.'</b></td>';
                                echo '  <td class="text-center">';
                                echo '      <div class="btn-group">';
                                echo '          <button typ"button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#ModalDetailAgenda" data-id="'.$id_agenda.'"><i class="bi bi-info-circle"></i></button>';
                                if($ListIdAkses==$SessionIdAkses){
                                    echo '          <button typ"button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#ModalEditAgenda" data-id="'.$id_agenda.'"><i class="bi bi-pencil-square"></i></button>';
                                    echo '          <button typ"button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDeleteAgenda" data-id="'.$id_agenda.'"><i class="bi bi-x"></i></button>';
                                }
                                echo '      </div>';
                                echo '  </td>';
                                echo '</tr>';
                                $no++;
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="row">
        <div class="col-md-12">
            <b>Periode :</b> <?php echo "$GetTanggal"; ?>
        </div>
    </div>
</div>
<?php } ?>