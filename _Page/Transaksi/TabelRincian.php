<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_mitra'])){
        echo '<div class="row mt-4">';
        echo '  <div class="col-md-12 text-center">';
        echo '      <div class="alert alert-danger" role="alert">';
        echo '          <b>Maaf!!</b> Silahkan Anda Isi Data Mitra Terlebih Dulu';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_mitra=$_POST['id_mitra'];
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM transaksi_rincian WHERE id_akses='$SessionIdAkses' AND id_transaksi='0' AND id_mitra='$id_mitra'"));
        if(empty($jml_data)){
            echo '<div class="row mt-4">';
            echo '  <div class="col-md-12 text-center">';
            echo '      <div class="alert alert-danger" role="alert">';
            echo '          Belum ada data rincian transaksi yang bisa ditampilkan.';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
?>
    
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-items-center mb-0">
                    <thead class="">
                        <tr>
                            <th class="text-center">
                                <b>No</b>
                            </th>
                            <th class="text-center">
                                <b>Rincian</b>
                            </th>
                            <th class="text-center">
                                <b>Kategori</b>
                            </th>
                            <th class="text-center">
                                <b>Harga</b>
                            </th>
                            <th class="text-center">
                                <b>QTY</b>
                            </th>
                            <th class="text-center">
                                <b>Jumlah</b>
                            </th>
                            <th class="text-center">
                                <b>Option</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $JumlahRincianTotal=0;
                            $query = mysqli_query($Conn, "SELECT*FROM transaksi_rincian WHERE id_akses='$SessionIdAkses' AND id_transaksi='0' AND id_mitra='$id_mitra'");
                            while ($data = mysqli_fetch_array($query)) {
                                $id_transaksi_rincian= $data['id_transaksi_rincian'];
                                $id_barang= $data['id_barang'];
                                $id_barang_harga= $data['id_barang_harga'];
                                $id_barang_satuan= $data['id_barang_satuan'];
                                $id_mitra= $data['id_mitra'];
                                $id_mitra_tindakan=$data['id_mitra_tindakan'];
                                $nama_barang= $data['nama_barang'];
                                $nama_tindakan= $data['nama_tindakan'];
                                $harga= $data['harga'];
                                $qty= $data['qty'];
                                $jumlah= $data['jumlah'];
                                if(empty($data['nama_barang'])){
                                    $NamaRincian= $data['nama_tindakan'];
                                    $Kategori="Tindakan";
                                    $ModalEdit="#ModalEditRincianTindakan";
                                }else{
                                    $NamaRincian= $data['nama_barang'];
                                    $Kategori="Obat/Alkes";
                                    $ModalEdit="#ModalEditRincianBarang";
                                }
                                //FormatRupiahJumlah
                                $JumlahRp="Rp " . number_format($jumlah,0,',','.');
                                $HargaRp="Rp " . number_format($harga,0,',','.');
                                $JumlahRincianTotal=$jumlah+$JumlahRincianTotal;
                            ?>
                                <tr>
                                    <td class="text-center text-xs">
                                        <?php 
                                            echo "<small >$no</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$NamaRincian</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$Kategori</small>";
                                        ?>
                                    </td>
                                    <td class="text-right" align="right">
                                        <?php 
                                            echo "<small>$HargaRp</small>";
                                        ?>
                                    </td>
                                    <td class="text-left" align="left">
                                        <?php 
                                            echo "<small>$qty</small>";
                                        ?>
                                    </td>
                                    <td class="text-right" align="right">
                                        <?php 
                                            echo "<small>$JumlahRp</small>";
                                        ?>
                                    </td>
                                    <td align="center">
                                        <button type="button" class="btn btn-success btn-sm btn-floating" data-bs-toggle="modal" data-bs-target="<?php echo "$ModalEdit";?>" data-id="<?php echo "$id_transaksi_rincian"; ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>  
                                        <button type="button" class="btn btn-danger btn-sm btn-floating" data-bs-toggle="modal" data-bs-target="#ModalDeleteTransaksiRincian" data-id="<?php echo "$id_transaksi_rincian"; ?>">
                                            <i class="bi bi-x"></i>
                                        </button>  
                                    </td>
                                </tr>
                            <?php 
                                $no++; } 
                                if(empty($jml_data)){
                                    $JumlahTotalRp="Rp 0";
                                }else{
                                    $JumlahTotalRp="Rp " . number_format($JumlahRincianTotal,0,',','.');
                                }
                            ?>
                            <tr>
                                <td colspan="5">
                                    <b>JUMLAH RINCIAN</b>
                                </td>
                                <td class="text-right" align="right">
                                    <?php 
                                        echo "<b>$JumlahTotalRp</b>";
                                    ?>
                                </td>
                                <td></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }} ?>