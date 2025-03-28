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
        //Validasi id_event_kategori tidak boleh kosong
        if(empty($_POST['id_event_kategori'])){
            echo '<small class="text-danger">Kategori Event tidak boleh kosong</small>';
        }else{
            //Validasi kategori tidak boleh kosong
            if(empty($_POST['kategori'])){
                echo '<small class="text-danger">Kategori panitia tidak boleh kosong</small>';
            }else{
                //Validasi nama_panitia  tidak boleh kosong
                if(empty($_POST['nama_panitia'])){
                    echo '<small class="text-danger">Nama panitia tidak boleh kosong</small>';
                }else{
                    //Validasi email  tidak boleh kosong
                    if(empty($_POST['email'])){
                        echo '<small class="text-danger">Email panitia tidak boleh kosong</small>';
                    }else{
                        //Validasi kontak  tidak boleh kosong
                        if(empty($_POST['kontak'])){
                            echo '<small class="text-danger">Kontak panitia tidak boleh kosong</small>';
                        }else{
                            $id_event_setting=$_POST['id_event_setting'];
                            $id_event_kategori=$_POST['id_event_kategori'];
                            $kategori=$_POST['kategori'];
                            $nama_panitia=$_POST['nama_panitia'];
                            $email=$_POST['email'];
                            $kontak=$_POST['kontak'];
                            //Validasi Duplikat
                            $ValidasiDataSama=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_panitia WHERE id_event_setting='$id_event_setting' AND id_event_kategori='$id_event_kategori' AND kategori='$kategori' AND nama_panitia='$nama_panitia' AND email='$email'"));
                            if(!empty($ValidasiDataSama)){
                                echo '<small class="text-danger">Data Panitia Event Tersebut Sudah ada</small>';
                            }else{
                                //Validasi Karakter Email
                                if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $email)) {
                                    echo '<small class="text-danger">Karakter alamat email yang digunakan tidak valid</small>';
                                }else{
                                    //Validasi Jumlah Karakter kontak
                                    if(strlen($kontak)>20){
                                        echo '<small class="text-danger">Kontak tidak boleh lebih dari 20 karakter</small>';
                                    }else{
                                        //Inisiasi File
                                        if(empty($_FILES['foto']['name'])){
                                            $NamaFileFoto="";
                                            $ValidasiFoto="Valid";
                                        }else{
                                            //nama gambar
                                            $nama_gambar=$_FILES['foto']['name'];
                                            $ukuran_gambar = $_FILES['foto']['size']; 
                                            $tipe_gambar = $_FILES['foto']['type']; 
                                            $tmp_gambar = $_FILES['foto']['tmp_name'];
                                            $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                            $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                            $FileNameRand=$key;
                                            $Pecah = explode("." , $nama_gambar);
                                            $BiasanyaNama=$Pecah[0];
                                            $Ext=$Pecah[1];
                                            $namabaru = "$FileNameRand.$Ext";
                                            $path = "../../assets/img/Panitia/".$namabaru;
                                            if($tipe_gambar== "image/jpeg"||$tipe_gambar == "image/jpg"||$tipe_gambar == "image/gif"||$tipe_gambar == "image/png"){
                                                if($ukuran_gambar<2000000){
                                                    $ValidasiDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_panitia WHERE foto='$namabaru'"));
                                                    if(!empty($ValidasiDuplikat)){
                                                        echo '<small class="text-danger">Nama File Sudah Ada</small>';
                                                    }else{
                                                        if(move_uploaded_file($tmp_gambar, $path)){
                                                            $NamaFileFoto=$namabaru;
                                                            $ValidasiFoto="Valid";
                                                        }else{
                                                            $ValidasiFoto="Upload file gagal!";
                                                        }
                                                    }
                                                }else{
                                                    $ValidasiFoto="Ukuran file tidak boleh lebih dari 2mb";
                                                }
                                            }else{
                                                $ValidasiFoto="Tipe File Hanya Boleh jpeg, jpg, gif, png";
                                            }
                                        }
                                        if($ValidasiFoto!=="Valid"){
                                            echo '<small class="text-danger">'.$ValidasiFoto.'</small>';
                                        }else{
                                            $entry="INSERT INTO event_panitia (
                                                id_event_setting,
                                                id_event_kategori,
                                                kategori,
                                                nama_panitia,
                                                email,
                                                kontak,
                                                foto
                                            ) VALUES (
                                                '$id_event_setting',
                                                '$id_event_kategori',
                                                '$kategori',
                                                '$nama_panitia',
                                                '$email',
                                                '$kontak',
                                                '$NamaFileFoto'
                                            )";
                                            $Input=mysqli_query($Conn, $entry);
                                            if($Input){
                                                $id_unit_kerja="";
                                                $KategoriLog="Tambah Panitia Event";
                                                $KeteranganLog="Tambah Panitia Event Berhasil";
                                                include "../../_Config/InputLog.php";
                                                echo '<small class="text-success" id="NotifikasiTambahPanitiaBerhasil">Success</small>';
                                            }else{
                                                echo '<small class="text-danger">Terjadi kesalahan ketika melakukan insert data</small>';
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