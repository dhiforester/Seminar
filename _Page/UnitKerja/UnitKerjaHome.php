<section class="section dashboard">
    <?php
        if($SessionAkses=="User"){
            echo '<div class="row">';
            echo '  <div class="col-lg-12">';
            echo '      <div class="alert alert-info alert-dismissible fade show" role="alert"> ';
            echo '          <small>';
            echo '              Berikut ini adalah unit kerja yang anda tempati, alokasi unit kerja tersebut sepenuhnya dikelola oleh admin.';
            echo '              Silahkan hubungi admin apabila ada data yang tidak sesuai.';
            echo '          </small>';
            echo '          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
            if($SessionAkses=="Admin"){
                echo '<div class="row">';
                echo '  <div class="col-lg-12">';
                echo '      <div class="alert alert-info alert-dismissible fade show" role="alert"> ';
                echo '          <small>';
                echo '              Silahkan kelola anggota masing-masing unit kerja pada halaman ini, pilih nama unit kerja kemudian lihat detailnya.';
                echo '              Pengelolaan unit kerja sepenuhnya adalah tugas admin aplikasi.';
                echo '          </small>';
                echo '          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '      </div>';
                echo '  </div>';
                echo '</div>';
            }
        }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <?php
                        if($SessionAkses=="User"){
                            //Hitung jumlah unit kerja yang berhubungan
                            $JumlahUnitKerja = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_akses='$SessionIdAkses'"));
                            echo "Jumlah Unit Kerja $JumlahUnitKerja";
                        }else{
                    ?>
                        <form action="javascript:void(0);" id="ProsesBatas">
                            <div class="row">
                                <div class="col-md-2 mt-3">
                                    <select name="batas" id="batas" class="form-control">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="250">250</option>
                                        <option value="500">500</option>
                                    </select>
                                    <small>Data</small>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <input type="text" name="keyword" id="keyword" class="form-control">
                                    <small>Pencarian</small>
                                </div>
                                <div class="col-md-2 mt-3">
                                    <button type="submit" class="btn btn-md btn-dark btn-block btn-rounded">
                                        <i class="bi bi-search"></i> Cari
                                    </button>
                                </div>
                                <div class="col-md-2 mt-3">
                                    <button type="button" class="btn btn-md btn-info btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalFilterUnitKerja">
                                        <i class="bi bi-funnel"></i> Filter
                                    </button>
                                </div>
                                <div class="col-md-3 text-center mt-3">
                                    <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahUnitKerja">
                                        <i class="bi bi-plus-lg"></i> Tambah Unit
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
                <?php
                    if($SessionAkses=="Admin"){
                        echo '<div id="MenampilkanTabelUnitKerja"></div>';
                    }else{
                ?>
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
                                                <b>Nama Unit</b>
                                            </th>
                                            <th class="text-center">
                                                <b>Anggota</b>
                                            </th>
                                            <th class="text-center">
                                                <b>Status</b>
                                            </th>
                                            <th class="text-center">
                                                <b>Opsi</b>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(empty($JumlahUnitKerja)){
                                                echo '<tr>';
                                                echo '  <td colspan="5" align="center">';
                                                echo '      <span class="text-danger text-center">Anda Belum Dimasukan Kedalam Unit kerja Manapun</span>';
                                                echo '  </td>';
                                                echo '</tr>';
                                            }else{
                                                $no = 1;
                                                //KONDISI PENGATURAN MASING FILTER
                                                $query = mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_akses='$SessionIdAkses'");
                                                while ($data = mysqli_fetch_array($query)) {
                                                    $id_unit_kerja= $data['id_unit_kerja'];
                                                    //Buka data unit kerja
                                                    $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                                                    $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                                                    $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                                                    $keterangan= $DataUnitKerja['keterangan'];
                                                    $status= $DataUnitKerja['status'];
                                                    //Hitung jumlah anggota
                                                    $JumlahAnggota = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_unit_kerja='$id_unit_kerja'"));
                                                ?>
                                            <tr>
                                                <td class="text-center text-xs">
                                                    <?php echo "$no" ?>
                                                </td>
                                                <td class="text-left" align="left">
                                                    <b><?php echo "$nama_unit_kerja";?></b>
                                                </td>
                                                <td class="text-left" align="left">
                                                    <small><?php echo "$JumlahAnggota Orang";?></small>
                                                </td>
                                                <td class="text-center" align="center">
                                                    <small class="credit">
                                                        <?php 
                                                            echo "<b>$status</b><br>";
                                                        ?>
                                                    </small>
                                                    <br>
                                                </td>
                                                <td align="center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDetailUnitKerja" data-id="<?php echo "$id_unit_kerja"; ?>">
                                                            <i class="bi bi-info-circle"></i> Detail
                                                        </button> 
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
                <?php } ?>
            </div>
        </div>
    </div>
</section>