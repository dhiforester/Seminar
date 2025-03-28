<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            //Koneksi
            include "_Config/Connection.php";
            include "_Config/SettingGeneral.php";
            include "_Config/SettingEmail.php";
            $Page="Verifikasi Email";
            include "_Partial/JsPlugin.php";
            date_default_timezone_set('UTC');
            $now=date('Y-m-d H:i:s');
            $now=strtotime($now);
            //Tangkap kode
            if(empty($_GET['kode'])){
                $HasilValidasi="Validation Code Cannot Be Empty";
            }else{
                if(empty($_GET['email'])){
                    $HasilValidasi="Email Cannot Be Empty";
                }else{
                    $kode=$_GET['kode'];
                    $email=$_GET['email'];
                    //Buka Event Peserta
                    $QryPeserta = mysqli_query($Conn,"SELECT * FROM event_peserta WHERE email='$email'")or die(mysqli_error($Conn));
                    $DataPeserta = mysqli_fetch_array($QryPeserta);
                    if(empty($DataPeserta['id_peserta'])){
                        $HasilValidasi="Email Not Registered";
                    }else{
                        $id_peserta=$DataPeserta['id_peserta'];
                        //Validasi Token ada atai tidak
                        $QryValidasiAkses = mysqli_query($Conn,"SELECT * FROM event_validasi WHERE token='$kode' AND id_peserta='$id_peserta'")or die(mysqli_error($Conn));
                        $DataValidasiAkses = mysqli_fetch_array($QryValidasiAkses);
                        //Apabila data token akses tidak ada
                        if(empty($DataValidasiAkses['id_peserta'])){
                            $HasilValidasi="The token you are using is invalid";
                        }else{
                            $id_peserta= $DataValidasiAkses['id_peserta'];
                            //Lakukan update status akses
                            $UpdateAkses = mysqli_query($Conn,"UPDATE event_peserta SET 
                                status_validasi='Valid'
                            WHERE id_peserta='$id_peserta'") or die(mysqli_error($Conn)); 
                            if($UpdateAkses){
                                $HasilValidasi="Success";
                            }else{
                                $HasilValidasi="Access Data Update Failed";
                            }
                        }
                    }
                }
            }
            if(!empty($redirect_validasi)){
                if($HasilValidasi=="Success"){
                    header("Location:$redirect_validasi");
                }else{
                    header("Location:$redirect_validasi");
                }
            }
        ?>
    </head>
    <body>
        <main class="login_background">
            <div class="container">
                <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
                                <div class="d-flex justify-content-center py-4">
                                    <a href="" class="logo d-flex align-items-center w-auto">
                                        <span class="d-none d-lg-block"><?php echo $title_page;?></span>
                                    </a>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                    if($HasilValidasi=="Success"){
                                                        echo '<h5 class="card-title text-center pb-0 fs-4"><i class="bi bi-check-circle"></i> Success!</h5>';
                                                        echo '<p class="text-center small">Validation Process Successful</p>';
                                                        echo '<p class="text-center small">Please continue to make payment.</p>';
                                                        echo '<a href="FormPembayaran.php?email='.$email.'&id='.$id_peserta.'" class="btn btn-sm btn-primary btn-block">';
                                                        echo '  Proceed to Payment <i class="bi bi-arrow-right-circle"></i>';
                                                        echo '</a>';
                                                    }else{
                                                        echo '<h5 class="card-title text-center text-danger pb-0 fs-4">Oops!</h5>';
                                                        echo '<p class="text-center small">'.$HasilValidasi.'</p>';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center mt-3">
                                            <small>
                                                <a href="https://diklatrsues.bconcept.co.id" class="text-primary">
                                                    <i class="bi bi-globe"></i> Return to Website Page
                                                </a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </main>
        <?php
            include "_Partial/BackToTop.php";
            include "_Partial/FooterJs.php";
            include "_Partial/RoutingJs.php";
            
        ?>
    </body>

</html>