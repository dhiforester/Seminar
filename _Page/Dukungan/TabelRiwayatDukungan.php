<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Keyword_by
    if(empty($_POST['GetIdDukungan'])){
        echo '<small class="text-danger">ID Dukungan Tidak Dapat Ditangkap Oleh Sistem</small>';
    }else{
        $id_dukungan=$_POST['GetIdDukungan'];
        $JumlahRiwayatDukungan = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE id_dukungan='$id_dukungan'"));
?>
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-items-center mb-0">
            <thead class="">
                <tr>
                    <th class="text-center">
                        <b>No</b>
                    </th>
                    <th class="text-center">
                        <b>Tanggal</b>
                    </th>
                    <th class="text-center">
                        <b>Nama Petugas</b>
                    </th>
                    <th class="text-center">
                        <b>Keterangan Kegiatan</b>
                    </th>
                    <th class="text-center">
                        <b>Opsi</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(empty($JumlahRiwayatDukungan)){
                        echo '<tr>';
                        echo '  <td colspan="5" class="text-center">';
                        echo '      <span class="text-danger">Belum Ada Riwayat Pekerjaan</span>';
                        echo '  </td>';
                        echo '</tr>';
                    }else{
                        $no = 1;
                        $query = mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE id_dukungan='$id_dukungan'");
                        while ($data = mysqli_fetch_array($query)) {
                            $id_riwayat_kerja = $data['id_riwayat_kerja'];
                            $id_akses= $data['id_akses'];
                            $id_unit_kerja= $data['id_unit_kerja'];
                            $tanggal= $data['tanggal'];
                            $kategori_kerja= $data['kategori_kerja'];
                            $keterangan= $data['keterangan'];
                            //Buka data akses
                            $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                            $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                            $nama_akses= $DataDetailAkses['nama_akses'];
                            //Buka unit tujuan
                            $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                            $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                            $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                            //Pecah Tanggal
                            $StrTanggal=strtotime($tanggal);
                            $Tanggal=date('d/m/Y',$StrTanggal);
                            $Waktu=date('H:i:s',$StrTanggal);

                        ?>
                    <tr>
                        <td class="text-center text-xs">
                            <?php echo "$no" ?>
                        </td>
                        <td class="text-left" align="left">
                            <?php 
                                echo "<b>$Tanggal</b><br>";
                                echo "<small>$Waktu</small>";
                            ?>
                        </td>
                        <td class="text-left" align="left">
                            <?php 
                                echo "<b>$nama_akses</b><br>";
                                echo "<small>$nama_unit_kerja</small>";
                            ?>
                        </td>
                        <td class="text-left" align="left">
                            <?php 
                                echo "<b>$kategori_kerja</b><br>";
                                echo "<small>$keterangan</small>";
                            ?>
                        </td>
                        <td align="center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDetailRiwayatKerja" data-id="<?php echo "$id_riwayat_kerja"; ?>">
                                    <i class="bi bi-info-circle"></i>
                                </button>  
                                <?php if($SessionAkses=="Admin"){ ?>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDeleteRiwayatKerja" data-id="<?php echo "$id_riwayat_kerja"; ?>">
                                        <i class="bi bi-x"></i>
                                    </button>  
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                        $no++; }}
                    ?>
            </tbody>
        </table>
    </div>
<?php } ?>