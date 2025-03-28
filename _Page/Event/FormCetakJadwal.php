<?php
    if(!empty($_POST['id_event'])){
        $id_event=$_POST['id_event'];
?>
    <form action="_Page/Event/ProsesCetakJadwal.php" method="POST" target="_blank">
        <input type="hidden" name="id_event" value="<?php echo "$id_event"; ?>">
        <div class="modal-body">
            <div class="row">
                <div class="col col-md-12 mb-3">
                    <label for="FormatCetak">Format Cetak</label>
                    <select name="FormatCetak" id="FormatCetak" class="form-control">
                        <option value="HTML">HTML</option>
                        <option value="PDF">PDF</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6 mb-3">
                    <label for="rincian_event">Rincian Event</label>
                    <select name="rincian_event" id="rincian_event" class="form-control">
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="col col-md-6 mb-3">
                    <label for="header">Header</label>
                    <select name="header" id="header" class="form-control">
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-info">
            <button type="submit" class="btn btn-primary btn-rounded">
                <i class="bi bi-printer"></i> Cetak
            </button>
            <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                <i class="bi bi-x-circle"></i> Tutup
            </button>
        </div>
    </form>
<?php 
    }else{
        $id_event="";
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col col-md-12 text-center">';
        echo '          <small class="modal-title my-3">Sorry, No data selected.</small>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '  <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">';
        echo '      <i class="bi bi-x-circle"></i> Tutup';
        echo '  </button>';
        echo '</div>';
    }
?>