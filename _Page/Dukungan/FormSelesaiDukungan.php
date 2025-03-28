<?php
    if(!empty($_POST['GetIdDukungan'])){
        date_default_timezone_set("Asia/Jakarta");
        $GetIdDukungan=$_POST['GetIdDukungan'];
        $tanggal=date('Y-m-d');
        $jam=date('H:i:s');
?>
    <div class="row">
        <div class="col col-md-12 text-center">
            <span class="modal-icon display-2-lg">
                <img src="assets/img/question.gif" width="70%">
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-6 mt-2">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="GetTanggal" class="form-control" value="<?php echo "$tanggal"; ?>">
        </div>
        <div class="col col-md-6 mt-2">
            <label for="jam">Jam</label>
            <input type="time" name="jam" id="GetJam" class="form-control" value="<?php echo "$jam"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col col-md-12 text-center mb-3">
            <small class="modal-title my-3" id="NotifikasiDukunganSelesai">Apakah anda yakin akan menyelesaikan dukungan ini?</small>
        </div>
    </div>
<?php 
    }else{
        $GetIdDukungan="";
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col col-md-12 text-center">';
        echo '          <small class="modal-title my-3">Sorry, No data selected.</small>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }
?>