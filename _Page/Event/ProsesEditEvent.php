<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['id_event_setting'])){
        echo '<small class="text-danger">ID Event tidak boleh kosong</small>';
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
                                                    $id_event_setting=$_POST['id_event_setting'];
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
                                                    $UpdateEvent = mysqli_query($Conn,"UPDATE event_setting SET 
                                                        tanggal_mulai='$tanggal_mulai',
                                                        tanggal_selesai='$tanggal_selesai',
                                                        mulai_pendaftaran='$tanggal_mulai_pendaftaran',
                                                        selesai_pendaftaran='$tanggal_selesai_pendaftaran',
                                                        nama_event='$nama_event',
                                                        keterangan='$keterangan_event',
                                                        status='$status'
                                                    WHERE id_event_setting='$id_event_setting'") or die(mysqli_error($Conn)); 
                                                    if($UpdateEvent){
                                                        $KategoriLog="Edit Event";
                                                        $KeteranganLog="Edit Event Berhasil";
                                                        $id_unit_kerja="";
                                                        include "../../_Config/InputLog.php";
                                                        $_SESSION ["NotifikasiSwal"]="Edit Event Berhasil";
                                                        echo '<small class="text-success" id="NotifikasiEditEventBerhasil">Success</small>';
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