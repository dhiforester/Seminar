<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['id_akses'])){
        echo '<small class="text-danger">ID Akses tidak boleh kosong</small>';
    }else{
        //Validasi tanggal_request tidak boleh kosong
        if(empty($_POST['tanggal_request'])){
            echo '<small class="text-danger">Tanggal Request tidak boleh kosong</small>';
        }else{
            //Validasi waktu_request tidak boleh kosong
            if(empty($_POST['waktu_request'])){
                echo '<small class="text-danger">Waktu Request tidak boleh kosong</small>';
            }else{
                //Validasi id_unit_kerja tidak boleh kosong
                if(empty($_POST['id_unit_kerja'])){
                    echo '<small class="text-danger">ID Unit Kerja tidak boleh kosong</small>';
                }else{
                    //Validasi kategori_dukungan tidak boleh kosong
                    if(empty($_POST['kategori_dukungan'])){
                        echo '<small class="text-danger">Kategori Dukungan tidak boleh kosong</small>';
                    }else{
                       //Validasi keterangan_dukungan tidak boleh kosong
                        if(empty($_POST['keterangan_dukungan'])){
                            echo '<small class="text-danger">Keterangan Dukungan tidak boleh kosong</small>';
                        }else{
                            //Validasi judul_dukungan tidak boleh kosong
                            if(empty($_POST['judul_dukungan'])){
                                echo '<small class="text-danger">Judul Dukungan tidak boleh kosong</small>';
                            }else{
                                //Variabel Data
                                $id_akses=$_POST['id_akses'];
                                $tanggal_request=$_POST['tanggal_request'];
                                $waktu_request=$_POST['waktu_request'];
                                $id_unit_kerja=$_POST['id_unit_kerja'];
                                $judul_dukungan=$_POST['judul_dukungan'];
                                $kategori_dukungan=$_POST['kategori_dukungan'];
                                $keterangan_dukungan=$_POST['keterangan_dukungan'];
                                $tanggal_request="$tanggal_request $waktu_request";
                                //Validasi Dduplikat ddaa
                                $ValiadsiDuplikatData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan WHERE id_akses='$id_akses' AND tanggal_request='$tanggal_request' AND id_unit_kerja='$id_unit_kerja' AND judul_dukungan='$judul_dukungan'"));
                                
                                if(!empty($ValiadsiDuplikatData)){
                                    echo '<small class="text-danger">Data Dukungan Tersebut Sudah Ada</small>';
                                }else{
                                    $entry="INSERT INTO dukungan (
                                        id_akses,
                                        id_unit_kerja,
                                        tanggal_request,
                                        tanggal_response,
                                        tanggal_selesai,
                                        judul_dukungan,
                                        kategori_dukungan,
                                        keterangan_dukungan,
                                        status_dukungan
                                    ) VALUES (
                                        '$id_akses',
                                        '$id_unit_kerja',
                                        '$tanggal_request',
                                        '0',
                                        '0',
                                        '$judul_dukungan',
                                        '$kategori_dukungan',
                                        '$keterangan_dukungan',
                                        'Request'
                                    )";
                                    $Input=mysqli_query($Conn, $entry);
                                    if($Input){
                                        $KategoriLog="Kirim Request Dukungan";
                                        $KeteranganLog="Kirim Request Dukungan Berhasil";
                                        include "../../_Config/InputLog.php";
                                        $_SESSION ["NotifikasiSwal"]="Kirim Request Dukungan Berhasil";
                                        echo '<small class="text-success" id="NotifikasiTambahDukunganBerhasil">Success</small>';
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
?>