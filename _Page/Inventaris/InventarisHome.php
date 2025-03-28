<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info alert-dismissible fade show" role="alert"> 
                <small>
                    Kelola inventaris digunakan untuk mempermudah personel pada unit yang bekerja mengelola barang-barangnya, tambahkan informasi dengan lengkap untuk mempermudah anda mengelola data inventaris tersebut.
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
                                <button type="button" class="btn btn-md btn-info btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalFilterInventaris">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                            </div>
                            <div class="col-md-2 text-center mt-3">
                                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahInventaris">
                                    <i class="bi bi-person-plus"></i> Tambah
                                </button>
                            </div>
                            <div class="col-md-2 text-center mt-3">
                                <button type="button" class="btn btn-md btn-warning btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalCetakInventaris">
                                    <i class="bi bi-printer"></i> Cetak
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="MenampilkanTabelInventaris">

                </div>
            </div>
        </div>
    </div>
</section>