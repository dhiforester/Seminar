<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10 mb-2 mt-2">
                            <b>Detail Unit Kerja</b>
                        </div>
                        <div class="col-md-2 mb-2 mt-2">
                            <a href="index.php?Page=UnitKerja" class="btn btn-md btn-dark w-100">
                                <i class="bi bi-arrow-left-circle"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                        if(empty($_GET['id'])){
                            echo '<div class="row">';
                            echo '  <div class="col col-md-12 text-danger">ID Unit Kerja Tidak Boleh Kosong</div>';
                            echo '</div>';
                        }else{
                            $id_unit_kerja=$_GET['id'];
                            //Buka data unit kerja
                            $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                            $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                            $id_unit_kerja = $DataUnitKerja['id_unit_kerja'];
                            $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                            $keterangan= $DataUnitKerja['keterangan'];
                            $status= $DataUnitKerja['status'];
                            //Siapakah saya di unit kerja ini?
                            $QryUnitKejaSaya = mysqli_query($Conn,"SELECT * FROM unit_kerja_anggota WHERE id_akses='$SessionIdAkses' AND id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                            $DataUnitKerjaSaya = mysqli_fetch_array($QryUnitKejaSaya);
                            if(empty($DataUnitKerjaSaya['level'])){
                                $LevelSaya="";
                            }else{
                                $LevelSaya= $DataUnitKerjaSaya['level'];
                            }                            //Hitung jumlah unit kerja
                            $JumlahAnggota = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_unit_kerja='$id_unit_kerja'"));
                            echo '<div class="row mb-3">';
                            echo '  <div class="col-md-2"><b>ID Unit</b></div>';
                            echo '  <div class="col-md-10" id="GetIdUnitKerja">'.$id_unit_kerja.'</div>';
                            echo '</div>';
                            echo '<div class="row mb-3">';
                            echo '  <div class="col-md-2"><b>Nama Unit</b></div>';
                            echo '  <div class="col-md-10">'.$nama_unit_kerja.'</div>';
                            echo '</div>';
                            echo '<div class="row mb-3">';
                            echo '  <div class="col-md-2"><b>Keterangan</b></div>';
                            echo '  <div class="col-md-10">'.$keterangan.'</div>';
                            echo '</div>';
                            echo '<div class="row mb-3">';
                            echo '  <div class="col-md-2"><b>Status</b></div>';
                            echo '  <div class="col-md-10">'.$status.'</div>';
                            echo '</div>';
                        }
                    ?>
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
                            <b>Anggota Unit Kerja</b>
                        </div>
                        <div class="col-md-2 mb-2 mt-2">
                            <?php if($SessionAkses=="Admin"||$LevelSaya=='Admin'){ ?>
                                <btton class="btn btn-md btn-primary w-100" data-bs-toggle="modal" data-bs-target="#ModalTambahAnggotaUnitKerja">
                                    <i class="bi bi-plus-circle"></i> Tambah
                                </btton>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" id="MenampilkanTabelAnggotaUnitKerja">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>