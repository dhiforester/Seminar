<?php
    if(!empty($_POST['id_peserta'])){
        $id_peserta=$_POST['id_peserta'];
?>
    <input type="hidden" id="PutIdPeserta" name="PutIdPeserta" value="<?php echo "$id_peserta" ?>">
    <div class="row">
            <div class="col col-md-12 text-center">
                <span class="modal-icon display-2-lg">
                    <img src="assets/img/question.gif" width="70%">
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-12 text-center mb-3">
                <small class="modal-title my-3" id="NotifikasiHapusPeserta">Apakah anda yakin akan menghapus data ini?</small>
            </div>
        </div>
    </div>
<?php 
    }else{
        $id_peserta="";
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col col-md-12 text-center">';
        echo '          <small class="modal-title my-3">Sorry, No access data selected.</small>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }
?>