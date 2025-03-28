<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            //Koneksi
            include "_Config/Connection.php";
            include "_Config/SettingGeneral.php";
            include "_Config/SettingEmail.php";
            $Page="Login";
            include "_Partial/JsPlugin.php";
            date_default_timezone_set('UTC');
            $now=date('Y-m-d H:i:s');
            $now=strtotime($now);
            //Tangkap Token
            if(empty($_GET['Token'])){
                $HasilValidasi="Validation Token Cannot Be Empty";
            }else{
                $Token=$_GET['Token'];
                //Validasi Token ada atai tidak
                $QryValidasiAkses = mysqli_query($Conn,"SELECT * FROM akses_validasi WHERE token='$Token'")or die(mysqli_error($Conn));
                $DataValidasiAkses = mysqli_fetch_array($QryValidasiAkses);
                //Apabila data token akses tidak ada
                if(empty($DataValidasiAkses['id_akses'])){
                    $HasilValidasi="The token you are using is invalid";
                }else{
                    $id_akses= $DataValidasiAkses['id_akses'];
                    //Lakukan update status akses
                    $UpdateAkses = mysqli_query($Conn,"UPDATE akses SET 
                        status='Pending',
                        datetime_update='$now'
                    WHERE id_akses='$id_akses'") or die(mysqli_error($Conn)); 
                    if($UpdateAkses){
                        $HasilValidasi="Success";
                    }else{
                        $HasilValidasi="Access Data Update Failed";
                    }
                }
            }
            if(!empty($redirect_validasi)){
                if($HasilValidasi=="Success"){
                    header("Location:$redirect_validasi?Code=200&message=$HasilValidasi");
                }else{
                    header("Location:$redirect_validasi?Code=2001&message=$HasilValidasi");
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
                            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                                <div class="d-flex justify-content-center py-4">
                                    <a href="index.php" class="logo d-flex align-items-center w-auto">
                                        <img src="assets/img/<?php echo $logo;?>" alt="">
                                        <span class="d-none d-lg-block"><?php echo $title_page;?></span>
                                    </a>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                    if($HasilValidasi=="Success"){
                                                        echo '<h5 class="card-title text-center pb-0 fs-4">Success!</h5>';
                                                        echo '<p class="text-center small">Proses Validasi Berhasil</p>';
                                                        echo '<p class="text-center small">Silahkan tunggu admin kami menerima pendaftaran anda.</p>';
                                                    }else{
                                                        echo '<h5 class="card-title text-center text-danger pb-0 fs-4">Oops!</h5>';
                                                        echo '<p class="text-center small">'.$HasilValidasi.'</p>';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <a href="Login.php" class="btn btn-primary w-100">Login to your account</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="credits">
                                    <!-- All the links in the footer should remain intact. -->
                                    <!-- You can delete the links only if you purchased the pro version. -->
                                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                    Designed by <a href="">Solihul Hadi</a>
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