<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    $tanggal_input=date('Y-m-d');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['nama'])){
        echo '<small class="text-danger">Nama tidak boleh kosong</small>';
    }else{
        //Validasi kategori_barang tidak boleh kosong
        if(empty($_POST['kategori_barang'])){
            echo '<small class="text-danger">Kategori barang tidak boleh kosong</small>';
        }else{
            //Validasi kategori_asset tidak boleh kosong
            if(empty($_POST['kategori_asset'])){
                echo '<small class="text-danger">Kategori asset barang tidak boleh kosong</small>';
            }else{
                //Validasi kondisi tidak boleh kosong
                if(empty($_POST['kondisi'])){
                    echo '<small class="text-danger">Kategori kondisi barang tidak boleh kosong</small>';
                }else{
                    //Validasi ketersediaan tidak boleh kosong
                    if(empty($_POST['ketersediaan'])){
                        echo '<small class="text-danger">Kategori ketersediaan barang tidak boleh kosong</small>';
                    }else{
                        //Validasi lokasi tidak boleh kosong
                        if(empty($_POST['lokasi'])){
                            echo '<small class="text-danger">Lokasi penyimpanan barang tidak boleh kosong</small>';
                        }else{
                            //Validasi satuan tidak boleh kosong
                            if(empty($_POST['satuan'])){
                                echo '<small class="text-danger">Satuan barang tidak boleh kosong</small>';
                            }else{
                                //Validasi qty tidak boleh kosong
                                if(empty($_POST['qty'])){
                                    echo '<small class="text-danger">Jumlah barang tidak boleh kosong</small>';
                                }else{
                                    //Buat variabel
                                    $kode=date('YmdHis');
                                    $nama=$_POST['nama'];
                                    $kategori_barang=$_POST['kategori_barang'];
                                    $kategori_asset=$_POST['kategori_asset'];
                                    $kondisi=$_POST['kondisi'];
                                    $ketersediaan=$_POST['ketersediaan'];
                                    $lokasi=$_POST['lokasi'];
                                    $satuan=$_POST['satuan'];
                                    $qty=$_POST['qty'];
                                    if(empty($_POST['nomor_serial'])){
                                        $nomor_serial="";
                                        $ValidasiNomorSerial="0";
                                    }else{
                                        $nomor_serial=$_POST['nomor_serial'];
                                        $ValidasiNomorSerial=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE nomor_serial='$nomor_serial'"));
                                    }
                                    if(empty($_POST['spesifikasi'])){
                                        $spesifikasi="";
                                    }else{
                                        $spesifikasi=$_POST['spesifikasi'];
                                    }
                                    if(empty($_POST['tanggal_beli'])){
                                        $tanggal_beli="";
                                    }else{
                                        $tanggal_beli=$_POST['tanggal_beli'];
                                    }
                                    if(empty($_POST['tanggal_garansi'])){
                                        $tanggal_garansi="";
                                    }else{
                                        $tanggal_garansi=$_POST['tanggal_garansi'];
                                    }
                                    if(empty($_POST['id_unit_kerja'])){
                                        $id_unit_kerja="0";
                                        $nama_unit_kerja="";
                                    }else{
                                        $id_unit_kerja=$_POST['id_unit_kerja'];
                                        //Buka unit kerja
                                        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                                        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                                        $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                                    }
                                    //Validasi kategori_barang tidak boleh lebih dari 20 karakter
                                    $JumlahKategoriBarang=strlen($_POST['kategori_barang']);
                                    if($JumlahKategoriBarang>25||$JumlahKategoriBarang<6){
                                        echo '<small class="text-danger">Kategori barang terdiri dari 6-25 karakter</small>';
                                    }else{
                                        $ValidasiBarangDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE nama='$nama'"));
                                        if(!empty($ValidasiBarangDuplikat)){
                                            echo '<small class="text-danger">Barang tersebut sudah terdaftar</small>';
                                        }else{
                                            $ValidasiKodeDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE kode='$kode'"));
                                            if(!empty($ValidasiKodeDuplikat)){
                                                echo '<small class="text-danger">Kode Barang tersebut sudah terdaftar</small>';
                                            }else{
                                                if(!empty($ValidasiNomorSerial)){
                                                    echo '<small class="text-danger">Seri Barang tersebut sudah terdaftar</small>';
                                                }else{
                                                    if(!empty($_FILES['gambar']['name'])){
                                                        //nama gambar
                                                        $nama_gambar=$_FILES['gambar']['name'];
                                                        //ukuran gambar
                                                        $ukuran_gambar = $_FILES['gambar']['size']; 
                                                        //tipe
                                                        $tipe_gambar = $_FILES['gambar']['type']; 
                                                        //sumber gambar
                                                        $tmp_gambar = $_FILES['gambar']['tmp_name'];
                                                        $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                                        $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                                        $FileNameRand=$key;
                                                        $Pecah = explode("." , $nama_gambar);
                                                        $BiasanyaNama=$Pecah[0];
                                                        $Ext=$Pecah[1];
                                                        $namabaru = "$FileNameRand.$Ext";
                                                        $path = "../../assets/img/Inventaris/".$namabaru;
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
                                                        $entry="INSERT INTO inventaris (
                                                            id_akses,
                                                            id_unit_kerja,
                                                            nama_unit_kerja,
                                                            kode,
                                                            nama,
                                                            kategori_barang,
                                                            kategori_asset,
                                                            spesifikasi,
                                                            nomor_serial,
                                                            gambar,
                                                            kondisi,
                                                            ketersediaan,
                                                            lokasi,
                                                            qty,
                                                            satuan,
                                                            tanggal_beli,
                                                            tanggal_garansi,
                                                            tanggal_input
                                                        ) VALUES (
                                                            '$SessionIdAkses',
                                                            '$id_unit_kerja',
                                                            '$nama_unit_kerja',
                                                            '$kode',
                                                            '$nama',
                                                            '$kategori_barang',
                                                            '$kategori_asset',
                                                            '$spesifikasi',
                                                            '$nomor_serial',
                                                            '$namabaru',
                                                            '$kondisi',
                                                            '$ketersediaan',
                                                            '$lokasi',
                                                            '$qty',
                                                            '$satuan',
                                                            '$tanggal_beli',
                                                            '$tanggal_garansi',
                                                            '$tanggal_input'
                                                        )";
                                                        $Input=mysqli_query($Conn, $entry);
                                                        if($Input){
                                                            $KategoriLog="Inventaris";
                                                            $KeteranganLog="Input Inventaris Baru Berhasil";
                                                            include "../../_Config/InputLog.php";
                                                            $_SESSION ["NotifikasiSwal"]="Tambah Inventaris Berhasil";
                                                            echo '<small class="text-success" id="NotifikasiTambahInventarisBerhasil">Success</small>';
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
?>