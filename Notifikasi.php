<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            //Koneksi
            include "_Config/Connection.php";
            include "_Config/SettingGeneral.php";
            include "_Config/SettingEmail.php";
            $Page="Notifikasi";
            include "_Partial/JsPlugin.php";
            date_default_timezone_set('UTC');
            $now=date('Y-m-d H:i:s');
            $now=strtotime($now);
            //Tangkap kode
            if(empty($_GET['Result'])){
                $Result="Unknown Error";
            }else{
                $Result=$_GET['Result'];
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
                                                    if($Result=="Success"){
                                                        echo '<h5 class="card-title text-center pb-0 fs-4 text-success"><i class="bi bi-check-circle"></i> Success!</h5>';
                                                        echo '<p class="text-center small">Payment Process Successful</p>';
                                                    }else{
                                                        if($Result=="Success"){
                                                            echo '<h5 class="card-title text-center pb-0 fs-4 text-info"><i class="bi bi-clock-history"></i> Pending!</h5>';
                                                            echo '<p class="text-center small">Proses Transaksi Pending</p>';
                                                        }else{
                                                            echo '<h5 class="card-title text-center text-danger pb-0 fs-4">Oops!</h5>';
                                                            echo '<p class="text-center small">Unknown Error</p>';
                                                        }
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