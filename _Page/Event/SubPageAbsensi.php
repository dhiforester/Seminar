<?php
    //koneksi dan session
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    $TanggalSekarang=date('Y-m-d H:i');
    //batas
    if(empty($_POST['id_event_setting'])){
        $id_event_setting="";
    }else{
        $id_event_setting=$_POST['id_event_setting'];
    }
    $JumlahSesiAbsen = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_sesi_absen WHERE id_event_setting='$id_event_setting'"));
?>
<div class="row mb-4 mt-4">
    <div class="col-md-12 text-center">
        <code>
            <b>Keterangan:</b><br>
            Sesi absensi/kehadiran digunakan untuk mengatur kapan peserta dapat melakukan absensi.
        </code>
    </div>
</div>
<div class="row mb-4 mt-4">
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-md btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#ModalBuatSesiAbsen" data-id="<?php echo $id_event_setting; ?>">
            <i class="bi bi-plus"></i>Buat Sesi
        </button>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-12">
        <ol class="list-group list-group-numbered">
            <?php
                if(empty($JumlahSesiAbsen)){
                    echo '<span class="text-danger text-center">';
                    echo '  Belum Ada Data Sesi Absensi';
                    echo '</span>';
                }else{
                    $no = 1;
                    //KONDISI PENGATURAN MASING FILTER
                    $query = mysqli_query($Conn, "SELECT*FROM event_sesi_absen WHERE id_event_setting='$id_event_setting' ORDER BY id_event_sesi_absen DESC");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_event_sesi_absen= $data['id_event_sesi_absen'];
                        $label_sesi= $data['label_sesi'];
                        $tanggal_mulai= $data['tanggal_mulai'];
                        $tanggal_selesai= $data['tanggal_selesai'];
                        $tanggal_mulai=strtotime($tanggal_mulai);
                        $tanggal_selesai=strtotime($tanggal_selesai);
                        $TanggalSekarang=strtotime($TanggalSekarang);
                        //Routing Status Sesi
                        if($TanggalSekarang<$tanggal_mulai){
                            $LabelStatusSesi='<span class="text-dark">Belum Dibuka</span>';
                        }else{
                            if($TanggalSekarang>$tanggal_selesai){
                                $LabelStatusSesi='<span class="text-danger">Sudah Ditutup</span>';
                            }else{
                                if($TanggalSekarang<$tanggal_selesai&&$TanggalSekarang>$tanggal_mulai){
                                    $LabelStatusSesi='<span class="text-success">Dibuka</span>';
                                }else{
                                    $LabelStatusSesi='<span class="text-info">None</span>';
                                }
                            }
                        }
                        //Karena memiliki format strtotime tinggal ubah
                        $TanggalMulai=date('d/m/Y H:i T',$tanggal_mulai);
                        $TanggalSelesai=date('d/m/Y H:i T',$tanggal_selesai);
                        //Jumlah Peserta Yang Sudah Absen
                        $JumlAhPesertaAbsen = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_absen WHERE id_event_sesi_absen='$id_event_sesi_absen'"));
                        echo '<li class="list-group-item d-flex justify-content-between align-items-start">';
                        echo '  <div class="ms-2 me-auto">';
                        echo '      <div class="fw-bold">'.$label_sesi.'</div>';
                        echo '      <small>Mulai : '.$TanggalMulai.'</small><br>';
                        echo '      <small>Selesai : '.$TanggalSelesai.'</small><br>';
                        echo '      <small>Absensi : '.$JumlAhPesertaAbsen.' Orang</small><br>';
                        echo '      <small>Status : '.$LabelStatusSesi.'</small><br>';
                        echo '      <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailSesiAbsensi" data-id="'.$id_event_sesi_absen.'">Selengkapnya</a>';
                        echo '  </div>';
                        echo '</li>';
                        $no++;
                        }
                    } 
            ?>
        </ol>
    </div>
</div>