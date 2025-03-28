<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_ruangan
    if(empty($_POST['id_ruangan'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          Access ID Data Undefined.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_ruangan=$_POST['id_ruangan'];
        //Buka data Ruangan
        $QryRuangan = mysqli_query($Conn,"SELECT * FROM list_ruangan WHERE id_ruangan='$id_ruangan'")or die(mysqli_error($Conn));
        $DataRuangan = mysqli_fetch_array($QryRuangan);
        $nama_ruangan= $DataRuangan['nama_ruangan'];
        $kategori= $DataRuangan['kategori'];
?>
    <input type="hidden" name="id_ruangan" id="id_ruangan" value="<?php echo "$id_ruangan"; ?>">
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="nama_ruangan">Nama Lengkap</label>
            <input type="text" name="nama_ruangan" id="nama_ruangan" class="form-control" value="<?php echo "$nama_ruangan"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="kategori">Kategori Kerja</label>
            <input type="text" name="kategori" id="kategori" class="form-control" list="ListKategori" value="<?php echo "$kategori"; ?>">
            <datalist id="ListKategori">
                <?php
                    $query = mysqli_query($Conn, "SELECT DISTINCT kategori FROM list_ruang");
                    while ($data = mysqli_fetch_array($query)) {
                        $kategori = $data['kategori'];
                        echo '<option value="'.$kategori.'">';
                    }
                ?>
            </datalist>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditRuangan">
            <small class="text-primary">Pastikan data yang anda input sudah sesuai</small>
        </div>
    </div>
<?php } ?>