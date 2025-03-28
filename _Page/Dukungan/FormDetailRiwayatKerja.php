<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_riwayat_kerja
    if(empty($_POST['id_riwayat_kerja'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3">';
        echo '          ID Riwayat Kerja Tidak Ditemukan.';
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
        $id_riwayat_kerja=$_POST['id_riwayat_kerja'];
        //Buka data riwayat kerja
        $QryRiwayatKerja= mysqli_query($Conn,"SELECT * FROM riwayat_kerja WHERE id_riwayat_kerja='$id_riwayat_kerja'")or die(mysqli_error($Conn));
        $DataRiwayatKerja= mysqli_fetch_array($QryRiwayatKerja);
        $id_akses= $DataRiwayatKerja['id_akses'];
        $id_unit_kerja= $DataRiwayatKerja['id_unit_kerja'];
        $id_dukungan= $DataRiwayatKerja['id_dukungan'];
        $tanggal= $DataRiwayatKerja['tanggal'];
        $kategori_kerja= $DataRiwayatKerja['kategori_kerja'];
        $keterangan= $DataRiwayatKerja['keterangan'];
        $gambar_kerja= $DataRiwayatKerja['gambar_kerja'];
        //Buka data akses
        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
        $nama_akses= $DataDetailAkses['nama_akses'];
        //Buka unit tujuan
        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
        if(empty($DataUnitKerja['nama_unit_kerja'])){
            $nama_unit_kerja="";
        }else{
            $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
        }
        
?>
<div class="modal-body">
    <div class="row mt-2"> 
        <div class="col-md-8">
            <table class="">
                <tbody>
                    <tr>
                        <td>
                            <small><dt>Tanggal</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $tanggal; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Nama Petugas</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $nama_akses; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Unit/Tujuan</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $nama_unit_kerja; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Kategori</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $kategori_kerja; ?></small>
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
                        <td colspan="3">
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <?php
                if(!empty($gambar_kerja)){
                    echo '<img src="assets/img/Kerja/'.$gambar_kerja.'" alt="'.$gambar_kerja.'" width="80%">';
                }
            ?>
        </div>
    </div>
</div>
<div class="modal-footer bg-info">
    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
        <i class="bi bi-x-circle"></i> Tutup
    </button>
</div>
<?php } ?>