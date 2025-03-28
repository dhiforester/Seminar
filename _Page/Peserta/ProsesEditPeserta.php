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
                            //Validasi email tidak boleh kosong
                            if(empty($_POST['email'])){
                                echo '<small class="text-danger">Email tidak boleh kosong</small>';
                            }else{
                                //Validasi organization tidak boleh kosong
                                if(empty($_POST['organization'])){
                                    echo '<small class="text-danger">Informasi Organization akses tidak boleh kosong</small>';
                                }else{
                                    if(empty($_POST['status_validasi'])){
                                        echo '<small class="text-danger">Status Validasi tidak boleh kosong</small>';
                                    }else{
                                        //Variabel Lainnya
                                        $id_peserta=$_POST['id_peserta'];
                                        $id_event_setting=$_POST['id_event_setting'];
                                        $id_event_kategori=$_POST['id_event_kategori'];
                                        $nama=$_POST['nama'];
                                        $kontak=$_POST['kontak'];
                                        $email=$_POST['email'];
                                        $organization=$_POST['organization'];
                                        $status_validasi=$_POST['status_validasi'];
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
                                        //Validasi kontak tidak boleh duplikat
                                        $QryDetailPeserta = mysqli_query($Conn,"SELECT * FROM event_peserta WHERE id_peserta='$id_peserta'")or die(mysqli_error($Conn));
                                        $DataDetailPeserta = mysqli_fetch_array($QryDetailPeserta);
                                        $KontakPeserta= $DataDetailPeserta['kontak'];
                                        $EmailPeserta= $DataDetailPeserta['email'];
                                        if($KontakPeserta==$kontak){
                                            $ValidasiKontakDuplikat="";
                                        }else{
                                            $ValidasiKontakDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE kontak='$kontak'"));
                                        }
                                        if($EmailPeserta==$email){
                                            $ValidasiEmailDuplikat="";
                                        }else{
                                            $ValidasiEmailDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE email='$email'"));
                                        }
                                        if(!empty($ValidasiKontakDuplikat)){
                                            echo '<small class="text-danger">Nomor kontak tersebut sudah terdaftar</small>';
                                        }else{
                                            //Validasi email duplikat
                                            if(!empty($ValidasiEmailDuplikat)){
                                                echo '<small class="text-danger">Email sudah digunakan</small>';
                                            }else{
                                                $UpdatePeserta = mysqli_query($Conn,"UPDATE event_peserta SET 
                                                    id_event_setting='$id_event_setting',
                                                    id_event_kategori='$id_event_kategori',
                                                    nama='$nama',
                                                    kontak='$kontak',
                                                    email='$email',
                                                    alamat='$alamat',
                                                    kota='$kota',
                                                    kode_pos='$kode_pos',
                                                    organization='$organization',
                                                    status_validasi='$status_validasi'
                                                WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn)); 
                                                if($UpdatePeserta){
                                                    $KategoriLog="Edit Peserta Manual";
                                                    $KeteranganLog="Edit Peserta Manual Berhasil";
                                                    $id_unit_kerja="";
                                                    include "../../_Config/InputLog.php";
                                                    $_SESSION ["NotifikasiSwal"]="Edit Peserta Berhasil";
                                                    echo '<small class="text-success" id="NotifikasiEditPesertaBerhasil">Success</small>';
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
?>