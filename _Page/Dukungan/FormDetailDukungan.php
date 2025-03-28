<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_dukungan
    if(empty($_POST['id_dukungan'])){
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
        $id_dukungan=$_POST['id_dukungan'];
        //Buka data askes
        $QryDetailDukungan= mysqli_query($Conn,"SELECT * FROM dukungan WHERE id_dukungan='$id_dukungan'")or die(mysqli_error($Conn));
        $DataDetailDukungan= mysqli_fetch_array($QryDetailDukungan);
        $id_akses= $DataDetailDukungan['id_akses'];
        $id_unit_kerja= $DataDetailDukungan['id_unit_kerja'];
        $tanggal_request= $DataDetailDukungan['tanggal_request'];
        $tanggal_response= $DataDetailDukungan['tanggal_response'];
        $tanggal_selesai= $DataDetailDukungan['tanggal_selesai'];
        $judul_dukungan= $DataDetailDukungan['judul_dukungan'];
        $kategori_dukungan= $DataDetailDukungan['kategori_dukungan'];
        $keterangan_dukungan= $DataDetailDukungan['keterangan_dukungan'];
        $status_dukungan= $DataDetailDukungan['status_dukungan'];
        //Buka data akses
        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
        $nama_akses= $DataDetailAkses['nama_akses'];
        //Buka unit tujuan
        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
        $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
?>
<div class="modal-body">
    <div class="row mt-2"> 
        <div class="col-md-8">
            <table class="">
                <tbody>
                    <tr>
                        <td>
                            <small><dt>Nama Pemohon</dt></small>
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
                            <small><dt>Tanggal Request</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $tanggal_request; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Tanggal Response</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $tanggal_response; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Tanggal Selesai</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $tanggal_selesai; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Nama Dukungan</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $judul_dukungan; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Kategori</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $kategori_dukungan; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Keterangan Dukungan</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $keterangan_dukungan; ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small><dt>Status</dt></small>
                        </td>
                        <td><b>:</b></td>
                        <td>
                            <small><?php echo $status_dukungan; ?></small>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer bg-info">
    <a href="index.php?Page=Dukungan&Sub=DetailDukungan&id_dukungan=<?php echo $id_dukungan;?>" class="btn btn-success btn-rounded">
        <i class="bi bi-three-dots"></i> Selengkapnya
    </a>
    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
        <i class="bi bi-x-circle"></i> Tutup
    </button>
</div>
<?php } ?>