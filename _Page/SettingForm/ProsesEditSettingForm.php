<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Waktu
    date_default_timezone_set('UTC');
    //Time Now Tmp
    $updatetime=date('Y-m-d H:i:s');
    //Variabel id_tamplate
    if(empty($_POST['id_tamplate'])){
        echo '<span class="text-danger">ID Tamplate Tidak Boleh Kosong!</span>';
    }else{
        if(empty($_POST['nama_tamplate'])){
            echo '<span class="text-danger">Nama Tamplate Tidak Boleh Kosong!</span>';
        }else{
            if(empty($_POST['kategori_tamplate'])){
                echo '<span class="text-danger">Kategori Tamplate Tidak Boleh Kosong!</span>';
            }else{
                if(empty($_POST['deskripsi_tamplate'])){
                    echo '<span class="text-danger">Deskprisi Tamplate Tidak Boleh Kosong!</span>';
                }else{
                    if(empty($_POST['form_tamplate'])){
                        echo '<span class="text-danger">Tamplate Form Tidak Boleh Kosong!</span>';
                    }else{
                        $id_tamplate=$_POST['id_tamplate'];
                        $nama_tamplate=$_POST['nama_tamplate'];
                        $kategori_tamplate=$_POST['kategori_tamplate'];
                        $deskripsi_tamplate=$_POST['deskripsi_tamplate'];
                        $form_tamplate=$_POST['form_tamplate'];
                        //Simpan data
                        $UpdateSettingForm = mysqli_query($Conn,"UPDATE tamplate SET 
                            nama_tamplate='$nama_tamplate',
                            kategori_tamplate='$kategori_tamplate',
                            deskripsi_tamplate='$deskripsi_tamplate',
                            form_tamplate='$form_tamplate',
                            updatetime='$updatetime'
                        WHERE id_tamplate='$id_tamplate'") or die(mysqli_error($Conn)); 
                        if($UpdateSettingForm){
                            $id_unit_kerja =0;
                            $KategoriLog="Update Form Setting";
                            $KeteranganLog="Update Form Setting Berhasil";
                            include "../../_Config/InputLog.php";
                            $_SESSION ["NotifikasiSwal"]="Simpan Form Setting Berhasil";
                            echo '<small class="text-success" id="NotifikasiEditSettingFormBerhasil">Success</small>';
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data!</small>';
                        }
                    }
                }
            }
        }
    }
?>