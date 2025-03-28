<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event'])){
        echo '<span class="text-danger">ID Event Tidak Boleh Kosong!</span>';
    }else{
        $id_event=$_POST['id_event'];
?>  
    <script>
        //Ketia kategori di ubah
        $('#kategori').change(function(){
            $('#FormFileName').html("Loading...");
            var kategori=$('#kategori').val();
            if(kategori=="Dokumen"){
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/FormFileDokumen.php',
                    success     : function(data){
                        $('#FormFileName').html(data);
                    }
                });
            }
            if(kategori=="Gambar/Foto"){
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/FormFileImage.php',
                    success     : function(data){
                        $('#FormFileName').html(data);
                    }
                });
            }
            if(kategori=="URL/Link"){
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/FormFileUrl.php',
                    success     : function(data){
                        $('#FormFileName').html(data);
                    }
                });
            }
            if(kategori==""){
                $('#FormFileName').html('Pilih Kategori Terlebih Dulu');
            }
        });
        //Proses Tambah File
        $('#ProsesTambahFile').submit(function(){
            $('#NotifikasiTambahFile').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
            var form = $('#ProsesTambahFile')[0];
            var data = new FormData(form);
            $.ajax({
                type 	    : 'POST',
                url 	    : '_Page/Event/ProsesTambahFile.php',
                data 	    :  data,
                cache       : false,
                processData : false,
                contentType : false,
                enctype     : 'multipart/form-data',
                success     : function(data){
                    $('#NotifikasiTambahFile').html(data);
                    var NotifikasiTambahFileBerhasil=$('#NotifikasiTambahFileBerhasil').html();
                    if(NotifikasiTambahFileBerhasil=="Success"){
                        $('#GetViewContent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                        $.ajax({
                            type 	    : 'POST',
                            url 	    : '_Page/Event/EventFile.php',
                            data 	    :  {GetIdEvent: GetIdEvent},
                            success     : function(data){
                                $('#GetViewContent').html(data);
                                $('#FormTambahFile').html("");
                                $('#ModalTambahFile').modal('hide');
                                swal("Good Job!", "Tambah File Event Berhasil", "success");
                            }
                        });
                    }
                }
            });
        });
    </script>
    <input type="hidden" name="id_event" id="id_event" value="<?php echo "$id_event"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" class="form-control">
                <option value="">Pilih</option>
                <option value="Dokumen">Dokumen</option>
                <option value="Gambar/Foto">Gambar/Foto</option>
                <option value="URL/Link">URL/Link</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="title_file">Judul/Title File</label>
            <input type="text" name="title_file" id="title_file" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3" id="FormFileName">
            Pilih Kategori Terlebih Dulu
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiTambahFile">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>