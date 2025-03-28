<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['id_event_file'])){
        echo '<small class="text-danger">ID File Event tidak boleh kosong</small>';
    }else{
        //Validasi in_ex tidak boleh kosong
        if(empty($_POST['kategori'])){
            echo '<small class="text-danger">Kategori File tidak boleh kosong</small>';
        }else{
             //Validasi title_file tidak boleh kosong
            if(empty($_POST['title_file'])){
                echo '<small class="text-danger">Title File tidak boleh kosong</small>';
            }else{
                //Validasi deskripsi tidak boleh kosong
                if(empty($_POST['deskripsi'])){
                    echo '<small class="text-danger">Deskripsi File tidak boleh kosong</small>';
                }else{
                    $id_event_file=$_POST['id_event_file'];
                    $kategori=$_POST['kategori'];
                    $title_file=$_POST['title_file'];
                    $deskripsi=$_POST['deskripsi'];
                    if(empty($_POST['deskripsi'])){
                        $file_name="";
                    }else{
                        $file_name=$_POST['file_name'];
                    }
                    if($kategori=="URL/Link"){
                        if(empty($file_name)){
                            echo '<small class="text-danger">URL File tidak boleh kosong</small>';
                        }else{
                            $UpdateFile = mysqli_query($Conn,"UPDATE event_file SET 
                                title_file='$title_file',
                                deskripsi='$deskripsi',
                                file_name='$file_name'
                            WHERE id_event_file='$id_event_file'") or die(mysqli_error($Conn)); 
                            if($UpdateFile){
                                $id_unit_kerja="0";
                                $KategoriLog="Edit File Event";
                                $KeteranganLog="Edit File Event Berhasil";
                                include "../../_Config/InputLog.php";
                                echo '<small class="text-success" id="NotifikasiEditFileBerhasil">Success</small>';
                            }else{
                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                            }
                        }
                    }else{
                        $UpdateFile = mysqli_query($Conn,"UPDATE event_file SET 
                            title_file='$title_file',
                            deskripsi='$deskripsi'
                        WHERE id_event_file='$id_event_file'") or die(mysqli_error($Conn)); 
                        if($UpdateFile){
                            $id_unit_kerja="0";
                            $KategoriLog="Edit File Event";
                            $KeteranganLog="Edit File Event Berhasil";
                            include "../../_Config/InputLog.php";
                            echo '<small class="text-success" id="NotifikasiEditFileBerhasil">Success</small>';
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                        }
                    }
                }
            }
        }
    }
?>