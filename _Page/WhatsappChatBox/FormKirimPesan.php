<?php
    if(empty($_POST['GetDetailNomor'])){
        $GetDetailNomor="";
    }else{
        $GetDetailNomor=$_POST['GetDetailNomor'];
    }
?>
<div class="row">
    <div class="col-md-6 mt-3">
        <label for="pengirim">Nomor Pengirim</label>
        <input type="text" name="pengirim" id="pengirim" class="form-control" value="<?php echo "$GetDetailNomor"; ?>">
    </div>
    <div class="col-md-6 mt-3">
        <label for="tujuan">Nomor Tujuan</label>
        <input type="text" name="tujuan" id="tujuan" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3">
        <label for="pesan">Isi Pesan</label>
        <textarea name="pesan" id="pesan" cols="30" rows="3" class="form-control"></textarea>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3">
        <label for="media">Isi Pesan</label>
        <input type="file" name="media" id="media" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3" id="NotifikasiKirimPesan2">
        <span class="text-primary">Pastikan Form Pesan Terisi Dengan Benar</span>
    </div>
</div>