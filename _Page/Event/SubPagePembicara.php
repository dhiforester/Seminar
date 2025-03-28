<?php
    //koneksi dan session
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    $TanggalSekarang=date('Y-m-d H:i');
    //batas
    if(empty($_POST['id_event_setting'])){
        $id_event_setting="";
    }else{
        $id_event_setting=$_POST['id_event_setting'];
    }
    $JumlahPengisiAcara = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_pengisi_acara WHERE id_event_setting='$id_event_setting'"));
?>
<div class="row mb-4 mt-4">
    <div class="col-md-12 text-center">
        <code class="text-primary">
            <b>Keterangan:</b><br>
            Fitur ini digunakan untuk mengelola pengisi acara, narasumber, moderator dll.
        </code>
    </div>
</div>
<div class="row mb-4 mt-4">
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-md btn-block btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahPengisiAcara" data-id="<?php echo $id_event_setting; ?>">
            <i class="bi bi-plus"></i> Tambah Pengisi Acara
        </button>
    </div>
</div>
<div class="row mb-4">
    <?php
        if(empty($JumlahPengisiAcara)){
            echo '<span class="text-danger text-center">';
            echo '  Belum Ada Data Pengisi Acara';
            echo '</span>';
        }else{
            echo '<div class="col-md-12 mb-4">';
            echo '  <ol class="list-group list-group-numbered">';
            $no = 1;
            //KONDISI PENGATURAN MASING FILTER
            $query = mysqli_query($Conn, "SELECT * FROM event_pengisi_acara WHERE id_event_setting='$id_event_setting' ORDER BY id_event_pengisi_acara DESC");
            while ($data = mysqli_fetch_array($query)) {
                $id_event_pengisi_acara= $data['id_event_pengisi_acara'];
                $nama= $data['nama'];
                $kontak= $data['kontak'];
                $email= $data['email'];
                $kategori= $data['kategori'];
                echo '<li class="list-group-item d-flex justify-content-between align-items-start">';
                echo '  <div class="ms-2 me-auto">';
                echo '      <a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#ModalDetailPengisiAcara" data-id="'.$id_event_pengisi_acara.'">';
                echo '          '.$nama.'';
                echo '      </a><br>';
                echo '      Kategori : <i>'.$kategori.'</i>';
                echo '  </div>';
                echo '  <div class="btn-group">';
                echo '      <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#ModalEditPengisiAcara" data-id="'.$id_event_pengisi_acara.'" title="Hapus Pengisi Acara">';
                echo '          <i class="bi bi-pencil"></i>';
                echo '      </button>';
                echo '      <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#ModalHapusPengisiAcara" data-id="'.$id_event_pengisi_acara.'" title="Hapus Pengisi Acara">';
                echo '          <i class="bi bi-trash"></i>';
                echo '      </button>';
                echo '  </div>';
                echo '</li>';
                $no++;
            }
            echo '  </ol>';
            echo '</div>';
        } 
    ?>
</div>