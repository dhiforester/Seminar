<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['id_event_undangan'])){
        echo '<small class="text-danger">ID Undangan Event tidak boleh kosong</small>';
    }else{
        //Validasi in_ex tidak boleh kosong
        if(empty($_POST['in_ex3'])){
            echo '<small class="text-danger">Kategori Internal/Eksternal tidak boleh kosong</small>';
        }else{
             //Validasi nama_undangan tidak boleh kosong
            if(empty($_POST['nama_undangan'])){
                echo '<small class="text-danger">Nama Undangan tidak boleh kosong</small>';
            }else{
                //Validasi unit_instansi tidak boleh kosong
                if(empty($_POST['unit_instansi'])){
                    echo '<small class="text-danger">Unit/instansi tidak boleh kosong</small>';
                }else{
                    //Validasi email_undangan tidak boleh kosong
                    if(empty($_POST['email_undangan'])){
                        echo '<small class="text-danger">Alamat Email tidak boleh kosong</small>';
                    }else{
                        //Validasi kontak_undangan tidak boleh kosong
                        if(empty($_POST['kontak_undangan'])){
                            echo '<small class="text-danger">Kontak tidak boleh kosong</small>';
                        }else{
                            $id_event_undangan=$_POST['id_event_undangan'];
                            $in_ex3=$_POST['in_ex3'];
                            $nama_undangan=$_POST['nama_undangan'];
                            $unit_instansi=$_POST['unit_instansi'];
                            $email_undangan=$_POST['email_undangan'];
                            $kontak_undangan=$_POST['kontak_undangan'];
                            $UpdateUndangan = mysqli_query($Conn,"UPDATE event_undangan SET 
                                in_ex='$in_ex3',
                                nama='$nama_undangan',
                                unit_instansi='$unit_instansi',
                                kontak='$kontak_undangan',
                                email='$email_undangan'
                            WHERE id_event_undangan='$id_event_undangan'") or die(mysqli_error($Conn)); 
                            if($UpdateUndangan){
                                $id_unit_kerja="0";
                                $KategoriLog="Edit Undangan Event";
                                $KeteranganLog="Edit Undangan Event Berhasil";
                                include "../../_Config/InputLog.php";
                                echo '<small class="text-success" id="NotifikasiEditUndanganBerhasil">Success</small>';
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