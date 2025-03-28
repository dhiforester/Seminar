<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    $tanggal=date('Y-m-d H:i:s');
    //Validasi kategori tidak boleh kosong
    if(empty($_POST['kategori'])){
        echo '<small class="text-danger">Kategori File Event tidak boleh kosong</small>';
    }else{
        //Validasi id_event tidak boleh kosong
        if(empty($_POST['id_event'])){
            echo '<small class="text-danger">ID Event tidak boleh kosong</small>';
        }else{
            //Validasi title_file tidak boleh kosong
            if(empty($_POST['title_file'])){
                echo '<small class="text-danger">Judul File tidak boleh kosong</small>';
            }else{
                //Validasi deskripsi tidak boleh kosong
                if(empty($_POST['deskripsi'])){
                    echo '<small class="text-danger">Deskripsi File tidak boleh kosong</small>';
                }else{
                    $id_event= $_POST['id_event'];
                    $kategori= $_POST['kategori'];
                    $title_file= $_POST['title_file'];
                    $deskripsi= $_POST['deskripsi'];
                    if($kategori=="Dokumen"||$kategori=="Gambar/Foto"){
                        if(empty($_FILES['file_name']['name'])){
                            echo '<small class="text-danger">File tidak boleh kosong</small>';
                        }else{
                            //nama gambar
                            $nama_gambar=$_FILES['file_name']['name'];
                            //ukuran gambar
                            $ukuran_gambar = $_FILES['file_name']['size']; 
                            //tipe
                            $tipe_gambar = $_FILES['file_name']['type']; 
                            //sumber gambar
                            $tmp_gambar = $_FILES['file_name']['tmp_name'];
                            $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                            $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                            $FileNameRand=$key;
                            $Pecah = explode("." , $nama_gambar);
                            $BiasanyaNama=$Pecah[0];
                            $Ext=$Pecah[1];
                            $namabaru = "$FileNameRand.$Ext";
                            $path = "../../assets/img/Dokumen/".$namabaru;
                            if($tipe_gambar== "image/jpeg"||$tipe_gambar == "image/jpg"||$tipe_gambar == "image/gif"||$tipe_gambar == "image/png"||$tipe_gambar == "application/pdf"||$tipe_gambar == "application/vnd.openxmlformats-officedocument.presentationml.presentation"||$tipe_gambar == "application/vnd.ms-excel"||$tipe_gambar == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){
                                if($ukuran_gambar<2000000){
                                    $ValidasiDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_file WHERE file_name='$namabaru'"));
                                    if(!empty($ValidasiDuplikat)){
                                        echo '<small class="text-danger">Data tersebut sudah terdaftar</small>';
                                    }else{
                                        if(move_uploaded_file($tmp_gambar, $path)){
                                            $entry="INSERT INTO event_file (
                                                id_event,
                                                id_akses,
                                                kategori,
                                                title_file,
                                                deskripsi,
                                                file_type,
                                                file_size,
                                                file_name,
                                                tanggal
                                            ) VALUES (
                                                '$id_event',
                                                '$SessionIdAkses',
                                                '$kategori',
                                                '$title_file',
                                                '$deskripsi',
                                                '$tipe_gambar',
                                                '$ukuran_gambar',
                                                '$namabaru',
                                                '$tanggal'
                                            )";
                                            $Input=mysqli_query($Conn, $entry);
                                            if($Input){
                                                $id_unit_kerja="0";
                                                $KategoriLog="Input File Baru";
                                                $KeteranganLog="Input File Baru Berhasil";
                                                include "../../_Config/InputLog.php";
                                                echo '<small class="text-success" id="NotifikasiTambahFileBerhasil">Success</small>';
                                            }else{
                                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                                            }
                                        }else{
                                            echo '<small class="text-danger">Upload File Gagal</small>';
                                        }
                                    }
                                }else{
                                    echo '<small class="text-danger">File Tidak Boleh Lebih Dari 2 mb</small>';
                                }
                            }else{
                                echo '<small class="text-danger">Tipe File '.$tipe_gambar.' anda ilegal</small>';
                            }
                        }
                    }else{
                        $namabaru= $_POST['file_name'];
                        $ValidasiDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_file WHERE file_name='$namabaru'"));
                        if(!empty($ValidasiDuplikat)){
                            echo '<small class="text-danger">Data tersebut sudah terdaftar</small>';
                        }else{
                            $entry="INSERT INTO event_file (
                                id_event,
                                id_akses,
                                kategori,
                                title_file,
                                deskripsi,
                                file_type,
                                file_size,
                                file_name,
                                tanggal
                            ) VALUES (
                                '$id_event',
                                '$SessionIdAkses',
                                '$kategori',
                                '$title_file',
                                '$deskripsi',
                                '',
                                '',
                                '$namabaru',
                                '$tanggal'
                            )";
                            $Input=mysqli_query($Conn, $entry);
                            if($Input){
                                $id_unit_kerja="0";
                                $KategoriLog="Input File Baru";
                                $KeteranganLog="Input File Baru Berhasil";
                                include "../../_Config/InputLog.php";
                                echo '<small class="text-success" id="NotifikasiTambahFileBerhasil">Success</small>';
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