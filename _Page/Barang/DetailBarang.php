<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    //Tangkap id_mitra
    if(empty($_GET['id'])){
        echo '<div class="card">';
        echo '  <div class="card-header">';
        echo '      <h4 class="card-title">Detail Barang</h4>';
        echo '  </div>';
        echo '  <div class="card-body">';
        echo '      <div class="row">';
        echo '          <div class="col-md-12 mb-3 text-danger text-center">';
        echo '              ID Barang Tidak Ditemukan.';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '  <div class="card-footer">';
        echo '      Error ID Null';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_barang=$_GET['id'];
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
?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="card-title">
                        <i class="bi bi-info-circle"></i> Info Barang
                    </h4>
                </div>
                <div class="col-md-2">
                    <a href="index.php?Page=Barang" class="btn btn-md btn-dark btn-rounded btn-block">
                        <i class="bi bi-arrow-left-short"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-2"> 
                <div class="col-md-5"><dt>ID Barang</dt></div>
                <div class="col-md-7"><?php echo "$id_barang"; ?></div>
            </div>
            <div class="row mt-2"> 
                <div class="col-md-5"><dt>Kode Barang</dt></div>
                <div class="col-md-7"><?php echo "$kode_barang"; ?></div>
            </div>
            <div class="row mt-2"> 
                <div class="col-md-5"><dt>Nama Barang</dt></div>
                <div class="col-md-7"><?php echo "$nama_barang"; ?></div>
            </div>
            <div class="row mt-2"> 
                <div class="col-md-5"><dt>Mitra</dt></div>
                <div class="col-md-7"><?php echo "$nama_mitra"; ?></div>
            </div>
            <div class="row mt-2"> 
                <div class="col-md-5"><dt>Kategori</dt></div>
                <div class="col-md-7"><?php echo "$kategori_barang"; ?></div>
            </div>
            <div class="row mt-2"> 
                <div class="col-md-5"><dt>Stok</dt></div>
                <div class="col-md-7"><?php echo "$stok_barang $satuan_barang"; ?></div>
            </div>
            <div class="row mt-2"> 
                <div class="col-md-5"><dt>Konversi</dt></div>
                <div class="col-md-7"><?php echo "$konversi $satuan_barang"; ?></div>
            </div>
            <div class="row mt-2"> 
                <div class="col-md-5"><dt>Harga Beli</dt></div>
                <div class="col-md-7"><?php echo "$harga_beli_rp"; ?></div>
            </div>
            <?php
                $QryHarga = mysqli_query($Conn, "SELECT*FROM barang_harga WHERE id_barang='$id_barang'");
                while ($DataHarga = mysqli_fetch_array($QryHarga)) {
                    $kategori_harga= $DataHarga['kategori_harga'];
                    $harga= $DataHarga['harga'];
                    $harga = "Rp " . number_format($harga,0,',','.');
            ?>
                <div class="row mt-2"> 
                    <div class="col-md-5"><dt><?php echo "$kategori_harga"; ?></dt></div>
                    <div class="col-md-7"><?php echo "$harga"; ?></div>
                </div>
            <?php } ?>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ModalEditBarang2" data-id="<?php echo "$id_barang"; ?>">
                <i class="bi bi-pencil-square"></i> Edit Barang
            </button>  
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            <h4 class="card-title">
                <i class="bi bi-tag"></i> Multi Satuan
            </h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <b>No</b>
                                </th>
                                <th class="text-center">
                                    <b>Kode</b>
                                </th>
                                <th class="text-center">
                                    <b>Satuan</b>
                                </th>
                                <th class="text-center">
                                    <b>Konversi</b>
                                </th>
                                <th class="text-center">
                                    <b>Stok</b>
                                </th>
                                <th class="text-center">
                                    <b>Option</b>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //Menghitung jumlah data barang_satuan
                                $JumlahSatuanBarang=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM barang_satuan WHERE id_barang='$id_barang'"));
                                if(empty($JumlahSatuanBarang)){
                                    echo '<tr>';
                                    echo '  <td class="text-center" colspan="5">';
                                    echo '      Belum ada data satuan barang';
                                    echo '  </td>';
                                    echo '</tr>';
                                }else{
                                    $no=1;
                                    $QrySatauan=mysqli_query($Conn, "SELECT*FROM barang_satuan WHERE id_barang='$id_barang' ORDER BY id_barang_satuan ASC");
                                    while ($DataSatuan = mysqli_fetch_array($QrySatauan)) {
                                        $id_barang_satuan=$DataSatuan['id_barang_satuan'];
                                        $id_barang=$DataSatuan['id_barang'];
                                        $kode_barang=$DataSatuan['kode_barang'];
                                        $satuan_multi=$DataSatuan['satuan_multi'];
                                        $konversi_multi=$DataSatuan['konversi_multi'];
                                        $stok_multi=$DataSatuan['stok_multi'];
                            ?>
                                <tr>
                                    <td class="text-center text-xs">
                                        <?php 
                                            echo "<small >$no</small>";
                                        ?>
                                    </td>
                                    <td class="text-center text-xs">
                                        <?php 
                                            echo "<small >$kode_barang</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$satuan_multi</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$konversi/$konversi_multi</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$stok_multi $satuan_multi</small>";
                                        ?>
                                    </td>
                                    <td align="center">
                                        <button type="button" class="btn btn-success btn-sm btn-floating" data-bs-toggle="modal" data-bs-target="#ModalEditSatuan" data-id="<?php echo "$id_barang_satuan"; ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>  
                                        <button type="button" class="btn btn-danger btn-sm btn-floating" data-bs-toggle="modal" data-bs-target="#ModalDeleteSatuan" data-id="<?php echo "$id_barang_satuan"; ?>">
                                            <i class="bi bi-x"></i>
                                        </button>  
                                    </td>
                                </tr>
                            <?php $no++;}} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <small class="credit">
                <a href="javascript:void(0);" class="btn btn-sm btn-success mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#ModalTambahSatuan" data-id="<?php echo "$id_barang"; ?>">
                    <i class="bi bi-plus"></i> Tambah Satuan
                </a>
            </small>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            <h4 class="card-title">
                <i class="bi bi-tag"></i> Multi Harga
            </h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <b>No</b>
                                </th>
                                <th class="text-center">
                                    <b>Kategori Harga</b>
                                </th>
                                <th class="text-center">
                                    <b>Satuan</b>
                                </th>
                                <th class="text-center">
                                    <b>Konversi</b>
                                </th>
                                <th class="text-center">
                                    <b>Harga</b>
                                </th>
                                <th class="text-center">
                                    <b>Option</b>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //Menghitung jumlah data barang_harga
                                $JumlahBarangHarga=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM barang_harga WHERE id_barang='$id_barang'"));
                                if(empty($JumlahBarangHarga)){
                                    echo '<tr>';
                                    echo '  <td class="text-center" colspan="6">';
                                    echo '      Belum ada data harga barang';
                                    echo '  </td>';
                                    echo '</tr>';
                                }else{
                                    $no=1;
                                    $QryHarga = mysqli_query($Conn, "SELECT*FROM barang_harga WHERE id_barang='$id_barang' ORDER BY id_barang_harga ASC");
                                    while ($DataHarga = mysqli_fetch_array($QryHarga)) {
                                        $id_barang_harga= $DataHarga['id_barang_harga'];
                                        $id_barang_satuan= $DataHarga['id_barang_satuan'];
                                        $kategori_harga= $DataHarga['kategori_harga'];
                                        $harga= $DataHarga['harga'];
                                        $harga = "Rp " . number_format($harga,0,',','.');
                                        //Buka data satuan
                                        if(empty($DataHarga['id_barang_satuan'])){
                                            $satuan_barang= $DataBarang['satuan_barang'];
                                            $KonversiBarangultiHarga= $DataBarang['konversi'];
                                        }else{
                                            $QrySatuanMultiDetail = mysqli_query($Conn,"SELECT * FROM barang_satuan WHERE id_barang_satuan='$id_barang_satuan'")or die(mysqli_error($Conn));
                                            $DataSatuanMultiDetail = mysqli_fetch_array($QrySatuanMultiDetail);
                                            $satuan_multi_detail= $DataSatuanMultiDetail['satuan_multi'];
                                            $satuan_barang=$DataSatuanMultiDetail['satuan_multi'];
                                            $KonversiBarangultiHarga=$DataSatuanMultiDetail['konversi_multi'];
                                        }
                            ?>
                                <tr>
                                    <td class="text-center text-xs">
                                        <?php 
                                            echo "<small >$no</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$kategori_harga</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$satuan_barang</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$KonversiBarangultiHarga</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$harga</small>";
                                        ?>
                                    </td>
                                    <td align="center">
                                        <button type="button" class="btn btn-success btn-sm btn-floating" data-bs-toggle="modal" data-bs-target="#ModalEditKategoriHarga" data-id="<?php echo "$id_barang_harga"; ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>  
                                        <button type="button" class="btn btn-danger btn-sm btn-floating" data-bs-toggle="modal" data-bs-target="#ModalDeleteKategoriHarga" data-id="<?php echo "$id_barang_harga"; ?>">
                                            <i class="bi bi-x"></i>
                                        </button>  
                                    </td>
                                </tr>
                            <?php $no++;}} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <small class="credit">
                <a href="javascript:void(0);" class="btn btn-sm btn-success mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#ModalTambahKategoriHarga" data-id="<?php echo "$id_barang"; ?>">
                    <i class="bi bi-plus"></i> Tambah Harga
                </a>
            </small>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            <h4 class="card-title">
                <i class="bi bi-calendar-check"></i> Batch & Expired Date
            </h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <b>No</b>
                                </th>
                                <th class="text-center">
                                    <b>No.Batch</b>
                                </th>
                                <th class="text-center">
                                    <b>Jumlah</b>
                                </th>
                                <th class="text-center">
                                    <b>Expired</b>
                                </th>
                                <th class="text-center">
                                    <b>Pemberitahuan</b>
                                </th>
                                <th class="text-center">
                                    <b>Status</b>
                                </th>
                                <th class="text-center">
                                    <b>Option</b>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //Menghitung jumlah data barang_harga
                                $JumlahDataBatch=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM barang_bacth WHERE id_barang='$id_barang'"));
                                if(empty($JumlahDataBatch)){
                                    echo '<tr>';
                                    echo '  <td class="text-center" colspan="7">';
                                    echo '      Belum ada data Batch barang';
                                    echo '  </td>';
                                    echo '</tr>';
                                }else{
                                    $no=1;
                                    $QryBatch = mysqli_query($Conn, "SELECT*FROM barang_bacth WHERE id_barang='$id_barang' ORDER BY id_barang_bacth ASC");
                                    while ($DataBatch = mysqli_fetch_array($QryBatch)) {
                                        $id_barang_bacth= $DataBatch['id_barang_bacth'];
                                        $id_barang= $DataBatch['id_barang'];
                                        $no_batch= $DataBatch['no_batch'];
                                        $expired_date= $DataBatch['expired_date'];
                                        $qty_batch= $DataBatch['qty_batch'];
                                        $reminder_date= $DataBatch['reminder_date'];
                                        $StatusExpired= $DataBatch['status'];
                                        if(empty($DataBatch['id_barang_satuan'])){
                                            $id_barang_satuan=0;
                                            $QryBarang = mysqli_query($Conn,"SELECT * FROM barang WHERE id_barang='$id_barang'")or die(mysqli_error($Conn));
                                            $DataBarang = mysqli_fetch_array($QryBarang);
                                            $SatuanExpired= $DataBarang['satuan_barang'];
                                        }else{
                                            $id_barang_satuan= $DataBatch['id_barang_satuan'];
                                            $QrySatuanMultiDetail = mysqli_query($Conn,"SELECT * FROM barang_satuan WHERE id_barang_satuan='$id_barang_satuan'")or die(mysqli_error($Conn));
                                            $DataSatuanMultiDetail = mysqli_fetch_array($QrySatuanMultiDetail);
                                            $SatuanExpired= $DataSatuanMultiDetail['satuan_multi'];
                                        }
                            ?>
                                <tr>
                                    <td class="text-center text-xs">
                                        <?php 
                                            echo "<small >$no</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$no_batch</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$qty_batch $SatuanExpired</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$expired_date</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$reminder_date</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$StatusExpired</small>";
                                        ?>
                                    </td>
                                    <td align="center">
                                        <button type="button" class="btn btn-success btn-sm btn-floating" data-bs-toggle="modal" data-bs-target="#ModalEditExpiredDate" data-id="<?php echo "$id_barang_bacth"; ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>  
                                        <button type="button" class="btn btn-danger btn-sm btn-floating" data-bs-toggle="modal" data-bs-target="#ModalDeleteExpiredDate" data-id="<?php echo "$id_barang_bacth"; ?>">
                                            <i class="bi bi-x"></i>
                                        </button>  
                                    </td>
                                </tr>
                            <?php $no++;}} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <small class="credit">
                <a href="javascript:void(0);" class="btn btn-sm btn-success mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#ModalTambahExpiredDate" data-id="<?php echo "$id_barang"; ?>">
                    <i class="bi bi-plus"></i> Tambah Expired Date
                </a>
            </small>
        </div>
    </div>
<?php } ?>