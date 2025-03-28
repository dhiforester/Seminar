<?php
    session_start();
    include "../../_Config/Connection.php";
    //Validasi keberadaan email dan password
    if(empty($_POST["email"])){
        echo 'Login Failed Error Code :<span id="ErrorCode">1</span>';
    }else{
        if(empty($_POST["password"])){
            echo 'Login Failed Error Code :<span id="ErrorCode">2</span>';
        }else{
            $email=$_POST["email"];
            $password=$_POST["password"];
            $passwordMd5=md5($password);
            //QUERY MEMANGGIL DATA DARI DATABASE Akses
            $Qry=mysqli_query($Conn,"SELECT*FROM akses WHERE email_akses='$email' AND password='$passwordMd5'")or die(mysqli_error($Conn));
            $DataAkses = mysqli_fetch_array($Qry);
            if(!empty($DataAkses["id_akses"])){
                $status=$DataAkses["status"];
                if($status=="Active"){
                    echo '<span id="NotifikasiProsesLoginBerhasil">Success</span>';
                    $_SESSION ["id_akses"]=$DataAkses["id_akses"];
                    $_SESSION ["NotifikasiSwal"]="Login Berhasil";
                    $GetIdAksesDariData=$_SESSION["id_akses"];
                }else{
                    if($status=="Register"){
                        echo 'Login Failed Error Code <span id="ErrorCode">4</span>';
                    }else{
                        if($status=="Pending"){
                            echo 'Login Failed Error Code <span id="ErrorCode">5</span>';
                        }else{
                            echo 'Login Failed Error Code <span id="ErrorCode">6</span>';
                        }
                    }
                }
            }else{
                echo 'Login Failed Error Code <span id="ErrorCode">3</span>';
            }
        }
    }	
?>