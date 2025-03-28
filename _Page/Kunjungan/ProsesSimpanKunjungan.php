<?php
    //Koneksi
    include "../../_Config/Connection.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_ruangan tidak boleh kosong
    if(empty($_POST['id_ruangan'])){
        echo '<small class="text-danger">ID Ruangan tidak boleh kosong</small>';
    }else{
        //Validasi Kategori tidak boleh kosong
        if(empty($_POST['unit'])){
            echo '<small class="text-danger">Unit/Instansi tidak boleh kosong</small>';
        }else{
            if(empty($_POST['nama'])){
                echo '<small class="text-danger">Nama pengunjung tidak boleh kosong</small>';
            }else{
                if(empty($_POST['foto'])){
                    echo '<small class="text-danger">Tanda tangan tidak boleh kosong</small>';
                }else{
                    //Variabel Lainnya
                    $id_ruangan=$_POST['id_ruangan'];
                    $unit=$_POST['unit'];
                    $nama=$_POST['nama'];
                    $data_uri=$_POST['foto'];
                    $encoded_image = explode(",", $data_uri)[1];
                    $decoded_image = base64_decode($encoded_image);
                    $entry="INSERT INTO list_kunjungan (
                        id_ruangan,
                        datetime,
                        nama,
                        unit,
                        signature
                    ) VALUES (
                        '$id_ruangan',
                        '$now',
                        '$nama',
                        '$unit',
                        '$encoded_image'
                    )";
                    $Input=mysqli_query($Conn, $entry);
                    if($Input){
                        echo '<small class="text-success" id="NotifikasiKunjunganBerhasil">Success</small>';
                    }else{
                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                    }
                }
            }
        }
    }
?>
