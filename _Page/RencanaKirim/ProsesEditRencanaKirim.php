<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap variabel
    if(empty($_POST['id_rencana_kirim'])){
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
                            $id_rencana_kirim=$_POST['id_rencana_kirim'];
                            $clientId=$_POST['clientId'];
                            $tanggal_kirim=$_POST['tanggal_kirim'];
                            $no_tujuan=$_POST['no_tujuan'];
                            $status=$_POST['status'];
                            $pesan=$_POST['pesan'];
                            //Simpan Data Rencana Kirim Pesan
                            $UpdateRencanaKirimPesan = mysqli_query($Conn,"UPDATE whatsapp_rencana_kirim SET 
                                clientId='$clientId',
                                tanggal_kirim='$tanggal_kirim',
                                no_tujuan='$no_tujuan',
                                pesan='$pesan',
                                status='$status'
                            WHERE id_rencana_kirim='$id_rencana_kirim'") or die(mysqli_error($Conn)); 
                            if($UpdateRencanaKirimPesan){
                                $_SESSION ["NotifikasiSwal"]="Tambah Rencana Kirim Pesan Berhasil";
                                echo '<small class="text-success" id="NotifikasiEditRencanaKirimPesanBerhasil">Success</small>';
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