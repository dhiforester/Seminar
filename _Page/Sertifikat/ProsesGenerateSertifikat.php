<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    date_default_timezone_set('Asia/Jakarta');
    if(empty($_POST['PutIdEvent'])){
        echo '<code class="text-danger">ID Event Tidak Boleh Kosong!</code>';
    }else{
        if(empty($_POST['CheckIdPerson'])){
            echo '<code class="text-danger">Tidak Ada Data Peserta Yang Dipilih</code>';
        }else{
            if(empty($_POST['id_setting_sertifikat'])){
                echo '<code class="text-danger">ID Setting Group Tidak Boleh Kosong!</code>';
            }else{
                if(empty($_POST['kategori_sertifikat'])){
                    echo '<code class="text-danger">Kategori Sertifikat Tidak Boleh Kosong!</code>';
                }else{
                    $id_event_setting=$_POST['PutIdEvent'];
                    $CheckIdPerson=$_POST['CheckIdPerson'];
                    $id_setting_sertifikat=$_POST['id_setting_sertifikat'];
                    $kategori_sertifikat=$_POST['kategori_sertifikat'];
                    $DatetimeNow=date('Y-m-d H:i:s');
                    $DatetimeNow=strtotime($DatetimeNow);
                    foreach($CheckIdPerson as $ListIdPerson){
                        $id_person=$ListIdPerson;
                        if($kategori_sertifikat=="Peserta"){
                            $nama=getDataDetail($Conn,'event_peserta','id_peserta',$id_person,'nama');
                        }else{
                            if($kategori_sertifikat=="Panitia"){
                                $nama=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_person,'nama_panitia');
                            }else{
                                if($kategori_sertifikat=="Pengisi Acara"){
                                    $nama=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_person,'nama');
                                }else{
                                    $nama="";
                                }
                            }
                        }
                        $group_name=getDataDetail($Conn,'setting_sertifikat','id_setting_sertifikat',$id_setting_sertifikat,'group_name');
                        //Buka Token Sebelumnya
                        $QryToken= mysqli_query($Conn,"SELECT * FROM event_sertifikat WHERE id_person='$id_person' AND kategori_sertifikat='$kategori_sertifikat'")or die(mysqli_error($Conn));
                        $DataToken= mysqli_fetch_array($QryToken);
                        if(empty($DataToken['token'])){
                            $TokenSebelumnya="";
                        }else{
                            $TokenSebelumnya=$DataToken['token'];
                        }
                        $token="$id_event_setting-$id_person-$kategori_sertifikat-$DatetimeNow";
                        $token=md5($token);
                        if(empty($TokenSebelumnya)){
                            //Insert
                            $EntrySertifikat="INSERT INTO event_sertifikat (
                                id_event_setting,
                                id_setting_sertifikat,
                                id_person,
                                nama,
                                kategori_sertifikat,
                                group_name,
                                kode_idi,
                                token
                            ) VALUES (
                                '$id_event_setting',
                                '$id_setting_sertifikat',
                                '$id_person',
                                '$nama',
                                '$kategori_sertifikat',
                                '$group_name',
                                '',
                                '$token'
                            )";
                            $ProsesGenerate=mysqli_query($Conn, $EntrySertifikat);
                        }else{
                            //Update
                            $UpdateSertifikat = mysqli_query($Conn,"UPDATE event_sertifikat SET 
                                id_event_setting='$id_event_setting',
                                id_setting_sertifikat='$id_setting_sertifikat',
                                id_person='$id_person',
                                nama='$nama',
                                kategori_sertifikat='$kategori_sertifikat',
                                group_name='$group_name',
                                token='$token'
                            WHERE token='$TokenSebelumnya'") or die(mysqli_error($Conn)); 
                        }
                    }
                    echo '<code id="NotifikasiGenerateTokenBerhasil">Success</code>';
                }
            }
        }
    }
?>