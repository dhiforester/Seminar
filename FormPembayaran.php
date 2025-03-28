<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            date_default_timezone_set('Asia/Jakarta');
            //Koneksi
            include "_Config/Connection.php";
            include "_Config/SettingGeneral.php";
            include "_Config/SettingEmail.php";
            include "_Config/Function.php";
            $Page="Form Pembayaran";
            include "_Partial/JsPlugin.php";
            $now=date('Y-m-d H:i:s');
            $now=strtotime($now);
            //Tangkap id_peserta
            if(empty($_GET['id'])){
                $HasilValidasi="Participant ID cannot be empty";
            }else{
                if(empty($_GET['email'])){
                    $HasilValidasi="Email Cannot Be Empty";
                }else{
                    $id_peserta=$_GET['id'];
                    $email=$_GET['email'];
                    //Buka Event Peserta
                    $QryPeserta = mysqli_query($Conn,"SELECT * FROM event_peserta WHERE email='$email'")or die(mysqli_error($Conn));
                    $DataPeserta = mysqli_fetch_array($QryPeserta);
                    if(empty($DataPeserta['id_peserta'])){
                        $HasilValidasi="Email Not Registered";
                    }else{
                        //Validasi ID Peserta Dan Email
                        $QryPeserta = mysqli_query($Conn,"SELECT * FROM event_peserta WHERE email='$email' AND id_peserta='$id_peserta'")or die(mysqli_error($Conn));
                        $DataPeserta = mysqli_fetch_array($QryPeserta);
                        //Apabila data token akses tidak ada
                        if(empty($DataPeserta['id_peserta'])){
                            $HasilValidasi="Participant ID you are using is invalid";
                        }else{
                            //Validasi status peserta
                            $status_validasi= $DataPeserta['status_validasi'];
                            if($status_validasi!=="Valid"){
                                $HasilValidasi="Peserta belum melakukan validasi email";
                            }else{
                                //Validasi Status Pembayaran
                                $QryPembayaran = mysqli_query($Conn,"SELECT * FROM event_pembayaran WHERE id_peserta='$id_peserta'")or die(mysqli_error($Conn));
                                $DataPembayaran = mysqli_fetch_array($QryPembayaran);
                                if(!empty($DataPembayaran['status'])){
                                    if($DataPembayaran['status']=="Lunas"){
                                        $HasilValidasi="You have completed the payment and the transaction data cannot be changed.";
                                    }else{
                                        $HasilValidasi="You have outstanding bills";
                                        $kode_transaksi=$DataPembayaran['kode_transaksi'];
                                    }
                                    $biaya_adm=$DataPembayaran['biaya_adm'];
                                    $biaya_adm_rp = number_format($biaya_adm, 0, ',', '.');
                                }else{
                                    $HasilValidasi="Valid";
                                    //Buka id_event_setting dan kategori
                                    $id_event_setting=$DataPeserta['id_event_setting'];
                                    $id_event_kategori=$DataPeserta['id_event_kategori'];
                                    //Buka Nama Event
                                    $QryEvent = mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
                                    $DataEvent = mysqli_fetch_array($QryEvent);
                                    if(!empty($DataEvent['nama_event'])){
                                        $nama_event=$DataEvent['nama_event'];
                                    }else{
                                        $nama_event="";
                                    }
                                    //Buka Kategori Event
                                    $QryEventKategori = mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
                                    $DataEventKategori = mysqli_fetch_array($QryEventKategori);
                                    if(!empty($DataEventKategori['kategori'])){
                                        $KategoriEvent =$DataEventKategori['kategori'];
                                        $HargaPembayaran =$DataEventKategori['harga_tiket'];
                                        $biaya_adm =$DataEventKategori['biaya_adm'];
                                    }else{
                                        $KategoriEvent ="";
                                        $HargaPembayaran ="0";
                                        $biaya_adm ="0";
                                    }
                                    $JumlahTagihan=$HargaPembayaran+$biaya_adm;

                                    $biaya_adm_rp = number_format($biaya_adm, 0, ',', '.');
                                    $format_rupiah_harga = number_format($HargaPembayaran, 0, ',', '.');
                                    $format_rupiah_tagihan = number_format($JumlahTagihan, 0, ',', '.');
                                }
                            }
                        }
                    }
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
                                                    if($HasilValidasi=="Valid"){
                                                        echo '<h5 class="card-title text-center pb-0 fs-4"><i class="bi bi-pencil"></i> Payment Form</h5>';
                                                        echo '<p class="text-center small">If you have a promo code, fill it in here.</p>';
                                                        include "SubFormPembayaran.php";
                                                    }else{
                                                        if($HasilValidasi=="You have outstanding bills"){
                                                            $IdTransaksi=getDataDetail($Conn,'event_pembayaran','kode_transaksi',$kode_transaksi,'id_event_pembayaran');
                                                            $TanggalTransaksi=getDataDetail($Conn,'event_pembayaran','kode_transaksi',$kode_transaksi,'tanggal');
                                                            $kode_kupon=getDataDetail($Conn,'event_pembayaran','kode_transaksi',$kode_transaksi,'kode_kupon');
                                                            $harga=getDataDetail($Conn,'event_pembayaran','kode_transaksi',$kode_transaksi,'harga');
                                                            $biaya_adm=getDataDetail($Conn,'event_pembayaran','kode_transaksi',$kode_transaksi,'biaya_adm');
                                                            $diskon=getDataDetail($Conn,'event_pembayaran','kode_transaksi',$kode_transaksi,'diskon');
                                                            $tagihan=getDataDetail($Conn,'event_pembayaran','kode_transaksi',$kode_transaksi,'tagihan');
                                                            $format_rupiah_harga = number_format($harga, 0, ',', '.');
                                                            $format_biaya_adm = number_format($biaya_adm, 0, ',', '.');
                                                            $format_rupiah_tagihan = number_format($tagihan, 0, ',', '.');
                                                            echo '<h5 class="card-title text-center text-primary pb-0 fs-4">Transaction Found!</h5>';
                                                            echo '<p class="text-center small">'.$HasilValidasi.'</p>';
                                                            echo '<ul>';
                                                            echo '  <li>Transaction ID : <code class="text-dark">'.$IdTransaksi.'</code></li>';
                                                            echo '  <li>Transaction Code : <code class="text-dark">'.$kode_transaksi.'</code></li>';
                                                            echo '  <li>Date : <code class="text-dark">'.$TanggalTransaksi.'</code></li>';
                                                            echo '  <li>Ticket Price : <code class="text-dark">IDR '.$format_rupiah_harga.'</code></li>';
                                                            echo '  <li>Coupon : <code class="text-dark">'.$kode_kupon.'</code></li>';
                                                            echo '  <li>Discount : <code class="text-dark">'.$diskon.' %</code></li>';
                                                            echo '  <li>Admin Fees : <code class="text-dark">IDR '.$format_biaya_adm.'</code></li>';
                                                            echo '  <li>Total : <code class="text-dark">IDR'.$format_rupiah_tagihan.'</code></li>';
                                                            echo '</ul>';
                                                            echo '<a href="Payment.php?kode='.$kode_transaksi.'" class="btn btn-primary btn-block btn-rounded">';
                                                            echo '  Go to Payment Page';
                                                            echo '</a>';
                                                        }else{
                                                            echo '<h5 class="card-title text-center text-danger pb-0 fs-4">Oops!</h5>';
                                                            echo '<p class="text-center small">'.$HasilValidasi.'</p>';
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center mt-3">
                                            <a href="https://diklatrsues.bconcept.co.id" class="text-primary">
                                                <i class="bi bi-globe"></i> Return to Website Page
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </main>
        <script>
            $('#TerapkanKupon').click(function(){
                $('#NotifikasiMenerapkanKodePromo').html('<div class="row"><div class="col-md-4"></div><div class="col-md-8">Loading..</div></div>');
                var id_event_kategori = $('#id_event_kategori').val();
                var kode_kupon = $('#kode_kupon').val();
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Peserta/ProsesCekKodePromo.php',
                    data 	    :  {id_event_kategori: id_event_kategori, kode_kupon: kode_kupon},
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiMenerapkanKodePromo').html(data);
                        var ValidasiDiskon=$('#ValidasiDiskon').val();
                        var NilaiDikon=$('#NilaiDikon').val();
                        var NilaiTagihan=$('#NilaiTagihan').val();
                        if(ValidasiDiskon=="Valid"){
                            $('#diskon').val(NilaiDikon);
                            $('#tagihan').val(NilaiTagihan);
                        }
                    }
                });
            });
            $('#ProsesGenerateKodePembayaran').submit(function(){
                $('#NotifikasiPembayaranPeserta').html('<div class="text-dark">Loading...</div>');
                var ProsesGenerateKodePembayaran = $('#ProsesGenerateKodePembayaran').serialize();
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Peserta/ProsesGenerateKodePembayaran.php',
                    data 	    :  ProsesGenerateKodePembayaran,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiPembayaranPeserta').html(data);
                        var NotifikasiPembayaranPesertaBerhasil=$('#NotifikasiPembayaranPesertaBerhasil').html();
                        if(NotifikasiPembayaranPesertaBerhasil=="Success"){
                            //Reload Halaman
                            location.reload();
                        }
                    }
                });
            });
        </script>
        <?php
            include "_Partial/BackToTop.php";
            include "_Partial/FooterJs.php";
            include "_Partial/RoutingJs.php";
        ?>
    </body>

</html>