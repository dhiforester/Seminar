<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_event_setting'])){
        echo '<code class="text-danger">ID Event Tidak Boleh Kosong!</code>';
    }else{
        if(empty($_POST['font_size'])){
            echo '<code class="text-danger">Font SizeT idak Boleh Kosong!</code>';
        }else{
            if(empty($_POST['font_color'])){
                echo '<code class="text-danger">Font color Tidak Boleh Kosong!</code>';
            }else{
                if(empty($_POST['font_name'])){
                    echo '<code class="text-danger">Font color Tidak Boleh Kosong!</code>';
                }else{
                    $id_event_setting=$_POST['id_event_setting'];
                    $font_size=$_POST['font_size'];
                    $font_color=$_POST['font_color'];
                    $font_name=$_POST['font_name'];
                    //Buka Pengaturan Lama
                    $id_setting_sertifikat=getDataDetail($Conn,'setting_sertifikat','id_event_setting',$id_event_setting,'id_setting_sertifikat');
                    $img_bg=getDataDetail($Conn,'setting_sertifikat','id_event_setting',$id_event_setting,'img_bg');
                    if(empty($_FILES['img_bg']['name'])){
                        $ValidasiGambar="Valid";
                        $namabaru=$img_bg;
                    }else{
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
                                    $ValidasiGambar="Valid";
                                    //Hapus Gambar lama
                                    $path = "../../assets/img/Sertifikat/".$img_bg;
                                    unlink($path);
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
                        if(empty($id_setting_sertifikat)){
                            //Insert
                            $entry="INSERT INTO setting_sertifikat (
                                id_event_setting,
                                font_name,
                                font_size,
                                font_color,
                                img_bg
                            ) VALUES (
                                '$id_event_setting',
                                '$font_name',
                                '$font_size',
                                '$font_color',
                                '$namabaru'
                            )";
                            $ProsesSettingSertifikat=mysqli_query($Conn, $entry);
                        }else{
                            //Update
                            $ProsesSettingSertifikat = mysqli_query($Conn,"UPDATE setting_sertifikat SET 
                                font_name='$font_name',
                                font_size='$font_size',
                                font_color='$font_color',
                                img_bg='$namabaru'
                            WHERE id_setting_sertifikat='$id_setting_sertifikat'") or die(mysqli_error($Conn)); 
                        }
                        if($ProsesSettingSertifikat){
                            echo '<code class="text-success" id="NotifikasiSimpanPengaturanSertifikatBerhasil">Success</code>';
                        }else{
                            echo '<code class="text-danger">Terjadi Kesalahan Pada Saat Setting Sertifikat</code>';
                        }
                    }
                }
            }
        }
    }
?>