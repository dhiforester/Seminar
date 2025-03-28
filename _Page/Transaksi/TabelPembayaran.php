<?php
    include "../../_Config/Connection.php";
    //Tangkap id_akses
    if(empty($_POST['id_transaksi'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          ID Transaksi Tidak Boleh Kosong.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_transaksi=$_POST['id_transaksi'];
        //Buka data Transaksi
        $QryTransaksi = mysqli_query($Conn,"SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'")or die(mysqli_error($Conn));
        $DataTransaksi = mysqli_fetch_array($QryTransaksi);
        $id_transaksi = $DataTransaksi['id_transaksi'];
        $id_akses= $DataTransaksi['id_akses'];
        $id_mitra= $DataTransaksi['id_mitra'];
        $id_pasien= $DataTransaksi['id_pasien'];
        $id_kunjungan= $DataTransaksi['id_kunjungan'];
        $tanggal= $DataTransaksi['tanggal'];
        $kategori= $DataTransaksi['kategori'];
        $tagihan= $DataTransaksi['tagihan'];
        $pembayaran= $DataTransaksi['pembayaran'];
        $metode= $DataTransaksi['metode'];
        $status= $DataTransaksi['status'];
        $pembayaran = "Rp " . number_format($pembayaran,2,',','.');
        $tagihan = "Rp " . number_format($tagihan,2,',','.');
        //Buka data mitra
        $QryMitra = mysqli_query($Conn,"SELECT * FROM mitra WHERE id_mitra='$id_mitra'")or die(mysqli_error($Conn));
        $DataMitra = mysqli_fetch_array($QryMitra);
        $nama_mitra= $DataMitra['nama_mitra'];
        if(!empty($id_pasien)){
            $QryPasien = mysqli_query($Conn,"SELECT * FROM pasien WHERE id_pasien='$id_pasien'")or die(mysqli_error($Conn));
            $DataPasien = mysqli_fetch_array($QryPasien);
            $nama_pasien= $DataPasien['nama_pasien'];
        }else{
            $nama_pasien="";
        }
?>
    <div class="table table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th><b>No</b></th>
                    <th><b>Tanggal</b></th>
                    <th><b>ID Trans</b></th>
                    <th><b>Order ID</b></th>
                    <th><b>Tagihan</b></th>
                    <th><b>Status</b></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM transaksi_pembayaran WHERE id_transaksi='$id_transaksi'"));
                    if(empty($jml_data)){
                        echo '<tr>';
                        echo '  <td colspan="7" class="text-center">';
                        echo '      <span class="text-danger">No Data</span>';
                        echo '  </td>';
                        echo '</tr>';
                    }else{
                        $no = 1;
                        //KONDISI PENGATURAN MASING FILTER
                        $query = mysqli_query($Conn, "SELECT*FROM transaksi_pembayaran WHERE id_transaksi='$id_transaksi' ORDER BY id_pembayaran ASC");
                        while ($data = mysqli_fetch_array($query)) {
                            $id_pembayaran = $data['id_pembayaran'];
                            $tanggal = $data['tanggal'];
                            $metode = $data['metode'];
                            $order_id = $data['order_id'];
                            $tagihan = $data['tagihan'];
                            $status = $data['status'];
                            //Format rupiah
                            $TagihanRp = "Rp " . number_format($tagihan,0,',','.');

                    ?>
                        <tr tabindex="0" class="table-light">
                            <td class="text-center" align="center"><?php echo "<small>$no</small>";?></td>    
                            <td class="text-left" align="left"><?php echo "<small>$tanggal</small>";?></td>
                            <td class="text-left" align="left"><?php echo "<small>$id_transaksi</small>";?></td>
                            <td class="text-left" align="left"><?php echo "<small>$order_id</small>";?></td>
                            <td class="text-left" align="left"><?php echo "<small>$TagihanRp</small>";?></td>
                            <td class="text-left" align="left"><?php echo "<small>$status</small>";?></td>
                        </tr>
                <?php
                    $no++; } }
                ?>
            </tbody>
        </table>
    </div>
<?php } ?>