<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_setting_api_key
    if(empty($_POST['id_setting_api_key'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          Api Key ID Data Undefined.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_setting_api_key=$_POST['id_setting_api_key'];
        //Buka data api_key
        $QryDetailApiKey = mysqli_query($Conn,"SELECT * FROM setting_api_key WHERE id_setting_api_key='$id_setting_api_key'")or die(mysqli_error($Conn));
        $DataDetailApiKey = mysqli_fetch_array($QryDetailApiKey);
        $id_setting_api_key = $DataDetailApiKey['id_setting_api_key'];
        $datetime_api_key= $DataDetailApiKey['datetime_api_key'];
        $title_api_key= $DataDetailApiKey['title_api_key'];
        $description_api_key= $DataDetailApiKey['description_api_key'];
        $api_key= $DataDetailApiKey['api_key'];
        $status_api_key= $DataDetailApiKey['status_api_key'];
?>
    <input type="hidden" name="id_setting_api_key" value="<?php echo "$id_setting_api_key"; ?>">
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="title_api_key">Nama Api Key</label>
            <input type="text" name="title_api_key" id="title_api_key_edit" class="form-control" value="<?php echo "$title_api_key"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="description_api_key">Keterangan</label>
            <textarea name="description_api_key" id="description_api_key_edit" cols="30" rows="3" class="form-control"><?php echo "$description_api_key"; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="api_key">Api Key</label>
            <input type="text" readonly name="api_key" id="api_key_edit" class="form-control" value="<?php echo "$api_key";?>" required>
            <small class="credit">
                <a href="javascript:void(0);" id="GenerateApiKeyEdit">Generate Ulang API Key</a>
            </small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="status_api_key">Status</label>
            <select name="status_api_key" id="status_api_key_edit" class="form-control" required>
                <option <?php if($status_api_key==""){echo "selected";} ?> value="">Choose..</option>
                <option <?php if($status_api_key=="Active"){echo "selected";} ?> value="Active">Active</option>
                <option <?php if($status_api_key=="Not Active"){echo "selected";} ?> value="Not Active">Not Active</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditApiKey">
            <small class="text-primary">Pastikan data API Key Sudah Sesuai</small>
        </div>
    </div>
<?php } ?>