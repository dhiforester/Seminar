<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['id_event_jadwal'])){
        echo '<small class="text-danger">ID Jadwal tidak boleh kosong</small>';
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
                        echo '<small class="text-danger">Keterangan tidak boleh kosong</small>';
                    }else{
                        //Validasi pengisi_acara tidak boleh kosong
                        if(empty($_POST['pengisi_acara'])){
                            echo '<small class="text-danger">Pengisi acara tidak boleh kosong</small>';
                        }else{
                            //Variabel Data
                            $id_event_jadwal=$_POST['id_event_jadwal'];
                            $tanggal=$_POST['tanggal'];
                            $waktu1=$_POST['waktu1'];
                            $waktu2=$_POST['waktu2'];
                            $keterangan=$_POST['keterangan'];
                            $pengisi_acara=$_POST['pengisi_acara'];
                            $UpdateJadwal = mysqli_query($Conn,"UPDATE event_jadwal SET 
                                tanggal='$tanggal',
                                waktu1='$waktu1',
                                waktu2='$waktu2',
                                keterangan='$keterangan',
                                pengisi_acara='$pengisi_acara'
                            WHERE id_event_jadwal='$id_event_jadwal'") or die(mysqli_error($Conn)); 
                            if($UpdateJadwal){
                                $id_unit_kerja="";
                                $KategoriLog="Edit Jadwal Event";
                                $KeteranganLog="Edit Jadwal Event Berhasil";
                                include "../../_Config/InputLog.php";
                                echo '<small class="text-success" id="NotifikasiEditJadwalBerhasil">Success</small>';
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