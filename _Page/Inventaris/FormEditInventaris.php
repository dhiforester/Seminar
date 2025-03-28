<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_inventaris
    if(empty($_POST['id_inventaris'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3">';
        echo '          ID Akses Tidak Boleh Kosong.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_inventaris=$_POST['id_inventaris'];
        //Buka data inventaris
        $QryDetailInventaris = mysqli_query($Conn,"SELECT * FROM inventaris WHERE id_inventaris='$id_inventaris'")or die(mysqli_error($Conn));
        $DataDetailInventaris = mysqli_fetch_array($QryDetailInventaris);
        if(empty($DataDetailInventaris['id_inventaris'])){
            echo '  <div class="row">';
            echo '      <div class="col-md-12 mb-3">';
            echo '          ID Akses Tidak Ditemukan.';
            echo '      </div>';
            echo '  </div>';
        }else{
            $id_akses= $DataDetailInventaris['id_akses'];
            $id_unit_kerja= $DataDetailInventaris['id_unit_kerja'];
            $nama_unit_kerja = $DataDetailInventaris['nama_unit_kerja'];
            $kode= $DataDetailInventaris['kode'];
            $nama= $DataDetailInventaris['nama'];
            $kategori_barang= $DataDetailInventaris['kategori_barang'];
            $kategori_asset= $DataDetailInventaris['kategori_asset'];
            $spesifikasi= $DataDetailInventaris['spesifikasi'];
            $nomor_serial= $DataDetailInventaris['nomor_serial'];
            $gambar= $DataDetailInventaris['gambar'];
            $kondisi= $DataDetailInventaris['kondisi'];
            $ketersediaan= $DataDetailInventaris['ketersediaan'];
            $lokasi= $DataDetailInventaris['lokasi'];
            $qty= $DataDetailInventaris['qty'];
            $satuan= $DataDetailInventaris['satuan'];
            $tanggal_beli= $DataDetailInventaris['tanggal_beli'];
            $tanggal_garansi= $DataDetailInventaris['tanggal_garansi'];
            $tanggal_input= $DataDetailInventaris['tanggal_input'];
            if(empty($gambar)){
                $gambar="no-image.jpg";
            }else{
                $gambar="$gambar";
            }
?>
<input type="hidden" name="id_inventaris" id="id_inventaris" value="<?php echo "$id_inventaris"; ?>">
<div class="row">
    <div class="col-md-4 mt-3">
        <label for="nama">Nama Barang</label>
        <input type="text" name="nama" id="nama" class="form-control" value="<?php echo "$nama"; ?>">
    </div>
    <div class="col-md-4 mt-3">
        <label for="kategori_barang">Kategori</label>
        <input type="text" name="kategori_barang" id="kategori_barang" list="list_kategori_barang" class="form-control" value="<?php echo "$kategori_barang"; ?>">
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
        <input type="text" name="nomor_serial" id="nomor_serial" class="form-control" value="<?php echo "$nomor_serial"; ?>">
    </div>
    
</div>
<div class="row">
    <div class="col-md-12 mt-3">
        <label for="spesifikasi">Spesifikasi</label>
        <textarea name="spesifikasi" id="spesifikasi" cols="30" rows="3" class="form-control"><?php echo "$spesifikasi"; ?></textarea>
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
                    $id_unit_kerja_list= $DataUnitKerjaAnggota['id_unit_kerja'];
                    //Buka data unit kerja
                    $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja_list'")or die(mysqli_error($Conn));
                    $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                    $nama_unit_kerja_list= $DataUnitKerja['nama_unit_kerja'];
                    if($id_unit_kerja_list==$id_unit_kerja){
                        echo '<option selected value="'.$id_unit_kerja_list.'">'.$nama_unit_kerja_list.'</option>';
                    }else{
                        echo '<option value="'.$id_unit_kerja_list.'">'.$nama_unit_kerja_list.'</option>';
                    }
                }
            ?>
        </select>
    </div>
    <div class="col-md-3 mt-3">
        <label for="kategori_asset">Asset/BHP</label>
        <select name="kategori_asset" id="kategori_asset" class="form-control">
            <option <?php if($kategori_asset==""){echo "selected";} ?> value="">Pilih..</option>
            <option <?php if($kategori_asset=="Asset"){echo "selected";} ?> value="Asset">Asset</option>
            <option <?php if($kategori_asset=="BHP"){echo "selected";} ?> value="BHP">BHP</option>
        </select>
    </div>
    <div class="col-md-3 mt-3">
        <label for="kondisi">Kondisi</label>
        <select name="kondisi" id="kondisi" class="form-control">
            <option <?php if($kondisi==""){echo "selected";} ?> value="">Pilih..</option>
            <option <?php if($kondisi=="Berfungsi"){echo "selected";} ?> value="Berfungsi">Berfungsi</option>
            <option <?php if($kondisi=="Rusak"){echo "selected";} ?> value="Rusak">Rusak</option>
        </select>
    </div>
    <div class="col-md-3 mt-3">
        <label for="ketersediaan">Ketersediaan</label>
        <select name="ketersediaan" id="ketersediaan" class="form-control">
            <option <?php if($ketersediaan=="Rusak"){echo "selected";} ?> value="">Pilih..</option>
            <option <?php if($ketersediaan=="Tersedia"){echo "selected";} ?> value="Tersedia">Tersedia</option>
            <option <?php if($ketersediaan=="Tidak Tersedia"){echo "selected";} ?> value="Tidak Tersedia">Tidak Tersedia</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mt-3">
        <label for="lokasi">Lokasi Penyimpanan</label>
        <input type="text" name="lokasi" id="lokasi" class="form-control" value="<?php echo "$lokasi"; ?>">
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
        <input type="text" name="satuan" id="satuan" list="ListSatuan" class="form-control" value="<?php echo "$satuan"; ?>">
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
        <input type="number" name="qty" id="qty" class="form-control" value="<?php echo "$qty"; ?>">
    </div>
    <div class="col-md-3 mt-3">
        <label for="tanggal_beli">Tanggal Beli</label>
        <input type="date" name="tanggal_beli" id="tanggal_beli" class="form-control" value="<?php echo "$tanggal_beli"; ?>">
    </div>
    <div class="col-md-3 mt-3">
        <label for="tanggal_garansi">Tanggal Garansi</label>
        <input type="date" name="tanggal_garansi" id="tanggal_garansi" class="form-control" value="<?php echo "$tanggal_garansi"; ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3" id="NotifikasiEditInventaris">
        <small class="text-primary">Pastkan data yang anda input sudah benar</small>
    </div>
</div>
<?php } } ?>