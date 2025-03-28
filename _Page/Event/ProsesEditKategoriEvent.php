<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_event_kategori tidak boleh kosong
    if(empty($_POST['id_event_kategori'])){
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
                    $id_event_kategori=$_POST['id_event_kategori'];
                    $kategori=$_POST['kategori'];
                    $harga_tiket=$_POST['harga_tiket'];
                    $kuota=$_POST['kuota'];
                    if(empty($_POST['keterangan'])){
                        $keterangan="";
                    }else{
                        $keterangan=$_POST['keterangan'];
                    }
                    if(empty($_POST['biaya_adm'])){
                        $biaya_adm="";
                    }else{
                        $biaya_adm=$_POST['biaya_adm'];
                    }
                    $Update = mysqli_query($Conn,"UPDATE event_kategori SET 
                        kategori='$kategori',
                        keterangan='$keterangan',
                        harga_tiket='$harga_tiket',
                        biaya_adm='$biaya_adm',
                        kuota='$kuota'
                    WHERE id_event_kategori='$id_event_kategori'") or die(mysqli_error($Conn)); 
                    if($Update){
                        $id_unit_kerja="";
                        $KategoriLog="Edit Kategori Event";
                        $KeteranganLog="Edit Kategori Event Berhasil";
                        $_SESSION ["NotifikasiSwal"]="Edit Kategori Event Berhasil";
                        include "../../_Config/InputLog.php";
                        echo '<small class="text-success" id="NotifikasiEditKategoriEventBerhasil">Success</small>';
                    }else{
                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                    }
                }
            }
        }
    }
?>