<?php
    //Koneksi
    include "../../_Config/Connection.php";
    if(!empty($_POST['id_rencana_kirim'])){
        $id_rencana_kirim=$_POST['id_rencana_kirim'];
        //Buka data Rencana Kirim Pesan
        $QryRencanaKirim = mysqli_query($Conn,"SELECT * FROM whatsapp_rencana_kirim WHERE id_rencana_kirim='$id_rencana_kirim'")or die(mysqli_error($Conn));
        $DataRencanaKirim = mysqli_fetch_array($QryRencanaKirim);
        $id_mitra= $DataRencanaKirim['id_mitra'];
        $clientId= $DataRencanaKirim['clientId'];
        $tanggal_kirim= $DataRencanaKirim['tanggal_kirim'];
        $no_tujuan= $DataRencanaKirim['no_tujuan'];
        $pesan= $DataRencanaKirim['pesan'];
        $status= $DataRencanaKirim['status'];
?>
    <input type="hidden" name="id_rencana_kirim" id="id_rencana_kirim" value="<?php echo "$id_rencana_kirim"; ?>">
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
                        $ClientIdList= $data['clientId'];
                        $nama_mitraList= $data['nama_mitra'];
                        $nomor_akun_wa_list= $data['nomor_akun_wa'];
                        if($ClientIdList=="$clientId"){
                            echo '<option selected value="'.$ClientIdList.'">'.$nomor_akun_wa_list.'</option>';
                        }else{
                            echo '<option selected value="'.$ClientIdList.'">'.$nomor_akun_wa_list.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="col-md-6 mt-3">
            <label for="tanggal_kirim">Tanggal Kirim</label>
            <input type="date" name="tanggal_kirim" id="tanggal_kirim" class="form-control" value="<?php echo "$tanggal_kirim"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="no_tujuan">Nomor Tujuan</label>
            <input type="text" name="no_tujuan" id="no_tujuan" class="form-control" value="<?php echo "$no_tujuan"; ?>">
        </div>
        <div class="col-md-6 mt-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option <?php if($status==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($status=="Terkirim"){echo "selected";} ?> value="Terkirim">Terkirim</option>
                <option <?php if($status=="None"){echo "selected";} ?> value="None">Rencana</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="no_tujuan">Pesan</label>
            <textarea name="pesan" id="pesan" cols="30" rows="3" class="form-control"><?php echo "$pesan"; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditRencanaKirimPesan">
            <span class="text-primary">Pastikan data rencana kirim pesan sudah sesuai.</span>
        </div>
    </div>
<?php 
    }else{
        $id_rencana_kirim="";
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col col-md-12 text-center">';
        echo '          <small class="modal-title my-3">Sorry, No access data selected.</small>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }
?>