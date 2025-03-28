<?php
    //Validasi id_akses tidak boleh kosong
    if(empty($_POST['id_akses'])){
        echo '<small class="text-danger">ID Undangan tidak boleh kosong</small>';
    }else{
        //Validasi tanggal tidak boleh kosong
        if(empty($_POST['tanggal'])){
            echo '<small class="text-danger">Tanggal tidak boleh kosong</small>';
        }else{
            //Validasi waktu tidak boleh kosong
            if(empty($_POST['waktu'])){
                echo '<small class="text-danger">Waktu tidak boleh kosong</small>';
            }else{
                //Validasi status tidak boleh kosong
                if(empty($_POST['status'])){
                    echo '<small class="text-danger">Status tidak boleh kosong</small>';
                }else{
                    $id_event= $_POST['id_event'];
                    $kategori_absen= $_POST['kategori_absen'];
                    $id_akses= $_POST['id_akses'];
                    $tanggal= $_POST['tanggal'];
                    $waktu= $_POST['waktu'];
                    $status= $_POST['status'];
                    $tanggal_absen="$tanggal $waktu";
                    //Buka data askes
                    $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                    $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                    $nama= $DataDetailAkses['nama_akses'];
                    $kontak= $DataDetailAkses['kontak_akses'];
                    $email = $DataDetailAkses['email_akses'];
                    //Cari unit kerja
                    $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja_anggota WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                    $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                    if(!empty($DataUnitKerja['id_unit_kerja'])){
                        $id_unit_kerja= $DataUnitKerja['id_unit_kerja'];
                        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                        $unit_instansi= $DataUnitKerja['nama_unit_kerja'];
                    }else{
                        $id_unit_kerja="0";
                        $unit_instansi="0";
                    }
                    $ValidasiDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_absen WHERE tanggal_absen='$tanggal_absen' AND nama='$nama'"));
                    if(!empty($ValidasiDuplikat)){
                        echo '<small class="text-danger">Data tersebut sudah terdaftar</small>';
                    }else{
                        if(!empty($_FILES['foto']['name'])){
                            //nama gambar
                            $nama_gambar=$_FILES['foto']['name'];
                            //ukuran gambar
                            $ukuran_gambar = $_FILES['foto']['size']; 
                            //tipe
                            $tipe_gambar = $_FILES['foto']['type']; 
                            //sumber gambar
                            $tmp_gambar = $_FILES['foto']['tmp_name'];
                            $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                            $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                            $FileNameRand=$key;
                            $Pecah = explode("." , $nama_gambar);
                            $BiasanyaNama=$Pecah[0];
                            $Ext=$Pecah[1];
                            $namabaru = "$FileNameRand.$Ext";
                            $path = "../../assets/img/Absen/".$namabaru;
                            if($tipe_gambar == "image/jpeg"||$tipe_gambar == "image/jpg"||$tipe_gambar == "image/gif"||$tipe_gambar == "image/png"){
                                if($ukuran_gambar<2000000){
                                    if(move_uploaded_file($tmp_gambar, $path)){
                                        $ValidasiGambar="Valid";
                                    }else{
                                        $ValidasiGambar="Upload file gambar gagal";
                                    }
                                }else{
                                    $ValidasiGambar="File gambar tidak boleh lebih dari 2 mb";
                                }
                            }else{
                                $ValidasiGambar="tipe file hanya boleh JPG, JPEG, PNG and GIF";
                            }
                        }else{
                            $ValidasiGambar="Valid";
                            $namabaru="";
                        }
                        //Apabila validasi upload valid maka simpan di database
                        if($ValidasiGambar!=="Valid"){
                            echo '<small class="text-danger">'.$ValidasiGambar.'</small>';
                        }else{
                            $entry="INSERT INTO event_absen (
                                id_event,
                                id_akses,
                                id_unit_kerja,
                                id_event_undangan,
                                ex_in,
                                nama,
                                unit_instansi,
                                kontak,
                                email,
                                tanggal_absen,
                                foto,
                                status
                            ) VALUES (
                                '$id_event',
                                '$id_akses',
                                '$id_unit_kerja',
                                '0',
                                'Internal',
                                '$nama',
                                '$unit_instansi',
                                '$kontak',
                                '$email',
                                '$tanggal_absen',
                                '$namabaru',
                                '$status'
                            )";
                            $Input=mysqli_query($Conn, $entry);
                            if($Input){
                                $KategoriLog="Input Absen Baru";
                                $KeteranganLog="Input Absen Baru Berhasil";
                                include "../../_Config/InputLog.php";
                                $_SESSION ["NotifikasiSwal"]="Tambah Absen Berhasil";
                                echo '<small class="text-success" id="NotifikasiTambahAbsenBerhasil">Success</small>';
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