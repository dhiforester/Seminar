<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            //Properti halaman
            $Page="Survey";
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
                            <div class="col-lg-6 col-md-6 col-sm-8 d-flex flex-column align-items-center justify-content-center">
                                <div class="d-flex justify-content-center py-4">
                                    <a href="index.php" class="logo d-flex align-items-center w-auto">
                                        <img src="assets/img/<?php echo $logo;?>" alt="">
                                        <span class="d-none d-lg-block"><?php echo $title_page;?></span>
                                    </a>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <?php
                                            if(empty($_GET['id'])){
                                                echo '<div class="pt-4 pb-2">';
                                                echo '  <h5 class="card-title text-center pb-0 fs-4">Error Page</h5>';
                                                echo '  <p class="text-center text-danger small">ID Survey Tidak Boleh Kosong</p>';
                                                echo '</div>';
                                            }else{
                                                if(empty($_GET['token'])){
                                                    echo '<div class="pt-4 pb-2">';
                                                    echo '  <h5 class="card-title text-center pb-0 fs-4">Error Page</h5>';
                                                    echo '  <p class="text-center text-danger small">Token Tidak Boleh Kosong</p>';
                                                    echo '</div>';
                                                }else{
                                                    $id_survey=$_GET['id'];
                                                    $token=$_GET['token'];
                                                    //Buka survey
                                                    //Buka data survey
                                                    $QryDetailSurvey= mysqli_query($Conn,"SELECT * FROM survey WHERE id_survey='$id_survey'")or die(mysqli_error($Conn));
                                                    $DataSurvey= mysqli_fetch_array($QryDetailSurvey);
                                                    if(empty($DataSurvey['nama_survey'])){
                                                        echo '<div class="pt-4 pb-2">';
                                                        echo '  <h5 class="card-title text-center pb-0 fs-4">Error Page</h5>';
                                                        echo '  <p class="text-center text-danger small">ID Survey Tidak Valid</p>';
                                                        echo '</div>';
                                                    }else{
                                                        $nama_survey= $DataSurvey['nama_survey'];
                                                        $keterangan= $DataSurvey['keterangan'];
                                                        echo '<div class="pt-4 pb-2">';
                                                        echo '  <h5 class="card-title text-center pb-0 fs-4">'.$nama_survey.'</h5>';
                                                        echo '  <p class="text-center small">'.$keterangan.'</p>';
                                                        echo '</div>';
                                                        //Buka data responden
                                                        $QryResponden = mysqli_query($Conn,"SELECT * FROM survey_responden WHERE token='$token'")or die(mysqli_error($Conn));
                                                        $DataResponden = mysqli_fetch_array($QryResponden);
                                                        $id_survey_responden= $DataResponden['id_survey_responden'];
                                                        $nama= $DataResponden['nama'];
                                                        $kontak= $DataResponden['kontak'];
                                                        $email= $DataResponden['email'];
                                                        $kategori= $DataResponden['kategori'];
                                                        $token= $DataResponden['token'];
                                                        //Buka hasil survey
                                                        $QryHasilSurvey = mysqli_query($Conn,"SELECT * FROM survey_nilai WHERE id_survey='$id_survey' AND id_survey_responden='$id_survey_responden'")or die(mysqli_error($Conn));
                                                        $DataHasilSurvey = mysqli_fetch_array($QryHasilSurvey);
                                                        if(!empty($DataHasilSurvey['id_survey_nilai'])){
                                                            $id_survey_nilai= $DataHasilSurvey['id_survey_nilai'];
                                                            include "_Page/Survey/FormHasilSurvey.php";
                                                        }else{
                                                            include "_Page/Survey/FormAngket.php";
                                                        }
                                                    }

                                                }
                                            }
                                        ?>
                                        
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
        <script>
            //Proses Isi Survey
            $('#ProsesIsiSurvey').submit(function(){
                $('#NotifikasiIsiSurvey').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesIsiSurvey')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Survey/ProsesIsiSurvey.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiIsiSurvey').html(data);
                        var NotifikasiIsiSurveyBerhasil=$('#NotifikasiIsiSurveyBerhasil').html();
                        if(NotifikasiIsiSurveyBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        </script>
    </body>

</html>