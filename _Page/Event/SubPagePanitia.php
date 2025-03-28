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
    $JumlahPanitia = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_panitia WHERE id_event_setting='$id_event_setting'"));
?>
<div class="row mb-4 mt-4">
    <div class="col-md-12 text-center">
        <code class="text-primary">
            <b>Keterangan:</b><br>
            Fitur ini digunakan untuk mengelola validitas data panitia.
        </code>
    </div>
</div>
<div class="row mb-4 mt-4">
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-md btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahPanitia" data-id="<?php echo $id_event_setting; ?>">
            <i class="bi bi-plus"></i> Tambah Panitia
        </button>
    </div>
</div>
<div class="row mb-4">
    <?php
        if(empty($JumlahPanitia)){
            echo '<span class="text-danger text-center">';
            echo '  Belum Ada Data Panitia';
            echo '</span>';
        }else{
            $no = 1;
            //KONDISI PENGATURAN MASING FILTER
            $query = mysqli_query($Conn, "SELECT DISTINCT kategori FROM event_panitia WHERE id_event_setting='$id_event_setting' ORDER BY kategori ASC");
            while ($data = mysqli_fetch_array($query)) {
                $kategori= $data['kategori'];
                //Jumlah Panitia
                $JumlahPanitia = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_panitia WHERE id_event_setting='$id_event_setting' AND kategori='$kategori'"));
                echo '<div class="col-md-12 mb-4">';
                echo '  <b>'.$kategori.'</b>';
                echo '  <ol class="list-group list-group-numbered">';
                $no2=1;
                $query2 = mysqli_query($Conn, "SELECT * FROM event_panitia WHERE id_event_setting='$id_event_setting' AND kategori='$kategori' ORDER BY nama_panitia ASC");
                while ($data2 = mysqli_fetch_array($query2)) {
                    $id_event_panitia= $data2['id_event_panitia'];
                    $nama_panitia= $data2['nama_panitia'];
                    $email= $data2['email'];
                    echo '<li class="list-group-item d-flex justify-content-between align-items-start">';
                    echo '  <div class="ms-2 me-auto">';
                    echo '      <a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#ModalDetailPanitia" data-id="'.$id_event_panitia.'">';
                    echo '          '.$nama_panitia.'<br>';
                    echo '      </a>';
                    echo '          Email : <i>'.$email.'</i>';
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