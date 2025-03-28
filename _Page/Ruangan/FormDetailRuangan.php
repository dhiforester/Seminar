<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/SettingGeneral.php";
    include "../../vendor/phpqrcode/qrlib.php"; 
    //Tangkap id_ruangan
    if(empty($_POST['id_ruangan'])){
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
        $id_ruangan=$_POST['id_ruangan'];
        //Buka data Ruangan
        $QryRuangan = mysqli_query($Conn,"SELECT * FROM list_ruangan WHERE id_ruangan='$id_ruangan'")or die(mysqli_error($Conn));
        $DataRuangan = mysqli_fetch_array($QryRuangan);
        $nama_ruangan= $DataRuangan['nama_ruangan'];
        $kategori= $DataRuangan['kategori'];
        //Membuat QR
        $Temp="../../_Page/Ruangan/";
        $isi = "$base_url/Kunjungan.php?id_ruangan=$id_ruangan"; 
        $NamaFile="$id_ruangan.png";
        $penyimpanan="../../_Page/Ruangan/$id_ruangan.png";
        if(!file_exists("$penyimpanan")){
            QRcode::png($isi, $Temp."$NamaFile",QR_ECLEVEL_Q);
        }
?>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <b>Nama Ruangan :</b><br>
                                    <?php echo "$nama_ruangan"; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Kategori Ruangan :</b><br>
                                    <?php echo "$kategori"; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <img src="_Page/Ruangan/<?php echo $NamaFile;?>" alt="<?php echo $nama_ruangan;?>" width="80%%">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-info">
        <a href="index.php?Page=Ruangan&Sub=DetailRuangan&&id_ruangan=<?php echo "$id_ruangan"; ?>" class="btn btn-success btn-rounded" title="Selengkapnya">
            <i class="bi bi-three-dots"></i> Selengkapnya
        </a>
        <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Tutup
        </button>
    </div>
<?php } ?>