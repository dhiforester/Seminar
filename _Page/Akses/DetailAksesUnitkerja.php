<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_akses
    if(empty($_POST['id_akses'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3">';
        echo '          ID Akses Tidak Ditemukan.';
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
        $id_akses=$_POST['id_akses'];
?>
<div class="modal-body">
    <div class="row mt-2"> 
        <div class="col-md-12 table table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center"><b>No</b></th>
                        <th class="text-center"><b>Nama Unit</b></th>
                        <th class="text-center"><b>Status</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        //KONDISI PENGATURAN MASING FILTER
                        $query = mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_akses='$id_akses'");
                        while ($data = mysqli_fetch_array($query)) {
                            $id_unit_kerja= $data['id_unit_kerja'];
                            $jabatan= $data['jabatan'];
                            //Buka data askes
                            $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                            $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                            $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                            $status= $DataUnitKerja['status'];
                            echo '<tr>';
                            echo '  <td align="center">'.$no.'</td>';
                            echo '  <td align="left">'.$nama_unit_kerja.'</td>';
                            echo '  <td align="center">'.$status.'</td>';
                            echo '</tr>';
                        }
                    ?>
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