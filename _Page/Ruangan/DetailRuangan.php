<?php
if(!empty($_GET['id_ruangan'])){
    $id_ruangan=$_GET['id_ruangan'];
    //Buka data Ruangan
    $QryRuangan = mysqli_query($Conn,"SELECT * FROM list_ruangan WHERE id_ruangan='$id_ruangan'")or die(mysqli_error($Conn));
    $DataRuangan = mysqli_fetch_array($QryRuangan);
    $nama_ruangan= $DataRuangan['nama_ruangan'];
    $kategori= $DataRuangan['kategori'];
    //Membuat QR
    $Temp="_Page/Ruangan/";
    $isi = "$base_url/Kunjungan.php?id_ruangan=$id_ruangan"; 
    $NamaFile="$id_ruangan.png";
    $penyimpanan="_Page/Ruangan/$id_ruangan.png";
    if(!file_exists("$penyimpanan")){
        QRcode::png($isi, $Temp."$NamaFile",QR_ECLEVEL_Q);
    }
    //Jumlah Total Penguinjung
    $JumlahKunjungan = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM list_kunjungan WHERE id_ruangan='$id_ruangan'"));
    //Format Jumlah
    $JumlahKunjungan = "" . number_format($JumlahKunjungan,0,',','.');
?>
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <b class="card-title">Detail Ruangan</b>
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <b>Nama Ruangan :</b><br>
                                    <?php echo "$nama_ruangan"; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Kategori :</b><br>
                                    <?php echo "$kategori"; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Total Kunjungan :</b><br>
                                    <?php echo "$JumlahKunjungan"; ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <img src="_Page/Ruangan/<?php echo $NamaFile;?>" alt="<?php echo $nama_ruangan;?>" width="80%%">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-md btn-dark btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalRegenerateQr" data-id="<?php echo "$id_ruangan"; ?>">
                        <i class="bi bi-qr-code"></i> Regenerate QR
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <form action="javascript:void(0);" id="ProsesBatasKunjungan">
                        <input type="hidden" name="IdRuangan" id="IdRuangan" value="<?php echo "$id_ruangan"; ?>">
                        <div class="row">
                            <div class="col-md-12 text-center mt-3">
                                <a href="">
                                    <b class="card-title">Log Kunjungan</b>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <input type="date" name="PeriodeAwal" id="PeriodeAwal" class="form-control">
                                <small>Periode Awal</small>
                            </div>
                            <div class="col-md-3 mt-3">
                                <input type="date" name="PeriodeAkhir" id="PeriodeAkhir" class="form-control">
                                <small>Periode Akhir</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="btn-group w-100">
                                    <button type="submit" class="btn btn-md btn-outline-dark">
                                        <i class="bi bi-search"></i> Cari
                                    </button>
                                    <button type="button" class="btn btn-md btn-outline-dark" data-bs-toggle="modal" data-bs-target="#ModalReportKunjungan">
                                        <i class="bi bi-graph-up"></i> Report
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row" id="MenampilkanTabelKunjungan">
                        <div class="col-md-12 text-center">
                            Isi Tanggal Data Terlebih Dulu
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>