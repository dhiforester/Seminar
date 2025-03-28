<?php
    if(empty($_POST['my_number'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '    <div class="col-md-12 text-danger text-center">';
        echo '          Maaf Data Nomor Akun WA Tidak Bisa Ditangkap Oleh Sistem';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '  <button type="button" class="btn btn-md btn-danger" data-bs-dismiss="modal">';
        echo '    <i class="bi bi-x-circle"></i> Tutup';
        echo '  </button>';
        echo '</div>';
    }else{
        if(empty($_POST['you_number'])){
            echo '<div class="modal-body">';
            echo '  <div class="row">';
            echo '    <div class="col-md-12 text-danger text-center">';
            echo '          Maaf Data Nomor Tujuan Pesan Tidak Bisa Ditangkap Oleh Sistem';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '  <button type="button" class="btn btn-md btn-danger w-100" data-bs-dismiss="modal">';
            echo '    <i class="bi bi-x-circle"></i> Tutup';
            echo '  </button>';
            echo '</div>';
        }else{
            $my_number=$_POST['my_number'];
            $you_number=$_POST['you_number'];
            echo '<div class="modal-body">';
            echo '  <div class="row">';
            echo '    <div class="col-md-12 text-danger text-center">';
            echo '          <img src="assets/img/question.gif" width="70%">';
            echo '      </div>';
            echo '  </div>';
            echo '  <div class="row">';
            echo '    <div class="col-md-12 text-danger text-center" id="NotifikasiHapusChatBox">';
            echo '          Apakah anda yakin akan menghapus pesan ini?';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
            echo '<div class="modal-footer bg-danger">';
            echo '  <div class="row">';
            echo '      <div class="col col-md-12">';
            echo '          <button type="button" class="btn btn-md btn-info mb-2" id="KonfirmasiHapusChatBox">';
            echo '              <i class="bi bi-check-circle"></i> Ya, Hapus';
            echo '          </button>';
            echo '          <button type="button" class="btn btn-md btn-dark mb-2" data-bs-dismiss="modal">';
            echo '              <i class="bi bi-x-circle"></i> Tidak';
            echo '          </button>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }
    }
?>