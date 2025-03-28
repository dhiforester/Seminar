<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            //Koneksi
            include "_Config/Connection.php";
            include "_Config/SettingGeneral.php";
            $Page="Payment Gateway";
            include "_Partial/JsPlugin.php";
            if(empty($_GET['kode'])){
                $kode="";
            }else{
                $kode=$_GET['kode'];
                $QryPembayaran= mysqli_query($Conn,"SELECT * FROM event_pembayaran WHERE kode_transaksi='$kode'")or die(mysqli_error($Conn));
                $DataPembayaran= mysqli_fetch_array($QryPembayaran);
                if(!empty($DataPembayaran['id_event_pembayaran'])){
                    $id_event_pembayaran= $DataPembayaran['id_event_pembayaran'];
                    $id_event_setting= $DataPembayaran['id_event_setting'];
                    $id_event_kategori= $DataPembayaran['id_event_kategori'];
                    $id_peserta= $DataPembayaran['id_peserta'];
                    $tanggal= $DataPembayaran['tanggal'];
                    $kode_kupon= $DataPembayaran['kode_kupon'];
                    $metode_pembayaran= $DataPembayaran['metode_pembayaran'];
                    $HargaPembayaran= $DataPembayaran['harga'];
                    $diskon= $DataPembayaran['diskon'];
                    $biaya_adm= $DataPembayaran['biaya_adm'];
                    $tagihan= $DataPembayaran['tagihan'];
                    $StatusPembayaran= $DataPembayaran['status'];
                    //Buka Peserta
                    $QryDetailPeserta = mysqli_query($Conn,"SELECT * FROM event_peserta WHERE id_peserta='$id_peserta'")or die(mysqli_error($Conn));
                    $DataDetailPeserta = mysqli_fetch_array($QryDetailPeserta);
                    if(empty($DataDetailPeserta['nama'])){
                        $nama="";
                    }else{
                        $nama= $DataDetailPeserta['nama'];
                    }
                    
                }else{
                    $nama="";
                    $id_event_pembayaran="";
                    $id_event_setting="";
                    $id_event_kategori="";
                    $id_peserta="";
                    $tanggal="";
                    $kode_kupon="";
                    $metode_pembayaran="";
                    $diskon="";
                    $biaya_adm="";
                    $HargaPembayaran="$harga_tiket";
                    $tagihan="$harga_tiket";
                    $StatusPembayaran="$status_pembayaran";
                }
        ?>
    </head>
    <body>
        <main class="login_background">
            <div class="container">
                <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-4 d-flex flex-column align-items-center justify-content-center">
                                <div class="d-flex justify-content-center py-4">
                                    <a href="" class="logo d-flex align-items-center w-auto">
                                        <span class="d-none d-lg-block"><?php echo $title_page;?></span>
                                    </a>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="pt-1">
                                            <h5 class="card-title text-center pb-0 fs-4">
                                                <i class="bi bi-coin"></i><br>
                                                Payment Page
                                            </h5>
                                            <p class="text-center small">Double check the payment description for your registration. Also make sure the payment information is correct.</p>
                                        </div>
                                        <form action="javascript:void(0);" class="row g-3" id="ProsesPembayaran">
                                            <input type="hidden" name="id_event_pembayaran" value="<?php echo $id_event_pembayaran;?>">
                                            <div class="col-12">
                                                <ol>
                                                    <?php
                                                        //Format Rupish
                                                        $HargaPembayaran="Rp " . number_format($HargaPembayaran, 0, ",", ".");
                                                        $tagihan="Rp " . number_format($tagihan, 0, ",", ".");
                                                    ?>
                                                    <li>Name : <code><?php echo "$nama"; ?></code></li>
                                                    <li>Transaction Code : <code><?php echo "$kode"; ?></code></li>
                                                    <li>Date : <code><?php echo "$tanggal"; ?></code></li>
                                                    <li>Ticket price : <code><?php echo "$HargaPembayaran"; ?></code></li>
                                                    <li>Coupon Code : <code><?php echo "$kode_kupon"; ?></code></li>
                                                    <li>Discount : <code><?php echo "$diskon %"; ?></code></li>
                                                    <li>Total Transactions : <code><?php echo "$tagihan"; ?></code></li>
                                                    <li>Status : <code><?php echo "$StatusPembayaran"; ?></code></li>
                                                </ol>
                                            </div>
                                            <div class="col-12 mb-4" id="TombolPembayaran">
                                                <?php if($StatusPembayaran=="Pending"){ ?>
                                                    <button type="button" class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#ModalPaymentGateway" data-id="<?php echo $id_event_pembayaran; ?>">
                                                        Continue <i class="bi bi-arrow-right-circle"></i>
                                                    </button>
                                                <?php } ?>
                                            </div>
                                            <div class="col-12 text-center">
                                                <a href="https://diklatrsues.bconcept.co.id/" class="text-primary">
                                                    <i class="bi bi-arrow-left-circle"></i> Returning Home
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </main>
        <?php
            include "_Partial/Modal.php";
            include "_Partial/BackToTop.php";
            include "_Partial/FooterJs.php";
            include "_Partial/RoutingJs.php";
        ?>
        <script>
            //Modal Hapus Kehadiran Peserta
            $('#ModalPaymentGateway').on('show.bs.modal', function (e) {
                var id_event_pembayaran = $(e.relatedTarget).data('id');
                $('#FormPaymentGateway').html("Loading...");
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Peserta/FormPaymentGateway.php',
                    data        : {id_event_pembayaran: id_event_pembayaran},
                    success     : function(data){
                        $('#FormPaymentGateway').html(data);
                    }
                });
            });
        </script>
    </body>
    <?php } ?>
</html>
