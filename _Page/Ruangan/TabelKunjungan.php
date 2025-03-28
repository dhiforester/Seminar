<?php
    //koneksi dan session
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    //IdRuangan
    if(empty($_POST['IdRuangan'])){
        echo 'ID Ruangan Tidak Boleh Kosong';
    }else{
        $IdRuangan=$_POST['IdRuangan'];
        //PeriodeAwal
        if(empty($_POST['PeriodeAwal'])){
            echo 'Silahkan Isi Tanggal Kunjungan Terlebih dulu';
        }else{
            //PeriodeAkhir
            if(empty($_POST['PeriodeAkhir'])){
                echo 'Silahkan Isi Tanggal Kunjungan Terlebih dulu';
            }else{
                $PeriodeAwal=$_POST['PeriodeAwal'];
                $PeriodeAkhir=$_POST['PeriodeAkhir'];
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM list_kunjungan WHERE (id_ruangan='$IdRuangan') AND (datetime>='$PeriodeAwal') AND (datetime<='$PeriodeAkhir')"));
?>
<div class="col-md-12 table-responsive">
    <table class="table table-hover table-bordered align-items-center mb-0">
        <thead class="">
            <tr>
                <th class="text-center">
                    <b>No</b>
                </th>
                <th class="text-center">
                    <b>Nama Pengunjung</b>
                </th>
                <th class="text-center">
                    <b>Unit/Lembaga</b>
                </th>
                <th class="text-center">
                    <b>Datetime</b>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(empty($jml_data)){
                    echo '<tr>';
                    echo '  <td class="text-center text-danger" colspan="4">Belum Ada Data Kunjungan</td>';
                    echo '</tr>';
                }
                $no = 1;
                //KONDISI PENGATURAN MASING FILTER
                $query = mysqli_query($Conn, "SELECT*FROM list_kunjungan WHERE (id_ruangan='$IdRuangan') AND (datetime>='$PeriodeAwal') AND (datetime<='$PeriodeAkhir')");
                while ($data = mysqli_fetch_array($query)) {
                    $id_kunjungan= $data['id_kunjungan'];
                    $id_ruangan= $data['id_ruangan'];
                    $nama= $data['nama'];
                    $unit= $data['unit'];
                    $datetime= $data['datetime'];
                ?>
            <tr>
                <td class="text-center text-xs">
                    <?php echo "$no" ?>
                </td>
                <td class="text-left text-xs">
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailKunjungan" data-id="<?php echo "$id_kunjungan"; ?>">
                        <?php echo "<b>$nama</b>" ?>
                    </a>
                </td>
                <td class="text-left text-xs">
                    <?php echo "$unit" ?>
                </td>
                <td class="text-left text-xs">
                    <?php echo "$datetime" ?>
                </td>
            </tr>
            <?php
                $no++; }
            ?>
        </tbody>
    </table>
</div>
<div class="col-md-12 mt-3">
    <a href="_Page/Ruangan/ProsesCetakKunjungan.php?id_ruangan=<?php echo "$IdRuangan"; ?>&periode1=<?php echo "$PeriodeAwal"; ?>&periode2=<?php echo "$PeriodeAkhir"; ?>" class="btn btn-md btn-outline-dark">
        <i class="bi bi-printer"></i> Cetak
    </a>
    <button type="button" class="btn btn-md btn-outline-dark" data-bs-toggle="modal" data-bs-target="#ModalGenerateKunjungan" data-id="<?php echo "$IdRuangan"; ?>">
        <i class="bi bi-list"></i> Generate
    </button>
</div>
<?php }}} ?>