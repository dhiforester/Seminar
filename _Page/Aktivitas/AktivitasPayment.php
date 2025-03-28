<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form action="javascript:void(0);" id="ProsesBatasAktivitasPayment">
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <select name="DasarPencarian" id="DasarPencarianPayment" class="form-control">
                                    <option value="Tanggal">Tanggal</option>
                                    <option value="Kode Transaksi">Kode Transaksi</option>
                                </select>
                                <small>Dasar Pencarian</small>
                            </div>
                            <div class="col-md-6 mt-3" id="KeywordFormTransaksi">
                                <input type="date" name="KeywordAktivitasPayment" id="KeywordAktivitasPayment" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                <small>Pencarian</small>
                            </div>
                            <div class="col-md-3 mt-3">
                                <button type="submit" class="btn btn-md btn-dark btn-block btn-rounded">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="MenampilkanTabelAktivitasPayment">
                    <!-- Menampilkan Tabel Aktivitas Payment -->
                </div>
            </div>
        </div>
    </div>
</section>