<?php
    //menghitung Jumlah akses
    $JumlahAkses = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses"));
    $JumlahAksesActive = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE status='Active'"));
    //Menghitung jumlah Event
    $JumlahEvent = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_setting"));
    //Menghiutng Jumlah log
    $JumlahLog = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log"));
    //Menghiutng Jumlah dukungan
    $JumlahPanitia = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_panitia"));
    //Menghiutng Jumlah Peserta
    $JumlahPeserta = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta"));
    //Menghiutng Jumlah Absensi
    $JumlahAbsensi = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_absen"));
?>
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-key"></i>
                                </div>
                                <div class="ps-3">
                                    <b><?php echo $JumlahAkses ;?></b><br>
                                    <span class="text-muted small pt-2 ps-1">Akses User</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-file-earmark-person"></i>
                                </div>
                                <div class="ps-3">
                                    <b><?php echo $JumlahPanitia ;?></b><br>
                                    <span class="text-muted small pt-2 ps-1">Panitia</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <b><?php echo $JumlahPeserta ;?></b><br>
                                    <span class="text-muted small pt-2 ps-1">Peserta</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-shield-plus"></i>
                                </div>
                                <div class="ps-3">
                                    <b><?php echo $JumlahLog ;?></b><br>
                                    <span class="text-muted small pt-2 ps-1">Aktivitas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Reports -->
                <div class="col-md-8">
                    <div class="card">
                        <!-- <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start"><h6>Filter</h6></li>
                                <li><a class="dropdown-item" href="#">7 Hari Terakhir</a></li>
                                <li><a class="dropdown-item" href="#">1 Bulan Terakhir</a></li>
                                <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                            </ul>
                        </div> -->
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Grafik Pendaftaran Peserta</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="reportsChart">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pendaftar Terbaru</h5>
                            <div class="activity mb-4 mt-4">
                                <?php
                                    if(empty($JumlahAkses)){
                                        echo '<div class="activity-item d-flex">';
                                        echo '  No activity yet';
                                        echo '</div>';
                                    }else{
                                        //Arraykan log
                                        $QryAksesUser= mysqli_query($Conn, "SELECT*FROM event_peserta ORDER BY id_peserta DESC LIMIT 6");
                                        while ($DataAksesUser = mysqli_fetch_array($QryAksesUser)) {
                                            $id_peserta= $DataAksesUser['id_peserta'];
                                            $namaPeserta= $DataAksesUser['nama'];
                                            $tanggal_daftar= $DataAksesUser['tanggal_daftar'];
                                            $status_pembayaran= $DataAksesUser['status_pembayaran'];
                                            $Strtotime=strtotime($tanggal_daftar);
                                            $WaktuDaftar=date('d/m/Y H:i', $Strtotime);
                                            echo '<div class="activity-item d-flex">';
                                            echo '  <div class="activite-label">'.$WaktuDaftar.'</div>';
                                            echo '  <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>';
                                            echo '  <div class="activity-content">';
                                            echo '      <b>'.$namaPeserta.'</b> <br>'.$status_pembayaran.'';
                                            echo '  </div>';
                                            echo '</div>';
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>