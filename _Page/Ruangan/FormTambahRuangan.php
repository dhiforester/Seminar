<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    $tanggal=date('Y-m-d');
    $jam=date('H:i:s');
?>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="nama_ruangan">Nama Ruangan</label>
            <input type="text" name="nama_ruangan" id="nama_ruangan" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="kategori">Kategori Kerja</label>
            <input type="text" name="kategori" id="kategori" class="form-control" list="ListKategori">
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
        <div class="col-md-12 mt-3" id="NotifikasiTambahRuangan">
            <span class="text-primary">Pastikan Data Yang Anda Input Sudah Benar</span>
        </div>
    </div>
