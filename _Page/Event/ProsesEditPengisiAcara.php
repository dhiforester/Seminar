<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_event_pengisi_acara tidak boleh kosong
    if(empty($_POST['id_event_pengisi_acara'])){
        echo '<small class="text-danger">ID Pengisi Acara tidak boleh kosong</small>';
    }else{
        //Validasi nama tidak boleh kosong
        if(empty($_POST['nama'])){
            echo '<small class="text-danger">Nama tidak boleh kosong</small>';
        }else{
            //Validasi email tidak boleh kosong
            if(empty($_POST['email'])){
                echo '<small class="text-danger">Email panitia tidak boleh kosong</small>';
            }else{
                //Validasi kontak  tidak boleh kosong
                if(empty($_POST['kontak'])){
                    echo '<small class="text-danger">Kontak panitia tidak boleh kosong</small>';
                }else{
                    //Validasi organization  tidak boleh kosong
                    if(empty($_POST['organization'])){
                        echo '<small class="text-danger">Organization panitia tidak boleh kosong</small>';
                    }else{
                        //Validasi kategori  tidak boleh kosong
                        if(empty($_POST['kategori'])){
                            echo '<small class="text-danger">Kategori panitia tidak boleh kosong</small>';
                        }else{
                            $id_event_pengisi_acara=$_POST['id_event_pengisi_acara'];
                            $nama=$_POST['nama'];
                            $email=$_POST['email'];
                            $kontak=$_POST['kontak'];
                            $organization=$_POST['organization'];
                            $kategori=$_POST['kategori'];
                            $FotoLama=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_event_pengisi_acara,'foto');
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
                                        $NamaFileFoto=$FotoLama;
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
                                        $path = "../../assets/img/pengisi_acara/".$namabaru;
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
                                        $Update = mysqli_query($Conn,"UPDATE event_pengisi_acara SET 
                                            nama='$nama',
                                            kontak='$kontak',
                                            email='$email',
                                            kategori='$kategori',
                                            organization='$organization',
                                            foto='$NamaFileFoto'
                                        WHERE id_event_pengisi_acara='$id_event_pengisi_acara'") or die(mysqli_error($Conn)); 
                                        if($Update){
                                            echo '<small class="text-success" id="NotifikasiEditPengisiAcaraBerhasil">Success</small>';
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
?>