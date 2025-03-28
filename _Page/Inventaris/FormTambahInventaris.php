<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
?>
<div class="row">
    <div class="col-md-4 mt-3">
        <label for="nama">Nama Barang</label>
        <input type="text" name="nama" id="nama" class="form-control">
    </div>
    <div class="col-md-4 mt-3">
        <label for="kategori_barang">Kategori</label>
        <input type="text" name="kategori_barang" id="kategori_barang" list="list_kategori_barang" class="form-control">
        <datalist id="list_kategori_barang">
            <?php
                $QryKategori = mysqli_query($Conn, "SELECT DISTINCT kategori_barang FROM inventaris ORDER BY kategori_barang ASC");
                while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                    $kategori_barang= $DataKategori['kategori_barang'];
                    echo '<option value="'.$kategori_barang.'">';
                }
            ?>
        </datalist>
    </div>
    <div class="col-md-4 mt-3">
        <label for="nomor_serial">Nomor Serial (Jika Ada)</label>
        <input type="text" name="nomor_serial" id="nomor_serial" class="form-control">
    </div>
    
</div>
<div class="row">
    <div class="col-md-12 mt-3">
        <label for="spesifikasi">Spesifikasi</label>
        <textarea name="spesifikasi" id="spesifikasi" cols="30" rows="3" class="form-control"></textarea>
    </div>
</div>
<div class="row">
    <div class="col-md-3 mt-3">
        <label for="id_unit_kerja">Unit Kerja</label>
        <select name="id_unit_kerja" id="id_unit_kerja" class="form-control">
            <option value="">General</option>
            <?php
                $QryUnitKerjaAnggota = mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_akses='$SessionIdAkses' ORDER BY id_unit_kerja ASC");
                while ($DataUnitKerjaAnggota = mysqli_fetch_array($QryUnitKerjaAnggota)) {
                    $id_unit_kerja= $DataUnitKerjaAnggota['id_unit_kerja'];
                    //Buka data unit kerja
                    $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                    $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                    $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                    echo '<option value="'.$id_unit_kerja.'">'.$nama_unit_kerja.'</option>';
                }
            ?>
        </select>
    </div>
    <div class="col-md-3 mt-3">
        <label for="kategori_asset">Asset/BHP</label>
        <select name="kategori_asset" id="kategori_asset" class="form-control">
            <option value="">Pilih..</option>
            <option value="Asset">Asset</option>
            <option value="BHP">BHP</option>
        </select>
    </div>
    <div class="col-md-3 mt-3">
        <label for="kondisi">Kondisi</label>
        <select name="kondisi" id="kondisi" class="form-control">
            <option value="">Pilih..</option>
            <option value="Berfungsi">Berfungsi</option>
            <option value="Rusak">Rusak</option>
        </select>
    </div>
    <div class="col-md-3 mt-3">
        <label for="ketersediaan">Ketersediaan</label>
        <select name="ketersediaan" id="ketersediaan" class="form-control">
            <option value="">Pilih..</option>
            <option value="Tersedia">Tersedia</option>
            <option value="Tidak Tersedia">Tidak Tersedia</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mt-3">
        <label for="lokasi">Lokasi Penyimpanan</label>
        <input type="text" name="lokasi" id="lokasi" class="form-control">
        <small class="credit">Nomor Rak/Nama Ruangan</small>
    </div>
    <div class="col-md-6 mt-3">
        <label for="gambar">Gambar Barang</label>
        <input type="file" name="gambar" id="gambar" class="form-control">
        <small class="credit">Maximum File 2 Mb (PNG, JPG, JPEG, GIF)</small>
    </div>
</div>
<div class="row">
    <div class="col-md-3 mt-3">
        <label for="satuan">satuan</label>
        <input type="text" name="satuan" id="satuan" list="ListSatuan" class="form-control">
        <datalist id="ListSatuan">
            <?php
                $QrySatuan = mysqli_query($Conn, "SELECT DISTINCT satuan FROM inventaris ORDER BY satuan ASC");
                while ($DataSatuan = mysqli_fetch_array($QrySatuan)) {
                    $satuan= $DataSatuan['satuan'];
                    echo '<option value="'.$satuan.'">';
                }
            ?>
        </datalist>
    </div>
    <div class="col-md-3 mt-3">
        <label for="qty">Qty</label>
        <input type="number" name="qty" id="qty" class="form-control">
    </div>
    <div class="col-md-3 mt-3">
        <label for="tanggal_beli">Tanggal Beli</label>
        <input type="date" name="tanggal_beli" id="tanggal_beli" class="form-control">
    </div>
    <div class="col-md-3 mt-3">
        <label for="tanggal_garansi">Tanggal Garansi</label>
        <input type="date" name="tanggal_garansi" id="tanggal_garansi" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3" id="NotifikasiTambahInventaris">
        <small class="text-primary">Pastkan data yang anda input sudah benar</small>
    </div>
</div>