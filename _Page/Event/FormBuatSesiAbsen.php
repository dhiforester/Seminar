<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_setting'])){
        echo '<span class="text-danger">ID Event Setting Tidak Boleh Kosong!</span>';
    }else{
        $id_event_setting=$_POST['id_event_setting'];
        //Buka data event
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $tanggal_mulai= $DataEvent['tanggal_mulai'];
        $tanggal_selesai= $DataEvent['tanggal_selesai'];
        $strtotime= strtotime($tanggal_mulai);
        $strtotime2= strtotime($tanggal_selesai);
        $tanggal_mulai= date('Y-m-d',$strtotime);
        $jam_mulai= date('H:i',$strtotime);
        $tanggal_selesai= date('Y-m-d',$strtotime2);
        $jam_selesai= date('H:i',$strtotime2);
?>
    <input type="hidden" name="id_event_setting" value="<?php echo "$id_event_setting"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="label_sesi">Label Sesi</label>
            <input type="text" name="label_sesi" id="label_sesi" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="tanggal_mulai">Tanggal Mulai</label>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="<?php echo "$tanggal_mulai"; ?>">
            <small>Tanggal</small>
        </div>
        <div class="col-md-6">
            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="<?php echo "$jam_mulai"; ?>">
            <small>Jam</small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="tanggal_selesai">Tanggal Selesai</label>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="<?php echo "$tanggal_selesai"; ?>">
            <small>Tanggal</small>
        </div>
        <div class="col-md-6">
            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="<?php echo "$jam_selesai"; ?>">
            <small>Jam</small>
        </div>
    </div>
<?php } ?>