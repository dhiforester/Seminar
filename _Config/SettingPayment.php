<?php
    //Inisiasi setting
    $QryPaymentSetting = mysqli_query($Conn,"SELECT * FROM setting_payment WHERE id_setting_payment='1'")or die(mysqli_error($Conn));
    $DataPaymentsetting = mysqli_fetch_array($QryPaymentSetting);
    $api_payment_url= $DataPaymentsetting['api_payment_url'];
    $id_marchant= $DataPaymentsetting['id_marchant'];
    $client_key= $DataPaymentsetting['client_key'];
    $server_key= $DataPaymentsetting['server_key'];
    $snap_url= $DataPaymentsetting['snap_url'];
    $production= $DataPaymentsetting['production'];
    $aktif_payment_gateway= $DataPaymentsetting['aktif_payment_gateway'];
?>