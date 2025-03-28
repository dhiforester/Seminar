<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_akses
    if(empty($_POST['id_agenda'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          ID Agenda Tidak Boleh Kosong.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_agenda=$_POST['id_agenda'];
        //Buka data agenda
        $QryAgenda = mysqli_query($Conn,"SELECT * FROM agenda WHERE id_agenda='$id_agenda'")or die(mysqli_error($Conn));
        $DataAgenda = mysqli_fetch_array($QryAgenda);
        $id_akses= $DataAgenda['id_akses'];
        $GetTanggal= $DataAgenda['tanggal'];
        $GetUnitHerja= $DataAgenda['id_unit_kerja'];
        $status= $DataAgenda['status'];
        $GetKategori= $DataAgenda['kategori'];
        $GetAgenda= $DataAgenda['agenda'];
        $Strtotime=strtotime($GetTanggal);
        $tanggal=date('Y-m-d',$Strtotime);
        $jam=date('H:i:s',$Strtotime);

        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
        $nama_akses= $DataDetailAkses['nama_akses'];
        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$GetUnitHerja'")or die(mysqli_error($Conn));
        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
        $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
?>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <table>
                    <tr>
                        <td><b>Tanggal</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$tanggal"; ?></td>
                    </tr>
                    <tr>
                        <td><b>Jam</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$jam"; ?></td>
                    </tr>
                    <tr>
                        <td><b>Staf/Petugas</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$nama_akses"; ?></td>
                    </tr>
                    <tr>
                        <td><b>Unit</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$nama_unit_kerja"; ?></td>
                    </tr>
                    <tr>
                        <td><b>Kategori</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$GetKategori"; ?></td>
                    </tr>
                    <tr>
                        <td><b>Agenda</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$GetAgenda"; ?></td>
                    </tr>
                    <tr>
                        <td><b>Status</b></td>
                        <td><b>:</b></td>
                        <td><?php echo "$status"; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-primary">
        <a href="index.php?Page=Agenda&Sub=DetailAgenda&id=<?php echo "$id_agenda"; ?>" class="btn btn-success btn-rounded">
            <i class="bi bi-three-dots"></i> Selengkapnya
        </a>
        <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Tutup
        </button>
    </div>  
<?php } ?>