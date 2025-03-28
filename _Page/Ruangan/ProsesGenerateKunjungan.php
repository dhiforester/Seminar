<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi tahun tidak boleh kosong
    if(empty($_POST['tahun'])){
        echo '<small class="text-danger">Tahun tidak boleh kosong</small>';
    }else{
        //Validasi Bulan tidak boleh kosong
        if(empty($_POST['bulan'])){
            echo '<small class="text-danger">Bulan tidak boleh kosong</small>';
        }else{
             //Validasi count1 tidak boleh kosong
            if(empty($_POST['count1'])){
                echo '<small class="text-danger">count1 tidak boleh kosong</small>';
            }else{
                //Validasi count2 tidak boleh kosong
                if(empty($_POST['count2'])){
                    echo '<small class="text-danger">count2 tidak boleh kosong</small>';
                }else{
                     //Validasi time1 tidak boleh kosong
                    if(empty($_POST['time1'])){
                        echo '<small class="text-danger">time1 tidak boleh kosong</small>';
                    }else{
                        //Validasi time2 tidak boleh kosong
                        if(empty($_POST['time2'])){
                            echo '<small class="text-danger">time2 tidak boleh kosong</small>';
                        }else{
                            //Validasi id_ruangan tidak boleh kosong
                            if(empty($_POST['id_ruangan'])){
                                echo '<small class="text-danger">ID Ruangan tidak boleh kosong</small>';
                            }else{
                                //Variabel Lainnya
                                $tahun=$_POST['tahun'];
                                $bulan=$_POST['bulan'];
                                $count1=$_POST['count1'];
                                $count2=$_POST['count2'];
                                $time1=$_POST['time1'];
                                $time2=$_POST['time2'];
                                $id_ruangan=$_POST['id_ruangan'];
                                //Cari jumlah hari
                                $jumHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                //Lakukan perulangan berdasarkan jumlah hari
                                for ( $i=1; $i<=$jumHari; $i++ ){
                                    //Tanggal
                                    $tanggal=sprintf("%02d", $i);
                                    $bulan=sprintf("%02d", $bulan);
                                    //Random count
                                    $RandomCount=rand($count1, $count2);
                                    //Perilangan count
                                    for ( $a=1; $a<=$RandomCount; $a++ ){
                                        $JumlahKunjungan=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM list_kunjungan"));
                                        $RandomJam=rand($time1, $time2);
                                        $jam="$RandomJam:00";
                                        //Menentukan jam
                                        $RandomIdKunjungan=rand(1, $JumlahKunjungan);
                                        //Buka detail kunjungan
                                        $QryKunjungan = mysqli_query($Conn,"SELECT * FROM list_kunjungan WHERE id_kunjungan='$RandomIdKunjungan'")or die(mysqli_error($Conn));
                                        $DataKunjungan = mysqli_fetch_array($QryKunjungan);
                                        if(!empty($DataKunjungan['nama'])){
                                            $nama= $DataKunjungan['nama'];
                                            $unit= $DataKunjungan['unit'];
                                            $datetime="$tahun-$bulan-$tanggal $jam";
                                            $signature= $DataKunjungan['signature'];
                                            $entry="INSERT INTO list_kunjungan (
                                                id_ruangan,
                                                datetime,
                                                nama,
                                                unit,
                                                signature
                                            ) VALUES (
                                                '$id_ruangan',
                                                '$datetime',
                                                '$nama',
                                                '$unit',
                                                '$signature'
                                            )";
                                            $Input=mysqli_query($Conn, $entry);
                                            if($Input){
                                                echo '<small class="text-success">'.$datetime.'</small><br>';
                                            }else{
                                                echo '<small class="text-danger">Generate Gagal</small><br>';
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
