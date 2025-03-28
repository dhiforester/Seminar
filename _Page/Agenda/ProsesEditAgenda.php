<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_agenda'])){
        echo '<span class="text-danger">ID Agenda Tidak Boleh Kosong</span>';
    }else{
        if(empty($_POST['tanggal'])){
            echo '<span class="text-danger">Tanggal Tidak Boleh Kosong</span>';
        }else{
            if(empty($_POST['jam'])){
                echo '<span class="text-danger">Jam Tidak Boleh Kosong</span>';
            }else{
                if(empty($_POST['id_unit_kerja'])){
                    echo '<span class="text-danger">Unit Kerja Tidak Boleh Kosong</span>';
                }else{
                    if(empty($_POST['status'])){
                        echo '<span class="text-danger">Status Agenda Tidak Boleh Kosong</span>';
                    }else{
                        if(empty($_POST['kategori'])){
                            echo '<span class="text-danger">Kategori Agenda Tidak Boleh Kosong</span>';
                        }else{
                            if(empty($_POST['agenda'])){
                                echo '<span class="text-danger">Keterangan Agenda Tidak Boleh Kosong</span>';
                            }else{
                                $id_agenda=$_POST['id_agenda'];
                                $tanggal=$_POST['tanggal'];
                                $jam=$_POST['jam'];
                                $id_unit_kerja=$_POST['id_unit_kerja'];
                                $status=$_POST['status'];
                                $kategori=$_POST['kategori'];
                                $agenda=$_POST['agenda'];
                                $TanggalJam="$tanggal $jam";
                                //Simpan Data
                                $UpdateAgenda = mysqli_query($Conn,"UPDATE agenda SET 
                                    tanggal='$TanggalJam',
                                    id_unit_kerja='$id_unit_kerja',
                                    status='$status',
                                    kategori='$kategori',
                                    agenda='$agenda'
                                WHERE id_agenda='$id_agenda'") or die(mysqli_error($Conn)); 
                                if($UpdateAgenda){
                                    $_SESSION ["NotifikasiSwal"]="Edit Agenda Berhasil";
                                    echo '<small class="text-success" id="NotifikasiEditAgendaBerhasil">Success</small>';
                                }else{
                                    echo '<span class="text-danger">Terjadi Kesalahan pada saat menyimpan data</span>';
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>