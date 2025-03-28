<script>
    
</script>
<div class="row">
    <div class="col-md-3 mb-3">
        <label for="id_mitra">Mitra</label>
        <select name="id_mitra" id="id_mitra" class="form-control">
            <option value="">Pilih</option>
            <?php
                include "../../_Config/Connection.php";
                $QryMitra = mysqli_query($Conn, "SELECT*FROM mitra ORDER BY nama_mitra ASC");
                while ($DataMitra = mysqli_fetch_array($QryMitra)) {
                    $id_mitra= $DataMitra['id_mitra'];
                    $nama_mitra= $DataMitra['nama_mitra'];
                    echo '<option value="'.$id_mitra.'">'.$nama_mitra.'</option>';
                }
            ?>
        </select>
    </div>
    <div class="col-md-3 mb-3">
        <label for="kode_barang">Kode Barang</label>
        <input type="text" name="kode_barang" id="kode_barang" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="kategori_barang">Kategori</label>
        <input type="text" name="kategori_barang" id="kategori_barang" list="Listkategori" class="form-control">
        <datalist id="Listkategori">
            <?php
                $QryKategori = mysqli_query($Conn, "SELECT DISTINCT kategori_barang FROM barang ORDER BY kategori_barang ASC");
                while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                    $kategori_barang= $DataKategori['kategori_barang'];
                    echo '<option value="'.$kategori_barang.'">';
                }
            ?>
        </datalist>
    </div>
    <div class="col-md-6 mb-3">
        <label for="satuan_barang">Satuan</label>
        <input type="text" name="satuan_barang" id="satuan_barang" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-3 mb-3">
        <label for="konversi">Konversi</label>
        <input type="number" min="1" name="konversi" id="konversi" class="form-control" required value="1">
    </div>
    <div class="col-md-3 mb-3">
        <label for="stok_barang">Stok</label>
        <input type="number" min="0" name="stok_barang" id="stok_barang" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        <label for="harga_beli">Harga Beli</label>
        <input type="number" min="0" name="harga_beli" id="harga_beli" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <button type="button" class="btn btn-outline-primary btn-block btn-rounded" id="ButtonTambahKategoriHarga">
            <i class="bi bi-plus"></i> Tambah Kategori
        </button>
    </div>
    <div class="col-md-6 mb-3">
        <button type="button" class="btn btn-outline-danger btn-block btn-rounded" id="HapusKategoriHarga">
            <i class="bi bi-x-lg"></i> Kurangi Kategori
        </button>
    </div>
</div>
<div id="ListKategoriHarga">
    <input type="hidden" name="jumlah_kategori_harga" id="jumlah_kategori_harga" value="1">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="kategori_harga1"><small>Kategori Harga 1</small></label>
            <input type="text" name="kategori_harga1" id="kategori_harga1" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label for="kode_barang"><small>Harga 1</small></label>
            <input type="number" name="harga_jual1" id="harga_jual1" class="form-control">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="NotifikasiTambahBarang">
        <span class="text-primary">Pastikan bahwa informasi barang yang anda masukan sudah benar</span>
    </div>
</div>
