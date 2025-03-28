<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/SettingGeneral.php";
    include "../../vendor/phpqrcode/qrlib.php"; 
    //Tangkap id_kunjungan
    if(empty($_POST['id_kunjungan'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          Access ID Data Undefined.';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo '<div class="modal-footer bg-info">';
        echo '  <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">';
        echo '      <i class="bi bi-x-circle"></i> Tutup';
        echo '  </button>';
        echo '</div>';
    }else{
        $id_kunjungan=$_POST['id_kunjungan'];
        //Buka data kunjungan
        $QryKunjungan = mysqli_query($Conn,"SELECT * FROM list_kunjungan WHERE id_kunjungan='$id_kunjungan'")or die(mysqli_error($Conn));
        $DataKunjungan = mysqli_fetch_array($QryKunjungan);
        $id_kunjungan= $DataKunjungan['id_kunjungan'];
        $id_ruangan= $DataKunjungan['id_ruangan'];
        $nama= $DataKunjungan['nama'];
        $unit= $DataKunjungan['unit'];
        $datetime= $DataKunjungan['datetime'];
        $signature= $DataKunjungan['signature'];
        //Buka data Ruangan
        $QryRuangan = mysqli_query($Conn,"SELECT * FROM list_ruangan WHERE id_ruangan='$id_ruangan'")or die(mysqli_error($Conn));
        $DataRuangan = mysqli_fetch_array($QryRuangan);
        $nama_ruangan= $DataRuangan['nama_ruangan'];
        $kategori= $DataRuangan['kategori'];
?>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <b>Nama Pengunjung :</b><br>
                                    <?php echo "$nama"; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Unit/Instansi :</b><br>
                                    <?php echo "$unit"; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Waktu Kunjungan:</b><br>
                                    <?php echo "$datetime"; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Ruangan Yang Dikunjungi :</b><br>
                                    <?php echo "$nama_ruangan"; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <?php
                                        echo '<img src="data:image/png;base64,' . $signature . '" width="100%" />';
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-info">
        <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Tutup
        </button>
    </div>
<?php } ?>