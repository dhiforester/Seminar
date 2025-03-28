<?php 
    date_default_timezone_set('Asia/Jakarta');
    if(empty($_POST['id_event'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-canger">';
        echo '      ID Event Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_event=$_POST['id_event'];
        $tanggal=date('Y-m-d');
        $waktu=date('H:i');
?>
    <script>
        var GetIdEvent=$('#GetIdEvent').html();
        //Proses Tambah Absen
        $('#ProsesTambahAbsen').submit(function(){
            $('#NotifikasiTambahAbsen').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
            var form = $('#ProsesTambahAbsen')[0];
            var data = new FormData(form);
            $.ajax({
                type 	    : 'POST',
                url 	    : '_Page/Event/ProsesTambahAbsen.php',
                data 	    :  data,
                cache       : false,
                processData : false,
                contentType : false,
                enctype     : 'multipart/form-data',
                success     : function(data){
                    $('#NotifikasiTambahAbsen').html(data);
                    var NotifikasiTambahAbsenBerhasil=$('#NotifikasiTambahAbsenBerhasil').html();
                    if(NotifikasiTambahAbsenBerhasil=="Success"){
                        $('#GetViewContent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                        $.ajax({
                            type 	    : 'POST',
                            url 	    : '_Page/Event/EventAbsensi.php',
                            data 	    :  {GetIdEvent: GetIdEvent},
                            success     : function(data){
                                $('#GetViewContent').html(data);
                                $('#FormTambahAbsen').html("");
                                $('#ModalTambahAbsen').modal('hide');
                                swal("Good Job!", "Tambah Absen Event Berhasil", "success");
                            }
                        });
                    }
                }
            });
        });
    </script>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="id_event_undangan">ID Undangan</label>
            <input type="text" name="id_event_undangan" id="id_event_undangan" class="form-control">
            <small>Masukan ID undangan peserta disini <a href="javascript:void(0);" id="CekIdUndangan">Cek Undangan</a></small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3" id="HasilCekUndangan">
        
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo "$tanggal"; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="waktu">Waktu</label>
            <input type="time" name="waktu" id="waktu" class="form-control" value="<?php echo "$waktu"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="foto">File Foto</label>
            <input type="file" name="foto" id="foto" class="form-control">
            <small>File max 2 mb</small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="status">Status Absensi</label>
            <select name="status" id="status" class="form-control">
                <option value="">Pilih</option>
                <option value="Checkin">Checkin</option>
                <option value="Hadir">Hadir</option>
                <option value="Invalid">Invalid</option>
            </select>
        </div>
    </div>
<?php } ?>