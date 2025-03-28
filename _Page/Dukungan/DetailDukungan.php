<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10 mb-2 mt-2">
                            <b>Detail Dukungan</b>
                        </div>
                        <div class="col-md-2 mb-2 mt-2">
                            <a href="index.php?Page=Dukungan" class="btn btn-md btn-dark w-100">
                                <i class="bi bi-arrow-left-circle"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                        if(empty($_GET['id_dukungan'])){
                            echo '<div class="row">';
                            echo '  <div class="col col-md-12 text-danger">ID Dukungan Tidak Boleh Kosong</div>';
                            echo '</div>';
                        }else{
                            $id_dukungan=$_GET['id_dukungan'];
                            //Buka data Dukungan
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
                        <div class="row mt-2"> 
                            <div class="col-md-8">
                                <table class="">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <small><dt>ID Dukungan</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small id="GetIdDukungan"><?php echo $id_dukungan; ?></small>
                                            </td>
                                        </tr>
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
                    <?php } ?>
                </div>
                <div class="card-footer">
                    <?php 
                        if($id_akses==$SessionIdAkses){ 
                            if($status_dukungan!=="Done"){
                    ?>
                        <div class="btn-group w-100">
                            <btton class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#ModalDukunganSelesai">
                                <i class="bi bi-check-circle-fill"></i> Selesai
                            </btton>
                            <btton class="btn btn-md btn-success" data-bs-toggle="modal" data-bs-target="#ModalEditDukungan">
                                <i class="bi bi-pencil"></i> Edit
                            </btton>
                            <btton class="btn btn-md btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDeleteDukungan">
                                <i class="bi bi-x-circle"></i> Hapus
                            </btton>
                        </div>
                    <?php 
                            }else{
                                echo "Dukungan Ini Sudah Selesai";
                            } 
                        }else{
                            echo "Hanyak Pemohon Yang Dapat Menyelesaikan Dukungan Ini";
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
                            <b>Riwayat Dukungan</b>
                        </div>
                        <div class="col-md-2 mb-2 mt-2">
                            <?php if($SessionAkses=="Admin"){ ?>
                                <btton class="btn btn-md btn-primary w-100" data-bs-toggle="modal" data-bs-target="#ModalTambahRiwayatDukungan" data-id="<?php echo "$id_dukungan"; ?>">
                                    <i class="bi bi-plus-circle"></i> Tambah
                                </btton>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" id="MenampilkanTabelRiwayatDukungan">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>