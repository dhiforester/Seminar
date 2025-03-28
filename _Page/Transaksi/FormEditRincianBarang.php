<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_transaksi_rincian
    if(empty($_POST['id_transaksi_rincian'])){
        echo ' <div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger mb-3">';
        echo '          ID Rincian Tidak Boleh Kosong!.';
        echo '      </div>';
        echo '  </div>';
        echo ' </div>';
        echo ' <div class="modal-footer bg-info">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3">';
        echo '          <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">';
        echo '              <i class="bi bi-x-circle"></i> Tutup';
        echo '          </button>';
        echo '      </div>';
        echo '  </div>';
        echo ' </div>';
    }else{
        $id_transaksi_rincian=$_POST['id_transaksi_rincian'];
        //Buka data rincian
        $QryRincian = mysqli_query($Conn,"SELECT * FROM transaksi_rincian WHERE id_transaksi_rincian='$id_transaksi_rincian'")or die(mysqli_error($Conn));
        $DataRincian = mysqli_fetch_array($QryRincian);
        $id_barang= $DataRincian['id_barang'];
        $qty= $DataRincian['qty'];
        $id_barang_harga= $DataRincian['id_barang_harga'];
        $id_barang_satuan= $DataRincian['id_barang_satuan'];
        $HargaRincian= $DataRincian['harga'];
        $JumlahRincian= $DataRincian['jumlah'];
        //Buka data barang
        $QryBarang = mysqli_query($Conn,"SELECT * FROM barang WHERE id_barang='$id_barang'")or die(mysqli_error($Conn));
        $DataBarang = mysqli_fetch_array($QryBarang);
        $id_mitra= $DataBarang['id_mitra'];
        $kode_barang= $DataBarang['kode_barang'];
        $nama_barang= $DataBarang['nama_barang'];
        $kategori_barang= $DataBarang['kategori_barang'];
        $satuan_barang= $DataBarang['satuan_barang'];
        $konversi= $DataBarang['konversi'];
        $harga_beli= $DataBarang['harga_beli'];
        $harga_beli_rp = "Rp " . number_format($harga_beli,0,',','.');
        $stok_barang= $DataBarang['stok_barang'];
        //Detail Mitra
        $QryMitra = mysqli_query($Conn,"SELECT * FROM mitra WHERE id_mitra='$id_mitra'")or die(mysqli_error($Conn));
        $DataMitra = mysqli_fetch_array($QryMitra);
        $nama_mitra= $DataMitra['nama_mitra'];
        //Harga Barang
        $QryHarga = mysqli_query($Conn,"SELECT * FROM barang_harga WHERE id_barang='$id_barang'")or die(mysqli_error($Conn));
        $DataHarga = mysqli_fetch_array($QryHarga);
        $HargaMulti= $DataHarga['harga'];
        if(empty($DataHarga['harga'])){
            $HargaJual=$harga_beli;
        }else{
            $HargaJual=$DataHarga['harga'];
        }
        //Pada saat mode edit transaksi
        if(empty($_POST['GetIdTransaksi'])){
            $GetIdTransaksi="";
        }else{
            $GetIdTransaksi=$_POST['GetIdTransaksi'];
        }
?>
    <input type="hidden" name="id_barang" id="id_barang" value="<?php echo "$id_barang"; ?>">
    <input type="hidden" name="GetIdTransaksi" id="GetIdTransaksi" value="<?php echo "$GetIdTransaksi"; ?>">
    <input type="hidden" name="id_transaksi_rincian" id="id_transaksi_rincian" value="<?php echo "$id_transaksi_rincian"; ?>">
    <div class="row mt-2"> 
        <div class="col-md-12 mb-3">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" readonly name="nama_barang" id="nama_barang" class="form-control" value="<?php echo $nama_barang;?>">
        </div>
    </div>
    <div class="row mt-2"> 
        <div class="col-md-6 mb-3">
            <label for="qty">QTY</label>
            <input type="number" name="qty" id="qty_rincian" class="form-control" value="<?php echo $qty;?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="qty">Satuan</label>
            <select name="rincian_satuan_barang" id="rincian_satuan_barang" class="form-control">
                <?php
                    echo '<option value="'.$satuan_barang.'">'.$satuan_barang.'</option>';
                    $QrySatuan = mysqli_query($Conn, "SELECT*FROM barang_satuan WHERE id_barang='$id_barang'");
                    while ($DataSatuan = mysqli_fetch_array($QrySatuan)) {
                        $id_barang_satuan_list= $DataSatuan['id_barang_satuan'];
                        $satuan_multi= $DataSatuan['satuan_multi'];
                        if($id_barang_satuan_list==$id_barang_satuan){
                            echo '<option selected value="'.$satuan_multi.'">'.$satuan_multi.'</option>';
                        }else{
                            echo '<option value="'.$satuan_multi.'">'.$satuan_multi.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3" id="FormKategoriHarga">
            <label for="id_barang_harga">Kategori Harga</label>
            <select name="id_barang_harga" id="id_barang_harga" class="form-control">
                <?php
                    echo '<option value="0">Harga Beli</option>';
                    $QryHargaMulti= mysqli_query($Conn, "SELECT*FROM barang_harga WHERE id_barang='$id_barang'");
                    while ($DataHargaMulti = mysqli_fetch_array($QryHargaMulti)) {
                        $id_barang_harga_list= $DataHargaMulti['id_barang_harga'];
                        $kategori_harga= $DataHargaMulti['kategori_harga'];
                        $HargaMutli= $DataHargaMulti['harga'];
                        if($id_barang_harga==$id_barang_harga_list){
                            echo '<option selected value="'.$id_barang_harga_list.'">'.$kategori_harga.'</option>';
                        }else{
                            echo '<option value="'.$id_barang_harga_list.'">'.$kategori_harga.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="harga">Harga</label>
            <input type="text" name="harga" id="harga_rincian" class="form-control" value="<?php echo $HargaRincian;?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="jumlah">Jumlah</label>
            <input type="text" name="jumlah" id="jumlah_rincian" class="form-control" value="<?php echo $JumlahRincian;?>">
        </div>
    </div>
    <div class="row mb-2"> 
        <div class="col-md-12" id="NotifikasiEditRincianBarang">
            <span>Pastikan rincian yang anda input sudah sesuai</span>
        </div>
    </div>
<?php } ?>