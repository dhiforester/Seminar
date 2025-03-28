<?php
    if(!empty($_POST['id_event_absen'])){
        $id_event_absen=$_POST['id_event_absen'];
?>
    <input type="hidden" id="PutIdEventAbsen" name="PutIdEventAbsen" value="<?php echo "$id_event_absen" ?>">
    <div class="row">
            <div class="col col-md-12 text-center">
                <span class="modal-icon display-2-lg">
                    <img src="assets/img/question.gif" width="70%">
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-12 text-center mb-3">
                <small class="modal-title my-3" id="NotifikasiHapusKehadiran">Apakah anda yakin akan menghapus data ini?</small>
            </div>
        </div>
    </div>
<?php 
    }else{
        $id_event_absen="";
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col col-md-12 text-center">';
        echo '          <small class="modal-title my-3">Sorry, No access data selected.</small>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }
?>