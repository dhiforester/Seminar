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
    $JumlahJadwalAcara = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_jadwal WHERE id_event_setting='$id_event_setting'"));
?>
<div class="row mb-4 mt-4">
    <div class="col-md-12 text-center">
        <code class="text-primary">
            <b>Keterangan:</b><br>
            Jadwal acara digunakan untuk mengelola susunan dan isi acara pada event.
        </code>
    </div>
</div>
<div class="row mb-4 mt-4">
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-md btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahJadwal" data-id="<?php echo $id_event_setting; ?>">
            <i class="bi bi-plus"></i> Tambah Jadwal
        </button>
    </div>
</div>
<div class="row mb-4">
    <?php
        if(empty($JumlahJadwalAcara)){
            echo '<span class="text-danger text-center">';
            echo '  Belum Ada Data Jadwal Acara';
            echo '</span>';
        }else{
            $no = 1;
            //KONDISI PENGATURAN MASING FILTER
            $query = mysqli_query($Conn, "SELECT DISTINCT tanggal FROM event_jadwal WHERE id_event_setting='$id_event_setting' ORDER BY tanggal ASC");
            while ($data = mysqli_fetch_array($query)) {
                $tanggal= $data['tanggal'];
                //Format Tanggal
                $strtotime=strtotime($tanggal);
                $FormatTanggal=date('d/m/Y',$strtotime);
                //Jumlah Sub Jadwal
                $JumlahSubJadwal = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_jadwal WHERE id_event_setting='$id_event_setting' AND tanggal='$tanggal'"));
                echo '<div class="col-md-12 mb-4">';
                echo '  <b>'.$no.'. Tanggal '.$FormatTanggal.'</b>';
                echo '  <ol class="list-group list-group-numbered">';
                $no2=1;
                $query2 = mysqli_query($Conn, "SELECT * FROM event_jadwal WHERE id_event_setting='$id_event_setting' AND tanggal='$tanggal' ORDER BY waktu1 ASC");
                while ($data2 = mysqli_fetch_array($query2)) {
                    $id_event_jadwal= $data2['id_event_jadwal'];
                    $waktu1= $data2['waktu1'];
                    $waktu2= $data2['waktu2'];
                    $keterangan= $data2['keterangan'];
                    $pengisi_acara= $data2['pengisi_acara'];
                    echo '<li class="list-group-item d-flex justify-content-between align-items-start">';
                    echo '  <div class="ms-2 me-auto">';
                    echo '      <a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#ModalDetailJadwal" data-id="'.$id_event_jadwal.'">';
                    echo '          Jam '.$waktu1.'-'.$waktu2.' WIB <br>';
                    echo '      </a>';
                    echo '      <small class="text-muted">'.$keterangan.'</small><br>';
                    echo '  </div>';
                    echo '</li>';
                    $no2++;
                }
                echo '  </ol>';
                echo '</div>';
                $no++;
            }
        } 
    ?>
</div>