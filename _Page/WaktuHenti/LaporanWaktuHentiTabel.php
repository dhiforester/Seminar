<?php
    //Menghitung Data
    if($periode_laporan=="Tahunan"){
        $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$tahun%'"));
    }else{
        $PeriodeTahun="$tahun-$bulan";
        $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$PeriodeTahun%'"));
    }
?>
<div class="row">
    <div class="col-md-12">
        <h5 class="card-title">Data Kejadian Waktu Henti <span>/ <?php echo "$tahun-$bulan"; ?></span></h5>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center"><b>No</b></th>
                        <th class="text-center"><b>Kategori</b></th>
                        <th class="text-center"><b>Nama User</b></th>
                        <th class="text-center"><b>Mulai</b></th>
                        <th class="text-center"><b>Selesai</b></th>
                        <th class="text-center"><b>Durasi</b></th>
                        <th class="text-center"><b>Status</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(empty($JumlahData)){
                            echo '<tr>';
                            echo '  <td colspan="7" class="text-center">Tdak Ada Data</td>';
                            echo '</tr>';
                        }else{
                            $no = 1;
                            //KONDISI PENGATURAN MASING FILTER
                            if($periode_laporan=="Tahunan"){
                                $query = mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$tahun%' ORDER BY tanggal_mulai ASC");
                            }else{
                                $PeriodeTahun="$tahun-$bulan";
                                $query = mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$PeriodeTahun%' ORDER BY tanggal_mulai ASC");
                            }
                                while ($data = mysqli_fetch_array($query)) {
                                $id_waktu_henti= $data['id_waktu_henti'];
                                $id_akses= $data['id_akses'];
                                $nama_user= $data['nama_user'];
                                $tanggal_mulai= $data['tanggal_mulai'];
                                $tanggal_selesai= $data['tanggal_selesai'];
                                $tanggal_catat= $data['tanggal_catat'];
                                $kategori= $data['kategori'];
                                $keterangan= $data['keterangan'];
                                $status= $data['status'];
                                //Buka Detail Akses
                                $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                $nama_akses= $DataDetailAkses['nama_akses'];
                                $kontak_akses= $DataDetailAkses['kontak_akses'];
                                $email_akses = $DataDetailAkses['email_akses'];
                                //Menghitung Durasi
                                $datetime1 = new DateTime($tanggal_mulai);//start time
                                $datetime2 = new DateTime($tanggal_selesai);//end time
                                $durasi = $datetime1->diff($datetime2);
                                $durasi=$durasi->format('%H Jam');
                                echo '<tr>';
                                echo '  <td class="text-center">'.$no.'</td>';
                                echo '  <td class="text-left">'.$kategori.'</td>';
                                echo '  <td class="text-left">'.$nama_user.'</td>';
                                echo '  <td class="text-left">'.$tanggal_mulai.'</td>';
                                echo '  <td class="text-left">'.$tanggal_selesai.'</td>';
                                echo '  <td class="text-left">'.$durasi.'</td>';
                                echo '  <td class="text-left">'.$status.'</td>';
                                echo '</tr>';
                            $no++;}
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
