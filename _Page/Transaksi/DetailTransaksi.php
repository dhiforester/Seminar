<?php
    //Tangkap id_akses
    if(empty($_GET['id'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          ID Transaksi Tidak Boleh Kosong.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_transaksi=$_GET['id'];
        //Buka data Transaksi
        $QryTransaksi = mysqli_query($Conn,"SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'")or die(mysqli_error($Conn));
        $DataTransaksi = mysqli_fetch_array($QryTransaksi);
        $id_transaksi = $DataTransaksi['id_transaksi'];
        $id_akses= $DataTransaksi['id_akses'];
        $id_mitra= $DataTransaksi['id_mitra'];
        $id_pasien= $DataTransaksi['id_pasien'];
        $id_kunjungan= $DataTransaksi['id_kunjungan'];
        $tanggal= $DataTransaksi['tanggal'];
        $kategori= $DataTransaksi['kategori'];
        $tagihan= $DataTransaksi['tagihan'];
        $pembayaran= $DataTransaksi['pembayaran'];
        $metode= $DataTransaksi['metode'];
        $status= $DataTransaksi['status'];
        $pembayaran = "Rp " . number_format($pembayaran,2,',','.');
        $tagihan = "Rp " . number_format($tagihan,2,',','.');
        //Buka data mitra
        $QryMitra = mysqli_query($Conn,"SELECT * FROM mitra WHERE id_mitra='$id_mitra'")or die(mysqli_error($Conn));
        $DataMitra = mysqli_fetch_array($QryMitra);
        $nama_mitra= $DataMitra['nama_mitra'];
        if(!empty($id_pasien)){
            $QryPasien = mysqli_query($Conn,"SELECT * FROM pasien WHERE id_pasien='$id_pasien'")or die(mysqli_error($Conn));
            $DataPasien = mysqli_fetch_array($QryPasien);
            $nama_pasien= $DataPasien['nama_pasien'];
        }else{
            $nama_pasien="<span class='text-danger'>None</span>";
        }
?>
    <input type="hidden" name="GetIdMitra" id="GetIdMitra" value="<?php echo $id_mitra;?>">
    <input type="hidden" name="GetIdTransaksi2" id="GetIdTransaksi2" value="<?php echo $id_transaksi;?>">
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <b class="card-title">Detail Transaksi</b>
                            </div>
                            <div class="col-md-2">
                                <a href="index.php?Page=Transaksi&Sub=EditTransaksi&id=<?php echo "$id_transaksi";?>" class="btn btn-success btn-block btn-rounded">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                            </div>
                            <div class="col-md-2">
                                <a href="_Page/CetakInvoice/CetakInvoiceByTransaksi.php?id_transaksi=<?php echo "$id_transaksi";?>" class="btn btn-info btn-rounded btn-block">
                                    <i class="bi bi-printer"></i> Print
                                </a>
                            </div>
                            <div class="col-md-2">
                                <a href="index.php?Page=Transaksi" class="btn btn-md btn-dark btn-rounded btn-block">
                                    <i class="bi bi-arrow-left-short"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table table-responsive">
                                    <table class="table table-hover ">
                                        <tbody>
                                            <tr>
                                                <td><small><dt>Transaksi</dt></small></td>
                                                <td><small id="GetIdTransaksi"><?php echo "$id_transaksi - $kategori"; ?></small></td>
                                            </tr>
                                            <tr>
                                                <td><small><dt>Tanggal</dt></small></td>
                                                <td><small><?php echo "$tanggal"; ?></small></td>
                                            </tr>
                                            <?php if(!empty($id_pasien)){?>
                                                <tr>
                                                    <td><small><dt>Pasien</dt></small></td>
                                                    <td><small><?php echo "$id_pasien/$id_kunjungan - $nama_pasien"; ?></small></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td><small><dt>Tagihan</dt></small></td>
                                                <td><small><?php echo "$tagihan"; ?></small></td>
                                            </tr>
                                            <tr>
                                                <td><small><dt>Pembayaran</dt></small></td>
                                                <td><small><?php echo "$pembayaran"; ?></small></td>
                                            </tr>
                                            <tr>
                                                <td><small><dt>Metode Pembayaran</dt></small></td>
                                                <td><small><?php echo "$metode"; ?></small></td>
                                            </tr>
                                            <tr>
                                                <td><small><dt>Mitra</dt></small></td>
                                                <td><small><?php echo "$nama_mitra"; ?></small></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9">
                                <b class="card-title">Rincian Transaksi</b>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-sm btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#ModalTambahRincian" data-id="<?php echo "$id_transaksi";?>">
                                    <i class="bi bi-plus"></i> Tambah Rincian
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM transaksi_rincian WHERE id_transaksi='$id_transaksi'"));
                                    if(empty($jml_data)){
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo '  Belum ada data rincian transaksi yang bisa ditampilkan.';
                                        echo '</div>';
                                    }else{
                                ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered align-items-center mb-0">
                                            <thead class="">
                                                <tr>
                                                    <th class="text-center">
                                                        <b>No</b>
                                                    </th>
                                                    <th class="text-center">
                                                        <b>Rincian</b>
                                                    </th>
                                                    <th class="text-center">
                                                        <b>Kategori</b>
                                                    </th>
                                                    <th class="text-center">
                                                        <b>Harga</b>
                                                    </th>
                                                    <th class="text-center">
                                                        <b>QTY</b>
                                                    </th>
                                                    <th class="text-center">
                                                        <b>Jumlah</b>
                                                    </th>
                                                    <th class="text-center">
                                                        <b>Option</b>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no = 1;
                                                    $JumlahRincianTotal=0;
                                                    $query = mysqli_query($Conn, "SELECT*FROM transaksi_rincian WHERE id_transaksi='$id_transaksi'");
                                                    while ($data = mysqli_fetch_array($query)) {
                                                        $id_transaksi_rincian= $data['id_transaksi_rincian'];
                                                        $id_barang= $data['id_barang'];
                                                        $id_barang_harga= $data['id_barang_harga'];
                                                        $id_barang_satuan= $data['id_barang_satuan'];
                                                        $id_mitra= $data['id_mitra'];
                                                        $id_mitra_tindakan=$data['id_mitra_tindakan'];
                                                        $nama_barang= $data['nama_barang'];
                                                        $nama_tindakan= $data['nama_tindakan'];
                                                        $harga= $data['harga'];
                                                        $qty= $data['qty'];
                                                        $jumlah= $data['jumlah'];
                                                        if(empty($data['nama_barang'])){
                                                            $NamaRincian= $data['nama_tindakan'];
                                                            $Kategori="Tindakan";
                                                            $ModalEdit="#ModalEditRincianTindakan";
                                                        }else{
                                                            $NamaRincian= $data['nama_barang'];
                                                            $Kategori="Obat/Alkes";
                                                            $ModalEdit="#ModalEditRincianBarang";
                                                        }
                                                        //FormatRupiahJumlah
                                                        $JumlahRp="Rp " . number_format($jumlah,0,',','.');
                                                        $HargaRp="Rp " . number_format($harga,0,',','.');
                                                        $JumlahRincianTotal=$jumlah+$JumlahRincianTotal;
                                                    ?>
                                                        <tr>
                                                            <td class="text-center text-xs">
                                                                <?php 
                                                                    echo "<small >$no</small>";
                                                                ?>
                                                            </td>
                                                            <td class="text-left" align="left">
                                                                <?php 
                                                                    echo "<small>$NamaRincian</small>";
                                                                ?>
                                                            </td>
                                                            <td class="text-left" align="left">
                                                                <?php 
                                                                    echo "<small>$Kategori</small>";
                                                                ?>
                                                            </td>
                                                            <td class="text-right" align="right">
                                                                <?php 
                                                                    echo "<small>$HargaRp</small>";
                                                                ?>
                                                            </td>
                                                            <td class="text-left" align="left">
                                                                <?php 
                                                                    echo "<small>$qty</small>";
                                                                ?>
                                                            </td>
                                                            <td class="text-right" align="right">
                                                                <?php 
                                                                    echo "<small>$JumlahRp</small>";
                                                                ?>
                                                            </td>
                                                            <td align="center">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="<?php echo "$ModalEdit";?>" data-id="<?php echo "$id_transaksi_rincian"; ?>">
                                                                        <i class="bi bi-pencil-square"></i>
                                                                    </button>  
                                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDeleteTransaksiRincian" data-id="<?php echo "$id_transaksi_rincian"; ?>">
                                                                        <i class="bi bi-x"></i>
                                                                    </button>  
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php 
                                                        $no++; } 
                                                        if(empty($jml_data)){
                                                            $JumlahTotalRp="Rp 0";
                                                        }else{
                                                            $JumlahTotalRp="Rp " . number_format($JumlahRincianTotal,0,',','.');
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td colspan="5">
                                                            <b>JUMLAH RINCIAN</b>
                                                        </td>
                                                        <td class="text-right" align="right">
                                                            <?php 
                                                                echo "<b>$JumlahTotalRp</b>";
                                                            ?>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="MenampilkanTabelJurnal">
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9">
                                <b class="card-title">Pembayaran</b>
                            </div>
                            <div class="col-md-3">
                                <a href="index.php?Page=Pembayaran&Sub=TambahPembayaran&id=<?php echo "$id_transaksi";?>" class="btn btn-sm btn-block btn-primary">
                                    <i class="bi bi-plus"></i> Pembayaran
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3" id="MenampilkanTabelPembayaran">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>