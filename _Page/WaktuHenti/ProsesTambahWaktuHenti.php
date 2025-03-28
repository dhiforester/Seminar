<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi tanggal_mulai tidak boleh kosong
    if(empty($_POST['tanggal_mulai'])){
        echo '<small class="text-danger">Tanggal mulai kejadian tidak boleh kosong</small>';
    }else{
        //Validasi waktu_mulai tidak boleh kosong
        if(empty($_POST['waktu_mulai'])){
            echo '<small class="text-danger">Waktu mulai kejadian tidak boleh kosong</small>';
        }else{
            //Validasi kategori tidak boleh kosong
            if(empty($_POST['kategori'])){
                echo '<small class="text-danger">Kategori Kejadian tidak boleh kosong</small>';
            }else{
                //Validasi keterangan tidak boleh kosong
                if(empty($_POST['keterangan'])){
                    echo '<small class="text-danger">Keterangan Kejadian tidak boleh kosong</small>';
                }else{
                    //Validasi Status tidak boleh kosong
                    if(empty($_POST['status'])){
                        echo '<small class="text-danger">Status akses tidak boleh kosong</small>';
                    }else{
                        if(empty($_POST['tanggal_selesai'])){
                            $tanggal_selesai="";
                        }else{
                            $tanggal_selesai=$_POST['tanggal_selesai'];
                            if(empty($_POST['waktu_selesai'])){
                                $waktu_selesai="";
                            }else{
                                $waktu_selesai=$_POST['waktu_selesai'];
                            }
                            $tanggal_selesai="$tanggal_selesai $waktu_selesai";
                        }
                        
                        //Variabel Lainnya
                        $tanggal_mulai=$_POST['tanggal_mulai'];
                        $waktu_mulai=$_POST['waktu_mulai'];
                        $kategori=$_POST['kategori'];
                        $keterangan=$_POST['keterangan'];
                        $status=$_POST['status'];
                        $tanggal_mulai="$tanggal_mulai $waktu_mulai";
                        //Validasi data duplikat
                        $ValidasiDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_catat='$now' AND keterangan='$keterangan'"));
                        if(!empty($ValidasiDuplikat)){
                            echo '<small class="text-danger">Data tersebut sudah terdaftar</small>';
                        }else{
                            $entry="INSERT INTO waktu_henti (
                                id_akses,
                                nama_user,
                                tanggal_mulai,
                                tanggal_selesai,
                                tanggal_catat,
                                kategori,
                                keterangan,
                                status
                            ) VALUES (
                                '$SessionIdAkses',
                                '$SessionNama',
                                '$tanggal_mulai',
                                '$tanggal_selesai',
                                '$now',
                                '$kategori',
                                '$keterangan',
                                '$status'
                            )";
                            $Input=mysqli_query($Conn, $entry);
                            if($Input){
                                $id_unit_kerja="0";
                                $KategoriLog="Waktu Henti";
                                $KeteranganLog="Input Waktu Henti";
                                include "../../_Config/InputLog.php";
                                $_SESSION ["NotifikasiSwal"]="Tambah Waktu Henti Berhasil";
                                echo '<small class="text-success" id="NotifikasiTambahWaktuHentiBerhasil">Success</small>';
                            }else{
                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                            }
                        }
                    }
                }
            }
        }
    }
?>