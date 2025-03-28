<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            //Koneksi
            date_default_timezone_set('Asia/Jakarta');
            include "_Config/Connection.php";
            include "_Config/SettingGeneral.php";
            include "_Partial/JsPlugin.php";
            $TanggalJam=date('d/m/y H:i');
            if(empty($_GET['id_ruangan'])){
                $id_ruangan="";
                $nama_ruangan="";
                $kategori="";
            }else{
                $id_ruangan=$_GET['id_ruangan'];
                 //Buka data Ruangan
                $QryRuangan = mysqli_query($Conn,"SELECT * FROM list_ruangan WHERE id_ruangan='$id_ruangan'")or die(mysqli_error($Conn));
                $DataRuangan = mysqli_fetch_array($QryRuangan);
                $nama_ruangan= $DataRuangan['nama_ruangan'];
                $kategori= $DataRuangan['kategori'];
            }
        ?>
        <style>
            /* mengatur ukuran canvas tanda tangan  */
            canvas {
                border: 1px solid #ccc;
                border-radius: 0.5rem;
                width: 100%;
                height: 200px;
            }
        </style>
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
                                            <h5 class="card-title text-center pb-0 fs-4">Selamat Datang</h5>
                                            <p class="text-center small">Di <?php echo "$nama_ruangan"; ?></p>
                                        </div>
                                        <form action="javascript:void(0);" class="row g-3" id="ProsesKunjungan">
                                            <input type="hidden" name="id_ruangan" id="id_ruangan" value="<?php echo "$id_ruangan"; ?>">
                                            <div class="col-12 text-center">
                                                <h4><?php echo $TanggalJam; ?></h4>
                                            </div>
                                            <div class="col-12">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="nama" class="form-control" id="nama" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="unit" class="form-label">Unit/Instansi</label>
                                                <input type="text" name="unit" class="form-control" id="unit" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="unit" class="form-label">Tanda Tangan</label>
                                                <canvas id="signature-pad" class="signature-pad"></canvas>
                                            </div>
                                            <div class="col-12 text-center">
                                                <div class="btn-group w-100">
                                                    <!-- tombol ganti warna  -->
                                                    <button type="button" class="btn btn-outline-dark" id="change-color" title="Ganti Warna">
                                                        <i class="bi bi-droplet"></i>
                                                    </button>
                                                    <!-- tombol undo  -->
                                                    <button type="button" class="btn btn-outline-dark" id="undo" title="Undo">
                                                        <span class="bi bi-reply-fill"></span>
                                                    </button>
                                                    <!-- tombol hapus tanda tangan  -->
                                                    <button type="button" class="btn btn-outline-dark" id="clear" title="Clear">
                                                        <span class="bi bi-eraser"></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-12" id="NotifikasiKunjungan">
                                                Pastikan informasi kunjungan sudah benar.
                                            </div>
                                            <div class="col-12 mb-2">
                                                <button class="btn btn-primary w-100" type="submit" id="SimpanKunjungan">Konfirmasi Kunjungan</button>
                                            </div>
                                        </form>
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
            // script di dalam ini akan dijalankan pertama kali saat dokumen dimuat
            document.addEventListener('DOMContentLoaded', function () {
                resizeCanvas();
            })
    
            //script ini berfungsi untuk menyesuaikan tanda tangan dengan ukuran canvas
            function resizeCanvas() {
                var ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
            }
    
    
            var canvas = document.getElementById('signature-pad');
    
            //warna dasar signaturepad
            var signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)'
            });
    
            //saat tombol clear diklik maka akan menghilangkan seluruh tanda tangan
            document.getElementById('clear').addEventListener('click', function () {
                signaturePad.clear();
            });
    
            //saat tombol undo diklik maka akan mengembalikan tanda tangan sebelumnya
            document.getElementById('undo').addEventListener('click', function () {
                var data = signaturePad.toData();
                if (data) {
                    data.pop(); // remove the last dot or line
                    signaturePad.fromData(data);
                }
            });
    
            //saat tombol change color diklik maka akan merubah warna pena
            document.getElementById('change-color').addEventListener('click', function () {
    
                //jika warna pena biru maka buat menjadi hitam dan sebaliknya
                if(signaturePad.penColor == "rgba(0, 0, 255, 1)"){
    
                    signaturePad.penColor = "rgba(0, 0, 0, 1)";
                }else{
                    signaturePad.penColor = "rgba(0, 0, 255, 1)";
                }
            })
            //Simpan Kunjungan
            $('#SimpanKunjungan').click(function(){
                var signature = signaturePad.toDataURL();
                var id_ruangan=$('#id_ruangan').val();
                var unit=$('#unit').val();
                var nama=$('#nama').val();
                $('#NotifikasiKunjungan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Kunjungan/ProsesSimpanKunjungan.php',
                    data 	    :  {foto: signature, id_ruangan: id_ruangan, unit: unit, nama: nama},
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiKunjungan').html(data);
                        var NotifikasiKunjunganBerhasil=$('#NotifikasiKunjunganBerhasil').html();
                        if(NotifikasiKunjunganBerhasil=="Success"){
                            location.href = "KunjunganBerhasil.php";
                        }
                    }
                });
            });
        </script>
    </body>
</html>