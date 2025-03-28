<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set("Asia/Jakarta");
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
     //Validasi nama_unit_kerja tidak boleh kosong
    if(empty($_POST['nama_unit_kerja'])){
        echo '<small class="text-danger">Nama unot kerja tidak boleh kosong</small>';
    }else{
        //Validasi keterangan tidak boleh kosong
        if(empty($_POST['keterangan'])){
            echo '<small class="text-danger">Keterangan unit kerja tidak boleh kosong</small>';
        }else{
            //Validasi Person Responsible tidak boleh kosong
            if(empty($_POST['status'])){
                echo '<small class="text-danger">Status unit tidak boleh kosong</small>';
            }else{
                //Validasi unit tidak boleh lebih dari 25 karakter
                $JumlahKarakterUnitKerja=strlen($_POST['nama_unit_kerja']);
                if($JumlahKarakterUnitKerja>25){
                    echo '<small class="text-danger">Nama unit maksimal 25 karakter huruf</small>';
                }else{
                    //Validasi unit tidak boleh duplikat pada database
                    $nama_unit_kerja=$_POST['nama_unit_kerja'];
                    $ValidasiUnitKerja=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM unit_kerja WHERE nama_unit_kerja='$nama_unit_kerja'"));
                    if(!empty($ValidasiUnitKerja)){
                        echo '<small class="text-danger">Unit kerja yang anda gunakan sudah terdaftar</small>';
                    }else{
                        //Variabel Lainnya
                        $keterangan=$_POST['keterangan'];
                        $status=$_POST['status'];
                        $Entry="INSERT INTO unit_kerja (
                            nama_unit_kerja,
                            keterangan,
                            status
                        ) VALUES (
                            '$nama_unit_kerja',
                            '$keterangan',
                            '$status'
                        )";
                        $Input=mysqli_query($Conn, $Entry);
                        if($Input){
                            if($Input){
                                $id_unit_kerja=0;
                                $KategoriLog="Input Unit Kerja Baru";
                                $KeteranganLog="Input Unit Kerja Baru Berhasil";
                                include "../../_Config/InputLog.php";
                                $_SESSION ["NotifikasiSwal"]="Tambah Unit Kerja Berhasil";
                                echo '<small class="text-success" id="NotifikasiTambahUnitKerjaBerhasil">Success</small>';
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