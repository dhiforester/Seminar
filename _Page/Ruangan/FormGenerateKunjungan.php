<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/SettingGeneral.php";
    include "../../vendor/phpqrcode/qrlib.php"; 
    //Tangkap id_ruangan
    if(empty($_POST['id_ruangan'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          Access ID Data Undefined.';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo '<div class="modal-footer bg-info">';
        echo '  <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">';
        echo '      <i class="bi bi-x-circle"></i> Tutup';
        echo '  </button>';
        echo '</div>';
    }else{
        $id_ruangan=$_POST['id_ruangan'];
?>
    <input type="hidden" name="id_ruangan" value="<?php echo "$id_ruangan"; ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6 mt-3">
                <label for="tahun">Tahun</label>
                <input type="number" id="tahun" name="tahun" class="form-control">
            </div>
            <div class="col-md-6 mt-3">
                <label for="bulan">Bulan</label>
                <input type="text" id="bulan" name="bulan" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <label for="count1">Count-1</label>
                <input type="number" id="count1" name="count1" class="form-control">
            </div>
            <div class="col-md-6 mt-3">
                <label for="count2">Count-2</label>
                <input type="number" id="count2" name="count2" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <label for="time1">Time-1</label>
                <input type="number" id="time1" name="time1" class="form-control">
            </div>
            <div class="col-md-6 mt-3">
                <label for="time2">Time-2</label>
                <input type="number" id="time2" name="time2" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3" id="HasilGenerate">
            </div>
        </div>
    </div>
    <div class="modal-footer bg-info">
        <button type="submit" class="btn btn-primary btn-rounded">
            <i class="bi bi-list"></i> Generate
        </button>
        <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Tutup
        </button>
    </div>
<?php } ?>