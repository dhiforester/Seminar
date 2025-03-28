<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set("Asia/Jakarta");
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
     //Validasi id_akses tidak boleh kosong
    if(empty($_POST['id_akses'])){
        echo '<small class="text-danger">ID Akses tidak boleh kosong</small>';
    }else{
        //Validasi id_unit_kerja tidak boleh kosong
        if(empty($_POST['id_unit_kerja'])){
            echo '<small class="text-danger">ID Unit Kerja tidak boleh kosong</small>';
        }else{
            //Validasi Nama Unit kerja tidak boleh kosong
            if(empty($_POST['nama_unit_kerja'])){
                echo '<small class="text-danger">Nama unit kerja tidak boleh kosong</small>';
            }else{
                if(empty($_POST['nama_akses'])){
                    echo '<small class="text-danger">Nama Akses Tidak Boleh Kosong</small>';
                }else{
                    if(empty($_POST['jabatan'])){
                        echo '<small class="text-danger">Jabatan Personil Tidak Boleh Kosong</small>';
                    }else{
                        if(empty($_POST['level'])){
                            echo '<small class="text-danger">Level Personil Tidak Boleh Kosong</small>';
                        }else{
                            //Variabel Lainnya
                            $id_akses=$_POST['id_akses'];
                            $id_unit_kerja=$_POST['id_unit_kerja'];
                            $nama_unit_kerja=$_POST['nama_unit_kerja'];
                            $nama_anggota=$_POST['nama_akses'];
                            $jabatan=$_POST['jabatan'];
                            $level=$_POST['level'];
                            $ValidasiAnggotaUnitKerja=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_akses='$id_akses' AND id_unit_kerja='$id_unit_kerja'"));
                            if(!empty($ValidasiAnggotaUnitKerja)){
                                echo '<small class="text-danger">Anggota Unit kerja yang anda gunakan sudah terdaftar</small>';
                            }else{
                                $Entry="INSERT INTO unit_kerja_anggota (
                                    id_unit_kerja,
                                    id_akses,
                                    nama_anggota,
                                    jabatan,
                                    level
                                ) VALUES (
                                    '$id_unit_kerja',
                                    '$id_akses',
                                    '$nama_anggota',
                                    '$jabatan',
                                    '$level'
                                )";
                                $Input=mysqli_query($Conn, $Entry);
                                if($Input){
                                    if($Input){
                                        $id_unit_kerja=0;
                                        $KategoriLog="Input Anggota Unit Kerja Baru";
                                        $KeteranganLog="Input Anggota Unit Kerja Baru Berhasil";
                                        include "../../_Config/InputLog.php";
                                        $_SESSION ["NotifikasiSwal"]="Tambah Anggota Unit Kerja Berhasil";
                                        echo '<small class="text-success" id="NotifikasiTambahAnggotaUnitKerjaBerhasil">Success</small>';
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