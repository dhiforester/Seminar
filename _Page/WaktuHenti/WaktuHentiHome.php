<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info alert-dismissible fade show" role="alert"> 
                <small>
                    Berikut ini adalah halaman waktu henti yang digunakan untuk mencatat kejadian waktu henti sistem (Down Time). 
                    Silahkan gunakan tombol <b>Tambah</b> untuk mencatat kejadian, pastikan anda mengisi informasi dengan benar dan akurat.
                </small>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form action="javascript:void(0);" id="ProsesBatas">
                        <div class="row">
                            <div class="col-md-1 mt-3">
                                <select name="batas" id="batas" class="form-control">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="250">250</option>
                                    <option value="500">500</option>
                                </select>
                                <small>Data</small>
                            </div>
                            <div class="col-md-3 mt-3">
                                <input type="text" name="keyword" id="keyword" class="form-control">
                                <small>Pencarian</small>
                            </div>
                            <div class="col-md-2 mt-3">
                                <button type="submit" class="btn btn-md btn-dark btn-block btn-rounded">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                            <div class="col-md-2 mt-3">
                                <button type="button" class="btn btn-md btn-info btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalFilterWaktuHenti">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                            </div>
                            <?php if($SessionAkses=="Admin"){ ?>
                                <div class="col-md-2 text-center mt-3">
                                    <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahWaktuHenti">
                                        <i class="bi bi-plus"></i> Tambah
                                    </button>
                                </div>
                            <?php } ?>
                            <div class="col-md-2 text-center mt-3">
                                <a href="index.php?Page=WaktuHenti&Sub=Laporan" class="btn btn-md btn-warning btn-block btn-rounded">
                                    <i class="bi bi-bar-chart"></i> Laporan
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="MenampilkanTabelWaktuHenti">

                </div>
            </div>
        </div>
    </div>
</section>