<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap variabel
    if(empty($_POST['id_mitra'])){
        echo '<span class="text-danger">ID Mitra Tidak Boleh</span>';
    }else{
        if(empty($_POST['clientId'])){
            echo '<span class="text-danger">Client ID Tidak Boleh</span>';
        }else{
            if(empty($_POST['tanggal_kirim'])){
                echo '<span class="text-danger">Tanggal Kirim Tidak Boleh</span>';
            }else{
                if(empty($_POST['no_tujuan'])){
                    echo '<span class="text-danger">Nomor Tujuan Tidak Boleh</span>';
                }else{
                    if(empty($_POST['status'])){
                        echo '<span class="text-danger">Status Tidak Boleh</span>';
                    }else{
                        if(empty($_POST['pesan'])){
                            echo '<span class="text-danger">Isi Pesan Tidak Boleh</span>';
                        }else{
                            //Buat Variabel
                            $id_mitra=$_POST['id_mitra'];
                            $clientId=$_POST['clientId'];
                            $tanggal_kirim=$_POST['tanggal_kirim'];
                            $no_tujuan=$_POST['no_tujuan'];
                            $status=$_POST['status'];
                            $pesan=$_POST['pesan'];
                            //Simpan Data
                            $entry="INSERT INTO whatsapp_rencana_kirim (
                                id_mitra,
                                clientId,
                                tanggal_kirim,
                                no_tujuan,
                                pesan,
                                status
                            ) VALUES (
                                '$id_mitra',
                                '$clientId',
                                '$tanggal_kirim',
                                '$no_tujuan',
                                '$pesan',
                                '$status'
                            )";
                            $Input=mysqli_query($Conn, $entry);
                            if($Input){
                                $KategoriLog="Input Rencana Kirim Pesan";
                                $KeteranganLog="Input Rencana Kirim Pesan Berhasil";
                                include "../../_Config/InputLog.php";
                                $_SESSION ["NotifikasiSwal"]="Tambah Rencana Kirim Pesan Berhasil";
                                echo '<small class="text-success" id="NotifikasiTambahRencanaKirimPesanBerhasil">Success</small>';
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