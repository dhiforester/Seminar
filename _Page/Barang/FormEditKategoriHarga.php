<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_mitra
    if(empty($_POST['id_barang_harga'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          ID Harga Barang Tidak Boleh Kosong!.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_barang_harga=$_POST['id_barang_harga'];
        //Buka data supplier
        $QryBarangHarga = mysqli_query($Conn,"SELECT * FROM barang_harga WHERE id_barang_harga='$id_barang_harga'")or die(mysqli_error($Conn));
        $DataBarangHarga = mysqli_fetch_array($QryBarangHarga);
        $id_barang= $DataBarangHarga['id_barang'];
        $id_barang_satuan= $DataBarangHarga['id_barang_satuan'];
        $kategori_harga= $DataBarangHarga['kategori_harga'];
        $harga= $DataBarangHarga['harga'];
        //Buka barang
        $QryBarang = mysqli_query($Conn,"SELECT * FROM barang WHERE id_barang='$id_barang'")or die(mysqli_error($Conn));
        $DataBarang = mysqli_fetch_array($QryBarang);
        $satuan_barang= $DataBarang['satuan_barang'];
?>
    <input type="hidden" name="id_barang_harga" id="id_barang_harga" value="<?php echo $id_barang_harga;?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="id_barang_satuan">Satuan</label>
            <select name="id_barang_satuan" id="id_barang_satuan_detail2" class="form-control">
                <option value="0"><?php echo "$satuan_barang"; ?></option>
                <?php
                    if(empty($id_barang_satuan)){
                        echo '<option selected value="0">'.$satuan_barang.'</option>';
                    }
                    $QrySatuanMulti = mysqli_query($Conn, "SELECT * FROM barang_satuan WHERE id_barang='$id_barang' ORDER BY satuan_multi ASC");
                    while ($DataSatuanMulti = mysqli_fetch_array($QrySatuanMulti)) {
                        $id_barang_satuan_list= $DataSatuanMulti['id_barang_satuan'];
                        $satuan_multi_list= $DataSatuanMulti['satuan_multi'];
                        if($id_barang_satuan_list==$id_barang_satuan){
                            echo '<option selected value="'.$id_barang_satuan_list.'">'.$satuan_multi_list.'</option>';
                        }else{
                            echo '<option  value="'.$id_barang_satuan_list.'">'.$satuan_multi_list.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="kategori_harga">Kategori Harga</label>
            <input type="text" name="kategori_harga" id="kategori_harga" class="form-control" value="<?php echo "$kategori_harga";?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="harga_multi">Harga</label>
            <input type="text" name="harga_multi" id="harga_multi2" class="form-control" value="<?php echo "$harga";?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="NotifikasiEditKategoriHarga">
            <span class="text-primary">Pastikan bahwa informasi barang yang anda masukan sudah benar</span>
        </div>
    </div>
<?php } ?>