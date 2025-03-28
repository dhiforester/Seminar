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
        <div class="col-md-12 mb-3 table table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center"><b>Opt</b></th>
                        <th class="text-center"><b>Nama Akun</b></th>
                        <th class="text-center"><b>Status</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "../../_Config/Connection.php";
                        $no = 1;
                        //KONDISI PENGATURAN MASING FILTER
                        $query = mysqli_query($Conn, "SELECT*FROM akses ORDER BY nama_akses ASC");
                        while ($data = mysqli_fetch_array($query)) {
                            $id_akses= $data['id_akses'];
                            $nama_akses= $data['nama_akses'];
                            $kontak_akses= $data['kontak_akses'];
                            $email_akses= $data['email_akses'];
                            $password= $data['password'];
                            $akses= $data['akses'];
                            $status= $data['status'];
                            $image_akses= $data['image_akses'];
                            $datetime_update= $data['datetime_update'];
                            $datetime_update=$datetime_update;
                        ?>
                    <tr>
                        <td class="text-center text-xs">
                            <input class="form-check-input" type="radio" name="id_akses" id="id_akses<?php echo "$id_akses"; ?>" value="<?php echo "$id_akses"; ?>">
                        </td>
                        <td class="text-left" align="left">
                            <label class="form-check-label" for="id_akses<?php echo "$id_akses"; ?>">
                                <b><?php echo "$nama_akses";?></b><br>
                                <?php 
                                    echo "<small>$email_akses</small><br>";
                                ?>
                            </label>
                        </td>
                        <td class="text-left" align="left">
                            <?php
                                if($status=="Active"){
                                    echo '<span class="badge badge-sm bg-success">Active</span>';
                                }else{
                                    if($status=="Pending"){
                                        echo '<span class="badge badge-sm bg-warning">Pending</span>';
                                    }else{
                                        echo '<small class="text-danger">'.$status.'</small>';
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                        $no++; }
                    ?>
                </tbody>
            </table>
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