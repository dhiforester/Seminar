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
        //Buka Pengaturan Sekarang
        $font_name=getDataDetail($Conn,'setting_sertifikat','id_event_setting',$id_event_setting,'font_name');
        $font_size=getDataDetail($Conn,'setting_sertifikat','id_event_setting',$id_event_setting,'font_size');
        $font_color=getDataDetail($Conn,'setting_sertifikat','id_event_setting',$id_event_setting,'font_color');
        $img_bg=getDataDetail($Conn,'setting_sertifikat','id_event_setting',$id_event_setting,'img_bg');
?>
    <input type="hidden" name="id_event_setting" value="<?php echo $id_event_setting;?>">
    <div class="row mb-4">
        <div class="col-md-12">
            <label for="font_name">Nama Font</label>
            <select name="font_name" id="font_name" class="form-control">
                <?php
                    $dir="../../assets/font-sertifikat/";
                    $open=opendir($dir) or die('Folder tidak ditemukan ...!');
                    while ($file=readdir($open)) {
                        if($file !='.' && $file !='..'){   
                            $files[]=$file;
                            foreach($files as $ListFile){
                                if($font_name==$ListFile){
                                    echo '<option selected value="'.$ListFile.'">'.$ListFile.'</option>';
                                }else{
                                    echo '<option value="'.$ListFile.'">'.$ListFile.'</option>';
                                }
                            }
                        }
                    }
                    
                ?>
            </select>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <label for="font_size">Font Size</label>
            <input type="number" id="font_size" name="font_size" class="form-control" value="<?php echo "$font_size"; ?>">
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <label for="font_color">Font Color</label>
            <select name="font_color" id="font_color" class="form-control">
                <option <?php if($font_color=="Black"){echo "";} ?> value="Black">Black</option>
                <option <?php if($font_color=="White"){echo "";} ?> value="White">White</option>
                <option <?php if($font_color=="Red"){echo "";} ?> value="Red">Red</option>
                <option <?php if($font_color=="Blue"){echo "";} ?> value="Blue">Blue</option>
            </select>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <label for="img_bg">Background</label>
            <input type="file" id="img_bg" name="img_bg" class="form-control">
           
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12" id="NotifikasiSimpanPengaturanSertifikat">
            <span class="text-primary">Pastikan pengaturan yang anda gunakan sudah benar!</span>
        </div>
    </div>
<?php } ?>