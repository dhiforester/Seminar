<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap data
    if(empty($_POST['id_mitra'])){
        echo '<span class="text-danger">ID Mitra Tidak Boleh Kosong!</span>';
    }else{
        if(empty($_POST['nama_tamplate'])){
            echo '<span class="text-danger">Nama Tamplate Tidak Boleh Kosong!</span>';
        }else{
            if(empty($_POST['pesan_tamplate'])){
                echo '<span class="text-danger">Pesan Tamplate Tidak Boleh Kosong!</span>';
            }else{
                if(empty($_POST['status'])){
                    echo '<span class="text-danger">Status Tamplate Tidak Boleh Kosong!</span>';
                }else{
                    if(empty($_POST['lampiran_invoice'])){
                        echo '<span class="text-danger">Lampiran Invoice Tidak Boleh Kosong!</span>';
                    }else{
                        if(empty($_POST['clientId'])){
                            $clientId="";
                        }else{
                            $clientId=$_POST['clientId'];
                        }
                        $id_mitra=$_POST['id_mitra'];
                        $nama_tamplate=$_POST['nama_tamplate'];
                        $pesan_tamplate=$_POST['pesan_tamplate'];
                        $lampiran_invoice=$_POST['lampiran_invoice'];
                        $status=$_POST['status'];
                        //Apakah data tamplate sudah ada atau belum
                        $QryTamplate = mysqli_query($Conn,"SELECT * FROM whatsapp_tamplate WHERE id_mitra='$id_mitra' AND nama_tamplate='$nama_tamplate'")or die(mysqli_error($Conn));
                        $DataTamplate = mysqli_fetch_array($QryTamplate);
                        if(empty($DataTamplate['id_whatsapp_tamplate'])){
                            //Simpan data
                            $SimpanData="INSERT INTO whatsapp_tamplate (
                                id_mitra,
                                clientId,
                                nama_tamplate,
                                pesan_tamplate,
                                lampiran_invoice,
                                status
                            ) VALUES (
                                '$id_mitra',
                                '$clientId',
                                '$nama_tamplate',
                                '$pesan_tamplate',
                                '$lampiran_invoice',
                                '$status'
                            )";
                            $InputTamplate=mysqli_query($Conn, $SimpanData);
                            if($InputTamplate){
                                $ValidasiProses="Success";
                            }else{
                                $ValidasiProses="Gagal Simpan Data Tamplate Ke Database";
                            }
                        }else{
                            $id_whatsapp_tamplate= $DataTamplate['id_whatsapp_tamplate'];
                            //Update Data
                            //Update
                            $UpdateTamplate = mysqli_query($Conn,"UPDATE whatsapp_tamplate SET 
                                id_mitra='$id_mitra',
                                clientId='$clientId',
                                nama_tamplate='$nama_tamplate',
                                pesan_tamplate='$pesan_tamplate',
                                lampiran_invoice='$lampiran_invoice',
                                status='$status'
                            WHERE id_whatsapp_tamplate='$id_whatsapp_tamplate'") or die(mysqli_error($Conn)); 
                            if($UpdateTamplate){
                                $ValidasiProses="Success";
                            }else{
                                $ValidasiProses="Gagal Update Data Tamplate Ke Database";
                            }
                        }
                        if($ValidasiProses=="Success"){
                            $_SESSION ["NotifikasiSwal"]="Simpan Tamplate Berhasil";
                            echo '<small class="text-success" id="NotifikasiTamplateWaBerhasil">'.$ValidasiProses.'</small><br>';
                        }else{
                            echo '<small class="text-danger">'.$ValidasiProses.'</small>';
                        }
                    }
                }
            }
        }
    }
?>  