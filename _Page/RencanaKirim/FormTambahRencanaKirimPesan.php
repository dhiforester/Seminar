<?php
    //Koneksi
    include "../../_Config/Connection.php";
    if(empty($_POST['id_mitra'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mt-3 text-danger text-center">';
        echo '      ID Mitra Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_mitra=$_POST['id_mitra'];
?>
    <input type="hidden" name="id_mitra" id="id_mitra" value="<?php echo "$id_mitra"; ?>">
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="clientId">Client ID</label>
            <select name="clientId" id="clientId" class="form-control">
                <?php
                    //Buka data Client
                    echo '<option value="">Pilih</option>';
                    $query = mysqli_query($Conn, "SELECT*FROM whatsapp_client WHERE id_mitra='$id_mitra' ORDER BY clientId ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_whatsapp_client= $data['id_whatsapp_client'];
                        $ClientId= $data['clientId'];
                        $nama_mitra= $data['nama_mitra'];
                        $nomor_akun_wa= $data['nomor_akun_wa'];
                        echo '<option value="'.$ClientId.'">'.$nomor_akun_wa.'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="col-md-6 mt-3">
            <label for="tanggal_kirim">Tanggal Kirim</label>
            <input type="date" name="tanggal_kirim" id="tanggal_kirim" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="no_tujuan">Nomor Tujuan</label>
            <input type="text" name="no_tujuan" id="no_tujuan" class="form-control">
        </div>
        <div class="col-md-6 mt-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="">Pilih</option>
                <option value="Terkirim">Terkirim</option>
                <option value="None">Rencana</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="no_tujuan">Pesan</label>
            <textarea name="pesan" id="pesan" cols="30" rows="3" class="form-control"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiTambahRencanaKirimPesan">
            <span class="text-primary">Pastikan data rencana kirim pesan sudah sesuai.</span>
        </div>
    </div>
<?php } ?>