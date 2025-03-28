<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(!empty($_POST['id_event_setting'])){
        $id_event_setting=$_POST['id_event_setting'];
        //Buka data event
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $tanggal_mulai= $DataEvent['tanggal_mulai'];
        $tanggal_selesai= $DataEvent['tanggal_selesai'];
        $mulai_pendaftaran= $DataEvent['mulai_pendaftaran'];
        $selesai_pendaftaran= $DataEvent['selesai_pendaftaran'];
        $nama_event= $DataEvent['nama_event'];
        $keterangan= $DataEvent['keterangan'];
        $status= $DataEvent['status'];
        //strtotime
        $strtotime1=strtotime($tanggal_mulai);
        $strtotime2=strtotime($tanggal_selesai);
        $strtotime3=strtotime($mulai_pendaftaran);
        $strtotime4=strtotime($selesai_pendaftaran);
        //Formated
        $TanggalMulai=date('Y-m-d',$strtotime1);
        $TanggalSelesai=date('Y-m-d',$strtotime2);
        $MulaiPendaftaran=date('Y-m-d',$strtotime3);
        $SelesaiPendaftaran=date('Y-m-d',$strtotime4);
        $JamMulai=date('H:i',$strtotime1);
        $JamSelesai=date('H:i',$strtotime2);
        $JamMulaiPendaftaran=date('H:i',$strtotime3);
        $JamSelesaiPendaftaran=date('H:i',$strtotime4);
?>
    <input type="hidden" name="id_event_setting" id="id_event_setting" value="<?php echo $id_event_setting;?>">
    <div class="row mb-4">
        <div class="col-md-4 mb-2">
            Mulai Event
        </div>
        <div class="col-md-4 mb-2">
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="<?php echo $TanggalMulai;?>">
            <small><label for="tanggal_mulai">Tanggal Mulai Event</label></small>
        </div>
        <div class="col-md-4 mb-2">
            <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" value="<?php echo $JamMulai;?>">
            <small><label for="waktu_mulai">Jam Mulai Event</label></small>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4 mb-2">
            Tanggal Selesai
        </div>
        <div class="col-md-4 mb-2">
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="<?php echo $TanggalSelesai;?>">
            <small><label for="tanggal_selesai">Tanggal Selesai Event</label></small>
        </div>
        <div class="col-md-4 mb-2">
            <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" value="<?php echo $JamSelesai;?>">
            <small><label for="waktu_selesai">Jam Selesai Event</label></small>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4 mb-2">
            Mulai Pendaftaran
        </div>
        <div class="col-md-4 mb-2">
            <input type="date" name="tanggal_mulai_pendaftaran" id="tanggal_mulai_pendaftaran" class="form-control" value="<?php echo $MulaiPendaftaran;?>">
            <small><label for="tanggal_mulai_pendaftaran">Tanggal Mulai Pendaftaran</label></small>
        </div>
        <div class="col-md-4 mb-2">
            <input type="time" name="waktu_mulai_pendaftaran" id="waktu_mulai_pendaftaran" class="form-control" value="<?php echo $JamMulaiPendaftaran;?>">
            <small><label for="waktu_mulai_pendaftaran">Jam Mulai Pendaftaran</label></small>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4 mb-2">
            Selesai Pendaftaran
        </div>
        <div class="col-md-4 mb-2">
            <input type="date" name="tanggal_selesai_pendaftaran" id="tanggal_selesai_pendaftaran" class="form-control" value="<?php echo $SelesaiPendaftaran;?>">
            <small><label for="tanggal_selesai_pendaftaran">Tanggal Selesai Pendaftaran</label></small>
        </div>
        <div class="col-md-4 mb-2">
            <input type="time" name="waktu_selesai_pendaftaran" id="waktu_selesai_pendaftaran" class="form-control" value="<?php echo $JamSelesaiPendaftaran;?>">
            <small><label for="waktu_selesai_pendaftaran">Jam Selesai Pendaftaran</label></small>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4 mb-2">
            <label for="nama_event">Nama Event</label>
        </div>
        <div class="col-md-8 mb-2">
            <input type="text" name="nama_event" id="nama_event" class="form-control" value="<?php echo $nama_event;?>">
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4 mb-2">
            <label for="keterangan_event">Keterangan Event</label>
        </div>
        <div class="col-md-8 mb-2">
            <textarea name="keterangan_event" id="keterangan_event" cols="30" rows="4" class="form-control"><?php echo $keterangan;?></textarea>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4 mb-2">
            <label for="status">Status</label>
        </div>
        <div class="col-md-8 mb-2">
            <select name="status" id="status" class="form-control">
                <option <?php if($status==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($status=="Rencana"){echo "selected";} ?> value="Rencana">Rencana</option>
                <option <?php if($status=="Berlangsung"){echo "selected";} ?> value="Berlangsung">Berlangsung</option>
                <option <?php if($status=="Selesai"){echo "selected";} ?> value="Selesai">Selesai</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditEvent">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>