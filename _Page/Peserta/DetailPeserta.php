<?php
    date_default_timezone_set('Asia/Jakarta');
    if(!empty($_GET['id_peserta'])){
        $id_peserta=$_GET['id_peserta'];
        //Buka Detail Peserta
        $QryDetailPeserta = mysqli_query($Conn,"SELECT * FROM event_peserta WHERE id_peserta='$id_peserta'")or die(mysqli_error($Conn));
        $DataDetailPeserta = mysqli_fetch_array($QryDetailPeserta);
        $id_event_setting= $DataDetailPeserta['id_event_setting'];
        $id_event_kategori= $DataDetailPeserta['id_event_kategori'];
        $tanggal_daftar= $DataDetailPeserta['tanggal_daftar'];
        $nama= $DataDetailPeserta['nama'];
        $kontak= $DataDetailPeserta['kontak'];
        $email= $DataDetailPeserta['email'];
        $alamat= $DataDetailPeserta['alamat'];
        $kota= $DataDetailPeserta['kota'];
        $kode_pos= $DataDetailPeserta['kode_pos'];
        $link_validasi= $DataDetailPeserta['link_validasi'];
        $link_payment= $DataDetailPeserta['link_payment'];
        $organization= $DataDetailPeserta['organization'];
        $status_validasi= $DataDetailPeserta['status_validasi'];
        $status_pembayaran= $DataDetailPeserta['status_pembayaran'];
        $strtotime=strtotime($tanggal_daftar);
        $TanggalDaftar=date('d/m/Y H:i T', $strtotime);
        //Buka Nama Event
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $nama_event= $DataEvent['nama_event'];
        //Nama Sub Event
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $KategoriEvent= $DataEvent['kategori'];
        // memanggil library php qrcode
        include "vendor/phpqrcode/qrlib.php"; 
        $penyimpanan = "assets/img/qrcode/";
        // isi qrcode yang ingin dibuat. akan muncul saat di scan
        $isi = "$id_peserta-$id_event_kategori-$id_event_setting"; 
        $teks_qrcode="$id_peserta-$id_event_kategori-$id_event_setting";
        $namafile="$id_peserta-$id_event_kategori-$id_event_setting.png";
        $quality="H";
        $ukuran=5;
        $padding=1;
        QRCode::png($teks_qrcode, $penyimpanan.$namafile, $quality, $ukuran, $padding);
        //Url Kembali
        if(empty($_SESSION['UrlKembaliPeserta'])){
            $UrlKembaliPeserta="index.php?Page=Peserta";
        }else{
            $UrlKembaliPeserta=$_SESSION['UrlKembaliPeserta'];
        }
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9">
                                <b class="card-title"><i class="bi bi-info-circle"></i> Detail Peserta</b>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo $UrlKembaliPeserta;?>" class="btn btn-sm btn-block btn-rounded btn-dark">
                                    <i class="bi bi-arrow-left-circle-fill"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4"><b>Nama</b></div>
                            <div class="col-md-8"><code class="text-dark"><?php echo "$nama"; ?></code></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><b>Tanggal Daftar</b></div>
                            <div class="col-md-8"><code class="text-dark"><?php echo "$TanggalDaftar"; ?></code></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><b>Kontak</b></div>
                            <div class="col-md-8"><code class="text-dark"><?php echo "$kontak"; ?></code></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><b>Email</b></div>
                            <div class="col-md-8"><code class="text-dark"><?php echo "$email"; ?></code></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><b>Alamat</b></div>
                            <div class="col-md-8"><code class="text-dark"><?php echo "$alamat"; ?></code></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><b>Kota</b></div>
                            <div class="col-md-8"><code class="text-dark"><?php echo "$kota"; ?></code></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><b>Kode Pos</b></div>
                            <div class="col-md-8"><code class="text-dark"><?php echo "$kode_pos"; ?></code></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><b>Organisasi</b></div>
                            <div class="col-md-8"><code class="text-dark"><?php echo "$organization"; ?></code></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><b>Event</b></div>
                            <div class="col-md-8"><code class="text-dark"><?php echo "$nama_event"; ?></code></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><b>Kategori</b></div>
                            <div class="col-md-8"><code class="text-dark"><?php echo "$KategoriEvent"; ?></code></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><b>Status Validasi</b></div>
                            <div class="col-md-8">
                                <code class="text-dark">
                                    <?php
                                        //Routing status
                                        if($status_validasi=="Valid"){
                                            echo '<span class="badge badge-sm bg-success">Valid</span>';
                                        }else{
                                            if($status_validasi=="Pending"){
                                                echo '<span class="badge badge-sm bg-warning">Pending</span>';
                                            }else{
                                                echo '<small class="badge badge-sm bg-dark">'.$status_validasi.'</small>';
                                            }
                                        }
                                    ?>
                                </code>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><b>Status Pembayaran</b></div>
                            <div class="col-md-8">
                                <code class="text-dark">
                                    <?php 
                                        if($status_pembayaran=="Lunas"){
                                            echo '<span class="badge badge-sm bg-success">Lunas</span>';
                                        }else{
                                            if($status_pembayaran=="Pending"){
                                                echo '<span class="badge badge-sm bg-warning">Pending</span>';
                                            }else{
                                                if($status_pembayaran=="Expired"){
                                                    echo '<span class="badge badge-sm bg-danger">Expired</span>';
                                                }else{
                                                    echo '<small class="badge badge-sm bg-dark">'.$status_pembayaran.'</small>';
                                                }
                                            }
                                        }
                                    ?>
                                </code>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><b>QR Code</b></div>
                            <div class="col-md-8">
                                <?php echo '<img src="assets/img/qrcode/'.$namafile.'">'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="javascript:void(0);" class="btn btn-md btn-rounded btn-outline-success" data-bs-toggle="modal" data-bs-target="#ModalEditPeserta" data-id="<?php echo "$id_peserta"; ?>" title="Ubah Peserta">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <a href="javascript:void(0);" class="btn btn-md btn-rounded btn-outline-success" data-bs-toggle="modal" data-bs-target="#ModalEditPassword" data-id="<?php echo "$id_peserta"; ?>" title="Ubah Password">
                            <i class="bi bi-key"></i> Password
                        </a>
                        <!-- <a href="javascript:void(0);" class="btn btn-md btn-rounded btn-outline-success" data-bs-toggle="modal" data-bs-target="#ModalEditPassword" data-id="<?php echo "$id_peserta"; ?>" title="Ubah Password">
                            <i class="bi bi-key"></i> Sertifikat
                        </a> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <b class="card-title"><i class="bi bi-cash-coin"></i> Informasi Pembayaran</b>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-sm btn-primary btn-block btn-rounded mb-3" data-bs-toggle="modal" data-bs-target="#ModalPembayaranPeserta" data-id="<?php echo "$id_peserta"; ?>">
                                    <i class="bi bi-pencil"></i> Pembayaran
                                </button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <?php
                                    $QryPembayaran = mysqli_query($Conn,"SELECT * FROM event_pembayaran WHERE id_peserta='$id_peserta'")or die(mysqli_error($Conn));
                                    $DataPembayaran = mysqli_fetch_array($QryPembayaran);
                                    if(!empty($DataPembayaran['id_event_pembayaran'])){
                                        $id_event_pembayaran= $DataPembayaran['id_event_pembayaran'];
                                        $kode_kupon= $DataPembayaran['kode_kupon'];
                                        $metode_pembayaran= $DataPembayaran['metode_pembayaran'];
                                        $TanggalPembayaran= $DataPembayaran['tanggal'];
                                        $harga= $DataPembayaran['harga'];
                                        if(empty($DataPembayaran['biaya_adm'])){
                                            $biaya_adm= $DataPembayaran['biaya_adm'];
                                        }else{
                                            $biaya_adm= $DataPembayaran['biaya_adm'];
                                        }
                                        $tagihan= $DataPembayaran['tagihan'];
                                        $diskon= $DataPembayaran['diskon'];
                                        $StatusPembayaran= $DataPembayaran['status'];
                                        $kode_transaksi= $DataPembayaran['kode_transaksi'];
                                        $HargaRupiah = "Rp " . number_format($harga, 0, ',', '.');
                                        $TagihanRupiah = "Rp " . number_format($tagihan, 0, ',', '.');
                                        $BiayaAdmRp = "Rp " . number_format($biaya_adm, 0, ',', '.');
                                        //Format Tanggal
                                        $strtotime2=strtotime($TanggalPembayaran);
                                        $TanggalPembayaran=date('d/m/Y H:i T', $strtotime2);
                                        echo '<ul>';
                                        echo '  <li>ID Pembayaran : <code class="text-dark">'.$id_event_pembayaran.'</code></li>';
                                        echo '  <li>Kode Transaksi : <code class="text-dark">'.$kode_transaksi.'</code></li>';
                                        echo '  <li>Tanggal : <code class="text-dark">'.$TanggalPembayaran.'</code></li>';
                                        echo '  <li>Kode Kupon : <code class="text-info">'.$kode_kupon.'</code></li>';
                                        echo '  <li>Metode : <code class="text-dark">'.$metode_pembayaran.'</code></li>';
                                        echo '  <li>Harga : <code class="text-dark">'.$HargaRupiah.'</code></li>';
                                        echo '  <li>Biaya Admin : <code class="text-dark">'.$BiayaAdmRp.'</code></li>';
                                        echo '  <li>Diskon : <code class="text-dark">'.$diskon.' %</code></li>';
                                        echo '  <li>Tagihan : <code class="text-dark">'.$TagihanRupiah.'</code></li>';
                                        echo '  <li>Status : <code class="text-dark">'.$StatusPembayaran.'</code></li>';
                                        echo '</ul>';
                                        //Cek Settingan Payment Gateway
                                        $QrySettingPayment= mysqli_query($Conn,"SELECT * FROM setting_payment WHERE id_setting_payment='1'")or die(mysqli_error($Conn));
                                        $DataSettingPayment= mysqli_fetch_array($QrySettingPayment);
                                        $AktifkanPaymentGateway= $DataSettingPayment['aktif_payment_gateway'];
                                        if($AktifkanPaymentGateway=="Ya"){
                                            //Apabila Ada Pengaturan dan Status Belum Lunas Maka Tampilkan
                                            if($StatusPembayaran!=="Lunas"){
                                                if($metode_pembayaran=="Online"){
                                                    echo '<code class="text-dark">';
                                                    echo '  Sistem mengaktifkan <i>Payment Gateway</i>, peserta bisa melakukan pembayaran online melalui';
                                                    echo '  <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalPaymentGateway" data-id="'.$id_event_pembayaran.'">';
                                                    echo '      link berikut ini.';
                                                    echo '  </a>';
                                                    echo '</code>';
                                                }else{
                                                    echo '<code class="text-dark">';
                                                    echo '  Karena pembayaran dilakukan secara offline maka sistem tidak dapat memfasilitasi transaksi pembayaran, silahkan lakukan validasi secara manual';
                                                    echo '</code>';
                                                }
                                            }else{
                                                echo '<code class="text-success">';
                                                echo '  Transaksi sudah lunas. Sebaiknya anda tidak melakukan perubahan pada data pembayaran ini.';
                                                echo '</code>';
                                            }
                                        }
                                    }else{
                                        echo '<div class="text-danger">';
                                        echo '  Belum Ada Data Pembayaran!';
                                        echo '</div>';
                                    }
                                    
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php if(!empty($DataPembayaran['id_event_pembayaran'])){ ?>
                            <a href="javascript:void(0);" class="btn btn-sm btn-info btn-block" data-bs-toggle="modal" data-bs-target="#ModalRiwayatPembayaran" data-id="<?php echo $DataPembayaran['id_event_pembayaran']; ?>">
                                <i class="bi bi-clock-history"></i> Riwayat Transaksi
                            </a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-dark btn-block" data-bs-toggle="modal" data-bs-target="#ModalHapusPembayaran" data-id="<?php echo "$id_peserta"; ?>">
                                <i class="bi bi-trash"></i> Hapus & Batalkan
                            </a>
                            <p>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <small>
                                            <a href="Payment.php?kode=<?php echo "$kode_transaksi"; ?>" target="_blank">
                                                <i class="bi bi-window-fullscreen"></i> Ke Pembayaran Mandiri
                                            </a>
                                        </small>
                                    </div>
                                </div>
                            </p>
                        <?php } ?>
                        
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <b class="card-title"><i class="bi bi-qr-code-scan"></i> Informasi Kehadiran</b>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12 text-center text-danger">
                                <button type="button" class="btn btn-sm btn-primary btn-block btn-rounded mb-3" data-bs-toggle="modal" data-bs-target="#ModalTambahKehadiran" data-id="<?php echo "$id_peserta"; ?>">
                                    <i class="bi bi-pencil"></i> Daftar Hadir
                                </button>
                            </div>
                        </div>
                        <?php
                            //Jumlah Data Kehadiran
                            $JumlahDataKehadiran = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_absen WHERE id_peserta='$id_peserta'"));
                            if(empty($JumlahDataKehadiran)){
                                echo '<div class="row">';
                                echo '  <div class="col-md-12 text-center text-danger">';
                                echo '      Peserta Belum Mengisi Daftar Hadir';
                                echo '  </div>';
                                echo '</div>';
                            }else{
                        ?>
                            <ol class="list-group list-group-numbered">
                                <?php
                                    $QryKehadiranPeserta = mysqli_query($Conn, "SELECT*FROM event_absen WHERE id_peserta='$id_peserta'");
                                    while ($DataKehadiranPeserta = mysqli_fetch_array($QryKehadiranPeserta)) {
                                        $id_event_absen= $DataKehadiranPeserta['id_event_absen'];
                                        $id_event_sesi_absen= $DataKehadiranPeserta['id_event_sesi_absen'];
                                        $TanggalAbsen= $DataKehadiranPeserta['tanggal'];
                                        $MetodeAbsensi= $DataKehadiranPeserta['metode'];
                                        //Format Tanggal
                                        $strtotime3=strtotime($TanggalAbsen);
                                        $TanggalAbsen=date('d/m/Y H:i T', $strtotime3);
                                        //Buka Sesi
                                        $QrySesi= mysqli_query($Conn,"SELECT * FROM event_sesi_absen WHERE id_event_sesi_absen='$id_event_sesi_absen'")or die(mysqli_error($Conn));
                                        $DataSesi= mysqli_fetch_array($QrySesi);
                                        $label_sesi= $DataSesi['label_sesi'];
                                ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"><?php echo "$label_sesi"; ?></div>
                                            <small>
                                                <code class="text-info"><?php echo "$TanggalAbsen"; ?></code><br>
                                                <a href="javascript:void(0);" class="text-danger" data-bs-toggle="modal" data-bs-target="#ModalHapusKehadiran" data-id="<?php echo "$id_event_absen"; ?>">
                                                    <i class="bi bi-x-circle"></i> Hapus
                                                </a>
                                            </small>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ol>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>