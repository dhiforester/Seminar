<?php
    //Koneksi
    include "../../_Config/Connection.php";
    //Validasi nama tidak boleh kosong
    if(empty($_POST['id_event_absen'])){
        echo '<small class="text-danger">ID Absensi tidak boleh kosong</small>';
    }else{
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
                            $id_event_absen= $_POST['id_event_absen'];
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
                                $UpdateAbsen = mysqli_query($Conn,"UPDATE event_absen SET 
                                    nama='$nama',
                                    unit_instansi='$unit_instansi',
                                    kontak='$kontak',
                                    email='$email',
                                    tanggal_absen='$tanggal_absen',
                                    foto='$namabaru',
                                    status='$status'
                                WHERE id_event_absen='$id_event_absen'") or die(mysqli_error($Conn)); 
                                if($UpdateAbsen){
                                    echo '<small class="text-success" id="NotifikasiEditAbsenBerhasil">Success</small>';
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