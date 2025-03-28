<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_tamplate'])){
        echo '<span class="text-danger">Tidak ada ID Tamplate Yang Dipilih!</span>';
    }else{
        $id_tamplate=$_POST['id_tamplate'];
        //Buka detail tamplate
        $QryTamplate = mysqli_query($Conn,"SELECT * FROM tamplate WHERE id_tamplate='$id_tamplate'")or die(mysqli_error($Conn));
        $DataTamplate = mysqli_fetch_array($QryTamplate);
        if(empty($DataTamplate['form_tamplate'])){
            echo '<span class="text-danger">Tidak ada form tamplate</span>';
        }else{
            $form_tamplate= $DataTamplate['form_tamplate'];
            echo "$form_tamplate";
        }
    }
?>  