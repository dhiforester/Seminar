<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_akses'])){
        echo '<span class="text-danger">ID Akses Tidak Boleh Kosong</span>';
    }else{
        if(empty($_POST['tanggal'])){
            echo '<span class="text-danger">Tanggal Tidak Boleh Kosong</span>';
        }else{
            if(empty($_POST['jam'])){
                echo '<span class="text-danger">Jam Tidak Boleh Kosong</span>';
            }else{
                if(empty($_POST['id_unit_kerja'])){
                    echo '<span class="text-danger">Unit Kerja Tidak Boleh Kosong</span>';
                }else{
                    if(empty($_POST['status'])){
                        echo '<span class="text-danger">Status Agenda Tidak Boleh Kosong</span>';
                    }else{
                        if(empty($_POST['kategori'])){
                            echo '<span class="text-danger">Kategori Agenda Tidak Boleh Kosong</span>';
                        }else{
                            if(empty($_POST['agenda'])){
                                echo '<span class="text-danger">Keterangan Agenda Tidak Boleh Kosong</span>';
                            }else{
                                $id_akses=$_POST['id_akses'];
                                $tanggal=$_POST['tanggal'];
                                $jam=$_POST['jam'];
                                $id_unit_kerja=$_POST['id_unit_kerja'];
                                $status=$_POST['status'];
                                $kategori=$_POST['kategori'];
                                $agenda=$_POST['agenda'];
                                $TanggalJam="$tanggal $jam";
                                //Validasi Duplikat Data
                                $ValidasiDuplikat = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda WHERE id_akses='$id_akses' AND tanggal='$TanggalJam' AND status='$status' AND kategori='$kategori' AND agenda='$agenda' AND id_unit_kerja='$id_unit_kerja'"));
                                if(!empty($ValidasiDuplikat)){
                                    echo '<span class="text-danger">Data Sudah Ada, Silahkan input yang lain</span>';
                                }else{
                                    //Simpan Data
                                    $entry="INSERT INTO agenda (
                                        id_akses,
                                        id_unit_kerja,
                                        tanggal,
                                        kategori,
                                        agenda,
                                        status
                                    ) VALUES (
                                        '$id_akses',
                                        '$id_unit_kerja',
                                        '$TanggalJam',
                                        '$kategori',
                                        '$agenda',
                                        '$status'
                                    )";
                                    $Input=mysqli_query($Conn, $entry);
                                    if($Input){
                                        $KategoriLog="Input Agenda Kegiatan";
                                        $KeteranganLog="Input Agenda Kegiatan Berhasil";
                                        include "../../_Config/InputLog.php";
                                        $_SESSION ["NotifikasiSwal"]="Tambah Agenda Berhasil";
                                        echo '<small class="text-success" id="NotifikasiTambahAgendaBerhasil">Success</small>';
                                    }else{
                                        echo '<span class="text-danger">Terjadi Kesalahan pada saat menyimpan data</span>';
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