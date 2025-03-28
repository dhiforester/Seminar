<?php
    //Inisiasi setting filemanager
    $QryFilemanager = mysqli_query($Conn,"SELECT * FROM setting_filemanager")or die(mysqli_error($Conn));
    $DataSettingFilemanager = mysqli_fetch_array($QryFilemanager);
    $id_setting_filemanager= $DataSettingFilemanager['id_setting_filemanager'];
    $api_key_filemanager= $DataSettingFilemanager['api_key'];
    $base_url_filemanager= $DataSettingFilemanager['base_url_filemanager'];
    $url_add_file= $DataSettingFilemanager['url_add_file'];
    $url_delete_file= $DataSettingFilemanager['url_delete_file'];
?>