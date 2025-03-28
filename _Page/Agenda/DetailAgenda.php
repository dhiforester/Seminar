<?php
    if(empty($_GET['id'])){
        $id_agenda="";
    }else{
        $id_agenda=$_GET['id'];
        //Buka data agenda
        $QryAgenda = mysqli_query($Conn,"SELECT * FROM agenda WHERE id_agenda='$id_agenda'")or die(mysqli_error($Conn));
        $DataAgenda = mysqli_fetch_array($QryAgenda);
        $GetTanggal= $DataAgenda['tanggal'];
        $Strtotime=strtotime($GetTanggal);
        $tahun=date('Y',$Strtotime);
        $bulan=date('m',$Strtotime);
        $tanggal=date('Y-m-d',$Strtotime);
        $jam=date('H:i:s',$Strtotime);
    }
?>
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10 mb-2 mt-2">
                            <b>Detail Agenda</b>
                        </div>
                        <div class="col-md-2 mb-2 mt-2">
                            <a href="index.php?Page=Agenda&tahun=<?php echo $tahun;?>&bulan=<?php echo $bulan;?>&id=" class="btn btn-md btn-dark w-100">
                                <i class="bi bi-arrow-left-circle"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                        if(empty($id_agenda)){
                            echo '<div class="row">';
                            echo '  <div class="col col-md-12 text-danger">ID Dukungan Tidak Boleh Kosong</div>';
                            echo '</div>';
                        }else{
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
                        <div class="row mt-2"> 
                            <div class="col-md-8">
                                <table>
                                    <tr>
                                        <td><b>ID Agenda</b></td>
                                        <td><b>:</b></td>
                                        <td id="GetIdAgenda"><?php echo "$id_agenda"; ?></td>
                                    </tr>
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
                    <?php } ?>
                </div>
                <div class="card-footer">
                    <?php if($id_akses==$SessionIdAkses){ ?>
                        <div class="btn-group w-100">
                            <btton class="btn btn-md btn-success" data-bs-toggle="modal" data-bs-target="#ModalEditAgenda" data-id="<?php echo "$id_agenda"; ?>">
                                <i class="bi bi-pencil"></i> Edit
                            </btton>
                            <btton class="btn btn-md btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDeleteAgenda" data-id="<?php echo "$id_agenda"; ?>">
                                <i class="bi bi-x-circle"></i> Hapus
                            </btton>
                        </div>
                    <?php }else{echo "Hanya pemilik data agenda ini yang bisa menghapus dan merubah informasi ini.";} ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10 mb-2 mt-2">
                            <b>Riwayat Kerja</b>
                        </div>
                        <div class="col-md-2 mb-2 mt-2">
                            <?php if($id_akses==$SessionIdAkses){ ?>
                                <btton class="btn btn-md btn-primary w-100" data-bs-toggle="modal" data-bs-target="#ModalTambahRiwayatKerja" data-id="<?php echo "$id_agenda"; ?>">
                                    <i class="bi bi-plus-circle"></i> Tambah
                                </btton>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
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
                                            $JumlahRiwayatKerja = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE id_agenda='$id_agenda'"));
                                            if(empty($JumlahRiwayatKerja)){
                                                echo '<tr>';
                                                echo '  <td colspan="5" class="text-center">';
                                                echo '      <span class="text-danger">Belum Ada Riwayat Pekerjaan</span>';
                                                echo '  </td>';
                                                echo '</tr>';
                                            }else{
                                                $no = 1;
                                                $query = mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE id_agenda='$id_agenda'");
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
                                                        <?php if($id_akses==$SessionIdAkses){ ?>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>