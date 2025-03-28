
<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Menangkap Data
    if(empty($_POST['IdEventSettingKupon'])){
        echo '<small class="text-danger">ID Event tidak boleh kosong</small>';
    }else{
        //Validasi IdKategoriEventKupon tidak boleh kosong
        if(empty($_POST['IdKategoriEventKupon'])){
            echo '<small class="text-danger">Kategori peserta event tidak boleh kosong</small>';
        }else{
            //Validasi DiskonKupon tidak boleh kosong
            if(empty($_POST['DiskonKupon'])){
                echo '<small class="text-danger">Diskon Kupon tidak boleh kosong</small>';
            }else{
                //Validasi JumlahKupon tidak boleh kosong
                if(empty($_POST['JumlahKupon'])){
                    echo '<small class="text-danger">Jumlah Kupon tidak boleh kosong</small>';
                }else{
                    $IdEventSettingKupon=$_POST['IdEventSettingKupon'];
                    $IdKategoriEventKupon=$_POST['IdKategoriEventKupon'];
                    $DiskonKupon=$_POST['DiskonKupon'];
                    $JumlahKupon=$_POST['JumlahKupon'];
                    function generateRandomString($length = 16) {
                        $characters = '0123456789abcdefghijkLmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ';
                        $randomString = '';
                        $charLength = strlen($characters);
                        for ($i = 0; $i < $length; $i++) {
                            $randomString .= $characters[rand(0, $charLength - 1)];
                        }
                        return $randomString;
                    }
                    for ($x=0; $x<$JumlahKupon; $x++) {
                        $randomString = generateRandomString(16);
                        $ValidasiDuplikat = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_kupon WHERE kode_kupon='$randomString'"));
                        //Simpan Data
                        if(empty($ValidasiDuplikat)){
                            $entry="INSERT INTO event_kupon (
                                id_event_setting,
                                id_event_kategori,
                                kode_kupon,
                                diskon,
                                status
                            ) VALUES (
                                '$IdEventSettingKupon',
                                '$IdKategoriEventKupon',
                                '$randomString',
                                '$DiskonKupon',
                                'Belum Digunakan'
                            )";
                            $Input=mysqli_query($Conn, $entry);
                        }
                    }
                    echo '<span class="text-success" id="NotifikasiTambahKuponMultipleBerhasil">Success</span>';
                }
            }
        }
    }
?>