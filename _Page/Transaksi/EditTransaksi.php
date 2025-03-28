<?php
    if(empty($_GET['id'])){
        echo '<section class="section dashboard">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12">';
        echo '          <div class="alert alert-danger" role="alert">';
        echo '              Maaf!! ID Transaksi Tidak Boleh Kosong!!';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</section>';
    }else{
        $id_transaksi=$_GET['id'];
        //Buka data transaksi
        $QryTransaksi = mysqli_query($Conn,"SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'")or die(mysqli_error($Conn));
        $DataTransaksi = mysqli_fetch_array($QryTransaksi);
        if(!empty($DataTransaksi['id_transaksi'])){
            $id_transaksi = $DataTransaksi['id_transaksi'];
            $id_akses= $DataTransaksi['id_akses'];
            $id_mitra= $DataTransaksi['id_mitra'];
            $id_pasien= $DataTransaksi['id_pasien'];
            $id_kunjungan= $DataTransaksi['id_kunjungan'];
            $id_supplier= $DataTransaksi['id_supplier'];
            $tanggal= $DataTransaksi['tanggal'];
            $kategori= $DataTransaksi['kategori'];
            $tagihan= $DataTransaksi['tagihan'];
            $pembayaran= $DataTransaksi['pembayaran'];
            $metode= $DataTransaksi['metode'];
            $keterangan= $DataTransaksi['keterangan'];
            $status= $DataTransaksi['status'];
            //Buka nama pasien
            if(!empty($id_pasien)){
                $QryPasien = mysqli_query($Conn,"SELECT * FROM pasien WHERE id_pasien='$id_pasien'")or die(mysqli_error($Conn));
                $DataPasien = mysqli_fetch_array($QryPasien);
                $nama_pasien= $DataPasien['nama_pasien'];
            }else{
                $nama_pasien="";
            }
            if(!empty($id_kunjungan)){
                //Buka Data Kunjungan
                $QryKunjungan = mysqli_query($Conn,"SELECT * FROM pasien_kunjungan WHERE id_kunjungan='$id_kunjungan'")or die(mysqli_error($Conn));
                $DataKunjungan = mysqli_fetch_array($QryKunjungan);
                $datetime_kunjungan= $DataKunjungan['datetime_kunjungan'];
            }else{
                $datetime_kunjungan="";
            }
        }else{
            $id_transaksi ="";
            $id_akses="";
            $id_mitra="";
            $id_pasien="";
            $id_kunjungan="";
            $id_supplier="";
            $tanggal="";
            $kategori="";
            $tagihan="";
            $pembayaran="";
            $metode="";
            $keterangan="";
            $status="";
            $nama_pasien="";
            $datetime_kunjungan="";
        }
?>
    <form action="javascript:void(0);" id="ProsesEditTransaksi" autocomplete="off">
        <input type="hidden" name="GetIdTransaksiEdit" id="GetIdTransaksiEdit" value="<?php echo "$id_transaksi"; ?>">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10 mt-3">
                                    <b class="card-title">Form Edit Transaksi</b>
                                </div>
                                <div class="col-md-2 mt-3">
                                    <a href="index.php?Page=Transaksi&Sub=DetailTransaksi&id=<?php echo "$id_transaksi"; ?>" class="btn btn-md btn-dark btn-rounded btn-block">
                                        <i class="bi bi-arrow-left-short"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="id_mitra">Mitra</label>
                                    <select name="id_mitra" id="GetIdMitra" class="form-control">
                                        <option value="">Pilih</option>
                                        <?php
                                            $QryMitra = mysqli_query($Conn, "SELECT*FROM mitra ORDER BY nama_mitra ASC");
                                            while ($DataMitra = mysqli_fetch_array($QryMitra)) {
                                                $id_mitra_list= $DataMitra['id_mitra'];
                                                $nama_mitra= $DataMitra['nama_mitra'];
                                                if($id_mitra==$id_mitra_list){
                                                    echo '<option selected value="'.$id_mitra_list.'">'.$nama_mitra.'</option>';
                                                }else{
                                                    echo '<option value="'.$id_mitra_list.'">'.$nama_mitra.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo "$tanggal"; ?>">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="kategori">Kategori</label>
                                    <select name="kategori" id="kategori" class="form-control">
                                        <option <?php if($kategori=="0"){echo "selected";} ?> value="">Pilih</option>
                                        <option <?php if($kategori=="Pembelian"){echo "selected";} ?> value="Pembelian">Pembelian</option>
                                        <option <?php if($kategori=="Penjualan"){echo "selected";} ?> value="Penjualan">Penjualan</option>
                                        <option <?php if($kategori=="Pendaftaran"){echo "selected";} ?> value="Pendaftaran">Pendaftaran</option>
                                        <option <?php if($kategori=="Pembayaran"){echo "selected";} ?> value="Pembayaran">Pembayaran</option>
                                        <option <?php if($kategori=="Penerimaan"){echo "selected";} ?> value="Penerimaan">Penerimaan</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="PilihSupplier">Supplier</label>
                                    <select name="id_supplier" id="PilihSupplier" class="form-control">
                                        <option value="">Pilih</option>
                                        <?php
                                            $QrySupplierByMitra = mysqli_query($Conn, "SELECT*FROM supplier WHERE id_mitra='$id_mitra' ORDER BY id_supplier ASC");
                                            while ($DataSupplierByMitra = mysqli_fetch_array($QrySupplierByMitra)) {
                                                $id_supplier_list= $DataSupplierByMitra['id_supplier'];
                                                $NamaSupplier= $DataSupplierByMitra['nama_supplier'];
                                                if($id_supplier==$id_supplier_list){
                                                    echo '<option selected value="'.$id_supplier_list.'">'.$NamaSupplier.'</option>';
                                                }else{
                                                    echo '<option value="'.$id_supplier_list.'">'.$NamaSupplier.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3" id="PutIdPasien">
                                    <label for="id_pasien">Pasien</label>
                                    <?php
                                        echo '<select name="id_pasien" id="id_pasien" class="form-control" data-bs-toggle="modal" data-bs-target="#ModalCariPasien">';
                                        echo '  <option value="'.$id_pasien.'">'.$nama_pasien.'</option>';
                                        echo '</select>';
                                    ?>
                                </div>
                                <div class="col-md-3 mb-3" id="PutIdKunjungan">
                                    <label for="id_kunjungan">Kunjungan</label>
                                    <?php
                                        if(empty($id_kunjungan)){
                                            echo '<input type="text" name="id_kunjungan" id="id_kunjungan" class="form-control" data-bs-toggle="modal" data-bs-target="#ModalCariPasien">';
                                        }else{
                                            echo '<select name="id_kunjungan" id="id_kunjungan" class="form-control" data-bs-toggle="modal" data-bs-target="#ModalCariPasien">';
                                            echo '  <option value="'.$id_kunjungan.'">'.$datetime_kunjungan.'</option>';
                                            echo '</select>';
                                        }
                                    ?>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="metode">Metode Pembayaran</label>
                                    <select name="metode" id="metode" class="form-control">
                                        <option <?php if($metode==""){echo "selected";} ?> value="">Pilih</option>
                                        <option <?php if($metode=="Cash"){echo "selected";} ?> value="Cash">Cash</option>
                                        <option <?php if($metode=="Online"){echo "selected";} ?> value="Online">Online</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="status">Status Transaksi</label>
                                    <select name="status" id="status" class="form-control">
                                        <option <?php if($status==""){echo "selected";} ?> value="">Pilih</option>
                                        <option <?php if($status=="Pending"){echo "selected";} ?> value="Pending">Pending</option>
                                        <option <?php if($status=="Lunas"){echo "selected";} ?> value="Lunas">Lunas</option>
                                        <option <?php if($status=="Batal"){echo "selected";} ?> value="Batal">Batal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="keterangan">Keterangan Transaksi</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?php echo "$keterangan"; ?>">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="tagihan">Jumlah Tagihan</label>
                                        <input type="text" name="tagihan" id="tagihan" class="form-control" value="<?php echo "$tagihan"; ?>">
                                        <label>
                                            <a href="javascript:void(0);" id="ClickTambahDariRincianEdit">
                                                <small>Update Dari Rincian</small>
                                            </a>
                                        </label>
                                    </div>
                                    
                                    
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="pembayaran">Pembayaran</label>
                                    <input type="text" name="pembayaran" id="pembayaran" class="form-control" value="<?php echo "$pembayaran"; ?>">
                                    <label>
                                        <a href="javascript:void(0);" id="ClickSamakanDenganJumlahTagihan">
                                            <small>Samakan Dengan Tagihan</small>
                                        </a>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3" id="NotifikasiEditTransaksi">
                                    <div class="alert alert-info text-center" role="alert">
                                        Pastikan bahwa data transaksi sudah terisi dengan benar!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-3 mt-3">
                                    <button type="submit" class="btn btn-md btn-block btn-success">
                                        <i class="bi bi-save"></i> Simpan Transaksi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
<?php } ?>