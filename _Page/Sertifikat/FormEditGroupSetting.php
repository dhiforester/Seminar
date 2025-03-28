<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_setting_sertifikat'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Setting Sertifikat Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_setting_sertifikat=$_POST['id_setting_sertifikat'];
        //Buka Pengaturan Sekarang
        $id_event_setting=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'id_event_setting');
        $group_name=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'group_name');
        $text_align=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'text_align');
        $line_height=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'line_height');
        $margin_left=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'margin_left');
        $font_name=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'font_name');
        $font_size=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'font_size');
        $font_color=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'font_color');
?>
    <input type="hidden" name="id_event_setting" value="<?php echo $id_event_setting;?>">
    <input type="hidden" name="id_setting_sertifikat" value="<?php echo $id_setting_sertifikat;?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="group_name">Nama Setting Group</label>
            <input type="text" id="group_name" name="group_name" class="form-control" value="<?php echo "$group_name"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="text_align">Text Align</label>
            <select name="text_align" id="text_align" class="form-control">
                <option <?php if($text_align==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($text_align=="left"){echo "selected";} ?> value="left">Left</option>
                <option <?php if($text_align=="right"){echo "selected";} ?> value="right">Right</option>
                <option <?php if($text_align=="center"){echo "selected";} ?> value="center">Center</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="line_height">Line Height</label>
            <input type="text" id="line_height" name="line_height" class="form-control" value="<?php echo "$line_height"; ?>">
            <small>Ex: 175mm</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="margin_left">Margin Left</label>
            <input type="text" id="margin_left" name="margin_left" class="form-control" value="<?php echo "$margin_left"; ?>">
            <small>Ex: 187px</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="font_name">Font Name</label>
            <select name="font_name" id="font_name" class="form-control">
                <option <?php if($font_name==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($font_name=="dejavusanscondensed"){echo "selected";} ?> value="dejavusanscondensed">dejavusanscondensed</option>
                <option <?php if($font_name=="dejavusans"){echo "selected";} ?> value="dejavusans">dejavusans</option>
                <option <?php if($font_name=="dejavuserif"){echo "selected";} ?> value="dejavuserif">dejavuserif</option>
                <option <?php if($font_name=="dejavusansmono"){echo "selected";} ?> value="dejavusansmono">dejavusansmono</option>
                <option <?php if($font_name=="freesans"){echo "selected";} ?> value="freesans">freesans</option>
                <option <?php if($font_name=="charm"){echo "selected";} ?> value="charm">charm</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="font_size">Font Size</label>
            <input type="text" id="font_size" name="font_size" class="form-control" value="<?php echo "$font_size"; ?>">
            <small>Ex: 52.5pt</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="font_color">Font Color</label>
            <input type="text" id="font_color" name="font_color" class="form-control" value="<?php echo "$font_color"; ?>">
            <small>Ex: #155B39</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="img_bg">Background Image</label>
            <input type="file" id="img_bg" name="img_bg" class="form-control">
            <small>Image Size: 1123 x 794 px</small>
        </div>
    </div>
<?php } ?>