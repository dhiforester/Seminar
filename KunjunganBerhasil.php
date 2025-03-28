<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            //Koneksi
            date_default_timezone_set('Asia/Jakarta');
            include "_Config/Connection.php";
            include "_Config/SettingGeneral.php";
            include "_Partial/JsPlugin.php";
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
                                        <div class="pt-4 pb-2">
                                            <h5 class="card-title text-center pb-0 fs-4">Terima Kasih</h5>
                                            <p class="text-center small">Kunjungan Berhasil Disimpan</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h1>
                                                    <i class="bi bi-check"></i>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="credits">
                                    <small>
                                        Designed by <a href="https://parasilva.site/">Solihul Hadi</a>
                                    </small>
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
            include "_Partial/RoutingSwal.php";
        ?>
    </body>
</html>