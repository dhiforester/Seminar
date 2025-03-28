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
        //Proses Tambah Riwayat
        $('#ProsesTambahRiwayat').submit(function(){
            $('#NotifikasiTambahRiwayat').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
            var form = $('#ProsesTambahRiwayat')[0];
            var data = new FormData(form);
            $.ajax({
                type 	    : 'POST',
                url 	    : '_Page/Event/ProsesTambahRiwayat.php',
                data 	    :  data,
                cache       : false,
                processData : false,
                contentType : false,
                enctype     : 'multipart/form-data',
                success     : function(data){
                    $('#NotifikasiTambahRiwayat').html(data);
                    var NotifikasiSimpanRiwayatKerjaBerhasil=$('#NotifikasiSimpanRiwayatKerjaBerhasil').html();
                    if(NotifikasiSimpanRiwayatKerjaBerhasil=="Success"){
                        $('#GetViewContent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                        $.ajax({
                            type 	    : 'POST',
                            url 	    : '_Page/Event/EventRiwayat.php',
                            data 	    :  {GetIdEvent: GetIdEvent},
                            success     : function(data){
                                $('#GetViewContent').html(data);
                                $('#FormTambahRiwayat').html("");
                                $('#ModalTambahRiwayat').modal('hide');
                                swal("Good Job!", "Tambah Riwayat Event Berhasil", "success");
                            }
                        });
                    }
                }
            });
        });
    </script>
    <input type="hidden" name="id_event" id="id_event" value="<?php echo "$id_event"; ?>">
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo "$tanggal"; ?>">
        </div>
        <div class="col-md-6 mt-3">
            <label for="jam">Jam</label>
            <input type="time" name="jam" id="jam" class="form-control" value="<?php echo "$jam"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="kategori_kerja">Kategori Kerja</label>
            <input type="text" name="kategori_kerja" id="kategori_kerja" class="form-control" list="ListKategoriKerja">
            <datalist id="ListKategoriKerja">
                <?php
                    $query = mysqli_query($Conn, "SELECT DISTINCT kategori_kerja FROM riwayat_kerja");
                    while ($data = mysqli_fetch_array($query)) {
                        $kategori_kerja = $data['kategori_kerja'];
                        echo '<option value="'.$kategori_kerja.'">';
                    }
                ?>
            </datalist>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="keterangan">Keterangan</label>
            <textarea id="keterangan" name="keterangan" class="form-control" cols="30" rows="4"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="gambar_kerja">Gambar Kegiatan Pekerjaan</label>
            <input type="file" name="gambar_kerja" id="gambar_kerja" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiTambahRiwayat">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>