<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_event_setting'])){
        echo '<code class="text-danger">ID Event Tidak Boleh Kosong!</code>';
    }else{
        if(empty($_POST['id_setting_sertifikat'])){
            echo '<code class="text-danger">ID Setting Sertivikat Tidak Boleh Kosong!</code>';
        }else{
            if(empty($_POST['group_name'])){
                echo '<code class="text-danger">Nama Group Setting Tidak Boleh Kosong!</code>';
            }else{
                if(empty($_POST['text_align'])){
                    echo '<code class="text-danger">Text Align Tidak Boleh Kosong!</code>';
                }else{
                    if(empty($_POST['line_height'])){
                        echo '<code class="text-danger">Line Hight Tidak Boleh Kosong!</code>';
                    }else{
                        if(empty($_POST['margin_left'])){
                            echo '<code class="text-danger">Margin Left Tidak Boleh Kosong!</code>';
                        }else{
                            if(empty($_POST['font_name'])){
                                echo '<code class="text-danger">Nama Font Tidak Boleh Kosong!</code>';
                            }else{
                                if(empty($_POST['font_size'])){
                                    echo '<code class="text-danger">Ukuran Font Tidak Boleh Kosong!</code>';
                                }else{
                                    if(empty($_POST['font_color'])){
                                        echo '<code class="text-danger">Warna Font Tidak Boleh Kosong!</code>';
                                    }else{
                                        $id_event_setting=$_POST['id_event_setting'];
                                        $id_setting_sertifikat=$_POST['id_setting_sertifikat'];
                                        $group_name=$_POST['group_name'];
                                        $text_align=$_POST['text_align'];
                                        $line_height=$_POST['line_height'];
                                        $margin_left=$_POST['margin_left'];
                                        $font_name=$_POST['font_name'];
                                        $font_size=$_POST['font_size'];
                                        $font_color=$_POST['font_color'];
                                        if(empty($_FILES['img_bg']['name'])){
                                            //Buka Image Lama
                                            $namabaru=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'img_bg');
                                            $ValidasiGambar="Valid";
                                        }else{
                                            //Variabel Gambar Background
                                            $nama_gambar=$_FILES['img_bg']['name'];
                                            //ukuran gambar
                                            $ukuran_gambar = $_FILES['img_bg']['size']; 
                                            //tipe
                                            $tipe_gambar = $_FILES['img_bg']['type']; 
                                            //sumber gambar
                                            $tmp_gambar = $_FILES['img_bg']['tmp_name'];
                                            $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                            $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                            $FileNameRand=$key;
                                            $Pecah = explode("." , $nama_gambar);
                                            $BiasanyaNama=$Pecah[0];
                                            $Ext=$Pecah[1];
                                            $namabaru = "$FileNameRand.$Ext";
                                            $path = "../../assets/img/Sertifikat/".$namabaru;
                                            if($tipe_gambar == "image/jpeg"||$tipe_gambar == "image/jpg"||$tipe_gambar == "image/gif"||$tipe_gambar == "image/png"){
                                                if($ukuran_gambar<2000000){
                                                    if(move_uploaded_file($tmp_gambar, $path)){
                                                        $FileLama=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'img_bg');
                                                        $PathFileLama = "../../assets/img/Sertifikat/".$FileLama;
                                                        //Hapus File
                                                        unlink($PathFileLama);
                                                        $ValidasiGambar="Valid";
                                                    }else{
                                                        $ValidasiGambar="Upload file gambar gagal";
                                                    }
                                                }else{
                                                    $ValidasiGambar="File gambar tidak boleh lebih dari 2 mb";
                                                }
                                            }else{
                                                $ValidasiGambar="tipe file hanya boleh JPG, JPEG, PNG and GIF";
                                            }
                                        }
                                        if($ValidasiGambar!=="Valid"){
                                            echo '<code class="text-danger">'.$ValidasiGambar.'</code>';
                                        }else{
                                            $ProsesSettingSertifikat = mysqli_query($Conn,"UPDATE setting_sertifikat SET 
                                                group_name='$group_name',
                                                text_align='$text_align',
                                                line_height='$line_height',
                                                margin_left='$margin_left',
                                                font_name='$font_name',
                                                font_size='$font_size',
                                                font_color='$font_color',
                                                img_bg='$namabaru'
                                            WHERE id_setting_sertifikat='$id_setting_sertifikat'") or die(mysqli_error($Conn)); 
                                            if($ProsesSettingSertifikat){
                                                echo '<code class="text-success" id="NotifikasiEditGroupSettingBerhasil">Success</code>';
                                            }else{
                                                echo '<code class="text-danger">Terjadi Kesalahan Pada Saat Setting Sertifikat</code>';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>