<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10 mb-2 mt-2">
                            <b>Detail Inventaris</b>
                        </div>
                        <div class="col-md-2 mb-2 mt-2">
                            <a href="index.php?Page=Inventaris" class="btn btn-md btn-dark w-100">
                                <i class="bi bi-arrow-left-circle"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                        if(empty($_GET['id_inventaris'])){
                            echo '<div class="row">';
                            echo '  <div class="col col-md-12 text-danger">ID Dukungan Tidak Boleh Kosong</div>';
                            echo '</div>';
                        }else{
                            $id_inventaris=$_GET['id_inventaris'];
                            //Buka data inventaris
                            $QryDetailInventaris = mysqli_query($Conn,"SELECT * FROM inventaris WHERE id_inventaris='$id_inventaris'")or die(mysqli_error($Conn));
                            $DataDetailInventaris = mysqli_fetch_array($QryDetailInventaris);
                            $id_akses= $DataDetailInventaris['id_akses'];
                            $id_unit_kerja= $DataDetailInventaris['id_unit_kerja'];
                            $nama_unit_kerja = $DataDetailInventaris['nama_unit_kerja'];
                            $kode= $DataDetailInventaris['kode'];
                            $nama= $DataDetailInventaris['nama'];
                            $kategori_barang= $DataDetailInventaris['kategori_barang'];
                            $kategori_asset= $DataDetailInventaris['kategori_asset'];
                            $spesifikasi= $DataDetailInventaris['spesifikasi'];
                            $nomor_serial= $DataDetailInventaris['nomor_serial'];
                            $gambar= $DataDetailInventaris['gambar'];
                            $kondisi= $DataDetailInventaris['kondisi'];
                            $ketersediaan= $DataDetailInventaris['ketersediaan'];
                            $lokasi= $DataDetailInventaris['lokasi'];
                            $qty= $DataDetailInventaris['qty'];
                            $satuan= $DataDetailInventaris['satuan'];
                            $tanggal_beli= $DataDetailInventaris['tanggal_beli'];
                            $tanggal_garansi= $DataDetailInventaris['tanggal_garansi'];
                            $tanggal_input= $DataDetailInventaris['tanggal_input'];
                            if(empty($gambar)){
                                $gambar="no-image.jpg";
                            }else{
                                $gambar="$gambar";
                            }
                            //Buka data askes
                            $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                            $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                            $nama_akses= $DataDetailAkses['nama_akses'];
                            //Hitung Jumlah Unit Kerja
                            $JumlahUnit = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah Dukungan
                            $JumlahDukungan = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah Agenda
                            $JumlahAgenda = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah Event
                            $JumlahEvent = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah Log
                            $JumlahLog = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah Riwayat Kerja
                            $JumlahRiwayat = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah undangan event
                            $JumlahUndangan = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_undangan WHERE id_akses='$id_akses'"));
                            //Hitung Jumlah Absen
                            $JumlahAbsen = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_absen WHERE id_akses='$id_akses'"));
                    ?>
                        <div class="row mt-2"> 
                            <div class="col-md-4 text-center">
                                <img src="assets/img/Inventaris/<?php echo "$gambar"; ?>" alt="" width="60%" class="rounded">
                            </div>
                            <div class="col-md-8">
                                <table class="">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <small><dt>Nama Barang</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $nama; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Kode</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $kode; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Nomor Seri</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $nomor_serial; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Kategori</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $kategori_barang; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Asset/BHP</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $kategori_asset; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Kondisi</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $kondisi; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Ketersediaan</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $ketersediaan; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Lokasi Penyimpanan</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $lokasi; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Jumlah/Satuan</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo "$qty $satuan"; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Tgl Pembelian</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo "$tanggal_beli"; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Tgl Garansi</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo "$tanggal_garansi"; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Tgl input</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo "$tanggal_input"; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Petugas/Unit</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo "$nama_akses $nama_unit_kerja"; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Spesifikasi</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo "$spesifikasi"; ?></small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>