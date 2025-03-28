<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_agenda tidak boleh kosong
    if(empty($_POST['id_agenda'])){
        echo '<small class="text-danger">ID Dukungan tidak boleh kosong</small>';
    }else{
        //Validasi id_unit_kerja tidak boleh kosong
        if(empty($_POST['id_unit_kerja'])){
            echo '<small class="text-danger">Unit Kerja tidak boleh kosong</small>';
        }else{
            //Validasi tanggal tidak boleh kosong
            if(empty($_POST['tanggal'])){
                echo '<small class="text-danger">Tanggal pengerjaan tidak boleh kosong</small>';
            }else{
                //Validasi jam tidak boleh kosong
                if(empty($_POST['jam'])){
                    echo '<small class="text-danger">Jam pengerjaan tidak boleh kosong</small>';
                }else{
                    //Validasi kategori_kerja tidak boleh kosong
                    if(empty($_POST['kategori_kerja'])){
                        echo '<small class="text-danger">Kategori pengerjaan tidak boleh kosong</small>';
                    }else{
                        //Validasi keterangan tidak boleh kosong
                        if(empty($_POST['keterangan'])){
                            echo '<small class="text-danger">Keterangan pengerjaan tidak boleh kosong</small>';
                        }else{
                            //Variabel Lainnya
                            $id_agenda=$_POST['id_agenda'];
                            $id_unit_kerja=$_POST['id_unit_kerja'];
                            $tanggal=$_POST['tanggal'];
                            $jam=$_POST['jam'];
                            $kategori_kerja=$_POST['kategori_kerja'];
                            $keterangan=$_POST['keterangan'];
                            $tanggal="$tanggal $jam";
                            //Validasi data yang sama
                            $ValidasiDataSama=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE tanggal='$tanggal' AND kategori_kerja='$kategori_kerja'"));
                            if(!empty($ValidasiDataSama)){
                                echo '<small class="text-danger">Data Yang Sama Sudah Ada</small>';
                            }else{
                                //Validasi kategori tidak boleh lebih dari 20 karakter
                                $JumlahKarakterKategori=strlen($_POST['kategori_kerja']);
                                if($JumlahKarakterKategori>25){
                                    echo '<small class="text-danger">Kategori Tidak Boleh Lebih Dari 25 Karakter</small>';
                                }else{
                                    //Validasi Gambar
                                    if(!empty($_FILES['gambar_kerja']['name'])){
                                        //nama gambar
                                        $nama_gambar=$_FILES['gambar_kerja']['name'];
                                        //ukuran gambar
                                        $ukuran_gambar = $_FILES['gambar_kerja']['size']; 
                                        //tipe
                                        $tipe_gambar = $_FILES['gambar_kerja']['type']; 
                                        //sumber gambar
                                        $tmp_gambar = $_FILES['gambar_kerja']['tmp_name'];
                                        $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                        $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                        $FileNameRand=$key;
                                        $Pecah = explode("." , $nama_gambar);
                                        $BiasanyaNama=$Pecah[0];
                                        $Ext=$Pecah[1];
                                        $namabaru = "$FileNameRand.$Ext";
                                        $path = "../../assets/img/Kerja/".$namabaru;
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
                                        $entry="INSERT INTO riwayat_kerja (
                                            id_akses,
                                            id_unit_kerja,
                                            id_dukungan,
                                            id_agenda,
                                            id_event,
                                            nama,
                                            tanggal,
                                            kategori_kerja,
                                            keterangan,
                                            gambar_kerja
                                        ) VALUES (
                                            '$SessionIdAkses',
                                            '$id_unit_kerja',
                                            '0',
                                            '$id_agenda',
                                            '0',
                                            '$SessionNama',
                                            '$tanggal',
                                            '$kategori_kerja',
                                            '$keterangan',
                                            '$namabaru'
                                        )";
                                        $Input=mysqli_query($Conn, $entry);
                                        if($Input){
                                            $KategoriLog="Input Riwayat Kerja";
                                            $KeteranganLog="Input Riwayat Kerja Berhasil";
                                            include "../../_Config/InputLog.php";
                                            $_SESSION ["NotifikasiSwal"]="Tambah Riwayat Kerja Berhasil";
                                            echo '<small class="text-success" id="NotifikasiSimpanRiwayatKerjaBerhasil">Success</small>';

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
?>