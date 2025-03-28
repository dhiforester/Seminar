<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_akses
    if(empty($_POST['tanggal'])){
        echo ' <div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          Tanggal Agenda Tidak Boleh Kosong.';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo '<div class="modal-footer bg-primary">';
        echo '  <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">';
        echo '      <i class="bi bi-x-circle"></i> Tutup';
        echo '  </button>';
        echo '</div>';
    }else{
        if(empty($_POST['id_unit_kerja'])){
            $id_unit_kerja="";
        }else{
            $id_unit_kerja=$_POST['id_unit_kerja'];
        }
        $tanggal=$_POST['tanggal'];
?>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 mt-3">
            List agenda kerja akan ditampilkan pada bagian bawah halaman.<br> 
            Silahkan tutup dialog ini.
        </div>
    </div>
</div>
<div class="modal-footer bg-primary">
    <button type="button" class="btn btn-dark btn-rounded w-100" data-bs-dismiss="modal">
        <i class="bi bi-x-circle"></i> Tutup
    </button>
</div>
<?php } ?>