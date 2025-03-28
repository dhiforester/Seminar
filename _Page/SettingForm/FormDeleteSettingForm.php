<?php
    if(!empty($_POST['id_tamplate'])){
        $id_tamplate=$_POST['id_tamplate'];
?>
<div class="row">
        <div class="col col-md-12 text-center">
            <span class="modal-icon display-2-lg">
                <img src="assets/img/question.gif" width="70%">
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-12 text-center mb-3">
            <small class="modal-title my-3" id="NotifikasiHapusSettingForm">Apakah Anda Yakin Akan Menghapus Data Ini?</small>
        </div>
    </div>
</div>
<?php 
    }else{
        $id_tamplate="";
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col col-md-12 text-center">';
        echo '          <small class="modal-title my-3">Maaf, Tidak ada data yang dipilih.</small>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }
?>