<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    $TanggalDaftar=date('Y-m-d H:i');
    //Validasi id_event_setting tidak boleh kosong
    if(empty($_POST['id_event_setting'])){
        echo '<small class="text-danger">ID Event tidak boleh kosong</small>';
    }else{
        //Validasi id_event_kategori tidak boleh kosong
        if(empty($_POST['id_event_kategori'])){
            echo '<small class="text-danger">ID Kategori tidak boleh kosong</small>';
        }else{
            //Validasi nama tidak boleh kosong
            if(empty($_POST['nama'])){
                echo '<small class="text-danger">Nama Peserta tidak boleh kosong</small>';
            }else{
                //Validasi kontak tidak boleh kosong
                if(empty($_POST['kontak'])){
                    echo '<small class="text-danger">Kontak tidak boleh kosong</small>';
                }else{
                    //Validasi kontak tidak boleh lebih dari 20 karakter
                    $JumlahKarakterKontak=strlen($_POST['kontak']);
                    if($JumlahKarakterKontak>20||$JumlahKarakterKontak<6||!preg_match("/^[0-9]*$/", $_POST['kontak'])){
                        echo '<small class="text-danger">Kontak terdiri dari 6-20 karakter numerik</small>';
                    }else{
                        //Validasi kontak tidak boleh duplikat
                        $kontak=$_POST['kontak'];
                        $ValidasiKontakDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE kontak='$kontak'"));
                        if(!empty($ValidasiKontakDuplikat)){
                            echo '<small class="text-danger">Nomor kontak tersebut sudah terdaftar</small>';
                        }else{
                            //Validasi email tidak boleh kosong
                            if(empty($_POST['email'])){
                                echo '<small class="text-danger">Email tidak boleh kosong</small>';
                            }else{
                                //Validasi email duplikat
                                $email=$_POST['email'];
                                $ValidasiEmailDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE email='$email'"));
                                if(!empty($ValidasiEmailDuplikat)){
                                    echo '<small class="text-danger">Email sudah digunakan</small>';
                                }else{
                                    //Validasi organization tidak boleh kosong
                                    if(empty($_POST['organization'])){
                                        echo '<small class="text-danger">Informasi Organization akses tidak boleh kosong</small>';
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
                                                    if(empty($_POST['status_validasi'])){
                                                        echo '<small class="text-danger">Status Validasi tidak boleh kosong</small>';
                                                    }else{
                                                        //Variabel Lainnya
                                                        $id_event_setting=$_POST['id_event_setting'];
                                                        $id_event_kategori=$_POST['id_event_kategori'];
                                                        $nama=$_POST['nama'];
                                                        $kontak=$_POST['kontak'];
                                                        $email=$_POST['email'];
                                                        $organization=$_POST['organization'];
                                                        $status_validasi=$_POST['status_validasi'];
                                                        $status_pembayaran="Pending";
                                                        $password1=$_POST['password1'];
                                                        $password1=MD5($password1);
                                                        //Form Tidak wajib
                                                        if(empty($_POST['alamat'])){
                                                            $alamat="";
                                                        }else{
                                                            $alamat=$_POST['alamat'];
                                                        }
                                                        if(empty($_POST['kota'])){
                                                            $kota="";
                                                        }else{
                                                            $kota=$_POST['kota'];
                                                        }
                                                        if(empty($_POST['kode_pos'])){
                                                            $kode_pos="";
                                                        }else{
                                                            $kode_pos=$_POST['kode_pos'];
                                                        }
                                                        if(empty($_POST['link_validasi'])){
                                                            $link_validasi="";
                                                        }else{
                                                            $link_validasi=$_POST['link_validasi'];
                                                        }
                                                        if(empty($_POST['link_payment'])){
                                                            $link_payment="";
                                                        }else{
                                                            $link_payment=$_POST['link_payment'];
                                                        }
                                                        //Buka Detail Kuota
                                                        $QryKategoriEvent= mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
                                                        $DataKategoriEvent= mysqli_fetch_array($QryKategoriEvent);
                                                        $KuotaPeserta= $DataKategoriEvent['kuota'];
                                                        //Melihat Jumlah Peserta Sekarang
                                                        $JumlahPesertaSekarang = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE id_event_kategori='$id_event_kategori'"));
                                                        $JumlahPesertaSekarang=$JumlahPesertaSekarang+1;
                                                        if($JumlahPesertaSekarang>$KuotaPeserta){
                                                            echo '<small class="text-danger">Kuota sudah penuh!</small>';
                                                        }else{
                                                            $entry="INSERT INTO event_peserta (
                                                                id_event_setting,
                                                                id_event_kategori,
                                                                tanggal_daftar,
                                                                nama,
                                                                kontak,
                                                                email,
                                                                organization,
                                                                password,
                                                                status_validasi,
                                                                status_pembayaran,
                                                                alamat,
                                                                kota,
                                                                kode_pos,
                                                                link_validasi,
                                                                link_payment
                                                            ) VALUES (
                                                                '$id_event_setting',
                                                                '$id_event_kategori',
                                                                '$TanggalDaftar',
                                                                '$nama',
                                                                '$kontak',
                                                                '$email',
                                                                '$organization',
                                                                '$password1',
                                                                '$status_validasi',
                                                                '$status_pembayaran',
                                                                '$alamat',
                                                                '$kota',
                                                                '$kode_pos',
                                                                '$link_validasi',
                                                                '$link_payment'
                                                            )";
                                                            $Input=mysqli_query($Conn, $entry);
                                                            if($Input){
                                                                $KategoriLog="Input Peserta Manual";
                                                                $KeteranganLog="Input Peserta Manual Berhasil";
                                                                $id_unit_kerja="";
                                                                include "../../_Config/InputLog.php";
                                                                $_SESSION ["NotifikasiSwal"]="Tambah Peserta Berhasil";
                                                                echo '<small class="text-success" id="NotifikasiTambahPesertaBerhasil">Success</small>';
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
        }
    }
?>