<section class="section dashboard">
    <?php
        if($SessionAkses=="User"){
            echo '<div class="row">';
            echo '  <div class="col-lg-12">';
            echo '      <div class="alert alert-info alert-dismissible fade show" role="alert"> ';
            echo '          <small>';
            echo '              Halaman dukungan ini digunakan untuk mengirimkan request dukungan teknis pada unit yang anda pilih.';
            echo '          </small>';
            echo '          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
            if($SessionAkses=="Admin"){
                echo '<div class="row">';
                echo '  <div class="col-lg-12">';
                echo '      <div class="alert alert-info alert-dismissible fade show" role="alert"> ';
                echo '          <small>';
                echo '              User dapat mengirimkan request dukungan teknis pada unit tujuannya. Setiap anggota pada unit kerja dapat melihat riwayat dukungan teknis tersebut.';
                echo '          </small>';
                echo '          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '      </div>';
                echo '  </div>';
                echo '</div>';
            }
        }
    ?>
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
                                <button type="button" class="btn btn-md btn-info btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalFilterDukungan">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                            </div>
                            <div class="col-md-2 text-center mt-3">
                                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahDukungan">
                                    <i class="bi bi-plus-lg"></i> Request
                                </button>
                            </div>
                            <div class="col-md-2 text-center mt-3">
                                <button type="button" class="btn btn-md btn-warning btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalLaporanDukungan">
                                    <i class="bi bi-bar-chart"></i> Laporan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="MenampilkanTabelDukungan">

                </div>
            </div>
        </div>
    </div>
</section>