<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_event_setting'])){
        echo '<div class="row mb-3">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Event Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_event_setting=$_POST['id_event_setting'];
        //Buka Nama Event
        $NamaEvent=getDataDetail($Conn,'event_setting','id_event_setting',$id_event_setting,'nama_event');
        echo '<input type="hidden" name="id_event_setting" class="form-control" value="'.$id_event_setting.'">';
        echo '<div class="row mb-3">';
        echo '  <div class="col-md-12" >';
        echo '      <label for="nama_event">Setting Event</label>';
        echo '      <input type="text" readonly name="nama_event" class="form-control" value="'.$NamaEvent.'">';
        echo '  </div>';
        echo '</div>';
    }
?>