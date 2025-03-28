<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_event_setting tidak boleh kosong
    if(empty($_POST['id_event_setting'])){
        echo '<small class="text-danger">ID Event tidak boleh kosong</small>';
    }else{
        //Validasi tanggal tidak boleh kosong
        if(empty($_POST['tanggal'])){
            echo '<small class="text-danger">Tanggal tidak boleh kosong</small>';
        }else{
            //Validasi waktu1 tidak boleh kosong
            if(empty($_POST['waktu1'])){
                echo '<small class="text-danger">Waktu Mulai tidak boleh kosong</small>';
            }else{
                //Validasi waktu2 tidak boleh kosong
                if(empty($_POST['waktu2'])){
                    echo '<small class="text-danger">Waktu Selesai tidak boleh kosong</small>';
                }else{
                    //Validasi keterangan tidak boleh kosong
                    if(empty($_POST['keterangan'])){
                        echo '<small class="text-danger">Keterangan Event tidak boleh kosong</small>';
                    }else{
                        //Validasi pengisi_acara tidak boleh kosong
                        if(empty($_POST['pengisi_acara'])){
                            echo '<small class="text-danger">Pengisi Acara Event tidak boleh kosong</small>';
                        }else{
                            //Variabel Data
                            $id_event_setting=$_POST['id_event_setting'];
                            $tanggal=$_POST['tanggal'];
                            $waktu1=$_POST['waktu1'];
                            $waktu2=$_POST['waktu2'];
                            $keterangan=$_POST['keterangan'];
                            $pengisi_acara=$_POST['pengisi_acara'];
                            $ValidasiDataSama=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_jadwal WHERE id_event_setting='$id_event_setting' AND tanggal='$tanggal' AND waktu1='$waktu1' AND waktu2='$waktu2' AND keterangan='$keterangan'"));
                            if(!empty($ValidasiDataSama)){
                                echo '<small class="text-danger">Data Jadwal Event Tersebut Sudah ada</small>';
                            }else{
                                $entry="INSERT INTO event_jadwal (
                                    id_event_setting,
                                    tanggal,
                                    waktu1,
                                    waktu2,
                                    keterangan,
                                    pengisi_acara
                                ) VALUES (
                                    '$id_event_setting',
                                    '$tanggal',
                                    '$waktu1',
                                    '$waktu2',
                                    '$keterangan',
                                    '$pengisi_acara'
                                )";
                                $Input=mysqli_query($Conn, $entry);
                                if($Input){
                                    $id_unit_kerja="";
                                    $KategoriLog="Tambah Jadwal Event";
                                    $KeteranganLog="Tambah Jadwal Event Berhasil";
                                    include "../../_Config/InputLog.php";
                                    echo '<small class="text-success" id="NotifikasiTambahJadwalBerhasil">Success</small>';
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