<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    $TanggalDaftar=date('Y-m-d H:i');
    //Validasi id_peserta tidak boleh kosong
    if(empty($_POST['id_peserta'])){
        echo '<small class="text-danger">ID Peserta tidak boleh kosong</small>';
    }else{
        //Validasi id_event_kategori tidak boleh kosong
        if(empty($_POST['id_event_kategori'])){
            echo '<small class="text-danger">ID Kategori tidak boleh kosong</small>';
        }else{
            //Validasi id_event_setting tidak boleh kosong
            if(empty($_POST['id_event_setting'])){
                echo '<small class="text-danger">ID Event tidak boleh kosong</small>';
            }else{
                //Validasi id_event_sesi_absen tidak boleh kosong
                if(empty($_POST['id_event_sesi_absen'])){
                    echo '<small class="text-danger">ID Sesi Absen tidak boleh kosong</small>';
                }else{
                    //Validasi tanggal tidak boleh kosong
                    if(empty($_POST['tanggal'])){
                        echo '<small class="text-danger">Tanggal Absen tidak boleh kosong</small>';
                    }else{
                        //Validasi jam tidak boleh kosong
                        if(empty($_POST['jam'])){
                            echo '<small class="text-danger">Jam Absen tidak boleh kosong</small>';
                        }else{
                            //Validasi metode tidak boleh kosong
                            if(empty($_POST['metode'])){
                                echo '<small class="text-danger">Metode Absen tidak boleh kosong</small>';
                            }else{
                                //Variabel Lainnya
                                $id_peserta=$_POST['id_peserta'];
                                $id_event_kategori=$_POST['id_event_kategori'];
                                $id_event_setting=$_POST['id_event_setting'];
                                $id_event_sesi_absen=$_POST['id_event_sesi_absen'];
                                $tanggal=$_POST['tanggal'];
                                $jam=$_POST['jam'];
                                $metode=$_POST['metode'];
                                //Assemble
                                $TanggalAbsen="$tanggal $jam";
                                $TanggalSekarang=strtotime($TanggalAbsen);
                                //Buka Detail Peserta
                                $QryDetailPeserta = mysqli_query($Conn,"SELECT * FROM event_peserta WHERE id_peserta='$id_peserta'")or die(mysqli_error($Conn));
                                $DataDetailPeserta = mysqli_fetch_array($QryDetailPeserta);
                                $status_pembayaran= $DataDetailPeserta['status_pembayaran'];
                                //Buka Sesi Absensi
                                $QryEvent= mysqli_query($Conn,"SELECT * FROM event_sesi_absen WHERE id_event_sesi_absen='$id_event_sesi_absen'")or die(mysqli_error($Conn));
                                $DataEvent= mysqli_fetch_array($QryEvent);
                                $id_event_sesi_absen= $DataEvent['id_event_sesi_absen'];
                                $label_sesi= $DataEvent['label_sesi'];
                                $tanggal_mulai= $DataEvent['tanggal_mulai'];
                                $tanggal_selesai= $DataEvent['tanggal_selesai'];
                                $tanggal_mulai=strtotime($tanggal_mulai);
                                $tanggal_selesai=strtotime($tanggal_selesai);
                                if($status_pembayaran!=="Lunas"){
                                    echo '<small class="text-danger">Peserta belum melakukan pembayaran!</small>';
                                }else{
                                    if($TanggalSekarang<$tanggal_mulai){
                                        echo '<small class="text-danger">Sesi Kehadiran Belum Dibuka!</small>';
                                    }else{
                                        if($TanggalSekarang>$tanggal_selesai){
                                            echo '<small class="text-danger">Sesi Kehadiran Sudah Ditutup!</small>';
                                        }else{
                                            if($TanggalSekarang<$tanggal_selesai&&$TanggalSekarang>$tanggal_mulai){
                                                //Cek Duplikat Data
                                                $QryKehadiran = mysqli_query($Conn,"SELECT * FROM event_absen WHERE id_peserta='$id_peserta' AND id_event_sesi_absen='$id_event_sesi_absen'")or die(mysqli_error($Conn));
                                                $DataKehadiran = mysqli_fetch_array($QryKehadiran);
                                                if(!empty($DataKehadiran['id_event_absen'])){
                                                    echo '<small class="text-danger">Peserta Sudah Mengisi Absen!</small>';
                                                }else{
                                                    $entry="INSERT INTO event_absen (
                                                        id_event_sesi_absen,
                                                        id_event_setting,
                                                        id_event_kategori,
                                                        id_peserta,
                                                        tanggal,
                                                        metode
                                                    ) VALUES (
                                                        '$id_event_sesi_absen',
                                                        '$id_event_setting',
                                                        '$id_event_kategori',
                                                        '$id_peserta',
                                                        '$TanggalAbsen',
                                                        '$metode'
                                                    )";
                                                    $ProsesAbsen=mysqli_query($Conn, $entry);
                                                    if($ProsesAbsen){
                                                        $KategoriLog="Absensi";
                                                        $KeteranganLog="Tambah Absensi Berhasil";
                                                        $id_unit_kerja="";
                                                        include "../../_Config/InputLog.php";
                                                        $_SESSION ["NotifikasiSwal"]="Tambah Absensi Berhasil";
                                                        echo '<small class="text-success" id="NotifikasiTambahKehadiranBerhasil">Success</small>';
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