<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_mitra
    if(empty($_POST['id_barang'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger mb-3">';
        echo '          ID Barang Tidak Boleh Kosong!.';
        echo '      </div>';
        echo '  </div>';
    }else{
        if(empty($_POST['id_mitra'])){
            echo '  <div class="row">';
            echo '      <div class="col-md-12 text-center text-danger mb-3">';
            echo '          ID Mitra Tidak Boleh Kosong!.';
            echo '      </div>';
            echo '  </div>';
        }else{
            //Khusus untuk mode edit
            if(!empty($_POST['GetIdTransaksi'])){
                $GetIdTransaksi=$_POST['GetIdTransaksi'];
            }else{
                $GetIdTransaksi="";
            }
            $id_barang=$_POST['id_barang'];
            $id_mitra=$_POST['id_mitra'];
            //Buka data barang
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
            $harga_beli_rp = "Rp " . number_format($harga_beli,0,',','.');
            $stok_barang= $DataBarang['stok_barang'];
            //Detail Mitra
            $QryMitra = mysqli_query($Conn,"SELECT * FROM mitra WHERE id_mitra='$id_mitra'")or die(mysqli_error($Conn));
            $DataMitra = mysqli_fetch_array($QryMitra);
            $nama_mitra= $DataMitra['nama_mitra'];
            //Harga Barang
            $QryHarga = mysqli_query($Conn,"SELECT * FROM barang_harga WHERE id_barang='$id_barang'")or die(mysqli_error($Conn));
            $DataHarga = mysqli_fetch_array($QryHarga);
            if(empty($DataHarga['harga'])){
                $HargaMulti="";
                $HargaJual=$harga_beli;
            }else{
                $HargaMulti= $DataHarga['harga'];
                $HargaJual=$DataHarga['harga'];
            }
            //menangkap data untuk transaksi sementara
            if(!empty($_POST['tanggal'])){
                $tanggal=$_POST['tanggal'];
            }else{
                $tanggal="";
            }
            if(!empty($_POST['kategori'])){
                $kategori=$_POST['kategori'];
            }else{
                $kategori="";
            }
            if(!empty($_POST['supplier'])){
                $supplier=$_POST['supplier'];
            }else{
                $supplier="0";
            }
            if(!empty($_POST['pasien'])){
                $pasien=$_POST['pasien'];
            }else{
                $pasien="0";
            }
            if(!empty($_POST['kunjungan'])){
                $kunjungan=$_POST['kunjungan'];
            }else{
                $kunjungan="0";
            }
            if(!empty($_POST['metode'])){
                $metode=$_POST['metode'];
            }else{
                $metode="";
            }
            if(!empty($_POST['keterangan'])){
                $keterangan=$_POST['keterangan'];
            }else{
                $keterangan="";
            }
            if(!empty($_POST['pembayaran'])){
                $pembayaran=$_POST['pembayaran'];
            }else{
                $pembayaran="0";
            }
            if(!empty($_POST['status'])){
                $status=$_POST['status'];
            }else{
                $status="";
            }
            //Cek apakah User tersebut sudah memiliki data sementara
            $QryCekDataSementara= mysqli_query($Conn,"SELECT * FROM transaksi_sementara WHERE id_akses='$SessionIdAkses'")or die(mysqli_error($Conn));
            $DataCekSementara = mysqli_fetch_array($QryCekDataSementara);
            if(empty($DataCekSementara['id_transaksi_sementara'])){
                //Menyimpan data transaksi sementara
                $EntryDataSementara="INSERT INTO transaksi_sementara (
                    id_akses,
                    id_mitra,
                    id_pasien,
                    id_kunjungan,
                    id_supplier,
                    tanggal,
                    kategori,
                    metode,
                    keterangan,
                    pembayaran,
                    status
                ) VALUES (
                    '$SessionIdAkses',
                    '$id_mitra',
                    '$pasien',
                    '$kunjungan',
                    '$supplier',
                    '$tanggal',
                    '$kategori',
                    '$metode',
                    '$keterangan',
                    '$pembayaran',
                    '$status'
                )";
                $InputDataSementara=mysqli_query($Conn, $EntryDataSementara);
                if($InputDataSementara){
                    $ValidasiDataSmenetara="Valid";
                }else{
                    $ValidasiDataSmenetara="Terjadi Kesalahan Pada Saat Menambah Data Sementara";
                }
            }else{
                $id_transaksi_sementara=$DataCekSementara['id_transaksi_sementara'];
                $UpdateDataSementara = mysqli_query($Conn,"UPDATE transaksi_sementara SET 
                    id_akses='$SessionIdAkses',
                    id_mitra='$id_mitra',
                    id_pasien='$pasien',
                    id_kunjungan='$kunjungan',
                    id_supplier='$supplier',
                    tanggal='$tanggal',
                    kategori='$kategori',
                    metode='$metode',
                    keterangan='$keterangan',
                    pembayaran='$pembayaran',
                    status='$status'
                WHERE id_transaksi_sementara='$id_transaksi_sementara'") or die(mysqli_error($Conn)); 
                if($UpdateDataSementara){
                    $ValidasiDataSmenetara="Valid";
                }else{
                    $ValidasiDataSmenetara="Terjadi Kesalahan Pada Saat Melakukan Update Data Sementara";
                }
            }
            if($ValidasiDataSmenetara=="Valid"){
?>

    <input type="hidden" name="id_mitra" value="<?php echo "$id_mitra"; ?>">
    <input type="hidden" name="id_barang" value="<?php echo "$id_barang"; ?>">
    <input type="hidden" name="tanggal" value="<?php echo "$tanggal"; ?>">
    <input type="hidden" name="kategori" value="<?php echo "$kategori"; ?>">
    <input type="hidden" name="supplier"  value="<?php echo "$supplier"; ?>">
    <input type="hidden" name="pasien"  value="<?php echo "$pasien"; ?>">
    <input type="hidden" name="kunjungan"  value="<?php echo "$kunjungan"; ?>">
    <input type="hidden" name="metode"  value="<?php echo "$metode"; ?>">
    <input type="hidden" name="status"  value="<?php echo "$status"; ?>">
    <input type="hidden" name="id_transaksi" value="<?php echo "$GetIdTransaksi"; ?>">
    <div class="row mt-2"> 
        <div class="col-md-12 mb-3">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" readonly name="nama_barang" id="nama_barang" class="form-control" value="<?php echo $nama_barang;?>">
        </div>
    </div>
    <div class="row mt-2"> 
        <div class="col-md-6 mb-3">
            <label for="qty">QTY</label>
            <input type="number" name="qty" id="qty_rincian" class="form-control" value="1">
        </div>
        <div class="col-md-6 mb-3">
            <label for="qty">Satuan</label>
            <select name="rincian_satuan_barang" id="rincian_satuan_barang" class="form-control">
                <?php
                    echo '<option value="'.$satuan_barang.'">'.$satuan_barang.'</option>';
                    $QrySatuan = mysqli_query($Conn, "SELECT*FROM barang_satuan WHERE id_barang='$id_barang'");
                    while ($DataSatuan = mysqli_fetch_array($QrySatuan)) {
                        $id_barang_satuan= $DataSatuan['id_barang_satuan'];
                        $satuan_multi= $DataSatuan['satuan_multi'];
                        echo '<option value="'.$satuan_multi.'">'.$satuan_multi.'</option>';
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
                        $id_barang_harga= $DataHargaMulti['id_barang_harga'];
                        $kategori_harga= $DataHargaMulti['kategori_harga'];
                        $HargaMutli= $DataHargaMulti['harga'];
                        echo '<option value="'.$id_barang_harga.'">'.$kategori_harga.'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="harga">Harga</label>
            <input type="text" name="harga" id="harga_rincian" class="form-control" value="<?php echo $HargaJual;?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="jumlah">Jumlah</label>
            <input type="text" name="jumlah" id="jumlah_rincian" class="form-control" value="<?php echo $HargaJual;?>">
        </div>
    </div>
    <div class="row mb-2"> 
        <div class="col-md-12" id="NotifikasiTambahRincianBarang">
            <span>Pastikan rincian yang anda input sudah sesuai</span>
        </div>
    </div>
<?php 
        }else{
            echo '  <div class="row">';
            echo '      <div class="col-md-12 text-center text-danger mb-3">';
            echo '          '.$ValidasiDataSmenetara.'';
            echo '      </div>';
            echo '  </div>';
        }
    } 
} 
?>