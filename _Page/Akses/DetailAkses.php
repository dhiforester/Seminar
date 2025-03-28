<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10 mb-2 mt-2">
                            <b>Detail Akses</b>
                        </div>
                        <div class="col-md-2 mb-2 mt-2">
                            <a href="index.php?Page=Akses" class="btn btn-md btn-dark w-100">
                                <i class="bi bi-arrow-left-circle"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                        if(empty($_GET['id_akses'])){
                            echo '<div class="row">';
                            echo '  <div class="col col-md-12 text-danger">ID Dukungan Tidak Boleh Kosong</div>';
                            echo '</div>';
                        }else{
                            $id_akses=$_GET['id_akses'];
                            //Buka data askes
                            $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                            $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                            $nama_akses= $DataDetailAkses['nama_akses'];
                            $kontak_akses= $DataDetailAkses['kontak_akses'];
                            $email_akses = $DataDetailAkses['email_akses'];
                            $password= $DataDetailAkses['password'];
                            $Akses= $DataDetailAkses['akses'];
                            $gambar= $DataDetailAkses['image_akses'];
                            if(empty($gambar)){
                                $gambar="No-Image.png";
                            }else{
                                $gambar="$gambar";
                            }
                            $akses= $DataDetailAkses['akses'];
                            $status= $DataDetailAkses['status'];
                            $datetime_daftar= $DataDetailAkses['datetime_daftar'];
                            $datetime_update= $DataDetailAkses['datetime_update'];
                            $registration=$datetime_daftar;
                            $updatetime=$datetime_update;
                            //Hitung Jumlah Unit Kerja
                            $JumlahUnit = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah Dukungan
                            $JumlahDukungan = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah Agenda
                            $JumlahAgenda = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah Event
                            $JumlahEvent = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah Log
                            $JumlahLog = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah Riwayat Kerja
                            $JumlahRiwayat = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah undangan event
                            $JumlahUndangan = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_undangan WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah Absen
                            $JumlahAbsen = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_absen WHERE id_akses='$id_akses'"));
                    ?>
                        <div class="row mt-2"> 
                            <div class="col-md-4 text-center">
                                <img src="assets/img/User/<?php echo "$gambar"; ?>" alt="" width="60%" class="rounded-circle">
                            </div>
                            <div class="col-md-8">
                                <table class="">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <small><dt>Nama</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $nama_akses; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Email</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $email_akses; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Kontak</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $kontak_akses; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Daftar</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $registration; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Update</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $updatetime; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Status</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $status; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Akses</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $Akses; ?></small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-6 col-md-3 col-lg-3">
            <div class="card info-card sales-card">
                <div class="filter">
                    <a class="icon text-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUnitKerjaAkses" data-id="<?php echo "$id_akses"; ?>" title="Detail Data Unit Kerja">
                        <i class="bi bi-info-circle"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="ps-3">
                            <b><?php echo $JumlahUnit ;?></b><br>
                            <span class="text-muted small pt-2 ps-1">Unit Kerja</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-6 col-md-3 col-lg-3">
            <div class="card info-card customers-card">
                <div class="filter">
                    <a class="icon text-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDukunganAkses" data-id="<?php echo "$id_akses"; ?>" title="Detail Data Dukungan">
                        <i class="bi bi-info-circle"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-hammer"></i>
                        </div>
                        <div class="ps-3">
                            <b><?php echo $JumlahDukungan ;?></b><br>
                            <span class="text-muted small pt-2 ps-1">Dukungan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-6 col-md-3 col-lg-3">
            <div class="card info-card revenue-card">
                <div class="filter">
                    <a class="icon text-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalAgendaAkses" data-id="<?php echo "$id_akses"; ?>" title="Detail Data Agenda">
                        <i class="bi bi-info-circle"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar"></i>
                        </div>
                        <div class="ps-3">
                            <b><?php echo $JumlahAgenda ;?></b><br>
                            <span class="text-muted small pt-2 ps-1">Agenda</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-6 col-md-3 col-lg-3">
            <div class="card info-card sales-card">
                <div class="filter">
                    <a class="icon text-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEventAkses" data-id="<?php echo "$id_akses"; ?>" title="Detail Data Event">
                        <i class="bi bi-info-circle"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="ps-3">
                            <b><?php echo $JumlahEvent ;?></b><br>
                            <span class="text-muted small pt-2 ps-1">Event</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-6 col-md-3 col-lg-3">
            <div class="card info-card light-card danger-card">
                <div class="filter">
                    <a class="icon text-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUndanganAkses" data-id="<?php echo "$id_akses"; ?>" title="Detail Data Undangan">
                        <i class="bi bi-info-circle"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-airplane"></i>
                        </div>
                        <div class="ps-3">
                            <b><?php echo $JumlahUndangan ;?></b><br>
                            <span class="text-muted small pt-2 ps-1">Undangan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-6 col-md-3 col-lg-3">
            <div class="card info-card blue-card">
                <div class="filter">
                    <a class="icon text-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalAbsensiAkses" data-id="<?php echo "$id_akses"; ?>" title="Detail Data Absensi">
                        <i class="bi bi-info-circle"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-check-fill"></i>
                        </div>
                        <div class="ps-3">
                            <b><?php echo $JumlahAbsen ;?></b><br>
                            <span class="text-muted small pt-2 ps-1">Absensi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-6 col-md-3 col-lg-3">
            <div class="card info-card yellow-card">
                <div class="filter">
                    <a class="icon text-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalRiwayatKerja" data-id="<?php echo "$id_akses"; ?>" title="Detail Data riwayat Kerja">
                        <i class="bi bi-info-circle"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-bar-chart"></i>
                        </div>
                        <div class="ps-3">
                            <b><?php echo $JumlahRiwayat ;?></b><br>
                            <span class="text-muted small pt-2 ps-1">Riwayat Kerja</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-6 col-md-3 col-lg-3">
            <div class="card info-card grey-card">
                <div class="filter">
                    <a class="icon text-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalLogAkses" data-id="<?php echo "$id_akses"; ?>" title="Detail Data Log Akses">
                        <i class="bi bi-info-circle"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-list-check"></i>
                        </div>
                        <div class="ps-3">
                            <b><?php echo $JumlahLog ;?></b><br>
                            <span class="text-muted small pt-2 ps-1">Log</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>