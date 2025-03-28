<form action="javascript:void(0);" id="ProsesGenerateKodePembayaran">
    <input type="hidden" id="id_peserta" name="id_peserta" value="<?php echo "$id_peserta" ?>">
    <input type="hidden" id="id_event_setting" name="id_event_setting" value="<?php echo "$id_event_setting" ?>">
    <input type="hidden" id="id_event_kategori" name="id_event_kategori" value="<?php echo "$id_event_kategori" ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="input-group">
                <input type="text" name="kode_kupon" id="kode_kupon" class="form-control" placeholder="Kode Promo">
                <button type="button" class="btn btn-sm btn-rounded btn-primary" id="TerapkanKupon">
                    Use 
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="NotifikasiMenerapkanKodePromo"></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <ol>
                <li>Event : <code class="text-info"><?php echo "$nama_event"; ?></code></li>
                <li>Category : <code class="text-info"><?php echo "$KategoriEvent"; ?></code></li>
                <li>Ticket Price : <code class="text-info"><?php echo "$format_rupiah_harga"; ?></code></li>
                <li>Admin Fees : <code class="text-info"><?php echo "$biaya_adm_rp"; ?></code></li>
                <li>Discount : <code class="text-info">0 %</code></li>
                <li>Amount : <code class="text-info"><?php echo "$format_rupiah_tagihan"; ?></code></li>
            </ol>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12 mt-3 text-center" id="NotifikasiPembayaranPeserta">
            <small class="text-primary">Make sure the data you input is correct</small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-sm btn-rounded btn-primary btn-block">
                Continue <i class="bi bi-arrow-right-circle"></i>
            </button>
        </div>
    </div>
</form>