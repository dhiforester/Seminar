<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_mitra
    if(empty($_POST['id_barang'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          ID Supplier Tidak Boleh Kosong!.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_barang=$_POST['id_barang'];
        //Buka data supplier
        $QryBarang = mysqli_query($Conn,"SELECT * FROM barang WHERE id_barang='$id_barang'")or die(mysqli_error($Conn));
        $DataBarang = mysqli_fetch_array($QryBarang);
        $id_barang= $DataBarang['id_barang'];
        $id_mitra= $DataBarang['id_mitra'];
        $kode_barang= $DataBarang['kode_barang'];
        $nama_barang= $DataBarang['nama_barang'];
        $kategori_barang= $DataBarang['kategori_barang'];
        $satuan_barang= $DataBarang['satuan_barang'];
        $konversi= $DataBarang['konversi'];
        $harga_beli= $DataBarang['harga_beli'];
        $stok_barang= $DataBarang['stok_barang'];
        //Detail Mitra
        $QryMitra = mysqli_query($Conn,"SELECT * FROM mitra WHERE id_mitra='$id_mitra'")or die(mysqli_error($Conn));
        $DataMitra = mysqli_fetch_array($QryMitra);
        $nama_mitra= $DataMitra['nama_mitra'];
        //Hitung jumlah kategori harga
        $JumlahKategoriHarga=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM barang_harga WHERE id_barang='$id_barang'"));
?>
    <input type="hidden" name="id_barang" id="id_barang" value="<?php echo $id_barang;?>">
    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="id_mitra">Mitra</label>
            <select name="id_mitra" id="id_mitra" class="form-control">
                <option value="">Pilih</option>
                <?php
                    include "../../_Config/Connection.php";
                    $QryMitra = mysqli_query($Conn, "SELECT*FROM mitra ORDER BY nama_mitra ASC");
                    while ($DataMitra = mysqli_fetch_array($QryMitra)) {
                        $id_mitra_list= $DataMitra['id_mitra'];
                        $nama_mitra_list= $DataMitra['nama_mitra'];
                        if($id_mitra==$id_mitra_list){
                            echo '<option selected value="'.$id_mitra_list.'">'.$nama_mitra_list.'</option>';
                        }else{
                            echo '<option value="'.$id_mitra_list.'">'.$nama_mitra_list.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="col-md-3 mb-3">
            <label for="kode_barang">Kode Barang</label>
            <input type="text" name="kode_barang" id="kode_barang" class="form-control" value="<?php echo "$kode_barang"; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?php echo "$nama_barang"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="kategori_barang">Kategori</label>
            <input type="text" name="kategori_barang" id="kategori_barang" list="Listkategori" class="form-control" value="<?php echo "$kategori_barang"; ?>">
            <datalist id="Listkategori">
                <?php
                    $QryKategori = mysqli_query($Conn, "SELECT DISTINCT kategori_barang FROM barang ORDER BY kategori_barang ASC");
                    while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                        $kategori_barang_list= $DataKategori['kategori_barang'];
                        echo '<option value="'.$kategori_barang_list.'">';
                    }
                ?>
            </datalist>
        </div>
        <div class="col-md-6 mb-3">
            <label for="satuan_barang">Satuan</label>
            <input type="text" name="satuan_barang" id="satuan_barang" class="form-control" value="<?php echo "$satuan_barang"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="konversi">Konversi</label>
            <input type="number" min="1" name="konversi" id="konversi" class="form-control" required value="<?php echo "$konversi"; ?>">
        </div>
        <div class="col-md-3 mb-3">
            <label for="stok_barang">Stok</label>
            <input type="number" min="0" name="stok_barang" id="stok_barang" class="form-control" value="<?php echo "$stok_barang"; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="harga_beli">Harga Beli</label>
            <input type="number" min="0" name="harga_beli" id="harga_beli" class="form-control" value="<?php echo "$harga_beli"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <button type="button" class="btn btn-outline-primary btn-block btn-rounded" id="ButtonTambahKategoriHargaEdit">
                <i class="bi bi-plus"></i> Tambah Kategori
            </button>
        </div>
        <div class="col-md-6 mb-3">
            <button type="button" class="btn btn-outline-danger btn-block btn-rounded" id="HapusKategoriHargaEdit">
                <i class="bi bi-x-lg"></i> Kurangi Kategori
            </button>
        </div>
    </div>
    <div id="ListKategoriHargaEdit">
        <input type="hidden" name="jumlah_kategori_harga" id="jumlah_kategori_harga" value="<?php echo $JumlahKategoriHarga;?>">
        <?php
            $no=1;
            $QryHarga = mysqli_query($Conn, "SELECT*FROM barang_harga WHERE id_barang='$id_barang'");
            while ($DataHarga = mysqli_fetch_array($QryHarga)) {
                $kategori_harga= $DataHarga['kategori_harga'];
                $harga= $DataHarga['harga'];
        ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kode_barang<?php echo $no;?>"><small>Kategori Harga <?php echo $no;?></small></label>
                    <input type="text" name="kategori_harga<?php echo $no;?>" id="kategori_harga<?php echo $no;?>" class="form-control" value="<?php echo $kategori_harga;?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="kode_barang<?php echo $no;?>"><small>Harga <?php echo $no;?></small></label>
                    <input type="number" name="harga_jual<?php echo $no;?>" id="harga_jual<?php echo $no;?>" class="form-control" value="<?php echo $harga;?>">
                </div>
            </div>
        <?php $no++;} ?>
    </div>
    <div class="row">
        <div class="col-md-12" id="NotifikasiEditBarang">
            <span class="text-primary">Pastikan bahwa informasi barang yang anda masukan sudah benar</span>
        </div>
    </div>
<?php } ?>