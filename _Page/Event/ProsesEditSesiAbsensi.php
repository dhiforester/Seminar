<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['id_event_sesi_absen'])){
        echo '<small class="text-danger">ID Sesi Absensi tidak boleh kosong</small>';
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
                            $id_event_sesi_absen=$_POST['id_event_sesi_absen'];
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
                                $UpdateSesiAbsensi = mysqli_query($Conn,"UPDATE event_sesi_absen SET 
                                    label_sesi='$label_sesi',
                                    tanggal_mulai='$TanggalMulai2',
                                    tanggal_selesai='$TanggalSelesai2'
                                WHERE id_event_sesi_absen='$id_event_sesi_absen'") or die(mysqli_error($Conn)); 
                                if($UpdateSesiAbsensi){
                                    $id_unit_kerja="";
                                    $KategoriLog="Absensi";
                                    $KeteranganLog="Edit Sesi Absensi Berhasil";
                                    include "../../_Config/InputLog.php";
                                    echo '<small class="text-success" id="NotifikasiEditSesiAbsenBerhasil">Success</small>';
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
?>