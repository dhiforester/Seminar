<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    //Tangkap id_pasien
    if(empty($_POST['id_pasien'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Akses Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_pasien=$_POST['id_pasien'];
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM pasien_kunjungan WHERE id_pasien='$id_pasien'"));
        if(empty($jml_data)){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      Belum ada data kunjungan!';
            echo '  </div>';
            echo '</div>';
        }else{
?>
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-items-center mb-0">
                    <thead class="">
                        <tr>
                            <th class="text-center">
                                <b>No</b>
                            </th>
                            <th class="text-center">
                                <b>ID REG</b>
                            </th>
                            <th class="text-center">
                                <b>Pasien</b>
                            </th>
                            <th class="text-center">
                                <b>Kategori</b>
                            </th>
                            <th class="text-center">
                                <b>Mitra</b>
                            </th>
                            <th class="text-center">
                                <b>Opsi</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(empty($jml_data)){
                                echo '<tr>';
                                echo '  <td class="text-center text-danger" colspan="7">No Data</td>';
                                echo '</tr>';
                            }else{
                                $no = 1;
                                $query = mysqli_query($Conn, "SELECT*FROM pasien_kunjungan WHERE id_pasien='$id_pasien' ORDER BY id_kunjungan DESC");
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_kunjungan= $data['id_kunjungan'];
                                    $id_pasien= $data['id_pasien'];
                                    $id_mitra= $data['id_mitra'];
                                    $id_dokter= $data['id_dokter'];
                                    $id_jadwal_dokter= $data['id_jadwal_dokter'];
                                    $id_mitra_tindakan= $data['id_mitra_tindakan'];
                                    $antrian= $data['antrian'];
                                    $estimasi_antrian= $data['estimasi_antrian'];
                                    $nama_pasien= $data['nama_pasien'];
                                    $kategori_kunjungan= $data['kategori_kunjungan'];
                                    $metode_pembayaran= $data['metode_pembayaran'];
                                    $datetime_kunjungan= $data['datetime_kunjungan'];
                                    $datetime_daftar= $data['datetime_daftar'];
                                    $status= $data['status'];
                                    //Format estimasi
                                    $estimasi_antrian=date('d/m/y H:i', $estimasi_antrian);
                                    //Format Datetime daftar
                                    $datetime_daftar=strtotime($datetime_daftar);
                                    $datetime_daftar=date('d F Y', $datetime_daftar);
                                    //Buka data mitra_tindakan
                                    $QryTindakan = mysqli_query($Conn,"SELECT * FROM mitra_tindakan WHERE id_mitra_tindakan='$id_mitra_tindakan'")or die(mysqli_error($Conn));
                                    $DataTindakan = mysqli_fetch_array($QryTindakan);
                                    $nama_tindakan= $DataTindakan['nama_tindakan'];
                                    //Buka nama mitra
                                    $QryMitra = mysqli_query($Conn,"SELECT * FROM mitra WHERE id_mitra='$id_mitra'")or die(mysqli_error($Conn));
                                    $DataMitra = mysqli_fetch_array($QryMitra);
                                    $nama_mitra= $DataMitra['nama_mitra'];
                                    //Buka nama dokter
                                    $QryDokter = mysqli_query($Conn,"SELECT * FROM dokter WHERE id_dokter='$id_dokter'")or die(mysqli_error($Conn));
                                    $DataDokter = mysqli_fetch_array($QryDokter);
                                    $nama_dokter= $DataDokter['nama_dokter'];
                        ?>
                            <tr>
                                <td class="text-center text-xs">
                                    <?php echo "<small>$no</small>" ?>
                                </td>
                                <td class="text-left" align="left">
                                    <small>
                                        <?php 
                                            echo "<b>ID REG $id_kunjungan/Q-$antrian </b><br>";
                                            echo "<small>$estimasi_antrian</small>";
                                        ?>
                                    </small>
                                </td>
                                <td class="text-left" align="left">
                                    <small>
                                        <?php 
                                            echo "<b>No.MR $id_pasien</b><br>";
                                            echo "$nama_pasien";
                                        ?>
                                    </small>
                                </td>
                                <td class="text-left" align="left">
                                    <small>
                                        <?php 
                                            echo "<b>$kategori_kunjungan</b><br>";
                                            echo "<small>$nama_tindakan</small>";
                                        ?>
                                    </small>
                                </td>
                                <td class="text-left" align="left">
                                    <small>
                                        <?php 
                                            echo "<b>$nama_mitra</b><br>";
                                            echo "<small>$nama_dokter</small>";
                                        ?>
                                    </small>
                                </td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm btn-floating" data-bs-toggle="modal" data-bs-target="#ModalPilihKunjunganPasien" data-id="<?php echo "$id_kunjungan, $id_pasien"; ?>">
                                        <i class="bi bi-check-circle"></i>
                                    </button>  
                                </td>
                            </tr>
                        <?php
                            $no++; }}
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }} ?>