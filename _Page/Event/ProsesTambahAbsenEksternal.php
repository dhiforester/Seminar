<?php
    //Validasi nama tidak boleh kosong
    if(empty($_POST['nama'])){
        echo '<small class="text-danger">Nama tidak boleh kosong</small>';
    }else{
        //Validasi unit_instansi tidak boleh kosong
        if(empty($_POST['unit_instansi'])){
            echo '<small class="text-danger">Unit/Instansi tidak boleh kosong</small>';
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
                        $nama= $_POST['nama'];
                        $unit_instansi= $_POST['unit_instansi'];
                        //Validasi kontak tidak boleh kosong
                        if(empty($_POST['kontak'])){
                            $kontak="0";
                        }else{
                            $kontak= $_POST['kontak'];
                        }
                        //Validasi email tidak boleh kosong
                        if(empty($_POST['email'])){
                            $email="0";
                        }else{
                            $email= $_POST['email'];
                        }
                        $tanggal= $_POST['tanggal'];
                        $waktu= $_POST['waktu'];
                        $status= $_POST['status'];
                        $tanggal_absen="$tanggal $waktu";
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
                                    '0',
                                    '0',
                                    '0',
                                    'Eksternal',
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
                                    $id_unit_kerja="0";
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
    }
?>