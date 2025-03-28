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
        //Validasi label_sesi tidak boleh kosong
        if(empty($_POST['label_sesi'])){
            echo '<small class="text-danger">Label/Nama Sesi tidak boleh kosong</small>';
        }else{
            //Validasi tanggal_mulai tidak boleh kosong
            if(empty($_POST['tanggal_mulai'])){
                echo '<small class="text-danger">Tanggal mulai tidak boleh kosong</small>';
            }else{
                //Validasi jam_mulai tidak boleh kosong
                if(empty($_POST['jam_mulai'])){
                    echo '<small class="text-danger">Jam mulai tidak boleh kosong</small>';
                }else{
                    //Validasi tanggal_selesai tidak boleh kosong
                    if(empty($_POST['tanggal_selesai'])){
                        echo '<small class="text-danger">Tanggal selesai tidak boleh kosong</small>';
                    }else{
                        //Validasi jam_selesai tidak boleh kosong
                        if(empty($_POST['jam_selesai'])){
                            echo '<small class="text-danger">jam selesai tidak boleh kosong</small>';
                        }else{
                            //Variabel Data
                            $id_event_setting=$_POST['id_event_setting'];
                            $label_sesi=$_POST['label_sesi'];
                            $tanggal_mulai=$_POST['tanggal_mulai'];
                            $jam_mulai=$_POST['jam_mulai'];
                            $tanggal_selesai=$_POST['tanggal_selesai'];
                            $jam_selesai=$_POST['jam_selesai'];
                            //Assemble
                            $TanggalMulai2="$tanggal_mulai $jam_mulai";
                            $TanggalSelesai2="$tanggal_selesai $jam_selesai";
                            //Konversi Ke STRTOTIME
                            $TanggalMulai=strtotime($TanggalMulai2);
                            $TanggalSelesai=strtotime($TanggalSelesai2);
                            if($TanggalSelesai<$TanggalMulai){
                                echo '<small class="text-danger">Tanggal mulai tidak boleh lebih besar dari tanggal selesai!</small>';
                            }else{
                                $ValidasiDataSama=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_sesi_absen WHERE id_event_setting='$id_event_setting' AND label_sesi='$label_sesi' AND tanggal_mulai='$TanggalMulai' AND tanggal_selesai='$TanggalSelesai'"));
                                if(!empty($ValidasiDataSama)){
                                    echo '<small class="text-danger">Data Sesi Tersebut Sudah ada</small>';
                                }else{
                                    $entry="INSERT INTO event_sesi_absen (
                                        id_event_setting,
                                        label_sesi,
                                        tanggal_mulai,
                                        tanggal_selesai
                                    ) VALUES (
                                        '$id_event_setting',
                                        '$label_sesi',
                                        '$TanggalMulai2',
                                        '$TanggalSelesai2'
                                    )";
                                    $Input=mysqli_query($Conn, $entry);
                                    if($Input){
                                        $id_unit_kerja="";
                                        $KategoriLog="Absensi";
                                        $KeteranganLog="Tambah Sesi Absensi Berhasil";
                                        include "../../_Config/InputLog.php";
                                        echo '<small class="text-success" id="NotifikasiTambahSesiAbsenBerhasil">Success</small>';
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
?>