<?php
    if(empty($_POST['bentuk_laporan'])){
        $bentuk_laporan="";
    }else{
        $bentuk_laporan=$_POST['bentuk_laporan'];
    }
    if(empty($_POST['periode_laporan'])){
        $periode_laporan="";
    }else{
        $periode_laporan=$_POST['periode_laporan'];
    }
    if(empty($_POST['tahun'])){
        $tahun=date('Y');
    }else{
        $tahun=$_POST['tahun'];
    }
    if(empty($_POST['bulan'])){
        $bulan=date('m');
    }else{
        $bulan=$_POST['bulan'];
    }
?>
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form action="index.php?Page=WaktuHenti&Sub=Laporan" method="POST">
                        <div class="row">
                            <div class="col-md-2 mb-2 mt-2">
                                <select name="bentuk_laporan" id="bentuk_laporan" class="form-control">
                                    <option <?php if($bentuk_laporan=="Grafik"){echo "selected";} ?> value="Grafik">Grafik</option>
                                    <option <?php if($bentuk_laporan=="Tabel"){echo "selected";} ?> value="Tabel">Tabel</option>
                                </select>
                                <small>Bentuk</small>
                            </div>
                            <div class="col-md-2 mb-2 mt-2">
                                <select name="periode_laporan" id="periode_laporan" class="form-control">
                                    <option <?php if($periode_laporan=="Tahunan"){echo "selected";} ?> value="Tahunan">Tahunan</option>
                                    <option <?php if($periode_laporan=="Bulanan"){echo "selected";} ?> value="Bulanan">Bulanan</option>
                                </select>
                                <small>Periode</small>
                            </div>
                            <div class="col-md-2 mb-2 mt-2">
                                <input type="number" name="tahun" id="tahun" class="form-control" value="<?php echo "$tahun"; ?>">
                                <small>Tahun</small>
                            </div>
                            <div class="col-md-2 mb-2 mt-2" id="FormBulan">
                                <?php
                                    if($periode_laporan!=="Bulanan"){
                                        echo '<input type="text" readonly name="bulan" id="bulan" class="form-control">';
                                        echo '<small>Bulan</small>';
                                    }else{
                                        include "_Page/WaktuHenti/FormPeriode.php";
                                    }
                                ?>
                            </div>
                            <div class="col-md-1 mb-2 mt-2">
                                <button type="submit" class="btn btn-md btn-primary w-100" title="Tampilkan Laporan">
                                    <i class="bi bi-arrow-90deg-down"></i>
                                </button>
                            </div>
                            <div class="col-md-1 mb-2 mt-2">
                                <button type="button" class="btn btn-md btn-info w-100" title="Cetak Laporan" data-bs-toggle="modal" data-bs-target="#ModalCetakWaktuHenti">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </div>
                            <div class="col-md-2 mb-2 mt-2">
                                <a href="index.php?Page=WaktuHenti" class="btn btn-md btn-dark w-100">
                                    <i class="bi bi-arrow-left-circle"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <?php
                        if(empty($_POST['bentuk_laporan'])){
                            echo "<div class='row'>";
                            echo "  <div class='col col-md-12 text-center'>";
                            echo "      Silahkan Isi Form Laporan Terlebih Dulu";
                            echo "  </div>";
                            echo "</div>";
                        }else{
                            $bentuk_laporan=$_POST['bentuk_laporan'];
                            if($bentuk_laporan=="Grafik"){
                                include "_Page/WaktuHenti/LaporanWaktuHentiGrafik.php";
                            }else{
                                include "_Page/WaktuHenti/LaporanWaktuHentiTabel.php";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>