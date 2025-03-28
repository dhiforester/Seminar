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
         //Tangkap id_mitra
        if(empty($_POST['id_mitra'])){
            echo ' <div class="modal-body">';
            echo '  <div class="row">';
            echo '      <div class="col-md-12 text-center text-danger mb-3">';
            echo '          ID Mitra Tidak Boleh Kosong!.';
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
            $id_mitra=$_POST['id_mitra'];
            //Buka data rincian
            $QryRincian = mysqli_query($Conn,"SELECT * FROM transaksi_rincian WHERE id_transaksi_rincian='$id_transaksi_rincian'")or die(mysqli_error($Conn));
            $DataRincian = mysqli_fetch_array($QryRincian);
            $id_mitra_tindakan= $DataRincian['id_mitra_tindakan'];
            $qty= $DataRincian['qty'];
            $id_barang_harga= $DataRincian['id_barang_harga'];
            $id_barang_satuan= $DataRincian['id_barang_satuan'];
            $HargaRincian= $DataRincian['harga'];
            $JumlahRincian= $DataRincian['jumlah'];
            //Buka data tindakan
            $QryTindakan = mysqli_query($Conn,"SELECT * FROM mitra_tindakan WHERE id_mitra_tindakan='$id_mitra_tindakan'")or die(mysqli_error($Conn));
            $DataTindakan = mysqli_fetch_array($QryTindakan);
            $nama_tindakan= $DataTindakan['nama_tindakan'];
            $kategori_tindakan_detail= $DataTindakan['kategori_tindakan'];
            $tarif_tindakan_detail= $DataTindakan['tarif_tindakan'];
            $deskripsi_tindakan_detail= $DataTindakan['deskripsi_tindakan'];
            $jasa_dokter_detail= $DataTindakan['jasa_dokter'];
            $image_tindakan= $DataTindakan['image_tindakan'];
             //Pada saat mode edit transaksi
            if(empty($_POST['GetIdTransaksi'])){
                $GetIdTransaksi="";
            }else{
                $GetIdTransaksi=$_POST['GetIdTransaksi'];
            }
?>
    <input type="hidden" name="id_transaksi_rincian" id="id_transaksi_rincian" value="<?php echo "$id_transaksi_rincian"; ?>">
    <input type="hidden" name="id_mitra_tindakan" id="id_mitra_tindakan" value="<?php echo "$id_mitra_tindakan"; ?>">
    <input type="hidden" name="id_mitra" id="id_mitra" value="<?php echo "$id_mitra"; ?>">
    <input type="hidden" name="GetIdTransaksi" id="GetIdTransaksi" value="<?php echo "$GetIdTransaksi"; ?>">
    <div class="row mt-2"> 
        <div class="col-md-12 mb-3">
            <label for="nama_tindakan">Nama Tindakan</label>
            <input type="text" readonly name="nama_tindakan" id="nama_tindakan" class="form-control" value="<?php echo $nama_tindakan;?>">
        </div>
    </div>
    <div class="row mt-2"> 
        <div class="col-md-6 mb-3">
            <label for="qty">QTY</label>
            <input type="number" name="qty" id="qty_rincian4" class="form-control" value="<?php echo $qty;?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="harga">Harga</label>
            <input type="text" name="harga" id="harga_rincian4" class="form-control" value="<?php echo $HargaRincian;?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="jumlah">Jumlah</label>
            <input type="text" name="jumlah" id="jumlah_rincian4" class="form-control" value="<?php echo "$JumlahRincian";?>">
        </div>
    </div>
    <div class="row mb-2"> 
        <div class="col-md-12" id="NotifikasiEditRincianTindakan">
            <span>Pastikan rincian yang anda input sudah sesuai</span>
        </div>
    </div>
<?php }} ?>