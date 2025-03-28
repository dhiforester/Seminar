<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_event_setting tidak boleh kosong
    if(empty($_POST['id_event_setting'])){
        echo '<small class="text-danger">ID Event tidak boleh kosong</small>';
    }else{
        //Validasi kategori tidak boleh kosong
        if(empty($_POST['kategori'])){
            echo '<small class="text-danger">Kategori peserta event tidak boleh kosong</small>';
        }else{
            //Validasi harga_tiket tidak boleh kosong
            if(empty($_POST['harga_tiket'])){
                echo '<small class="text-danger">Harga tiket tidak boleh kosong</small>';
            }else{
                //Validasi kuota tidak boleh kosong
                if(empty($_POST['kuota'])){
                    echo '<small class="text-danger">Kuota Peserta tidak boleh kosong</small>';
                }else{
                    //Variabel Data
                    $id_event_setting=$_POST['id_event_setting'];
                    $kategori=$_POST['kategori'];
                    $harga_tiket=$_POST['harga_tiket'];
                    $kuota=$_POST['kuota'];
                    if(empty($_POST['keterangan'])){
                        $keterangan="";
                    }else{
                        $keterangan=$_POST['keterangan'];
                    }
                    if(empty($_POST['biaya_adm'])){
                        $biaya_adm=0;
                    }else{
                        $biaya_adm=$_POST['biaya_adm'];
                    }
                    //Validasi Duplikat
                    $id_event_kategori=getDataDetail($Conn,'event_kategori','kategori',$kategori,'id_event_kategori');
                    if(!empty($id_event_kategori)){
                        echo '<small class="text-danger">Kategori event tersebut sudah ada</small>';
                    }else{
                        $entry="INSERT INTO event_kategori (
                            id_event_setting,
                            kategori,
                            keterangan,
                            harga_tiket,
                            biaya_adm,
                            kuota
                        ) VALUES (
                            '$id_event_setting',
                            '$kategori',
                            '$keterangan',
                            '$harga_tiket',
                            '$biaya_adm',
                            '$kuota'
                        )";
                        $Input=mysqli_query($Conn, $entry);
                        if($Input){
                            $id_unit_kerja="";
                            $KategoriLog="Tambah Kategori Event";
                            $KeteranganLog="Tambah Kategori Event Berhasil";
                            $_SESSION ["NotifikasiSwal"]="Tambah Kategori Event Berhasil";
                            include "../../_Config/InputLog.php";
                            echo '<small class="text-success" id="NotifikasiTambahKategoriEventBerhasil">Success</small>';
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                        }
                    }
                }
            }
        }
    }
?>