<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_mitra
    if(empty($_POST['id_barang'])){
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
        $id_barang=$_POST['id_barang'];
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
<div class="modal-body">
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
<div class="modal-footer bg-info">
    <a href="index.php?Page=Barang&Sub=DetailBarang&id=<?php echo $id_barang;?>" class="btn btn-primary btn-rounded">
        <i class="bi bi-x-circle"></i> Detail
    </a>
    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
        <i class="bi bi-x-circle"></i> Tutup
    </button>
</div>
<?php } ?>