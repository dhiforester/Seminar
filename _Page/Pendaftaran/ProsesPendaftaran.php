<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/SettingEmail.php";
    session_start();
    //Time Zone
    date_default_timezone_set("Asia/Jakarta");
    $Datetime_generate=date('Y-m-d H:i:s');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['nama_akses'])){
        echo '<small class="text-danger">Nama tidak boleh kosong</small>';
    }else{
        //Validasi kontak tidak boleh kosong
        if(empty($_POST['kontak_akses'])){
            echo '<small class="text-danger">Kontak tidak boleh kosong</small>';
        }else{
            //Validasi kontak tidak boleh lebih dari 20 karakter
            $JumlahKarakterKontak=strlen($_POST['kontak_akses']);
            if($JumlahKarakterKontak>20||$JumlahKarakterKontak<6||!preg_match("/^[0-9]*$/", $_POST['kontak_akses'])){
                echo '<small class="text-danger">Kontak terdiri dari 6-20 karakter numerik</small>';
            }else{
                //Validasi kontak tidak boleh duplikat
                $kontak_akses=$_POST['kontak_akses'];
                $ValidasiKontakDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE kontak_akses='$kontak_akses'"));
                if(!empty($ValidasiKontakDuplikat)){
                    echo '<small class="text-danger">Nomor kontak tersebut sudah terdaftar</small>';
                }else{
                    //Validasi email tidak boleh kosong
                    if(empty($_POST['email_akses'])){
                        echo '<small class="text-danger">Email tidak boleh kosong</small>';
                    }else{
                        //Validasi email duplikat
                        $email_akses=$_POST['email_akses'];
                        $ValidasiEmailDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE email_akses='$email_akses'"));
                        if(!empty($ValidasiEmailDuplikat)){
                            echo '<small class="text-danger">Email sudah digunakan</small>';
                        }else{
                            //Validasi Password tidak boleh kosong
                            if(empty($_POST['password1'])){
                                echo '<small class="text-danger">Password tidak boleh kosong</small>';
                            }else{
                                if($_POST['password1']!==$_POST['password2']){
                                    echo '<small class="text-danger">Password Tidak sama</small>';
                                }else{
                                    //Validasi jumlah dan jenis karakter password
                                    $JumlahKarakterPassword=strlen($_POST['password1']);
                                    if($JumlahKarakterPassword>20||$JumlahKarakterPassword<6||!preg_match("/^[a-zA-Z0-9]*$/", $_POST['password1'])){
                                        echo '<small class="text-danger">Password can only have 6-20 numeric characters</small>';
                                    }else{
                                        //kondisi apabila akses kosong
                                        $akses="User";
                                        if(empty($akses)){
                                            echo '<small class="text-danger">Level akses tidak boleh kosong</small>';
                                        }else{
                                            $id_unit_kerja=0;
                                            //Variabel Lainnya
                                            $nama_akses=$_POST['nama_akses'];
                                            $kontak_akses=$_POST['kontak_akses'];
                                            $email_akses=$_POST['email_akses'];
                                            $status="Register";
                                            $password1=$_POST['password1'];
                                            $password1=MD5($password1);
                                            //Validasi Gambar
                                            if(empty($_FILES['image_akses']['name'])){
                                                echo '<small class="text-danger">Foto profile tidak boleh kosong</small>';
                                            }else{
                                                //nama gambar
                                                $nama_gambar=$_FILES['image_akses']['name'];
                                                //ukuran gambar
                                                $ukuran_gambar = $_FILES['image_akses']['size']; 
                                                //tipe
                                                $tipe_gambar = $_FILES['image_akses']['type']; 
                                                //sumber gambar
                                                $tmp_gambar = $_FILES['image_akses']['tmp_name'];
                                                $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                                $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                                $FileNameRand=$key;
                                                $Pecah = explode("." , $nama_gambar);
                                                $BiasanyaNama=$Pecah[0];
                                                $Ext=$Pecah[1];
                                                $namabaru = "$FileNameRand.$Ext";
                                                $path = "../../assets/img/User/".$namabaru;
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
                                                //Apabila validasi upload valid maka simpan di database
                                                if($ValidasiGambar!=="Valid"){
                                                    echo '<small class="text-danger">'.$ValidasiGambar.'</small>';
                                                }else{
                                                    //Mencari nilai id_akses terbesar
                                                    $QryMaxIdAkses=mysqli_query($Conn, "SELECT max(id_akses) as id_akses FROM akses")or die(mysqli_error($Conn));
                                                    while($HasilNilai=mysqli_fetch_array($QryMaxIdAkses)){
                                                        $id_akses_max=$HasilNilai['id_akses'];
                                                    }
                                                    $id_akses=$id_akses_max+1;
                                                    //Membuat Token Validasi
                                                    $TokenValidasi=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                                    //Apakah id_akses sudah ada token?
                                                    $CekToken=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_validasi WHERE id_akses='$id_akses'"));
                                                    if(empty($CekToken)){
                                                        //Insert Token
                                                        $EntryTokenAkses="INSERT INTO akses_validasi (
                                                            id_akses,
                                                            token,
                                                            datetime
                                                        ) VALUES (
                                                            '$id_akses',
                                                            '$TokenValidasi',
                                                            '$Datetime_generate'
                                                        )";
                                                        $GenerateToken=mysqli_query($Conn, $EntryTokenAkses);
                                                    }else{
                                                        $GenerateToken = mysqli_query($Conn,"UPDATE akses_validasi SET 
                                                            id_akses='$id_akses',
                                                            token='$TokenValidasi',
                                                            datetime='$Datetime_generate'
                                                        WHERE id_akses='$id_akses'") or die(mysqli_error($Conn)); 
                                                    }
                                                    if($GenerateToken){
                                                        //Kirim Email
                                                        $subjek_email="Validasi Email Pendaftaran $title_page";
                                                        $isi_email="$pesan_validasi_email <a href=$base_url/ValidasiEmail.php?Token=$TokenValidasi>Klik Disini</a>";
                                                        $datetime_email=strtotime(date('Y-m-d H:i:s'));
                                                        $email_tujuan=$email_akses;
                                                        $nama_tujuan= $nama_akses;
                                                        //Mengirim Email
                                                        include "../../_Config/SendEmail.php";
                                                        if($GetPesan!=="Email Terkirim"){
                                                            echo '<small class="text-danger">Terjadi kesalahan pada saat mengirim email validasi</small>';
                                                        }else{
                                                            //Simpan Log Email
                                                            include "../../_Config/InputLogEmail.php";
                                                            if(!$InputLogEmail){
                                                                echo '<small class="text-danger">Terjadi kesalahan pada saat mengirim log email validasi</small>';
                                                            }else{
                                                                $entry="INSERT INTO akses (
                                                                    id_akses,
                                                                    nama_akses,
                                                                    kontak_akses,
                                                                    email_akses,
                                                                    password,
                                                                    image_akses,
                                                                    akses,
                                                                    status,
                                                                    datetime_daftar,
                                                                    datetime_update
                                                                ) VALUES (
                                                                    '$id_akses',
                                                                    '$nama_akses',
                                                                    '$kontak_akses',
                                                                    '$email_akses',
                                                                    '$password1',
                                                                    '$namabaru',
                                                                    '$akses',
                                                                    '$status',
                                                                    '$now',
                                                                    '$now'
                                                                )";
                                                                $Input=mysqli_query($Conn, $entry);
                                                                if($Input){
                                                                    $_SESSION ["NotifikasiSwal"]="Pendaftaran Berhasil";
                                                                    echo '<small class="text-success" id="NotifikasiPendaftaranBerhasil">Success</small>';
                                                                }else{
                                                                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                                                                }
                                                            }
                                                        }
                                                    }else{
                                                        echo '<small class="text-danger">Terjadi kesalahan pada saat membuat kode validasi akun</small>';
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