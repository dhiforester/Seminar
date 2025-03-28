<?php
    $Sekarang=date('Y-m-d');
    
    if(empty($_GET['tahun'])){
        $tahun=date('Y');
    }else{
        $tahun=$_GET['tahun'];
    }
    if(empty($_GET['bulan'])){
        $bulan=date('m');
    }else{
        $bulan=$_GET['bulan'];
    }
    $bulan= sprintf("%02d", $bulan);
    if(empty($_GET['ShowTgl'])){
        $ShowTgl="$tahun-$bulan";
    }else{
        $ShowTgl=$_GET['ShowTgl'];
    }
    if(empty($_GET['id'])){
        $id="";
    }else{
        $id=$_GET['id'];
    }
    //Back
    if($bulan=="01"){
        $BulanBack="12";
        $TahunBack=$tahun-1;
    }else{
        $BulanBack=$bulan-1;
        $TahunBack=$tahun;
    }

    //Next
    if($bulan=="12"){
        $BulanNext="01";
        $TahunNext=$tahun+1;
    }else{
        $BulanNext=$bulan+1;
        $TahunNext=$tahun;
    }
    $Tanggal="$tahun-$bulan";
    $JumahHari = cal_days_in_month(CAL_GREGORIAN, $BulanNext,  $TahunNext);
?>
<input type="hidden" name="ShowTgl" id="ShowTgl" value="<?php echo $ShowTgl;?>">
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info alert-dismissible fade show" role="alert"> 
                <small>
                    Pada halaman ini anda bisa menambahkan agenda kerja anda, melihat agenda orang lain dan menambahkan 
                    progres/riwayat kerja anda didalamnya. Setiap data agenda yang anda tambahkan disini dapat dilihat juga oleh pengguna lain.
                </small>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form action="index.php?Page=Agenda" method="GET">
                        <input type="hidden" name="Page" id="Page" value="Agenda">
                        <div class="row">
                            <div class="col-md-1 mt-3">
                                <a href="index.php?Page=Agenda&bulan=<?php echo "$BulanBack"; ?>&tahun=<?php echo "$TahunBack"; ?>&id=<?php echo "$id"; ?>" class="btn btn-md btn-primary btn-block btn-rounded">
                                    <i class="bi bi-arrow-left-circle"></i>
                                </a>
                            </div>
                            <div class="col-md-2 mt-3">
                                <input type="number" min="1990" name="tahun" id="tahun" class="form-control" value="<?php echo "$tahun"; ?>">
                                <small for="tahun">Tahun</small>
                            </div>
                            <div class="col-md-3 mt-3">
                                <select name="bulan" id="bulan" class="form-control">
                                    <option <?php if($bulan=="01"){echo "selected";} ?> value="01">Januari</option>
                                    <option <?php if($bulan=="02"){echo "selected";} ?> value="02">Februari</option>
                                    <option <?php if($bulan=="03"){echo "selected";} ?> value="03">Maret</option>
                                    <option <?php if($bulan=="04"){echo "selected";} ?> value="04">April</option>
                                    <option <?php if($bulan=="05"){echo "selected";} ?> value="05">Mei</option>
                                    <option <?php if($bulan=="06"){echo "selected";} ?> value="06">Juni</option>
                                    <option <?php if($bulan=="07"){echo "selected";} ?> value="07">Juli</option>
                                    <option <?php if($bulan=="08"){echo "selected";} ?> value="08">Agustus</option>
                                    <option <?php if($bulan=="09"){echo "selected";} ?> value="09">September</option>
                                    <option <?php if($bulan=="10"){echo "selected";} ?> value="10">Oktober</option>
                                    <option <?php if($bulan=="11"){echo "selected";} ?> value="11">November</option>
                                    <option <?php if($bulan=="12"){echo "selected";} ?>  value="12">Desember</option>
                                </select>
                                <small for="bulan">Bulan</small>
                            </div>
                            <div class="col-md-3 mt-3">
                                <select name="id" id="id" class="form-control">
                                    <option value="">All</option>
                                    <?php
                                        $query = mysqli_query($Conn, "SELECT*FROM unit_kerja ORDER BY nama_unit_kerja ASC");
                                        while ($data = mysqli_fetch_array($query)) {
                                            $id_unit_kerja= $data['id_unit_kerja'];
                                            $nama_unit_kerja= $data['nama_unit_kerja'];
                                            if($id==$id_unit_kerja){
                                                echo '<option selected value="'.$id_unit_kerja.'">'.$nama_unit_kerja.'</option>';
                                            }else{
                                                echo '<option value="'.$id_unit_kerja.'">'.$nama_unit_kerja.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <small for="id">Unit Kerja</small>
                            </div>
                            <div class="col-md-2 mt-3">
                                <button type="submit" class="btn btn-md btn-info btn-block btn-rounded">
                                    Cari
                                </a>
                            </div>
                            <div class="col-md-1 mt-3">
                                <a href="index.php?Page=Agenda&bulan=<?php echo "$BulanNext"; ?>&tahun=<?php echo "$TahunNext"; ?>&id=<?php echo "$id"; ?>" class="btn btn-md btn-primary btn-block btn-rounded">
                                    <i class="bi bi-arrow-right-circle"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <!-- <h3><?php echo "Periode $bulan/$tahun"; ?></h3> -->
                    <div class="table table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <td class="text-center">Minggu</td>
                                    <td class="text-center">Senin</td>
                                    <td class="text-center">Selasa</td>
                                    <td class="text-center">Rabu</td>
                                    <td class="text-center">Kamis</td>
                                    <td class="text-center">Jumat</td>
                                    <td class="text-center">Sabtu</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $s=date ("w", mktime (0,0,0,$bulan,1,$tahun));
                                    for ($ds=1;$ds<=$s;$ds++) {
                                        echo "<td></td>";
                                    }
                                    for ($d=1;$d<=$JumahHari;$d++) {
                                        $tgl=sprintf("%02d", $d);
                                        if (date("w",mktime (0,0,0,$bulan,$d,$tahun)) == 0) {
                                            echo "<tr>"; 
                                        }
                                        $warna="#000000"; // warna default
                                        if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday") { 
                                            $warna="text-danger"; 
                                        }else{
                                            $warna="text-dark"; 
                                        }
                                        $TanggalTsb="$tahun-$bulan-$tgl";
                                        if(empty($id)){
                                            $JumlahAgenda=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda WHERE id_akses!='$SessionIdAkses' AND tanggal like '%$TanggalTsb%'"));
                                        }else{
                                            $JumlahAgenda=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda WHERE id_akses!='$SessionIdAkses' AND id_unit_kerja='$id' AND tanggal like '%$TanggalTsb%'"));
                                        }
                                        $JumlahAgendaSaya=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM agenda WHERE id_akses='$SessionIdAkses' AND tanggal like '%$TanggalTsb%'"));
                                        if(empty($JumlahAgenda)){
                                            $Badge="";
                                        }else{
                                            $Badge='<span class="badge bg-danger">'.$JumlahAgenda.'</span>';
                                        }
                                        if(empty($JumlahAgendaSaya)){
                                            $BadgeSaya="";
                                        }else{
                                            $BadgeSaya='<span class="badge bg-success"><small>'.$JumlahAgendaSaya.'</small></span>';
                                        }
                                        if($TanggalTsb==$Sekarang){
                                            echo '<td class="text-center bg-primary"><a href="index.php?Page=Agenda&tahun='.$tahun.'&bulan='.$bulan.'&ShowTgl='.$TanggalTsb.'&id='.$id.'" class="text-light"  data-bs-target="#ModalTampilkanListAgenda" data-id="'.$tahun.'-'.$bulan.'-'.$tgl.'">'.$d.' '.$Badge.' '.$BadgeSaya.'</a></td>'; 
                                        }else{
                                            if($TanggalTsb==$ShowTgl){
                                                echo '<td class="text-center bg-info"><a href="index.php?Page=Agenda&tahun='.$tahun.'&bulan='.$bulan.'&ShowTgl='.$TanggalTsb.'&id='.$id.'" class="text-light"  data-bs-target="#ModalTampilkanListAgenda" data-id="'.$tahun.'-'.$bulan.'-'.$tgl.'">'.$d.' '.$Badge.' '.$BadgeSaya.'</a></td>'; 
                                            }else{
                                                echo '<td class="text-center"><a href="index.php?Page=Agenda&tahun='.$tahun.'&bulan='.$bulan.'&ShowTgl='.$TanggalTsb.'&id='.$id.'" class="'.$warna.'"  data-bs-target="#ModalTampilkanListAgenda" data-id="'.$tahun.'-'.$bulan.'-'.$tgl.'">'.$d.' '.$Badge.' '.$BadgeSaya.'</a></td>'; 
                                            } 
                                        }
                                        
                                        if (date("w",mktime (0,0,0,$bulan,$d,$tahun)) == 6) { 
                                            echo "</tr>"; 
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="table table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <td class="text-center">Tgl</td>
                                    <td class="text-center">Waktu</td>
                                    <td class="text-center">Staf/Petugas</td>
                                    <td class="text-center">Unit</td>
                                    <td class="text-center">Kegiatan</td>
                                    <td class="text-center">Status</td>
                                    <td class="text-center">Opt</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $tgl=1;
                                    for ( $i =$tgl; $i<=$JumahHari; $i++ ){
                                        $tgl=sprintf("%02d", $i);
                                        $FulTanggal="$tahun-$bulan-$tgl";
                                        $Strtotime=strtotime($FulTanggal);
                                        $NamaHari=date('l',$Strtotime);
                                        if($NamaHari=="Sunday"){
                                            $BgWarna="bg-danger text-light";
                                        }else{
                                            if($Sekarang==$FulTanggal){
                                                $BgWarna="bg-success text-dark";
                                            }else{
                                                $BgWarna="bg-light text-dark";
                                            }
                                        }
                                        echo '<tr class="'.$BgWarna.'">';
                                        echo '  <td class="text-center"><b>'.$tgl.'</b></td>';
                                        echo '  <td class="text-left" colspan="5"><b>'.$NamaHari.' '.$tgl.'/'.$bulan.'/'.$tahun.'</b></td>';
                                        echo '  <td class="text-center">';
                                        echo '  <button typ"button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahAgenda" data-id="'.$tahun.'-'.$bulan.'-'.$tgl.'"><i class="bi bi-plus-circle"></i></button>';
                                        echo '  </td>';
                                        echo '</tr>';
                                        //Menampilkan data kegiatan
                                        if(empty($id)){
                                            $QryKegiatan = mysqli_query($Conn, "SELECT*FROM agenda WHERE tanggal like '%$FulTanggal%' ORDER BY id_agenda ASC");
                                        }else{
                                            $QryKegiatan = mysqli_query($Conn, "SELECT*FROM agenda WHERE id_unit_kerja='$id' AND tanggal like '%$FulTanggal%' ORDER BY id_agenda ASC");
                                        }
                                        
                                        while ($DataKegiatan = mysqli_fetch_array($QryKegiatan)) {
                                            $id_agenda= $DataKegiatan['id_agenda'];
                                            $ListIdAkses= $DataKegiatan['id_akses'];
                                            $ListIdUnitKerja= $DataKegiatan['id_unit_kerja'];
                                            $tanggal= $DataKegiatan['tanggal'];
                                            $kategori= $DataKegiatan['kategori'];
                                            $agenda= $DataKegiatan['agenda'];
                                            $status= $DataKegiatan['status'];
                                            $strtotime=strtotime($tanggal);
                                            $JamKegiatan=date('H:i',$strtotime);
                                             //Buka data askes
                                            $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$ListIdAkses'")or die(mysqli_error($Conn));
                                            $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                            $nama_akses= $DataDetailAkses['nama_akses'];
                                            $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                                            $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                                            $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                                            echo '<tr class="'.$BgWarna.'">';
                                            echo '  <td class="text-center"></td>';
                                            echo '  <td class="text-left"><small>Jam '.$JamKegiatan.'</small></td>';
                                            echo '  <td class="text-left"><small>'.$nama_akses.'</small></td>';
                                            echo '  <td class="text-left"><small>'.$nama_unit_kerja.'</small></td>';
                                            echo '  <td class="text-left"><small>'.$kategori.'</small></td>';
                                            echo '  <td class="text-left"><b>'.$status.'</b></td>';
                                            echo '  <td class="text-center">';
                                            echo '  <button typ"button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#ModalEditAgenda" data-id="'.$id_agenda.'"><i class="bi bi-info-circle"></i></button>';
                                            echo '  </td>';
                                            echo '</tr>';
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <b class="card-title">List Agenda</b>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-rounded w-100" data-bs-toggle="modal" data-bs-target="#ModalTambahAgenda" data-id="<?php echo "$ShowTgl"; ?>">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </button>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-warning btn-rounded w-100" data-bs-toggle="modal" data-bs-target="#ModalCetakAgenda">
                                <i class="bi bi-printer"></i> Cetak
                            </button>
                        </div>
                    </div>
                </div>
                <div id="ListAgenda">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                Belum Ada Data Yang Dipilih
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>