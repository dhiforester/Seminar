<?php
    //Connection
    include "../../_Config/Connection.php";
    if(empty($_POST['id_setting_api_key'])){
        echo '<span class="text-danger">Api Key ID Cannot be captured during deletion process</span>';
    }else{
        $id_setting_api_key=$_POST['id_setting_api_key'];
        //Proses hapus data
        $query = mysqli_query($Conn, "DELETE FROM setting_api_key WHERE id_setting_api_key='$id_setting_api_key'") or die(mysqli_error($Conn));
        if ($query) {
            echo '<span class="text-success" id="NotifikasiHapusApiKeyBerhasil">Success</span>';
        }else{
            echo '<span class="text-danger">Clear Data Fail</span>';
        }
    }
?>