<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_mitra_tindakan
    if(empty($_POST['id_mitra_tindakan'])){
        echo ' <div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger mb-3">';
        echo '          ID Barang Tidak Boleh Kosong!.';
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
            echo '          ID Barang Tidak Boleh Kosong!.';
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
            $id_mitra_tindakan=$_POST['id_mitra_tindakan'];
            $id_mitra=$_POST['id_mitra'];
            //Buka data askes
            $QryTindakan = mysqli_query($Conn,"SELECT * FROM mitra_tindakan WHERE id_mitra_tindakan='$id_mitra_tindakan'")or die(mysqli_error($Conn));
            $DataTindakan = mysqli_fetch_array($QryTindakan);
            $id_mitra_tindakan= $DataTindakan['id_mitra_tindakan'];
            $id_mitra= $DataTindakan['id_mitra'];
            $nama_tindakan= $DataTindakan['nama_tindakan'];
            $kategori_tindakan_detail= $DataTindakan['kategori_tindakan'];
            $tarif_tindakan_detail= $DataTindakan['tarif_tindakan'];
            $deskripsi_tindakan_detail= $DataTindakan['deskripsi_tindakan'];
            $jasa_dokter_detail= $DataTindakan['jasa_dokter'];
            $image_tindakan= $DataTindakan['image_tindakan'];
            //apabila ada id transaksi
            if(!empty($_POST['id_transaksi'])){
                $id_transaksi=$_POST['id_transaksi'];
            }else{
                $id_transaksi="";
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
    <input type="hidden" name="id_mitra_tindakan" id="id_mitra_tindakan" value="<?php echo "$id_mitra_tindakan"; ?>">
    <input type="hidden" name="id_mitra" id="id_mitra" value="<?php echo "$id_mitra"; ?>">
    <input type="hidden" name="id_transaksi" id="id_transaksi" value="<?php echo "$id_transaksi"; ?>">
    <div class="row mt-2"> 
        <div class="col-md-12 mb-3">
            <label for="nama_tindakan">Nama Tindakan</label>
            <input type="text" readonly name="nama_tindakan" id="nama_tindakan" class="form-control" value="<?php echo $nama_tindakan;?>">
        </div>
    </div>
    <div class="row mt-2"> 
        <div class="col-md-6 mb-3">
            <label for="qty">QTY</label>
            <input type="number" name="qty" id="qty_rincian2" class="form-control" value="1">
        </div>
        <div class="col-md-6 mb-3">
            <label for="harga">Harga</label>
            <input type="text" name="harga" id="harga_rincian2" class="form-control" value="<?php echo $tarif_tindakan_detail;?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="jumlah">Jumlah</label>
            <input type="text" name="jumlah" id="jumlah_rincian2" class="form-control" value="<?php echo "$tarif_tindakan_detail";?>">
        </div>
    </div>
    <div class="row mb-2"> 
        <div class="col-md-12" id="NotifikasiTambahRincianTindakan">
            <span>Pastikan rincian yang anda input sudah sesuai</span>
        </div>
    </div>
<?php }}} ?>