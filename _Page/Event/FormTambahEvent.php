<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    date_default_timezone_set("Asia/Jakarta");
    $tanggal=date('Y-m-d');
    $jam=date('H:i');
?>
<input type="hidden" name="id_akses" id="id_akses" value="<?php echo $SessionIdAkses;?>">
<div class="row mb-4">
    <div class="col-md-4 mb-2">
        Mulai Event
    </div>
    <div class="col-md-4 mb-2">
        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="<?php echo $tanggal;?>">
        <small><label for="tanggal_mulai">Tanggal Mulai Event</label></small>
    </div>
    <div class="col-md-4 mb-2">
        <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" value="<?php echo $jam;?>">
        <small><label for="waktu_mulai">Jam Mulai Event</label></small>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-4 mb-2">
        Tanggal Selesai
    </div>
    <div class="col-md-4 mb-2">
        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control">
        <small><label for="tanggal_selesai">Tanggal Selesai Event</label></small>
    </div>
    <div class="col-md-4 mb-2">
        <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control">
        <small><label for="waktu_selesai">Jam Selesai Event</label></small>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-4 mb-2">
        Mulai Pendaftaran
    </div>
    <div class="col-md-4 mb-2">
        <input type="date" name="tanggal_mulai_pendaftaran" id="tanggal_mulai_pendaftaran" class="form-control" value="<?php echo $tanggal;?>">
        <small><label for="tanggal_mulai_pendaftaran">Tanggal Mulai Pendaftaran</label></small>
    </div>
    <div class="col-md-4 mb-2">
        <input type="time" name="waktu_mulai_pendaftaran" id="waktu_mulai_pendaftaran" class="form-control" value="<?php echo $jam;?>">
        <small><label for="waktu_mulai_pendaftaran">Jam Mulai Pendaftaran</label></small>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-4 mb-2">
        Selesai Pendaftaran
    </div>
    <div class="col-md-4 mb-2">
        <input type="date" name="tanggal_selesai_pendaftaran" id="tanggal_selesai_pendaftaran" class="form-control">
        <small><label for="tanggal_selesai_pendaftaran">Tanggal Selesai Pendaftaran</label></small>
    </div>
    <div class="col-md-4 mb-2">
        <input type="time" name="waktu_selesai_pendaftaran" id="waktu_selesai_pendaftaran" class="form-control">
        <small><label for="waktu_selesai_pendaftaran">Jam Selesai Pendaftaran</label></small>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-4 mb-2">
        <label for="nama_event">Nama Event</label>
    </div>
    <div class="col-md-8 mb-2">
        <input type="text" name="nama_event" id="nama_event" class="form-control">
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-4 mb-2">
        <label for="keterangan_event">Keterangan Event</label>
    </div>
    <div class="col-md-8 mb-2">
        <textarea name="keterangan_event" id="keterangan_event" cols="30" rows="4" class="form-control"></textarea>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-4 mb-2">
        <label for="status">Status</label>
    </div>
    <div class="col-md-8 mb-2">
        <select name="status" id="status" class="form-control">
            <option value="">Pilih</option>
            <option value="Rencana">Rencana</option>
            <option value="Berlangsung">Berlangsung</option>
            <option value="Selesai">Selesai</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3" id="NotifikasiTambahEvent">
        <small class="text-primary">Pastkan data yang anda input sudah benar</small>
    </div>
</div>