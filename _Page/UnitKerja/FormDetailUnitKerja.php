<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_unit_kerja
    if(empty($_POST['id_unit_kerja'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          ID Unit Kerja Tidak Dapat Ditangkap Oleh Sistem.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_unit_kerja=$_POST['id_unit_kerja'];
        //Buka data unit kerja
        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
        $id_unit_kerja = $DataUnitKerja['id_unit_kerja'];
        $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
        $keterangan= $DataUnitKerja['keterangan'];
        $status= $DataUnitKerja['status'];
        //Hitung jumlah unit kerja
        $JumlahAnggota = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_unit_kerja='$id_unit_kerja'"));
?>
<div class="modal-body">
    <div class="row">
        <div class="col-md-4 mt-3">
            <b>Nama Unit Kerja</b><br>
        </div>
        <div class="col-md-8 mt-3">
            <?php echo "<b>:</b> $nama_unit_kerja"; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mt-3">
            <b>Keterangan</b><br>
        </div>
        <div class="col-md-8 mt-3">
            <?php echo "<b>:</b> $keterangan"; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mt-3">
            <b>Anggota</b><br>
        </div>
        <div class="col-md-8 mt-3">
            <?php echo "<b>:</b> $JumlahAnggota Orang"; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mt-3">
            <b>Status</b><br>
        </div>
        <div class="col-md-8 mt-3">
            <?php echo "<b>:</b> $status"; ?>
        </div>
    </div>
</div>
<div class="modal-footer bg-info">
    <a href="index.php?Page=UnitKerja&Sub=DetailUnitKerja&id=<?php echo "$id_unit_kerja"; ?>" class="btn btn-success btn-rounded">
        <i class="bi bi-three-dots"></i> Selengkapnya
    </a>
    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
        <i class="bi bi-x-circle"></i> Tutup
    </button>
</div>
<?php } ?>