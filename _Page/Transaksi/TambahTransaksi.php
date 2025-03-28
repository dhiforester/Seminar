<?php
    
    //Buka data sementara
    $QryDetailDataSementara = mysqli_query($Conn,"SELECT * FROM transaksi_sementara WHERE id_akses='$SessionIdAkses'")or die(mysqli_error($Conn));
    $DataTransaksiSementara = mysqli_fetch_array($QryDetailDataSementara);
    if(!empty($DataTransaksiSementara['id_transaksi_sementara'])){
        $GetIdMitraUrl=$DataTransaksiSementara['id_mitra'];
        $GetIdPasien=$DataTransaksiSementara['id_pasien'];
        $GetIdKunjungan=$DataTransaksiSementara['id_kunjungan'];
        $GetIdSupplier=$DataTransaksiSementara['id_supplier'];
        $now=$DataTransaksiSementara['tanggal'];
        $GetKategori=$DataTransaksiSementara['kategori'];
        $GetMetode=$DataTransaksiSementara['metode'];
        $GetKeterangan=$DataTransaksiSementara['keterangan'];
        $GetPembayaran=$DataTransaksiSementara['pembayaran'];
        $GetStatus=$DataTransaksiSementara['status'];
        if(!empty($DataTransaksiSementara['id_kunjungan'])){
            //Buka Data Kunjungan
            $QryKunjungan = mysqli_query($Conn,"SELECT * FROM pasien_kunjungan WHERE id_kunjungan='$GetIdKunjungan'")or die(mysqli_error($Conn));
            $DataKunjungan = mysqli_fetch_array($QryKunjungan);
            $nama_pasien= $DataKunjungan['nama_pasien'];
            $datetime_kunjungan= $DataKunjungan['datetime_kunjungan'];
        }else{
            $nama_pasien="";
            $datetime_kunjungan="";
        }
    }else{
        $GetIdMitraUrl="0";
        $GetIdPasien="";
        $GetIdKunjungan="0";
        $GetIdSupplier="0";
        $now=date('Y-m-d');
        $GetKategori="0";
        $GetMetode="0";
        $GetKeterangan="0";
        $GetPembayaran="0";
        $GetStatus="0";
        $nama_pasien="";
        $datetime_kunjungan="";
    }
?>
<form action="javascript:void(0);" id="ProsesTambahTransaksi" autocomplete="off">
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8 mt-3">
                                <b class="card-title">Form Tambah Transaksi</b>
                            </div>
                            <div class="col-md-2 mt-3">
                                <a href="index.php?Page=Transaksi" class="btn btn-md btn-dark btn-rounded btn-block">
                                    <i class="bi bi-arrow-left-short"></i> Back
                                </a>
                            </div>
                            <div class="col-md-2 mt-3" id="TombolAutoJurnal">
                                
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
                                            $id_mitra= $DataMitra['id_mitra'];
                                            $nama_mitra= $DataMitra['nama_mitra'];
                                            if($GetIdMitraUrl==$id_mitra){
                                                echo '<option selected value="'.$id_mitra.'">'.$nama_mitra.'</option>';
                                            }else{
                                                echo '<option value="'.$id_mitra.'">'.$nama_mitra.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo "$now"; ?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control">
                                    <option <?php if($GetKategori=="0"){echo "selected";} ?> value="">Pilih</option>
                                    <option <?php if($GetKategori=="Pembelian"){echo "selected";} ?> value="Pembelian">Pembelian</option>
                                    <option <?php if($GetKategori=="Penjualan"){echo "selected";} ?> value="Penjualan">Penjualan</option>
                                    <option <?php if($GetKategori=="Pendaftaran"){echo "selected";} ?> value="Pendaftaran">Pendaftaran</option>
                                    <option <?php if($GetKategori=="Pembayaran"){echo "selected";} ?> value="Pembayaran">Pembayaran</option>
                                    <option <?php if($GetKategori=="Penerimaan"){echo "selected";} ?> value="Penerimaan">Penerimaan</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="PilihSupplier">Supplier</label>
                                <select name="id_supplier" id="PilihSupplier" class="form-control">
                                    <option value="">Pilih</option>
                                    <?php
                                        if(!empty($GetIdMitraUrl)){
                                            $QrySupplierByMitra = mysqli_query($Conn, "SELECT*FROM supplier WHERE id_mitra='$GetIdMitraUrl' ORDER BY id_supplier ASC");
                                            while ($DataSupplierByMitra = mysqli_fetch_array($QrySupplierByMitra)) {
                                                $id_supplier= $DataSupplierByMitra['id_supplier'];
                                                $NamaSupplier= $DataSupplierByMitra['nama_supplier'];
                                                if($GetIdSupplier==$id_supplier){
                                                    echo '<option selected value="'.$id_supplier.'">'.$NamaSupplier.'</option>';
                                                }else{
                                                    echo '<option value="'.$id_supplier.'">'.$NamaSupplier.'</option>';
                                                }
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
                                    if(empty($GetIdPasien)){
                                        echo '<input type="text" name="id_pasien" id="id_pasien" class="form-control" data-bs-toggle="modal" data-bs-target="#ModalCariPasien">';
                                    }else{
                                        echo '<select name="id_pasien" id="id_pasien" class="form-control" data-bs-toggle="modal" data-bs-target="#ModalCariPasien">';
                                        echo '  <option value="'.$GetIdPasien.'">'.$nama_pasien.'</option>';
                                        echo '</select>';
                                    }
                                ?>
                            </div>
                            <div class="col-md-3 mb-3" id="PutIdKunjungan">
                                <label for="id_kunjungan">Kunjungan</label>
                                <?php
                                    if(empty($GetIdKunjungan)){
                                        echo '<input type="text" name="id_kunjungan" id="id_kunjungan" class="form-control" data-bs-toggle="modal" data-bs-target="#ModalCariPasien">';
                                    }else{
                                        echo '<select name="id_kunjungan" id="id_kunjungan" class="form-control" data-bs-toggle="modal" data-bs-target="#ModalCariPasien">';
                                        echo '  <option value="'.$GetIdKunjungan.'">'.$datetime_kunjungan.'</option>';
                                        echo '</select>';
                                    }
                                ?>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="metode">Metode Pembayaran</label>
                                <select name="metode" id="metode" class="form-control">
                                    <option <?php if($GetMetode==""){echo "selected";} ?> value="">Pilih</option>
                                    <option <?php if($GetMetode=="Cash"){echo "selected";} ?> value="Cash">Cash</option>
                                    <option <?php if($GetMetode=="Online"){echo "selected";} ?> value="Online">Online</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="status">Status Transaksi</label>
                                <select name="status" id="status" class="form-control">
                                    <option <?php if($GetStatus==""){echo "selected";} ?> value="">Pilih</option>
                                    <option <?php if($GetStatus=="Pending"){echo "selected";} ?> value="Pending">Pending</option>
                                    <option <?php if($GetStatus=="Lunas"){echo "selected";} ?> value="Lunas">Lunas</option>
                                    <option <?php if($GetStatus=="Batal"){echo "selected";} ?> value="Batal">Batal</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <button type="button" class="btn btn-md btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#ModalTambahRincian">
                                    <i class="bi bi-plus-lg"></i> Tambah Rincian
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3" id="MenampilkanTabelRincian">
                                <!-- Menampilkan Data Rincian Transaksi -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="keterangan">Keterangan Transaksi</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?php echo "$GetKeterangan"; ?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="jumlah_transaksi">Jumlah Tagihan</label>
                                    <input type="text" name="jumlah_transaksi" id="jumlah_transaksi" class="form-control">
                                    <label>
                                        <a href="javascript:void(0);" id="ClickTambahDariRincian">
                                            <small>Tambah Dari Rincian</small>
                                        </a>
                                    </label>
                                    
                                </div>
                                
                                
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="pembayaran">Pembayaran</label>
                                <input type="text" name="pembayaran" id="pembayaran" class="form-control is-valid" value="<?php echo "$GetPembayaran"; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3" id="NotifikasiTambahTransaksi">
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
                            <div class="col-md-2 mt-3">
                                <button type="button" class="btn btn-md btn-block btn-warning" data-bs-toggle="modal" data-bs-target="#ModalBatalkanTransaksi">
                                    <i class="bi bi-arrow-counterclockwise"></i> Batalkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>