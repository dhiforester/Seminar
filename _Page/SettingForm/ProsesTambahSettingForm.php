<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Waktu
    date_default_timezone_set('UTC');
    //Time Now Tmp
    $updatetime=date('Y-m-d H:i:s');
    //Variabel nama_tamplate
    if(empty($_POST['nama_tamplate'])){
        echo '<span class="text-danger">Nama Tamplate Tidak Boleh Kosong!</span>';
    }else{
        if(empty($_POST['kategori_tamplate'])){
            echo '<span class="text-danger">Kategori Tamplate Tidak Boleh Kosong!</span>';
        }else{
            if(empty($_POST['deskripsi_tamplate'])){
                echo '<span class="text-danger">Deskripsi Tamplate Tidak Boleh Kosong!</span>';
            }else{
                if(empty($_POST['form_tamplate'])){
                    echo '<span class="text-danger">Tamplate Form Tidak Boleh Kosong!</span>';
                }else{
                    $nama_tamplate=$_POST['nama_tamplate'];
                    $kategori_tamplate=$_POST['kategori_tamplate'];
                    $deskripsi_tamplate=$_POST['deskripsi_tamplate'];
                    $form_tamplate=$_POST['form_tamplate'];
                    //Proses simpan data
                    $entry="INSERT INTO tamplate (
                        id_akses,
                        nama_tamplate,
                        kategori_tamplate,
                        deskripsi_tamplate,
                        form_tamplate,
                        updatetime
                    ) VALUES (
                        '$SessionIdAkses',
                        '$nama_tamplate',
                        '$kategori_tamplate',
                        '$deskripsi_tamplate',
                        '$form_tamplate',
                        '$updatetime'
                    )";
                    $Input=mysqli_query($Conn, $entry);
                    if($Input){
                        $id_unit_kerja=0;
                        $KategoriLog="Input Form Setting";
                        $KeteranganLog="Input Form Setting Berhasil";
                        include "../../_Config/InputLog.php";
                        $_SESSION ["NotifikasiSwal"]="Simpan Form Setting Berhasil";
                        echo '<small class="text-success" id="NotifikasiTambahSettingFormBerhasil">Success</small>';
                    }else{
                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data!</small>';
                    }
                }
            }
        }
    }
?>