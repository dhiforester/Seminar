<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_event_setting'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Event Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_event_setting=$_POST['id_event_setting'];
        $NamaEvent=getDataDetail($Conn,'event_setting','id_event_setting',$id_event_setting,'nama_event');
?>
    <input type="hidden" name="id_event_setting" value="<?php echo $id_event_setting;?>">
    <div class="row mb-4">
        <div class="col-md-12">
            <label for="nama_event">Event</label>
            <input type="text" readonly id="nama_event" name="nama_event" class="form-control" value="<?php echo "$NamaEvent"; ?>">
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <label for="IdSettingSertifikat">Pilih Group Setting</label>
            <select name="id_setting_sertifikat" id="IdSettingSertifikat" class="form-control">
                <option value="">Pilih</option>
                <?php
                    $query = mysqli_query($Conn, "SELECT*FROM setting_sertifikat WHERE id_event_setting='$id_event_setting'");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_setting_sertifikat= $data['id_setting_sertifikat'];
                        $group_name= $data['group_name'];
                        echo '<option value="'.$id_setting_sertifikat.'">'.$group_name.'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <label for="nama">Nama Partisipan</label>
            <input type="text" id="nama" name="nama" class="form-control">
        </div>
    </div>
<?php } ?>