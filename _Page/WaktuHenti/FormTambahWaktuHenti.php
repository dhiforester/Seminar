<div class="row">
    <div class="col-md-6 mt-3">
        <label for="tanggal_mulai">Tanggal Kejadian</label>
        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control">
    </div>
    <div class="col-md-6 mt-3">
        <label for="waktu_mulai">Waktu Kejadian</label>
        <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mt-3">
        <label for="tanggal_selesai">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control">
    </div>
    <div class="col-md-6 mt-3">
        <label for="waktu_selesai">Waktu Kejadian</label>
        <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3">
        <label for="kategori">Kategori</label>
        <select name="kategori" id="kategori" class="form-control">
            <option value="">Pilih..</option>
            <option value="Direncanakan">Direncanakan</option>
            <option value="Tidak Direncanakan">Tidak Direncanakan</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3">
        <label for="keterangan">Keterangan/Penyebab Down & Penyelesaian</label>
        <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control"></textarea>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="">Pilih..</option>
            <option value="Pending">Pending</option>
            <option value="Proses">Proses</option>
            <option value="Selesai">Selesai</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3" id="NotifikasiTambahWaktuHenti">
        <small class="text-primary">Pastkan data yang anda input sudah benar</small>
    </div>
</div>