<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_waktu_henti tidak boleh kosong
    if(empty($_POST['id_waktu_henti'])){
        echo '<small class="text-danger">ID kejadian waktu henti tidak boleh kosong</small>';
    }else{
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
                            $id_waktu_henti=$_POST['id_waktu_henti'];
                            $tanggal_mulai=$_POST['tanggal_mulai'];
                            $waktu_mulai=$_POST['waktu_mulai'];
                            $kategori=$_POST['kategori'];
                            $keterangan=$_POST['keterangan'];
                            $status=$_POST['status'];
                            $tanggal_mulai="$tanggal_mulai $waktu_mulai";
                            $UpdateWaktuHenti = mysqli_query($Conn,"UPDATE waktu_henti SET 
                                tanggal_mulai='$tanggal_mulai',
                                tanggal_selesai='$tanggal_selesai',
                                kategori='$kategori',
                                keterangan='$keterangan',
                                status='$status'
                            WHERE id_waktu_henti='$id_waktu_henti'") or die(mysqli_error($Conn)); 
                            if($UpdateWaktuHenti){
                                $id_unit_kerja="0";
                                $KategoriLog="Waktu Henti";
                                $KeteranganLog="Edit Waktu Henti Berhasil";
                                include "../../_Config/InputLog.php";
                                echo '<small class="text-success" id="NotifikasiEditWaktuHentiBerhasil">Success</small>';
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