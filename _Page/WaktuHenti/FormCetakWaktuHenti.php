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
<div class="row">
    <div class="col-md-6 mt-3">
        <label for="FormatCetak">Format Cetak</label>
        <input type="text" readonly name="bentuk_laporan2" id="bentuk_laporan2" class="form-control" value="<?php echo "$bentuk_laporan"; ?>">
    </div>
    <div class="col-md-6 mt-3">
        <label for="periode_laporan2">Format Cetak</label>
        <input type="text" readonly name="periode_laporan2" id="periode_laporan2" class="form-control" value="<?php echo "$periode_laporan"; ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mt-3">
        <label for="tahun2">Tahun</label>
        <input type="text" readonly name="tahun2" id="tahun2" class="form-control" value="<?php echo "$tahun"; ?>">
    </div>
    <div class="col-md-6 mt-3">
        <label for="bulan2">Bulan</label>
        <input type="text" readonly name="bulan2" id="bulan2" class="form-control" value="<?php echo "$bulan"; ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mt-3">
        <label for="FormatCetak">Format Cetak</label>
        <select name="FormatCetak" id="FormatCetak" class="form-control">
            <option value="PDF">PDF</option>
            <option value="HTML">HTML</option>
        </select>
    </div>
    <div class="col-md-6 mt-3">
        <label for="TampilkanKop">Tampilkan Header</label>
        <select name="TampilkanKop" id="TampilkanKop" class="form-control">
            <option value="Ya">Ya</option>
            <option value="Tidak">Tidak</option>
        </select>
    </div>
</div>