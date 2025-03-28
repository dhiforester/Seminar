<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['id_event'])){
        echo '<small class="text-danger">ID Event tidak boleh kosong</small>';
    }else{
        //Validasi in_ex tidak boleh kosong
        if(empty($_POST['in_ex2'])){
            echo '<small class="text-danger">Kategori Internal/Eksternal tidak boleh kosong</small>';
        }else{
            $id_event= $_POST['id_event'];
            $in_ex= $_POST['in_ex2'];
            if($in_ex=="Internal"){
                //Validasi id_akses tidak boleh kosong
                if(empty($_POST['id_akses'])){
                    echo '<small class="text-danger">Nama Pengguna/Akses tidak boleh kosong</small>';
                }else{
                    $id_akses=$_POST['id_akses'];
                    //Buka data askes
                    $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                    $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                    $nama_undangan= $DataDetailAkses['nama_akses'];
                    $kontak= $DataDetailAkses['kontak_akses'];
                    $email= $DataDetailAkses['email_akses'];
                    //Cari unit kerja askes
                    $QryUnit = mysqli_query($Conn,"SELECT * FROM unit_kerja_anggota WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                    $DataUnit = mysqli_fetch_array($QryUnit);
                    if(!empty($DataUnit['id_unit_kerja'])){
                        $id_unit_kerja= $DataUnit['id_unit_kerja'];
                        //Nama Unit Kerja
                        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                        $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                    }else{
                        $nama_unit_kerja="None";
                        $id_unit_kerja="0";
                    }
                    $ValidasiDataSama=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_undangan WHERE id_event='$id_event' AND in_ex='$in_ex' AND nama='$nama_undangan' AND kontak='$kontak' AND email='$email'"));
                    if(!empty($ValidasiDataSama)){
                        echo '<small class="text-danger">Data Undangan Event Tersebut Sudah ada</small>';
                    }else{
                        $entry="INSERT INTO event_undangan (
                            id_event,
                            id_akses,
                            id_unit_kerja,
                            in_ex,
                            nama,
                            unit_instansi,
                            kontak,
                            email,
                            status
                        ) VALUES (
                            '$id_event',
                            '$id_akses',
                            '$id_unit_kerja',
                            '$in_ex',
                            '$nama_undangan',
                            '$nama_unit_kerja',
                            '$kontak',
                            '$email',
                            'None'
                        )";
                        $Input=mysqli_query($Conn, $entry);
                        if($Input){
                            $KategoriLog="Tambah Undangan Event";
                            $KeteranganLog="Tambah Undangan Event Berhasil";
                            include "../../_Config/InputLog.php";
                            echo '<small class="text-success" id="NotifikasiTambahUndanganBerhasil">Success</small>';
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                        }
                    }
                }
            }else{
                if(empty($_POST['nama_undangan'])){
                    echo '<small class="text-danger">Nama Undangan tidak boleh kosong</small>';
                }else{
                    if(empty($_POST['unit_instansi'])){
                        echo '<small class="text-danger">Unit/Instansi tidak boleh kosong</small>';
                    }else{
                        if(empty($_POST['email_undangan'])){
                            echo '<small class="text-danger">Email tidak boleh kosong</small>';
                        }else{
                            if(empty($_POST['kontak_undangan'])){
                                echo '<small class="text-danger">Kotak tidak boleh kosong</small>';
                            }else{
                                $id_akses=0;
                                $id_unit_kerja=0;
                                $nama_undangan= $_POST['nama_undangan'];
                                $unit_instansi= $_POST['unit_instansi'];
                                $email_undangan= $_POST['email_undangan'];
                                $kontak_undangan= $_POST['kontak_undangan'];
                                $ValidasiDataSama=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_undangan WHERE id_event='$id_event' AND in_ex='$in_ex' AND nama='$nama_undangan' AND kontak='$kontak_undangan' AND email='$email_undangan'"));
                                if(!empty($ValidasiDataSama)){
                                    echo '<small class="text-danger">Data Undangan Event Tersebut Sudah ada</small>';
                                }else{
                                    $entry="INSERT INTO event_undangan (
                                        id_event,
                                        id_akses,
                                        id_unit_kerja,
                                        in_ex,
                                        nama,
                                        unit_instansi,
                                        kontak,
                                        email,
                                        status
                                    ) VALUES (
                                        '$id_event',
                                        '$id_akses',
                                        '$id_unit_kerja',
                                        '$in_ex',
                                        '$nama_undangan',
                                        '$unit_instansi',
                                        '$kontak_undangan',
                                        '$email_undangan',
                                        'None'
                                    )";
                                    $Input=mysqli_query($Conn, $entry);
                                    if($Input){
                                        $KategoriLog="Tambah Undangan Event";
                                        $KeteranganLog="Tambah Undangan Event Berhasil";
                                        include "../../_Config/InputLog.php";
                                        echo '<small class="text-success" id="NotifikasiTambahUndanganBerhasil">Success</small>';
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