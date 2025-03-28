<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/SettingEmail.php";
    //Zona Waktu
    date_default_timezone_set("Asia/Jakarta");
    //Tanggal Sekarang
    $tanggal=date('Y-m-d H:i:s');
    $tanggal=strtotime($tanggal);
    //Menangkap email
    if(empty($_POST['email'])){
        echo '<small class="text-danger">Maaf!! Email Tidak Boleh Kosong, Silahkan Diisi.</small>';
    }else{
        $email=$_POST['email'];
        //Cek apakah email tersebut ada?
        $Qry=mysqli_query($Conn,"SELECT*FROM akses WHERE email_akses='$email'")or die(mysqli_error($Conn));
        $DataAkses = mysqli_fetch_array($Qry);
        if(empty($DataAkses["id_akses"])){
            echo '<small class="text-danger">Maaf!! Email Yang Anda Masukan Tidak Terdaftar.</small>';
        }else{
            $nama_akses=$DataAkses["nama_akses"];
            $id_akses=$DataAkses["id_akses"];
            //Cek apakah akses tersebut sudah mengajukan lupa password sebelumnya?
            $Qry=mysqli_query($Conn,"SELECT*FROM lupa_password WHERE id_akses='$id_akses' AND tanggal_expired>'$tanggal'")or die(mysqli_error($Conn));
            $DataAkses = mysqli_fetch_array($Qry);
            if(!empty($DataAkses["id_akses"])){
                echo '<small class="text-danger">Permintaan Reset Password Anda Sebelumnya Masih Berlaku, Silahkan Cek Email Anda.</small>';
            }else{
                //Buat Kode Unik
                $length=5;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[Rand(0, $charactersLength - 1)];
                }
                $code_unik=md5($randomString);
                //Menghiutng waktu expired
                $tanggal_expired=strtotime("+1 days", $tanggal);
                //Simpan data
                $entry="INSERT INTO lupa_password (
                    id_akses,
                    tanggal_dibuat,
                    tanggal_expired,
                    code_unik
                ) VALUES (
                    '$id_akses',
                    '$tanggal',
                    '$tanggal_expired',
                    '$code_unik'
                )";
                $Input=mysqli_query($Conn, $entry);
                if($Input){
                    //Mengirim URL ke email
                    $subjek="Reset Password";
                    $email_tujuan=$email;
                    $pesan="
                        Anda telah mengajukan untuk melakukan reset password. Klik tautan berikut ini untuk melakukan konfirmasi.
                        <a href='$base_url/LupaPassword.php?Page=UbahPassword&email=$email&token=$randomString'>Reset Password</a>. 
                        Apabila tautan tidak muncul copi URL beruikut:
                        $base_url/LupaPassword.php?Page=UbahPassword&email=$email&token=$randomString
                        
                    ";
                    $ch = curl_init();
                    $headers = array(
                        'Content-Type: Application/JSON',          
                        'Accept: Application/JSON'     
                    );
                    $arr = array(
                        "subjek" => "$subjek",
                        "email_asal" => "$email_gateway",
                        "password_email_asal" => "$password_gateway",
                        "url_provider" => "$url_provider",
                        "nama_pengirim" => "$nama_pengirim",
                        "email_tujuan" => "$email_tujuan",
                        "nama_tujuan" => "$nama_akses",
                        "pesan" => "$pesan",
                        "port" => "$port_gateway"
                    );
                    $json = json_encode($arr);
                    curl_setopt($ch, CURLOPT_URL, "$url_service");
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 3); 
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $content = curl_exec($ch);
                    $err = curl_error($ch);
                    curl_close($ch);
                    $get =json_decode($content, true);
                    if($get['code']==200){
                        echo '<small class="text-success" id="NotifikasiResetPasswordBerhasil">Success</small>';
                    }else{
                        if($get['pesan']=="Email Terkirim"){
                            echo '<small class="text-success" id="NotifikasiResetPasswordBerhasil">Success</small>';
                        }else{
                            $pesan=$get['pesan'];
                            echo '<small class="text-danger">'.$pesan.'</small>';
                        }
                    }
                }else{
                    echo '<small class="text-danger">Maaf!! Terjadi kesalahan pada saat menyimpan data kode verifikasi.</small>';
                }
            }
        }
    }
?>