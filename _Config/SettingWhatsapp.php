<?php
    //Inisiasi setting Whatsapp
    $QrySettingWhatsapp = mysqli_query($Conn,"SELECT * FROM setting_whatsapp")or die(mysqli_error($Conn));
    $DataSettingWhatsapp = mysqli_fetch_array($QrySettingWhatsapp);
    $id_setting_whatsapp= $DataSettingWhatsapp['id_setting_whatsapp'];
    $api_key_Whatsapp= $DataSettingWhatsapp['api_key'];
    $url_add_client= $DataSettingWhatsapp['url_add_client'];
    $url_status_client= $DataSettingWhatsapp['url_status_client'];
    $url_status_all_client= $DataSettingWhatsapp['url_status_all_client'];
    $url_logout_client= $DataSettingWhatsapp['url_logout_client'];
    $url_remove_client= $DataSettingWhatsapp['url_remove_client'];
    $url_send_message= $DataSettingWhatsapp['url_send_message'];
    $url_add_auto_reply= $DataSettingWhatsapp['url_add_auto_reply'];
    $url_all_auto_reply= $DataSettingWhatsapp['url_all_auto_reply'];
    $url_detail_auto_reply= $DataSettingWhatsapp['url_detail_auto_reply'];
    $url_hapus_auto_reply= $DataSettingWhatsapp['url_hapus_auto_reply'];
    $url_edit_auto_reply= $DataSettingWhatsapp['url_edit_auto_reply'];
    $url_count_chatbox= $DataSettingWhatsapp['url_count_chatbox'];
    $url_chatbox_distinct= $DataSettingWhatsapp['url_chatbox_distinct'];
    $url_chatbox_youme= $DataSettingWhatsapp['url_chatbox_youme'];
    $url_chatbox_count_youme= $DataSettingWhatsapp['url_chatbox_count_youme'];
    $url_chatbox_delete_youme= $DataSettingWhatsapp['url_chatbox_delete_youme'];
    $url_tambah_akun_wa= $DataSettingWhatsapp['url_tambah_akun_wa'];
    $url_hapus_akun_wa= $DataSettingWhatsapp['url_hapus_akun_wa'];
?>