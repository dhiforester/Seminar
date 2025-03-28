<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('UTC');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    $datetime_api_key=strtotime($now);
    //Validasi title_api_key tidak boleh kosong
    if(empty($_POST['title_api_key'])){
        echo '<small class="text-danger">Title Can not Be Empty</small>';
    }else{
        //Validasi description_api_key tidak boleh kosong
        if(empty($_POST['description_api_key'])){
            echo '<small class="text-danger">Description Number Cannot Be Empty</small>';
        }else{
            //Validasi title_api_key tidak boleh lebih dari 20 karakter
            $JumlahKarakterTitle=strlen($_POST['title_api_key']);
            if($JumlahKarakterTitle>20){
                echo '<small class="text-danger">The title can only have 20 characters</small>';
            }else{
                //Validasi api_key tidak boleh kosong
                if(empty($_POST['api_key'])){
                    echo '<small class="text-danger">API Key Cannot Be Empty</small>';
                }else{
                    //Validasi status_api_key tidak boleh kosong
                    if(empty($_POST['status_api_key'])){
                        echo '<small class="text-danger">Status Access Cannot Be Empty</small>';
                    }else{
                        $title_api_key=$_POST['title_api_key'];
                        $description_api_key=$_POST['description_api_key'];
                        $api_key=$_POST['api_key'];
                        $status_api_key=$_POST['status_api_key'];
                        //Validasi API key Sama
                        $ValidasiApiKeyDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM setting_api_key WHERE api_key='$api_key'"));
                        if(!empty($ValidasiApiKeyDuplikat)){
                            echo '<small class="text-danger">The API key already exists</small>';
                        }else{
                            //Simpan Ke database
                            $entry="INSERT INTO setting_api_key (
                                datetime_api_key,
                                title_api_key,
                                description_api_key,
                                api_key,
                                status_api_key
                            ) VALUES (
                                '$datetime_api_key',
                                '$title_api_key',
                                '$description_api_key',
                                '$api_key',
                                '$status_api_key'
                            )";
                            $Input=mysqli_query($Conn, $entry);
                            if($Input){
                                $id_mitra=0;
                                $KategoriLog="Input API Key";
                                $KeteranganLog="Input API Key Berhasil";
                                include "../../_Config/InputLog.php";
                                echo '<small class="text-success" id="NotifikasiTambahApiKeyBerhasil">Success</small>';
                            }else{
                                echo '<small class="text-danger">An error occurred while inputting data</small>';
                            }
                        }
                    }
                }
            }
        }
    }
?>