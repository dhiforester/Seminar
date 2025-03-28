<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['id_akses'])){
        echo '<small class="text-danger">ID Akses tidak boleh kosong</small>';
    }else{
        //Validasi tanggal_mulai tidak boleh kosong
        if(empty($_POST['tanggal_mulai'])){
            echo '<small class="text-danger">Tanggal Mulai tidak boleh kosong</small>';
        }else{
            //Validasi waktu_mulai tidak boleh kosong
            if(empty($_POST['waktu_mulai'])){
                echo '<small class="text-danger">Waktu Mulai tidak boleh kosong</small>';
            }else{
                //Validasi tanggal_selesai tidak boleh kosong
                if(empty($_POST['tanggal_selesai'])){
                    echo '<small class="text-danger">Tanggal Selesai tidak boleh kosong</small>';
                }else{
                    //Validasi waktu_selesai tidak boleh kosong
                    if(empty($_POST['waktu_selesai'])){
                        echo '<small class="text-danger">Waktu selesai tidak boleh kosong</small>';
                    }else{
                        //Validasi tanggal_mulai_pendaftaran tidak boleh kosong
                        if(empty($_POST['tanggal_mulai_pendaftaran'])){
                            echo '<small class="text-danger">Tanggal Mulai pendaftaran tidak boleh kosong</small>';
                        }else{
                            //Validasi waktu_mulai_pendaftaran tidak boleh kosong
                            if(empty($_POST['waktu_mulai_pendaftaran'])){
                                echo '<small class="text-danger">Jam Mulai pendaftaran tidak boleh kosong</small>';
                            }else{
                                //Validasi tanggal_selesai_pendaftaran tidak boleh kosong
                                if(empty($_POST['tanggal_selesai_pendaftaran'])){
                                    echo '<small class="text-danger">Tanggal selesai pendaftaran tidak boleh kosong</small>';
                                }else{
                                    //Validasi waktu_selesai_pendaftaran tidak boleh kosong
                                    if(empty($_POST['waktu_selesai_pendaftaran'])){
                                        echo '<small class="text-danger">Jam selesai pendaftaran tidak boleh kosong</small>';
                                    }else{
                                        //Validasi nama_event tidak boleh kosong
                                        if(empty($_POST['nama_event'])){
                                            echo '<small class="text-danger">Nama Event tidak boleh kosong</small>';
                                        }else{
                                            //Validasi keterangan_event tidak boleh kosong
                                            if(empty($_POST['keterangan_event'])){
                                                echo '<small class="text-danger">Keterangan Event tidak boleh kosong</small>';
                                            }else{
                                                //Validasi status tidak boleh kosong
                                                if(empty($_POST['status'])){
                                                    echo '<small class="text-danger">Status Event tidak boleh kosong</small>';
                                                }else{
                                                    //Variabel Data
                                                    $id_akses=$_POST['id_akses'];
                                                    $tanggal_mulai=$_POST['tanggal_mulai'];
                                                    $waktu_mulai=$_POST['waktu_mulai'];
                                                    $tanggal_selesai=$_POST['tanggal_selesai'];
                                                    $waktu_selesai=$_POST['waktu_selesai'];
                                                    $tanggal_mulai_pendaftaran=$_POST['tanggal_mulai_pendaftaran'];
                                                    $waktu_mulai_pendaftaran=$_POST['waktu_mulai_pendaftaran'];
                                                    $tanggal_selesai_pendaftaran=$_POST['tanggal_selesai_pendaftaran'];
                                                    $waktu_selesai_pendaftaran=$_POST['waktu_selesai_pendaftaran'];
                                                    $nama_event=$_POST['nama_event'];
                                                    $keterangan_event=$_POST['keterangan_event'];
                                                    $status=$_POST['status'];
                                                    $tanggal_mulai="$tanggal_mulai $waktu_mulai";
                                                    $tanggal_selesai="$tanggal_selesai $waktu_selesai";
                                                    $tanggal_mulai_pendaftaran="$tanggal_mulai_pendaftaran $waktu_mulai_pendaftaran";
                                                    $tanggal_selesai_pendaftaran="$tanggal_selesai_pendaftaran $waktu_selesai_pendaftaran";
                                                    $entry="INSERT INTO event_setting (
                                                        tanggal_mulai,
                                                        tanggal_selesai,
                                                        mulai_pendaftaran,
                                                        selesai_pendaftaran,
                                                        nama_event,
                                                        keterangan,
                                                        status
                                                    ) VALUES (
                                                        '$tanggal_mulai',
                                                        '$tanggal_selesai',
                                                        '$tanggal_mulai_pendaftaran',
                                                        '$tanggal_selesai_pendaftaran',
                                                        '$nama_event',
                                                        '$keterangan_event',
                                                        '$status'
                                                    )";
                                                    $Input=mysqli_query($Conn, $entry);
                                                    if($Input){
                                                        $KategoriLog="Tambah Event";
                                                        $KeteranganLog="Tambah Event Berhasil";
                                                        $id_unit_kerja="";
                                                        include "../../_Config/InputLog.php";
                                                        $_SESSION ["NotifikasiSwal"]="Tambah Event Berhasil";
                                                        echo '<small class="text-success" id="NotifikasiTambahEventBerhasil">Success</small>';
                                                    }else{
                                                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
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
        }
    }
?>