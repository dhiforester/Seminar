<?php
    include "_Config/Connection.php";
    include "_Config/SettingGeneral.php";
    include "_Config/Function.php";
    
    if(empty($_GET['Token'])){
        echo "Token Sertifikat Tidak Valid!";
    }else{
        $Token=$_GET['Token'];
        $id_event_setting=getDataDetail($Conn,'event_sertifikat','token',$Token,'id_event_setting');
        $nama_event=getDataDetail($Conn,'event_setting','id_event_setting',$id_event_setting,'nama_event');
        $id_peserta=getDataDetail($Conn,'event_sertifikat','token',$Token,'id_peserta');
        $nama=getDataDetail($Conn,'event_peserta','id_peserta',$id_peserta,'nama');
        //Buka Pengaturan
        $id_setting_sertifikat=getDataDetail($Conn,'setting_sertifikat','id_event_setting',$id_event_setting,'id_setting_sertifikat');
        $font_name=getDataDetail($Conn,'setting_sertifikat','id_event_setting',$id_event_setting,'font_name');
        $font_size=getDataDetail($Conn,'setting_sertifikat','id_event_setting',$id_event_setting,'font_size');
        $font_color=getDataDetail($Conn,'setting_sertifikat','id_event_setting',$id_event_setting,'font_color');
        $img_bg=getDataDetail($Conn,'setting_sertifikat','id_event_setting',$id_event_setting,'img_bg');
        if(empty($id_setting_sertifikat)){
            echo "Tidak ada pengaturan setting sertifikat";
        }else{
            $gambar = "assets/img/Sertifikat/$img_bg";
            putenv('GDFONTPATH=' . realpath('.'));
            $image = imagecreatefromjpeg($gambar);
            if($font_color=="White"){
                $FontColor = imageColorAllocate($image, 255, 255, 255);
            }else{
                if($font_color=="Black"){
                    $FontColor = imageColorAllocate($image, 0, 0, 0);
                }else{
                    if($font_color=="Red"){
                        $FontColor = imageColorAllocate($image, 205, 19, 19);
                    }else{
                        if($font_color=="Blue"){
                            $FontColor = imageColorAllocate($image, 56, 137, 242);
                        }else{
                            $FontColor = imageColorAllocate($image, 255, 255, 255);
                        }
                    }
                }
            }
            $font = dirname(__FILE__) . '/assets/font-sertifikat/'.$font_name.'';
            $size = $font_size;
            //definisikan lebar gambar agar posisi teks selalu ditengah berapapun jumlah hurufnya
            $image_width = imagesx($image);  
            //membuat textbox agar text centered
            $text_box = imagettfbbox($size,0,$font,$nama);
            $text_width = $text_box[2]-$text_box[0];
            $text_height = $text_box[3]-$text_box[1];
            $x = ($image_width/2) - ($text_width/2);
            //generate sertifikat beserta namanya
            imagettftext($image, $size, 0, $x, 400, $FontColor, $font, $nama);
            //tampilkan di browser
            header("Content-type:  image/jpeg");
            imagejpeg($image);
            imagedestroy($image);
        }
    }
?>