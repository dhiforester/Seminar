<?php
    //koneksi dan session
    ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Keyword_by
    if(!empty($_POST['keyword_by'])){
        $keyword_by=$_POST['keyword_by'];
    }else{
        $keyword_by="";
    }
    //keyword
    if(!empty($_POST['keyword'])){
        $keyword=$_POST['keyword'];
    }else{
        $keyword="";
    }
    //batas
    if(!empty($_POST['batas'])){
        $batas=$_POST['batas'];
    }else{
        $batas="10";
    }
    //ShortBy
    if(!empty($_POST['ShortBy'])){
        $ShortBy=$_POST['ShortBy'];
        if($ShortBy=="ASC"){
            $NextShort="DESC";
        }else{
            $NextShort="ASC";
        }
    }else{
        $ShortBy="DESC";
        $NextShort="ASC";
    }
    //OrderBy
    if(!empty($_POST['OrderBy'])){
        $OrderBy=$_POST['OrderBy'];
    }else{
        $OrderBy="tanggal";
    }
    //Atur Page
    if(!empty($_POST['page'])){
        $page=$_POST['page'];
        $posisi = ( $page - 1 ) * $batas;
    }else{
        $page="1";
        $posisi = 0;
    }
    if(empty($keyword_by)){
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM riwayat_kerja"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE tanggal like '%$keyword%' OR nama like '%$keyword%' OR kategori_kerja like '%$keyword%' OR keterangan like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM riwayat_kerja"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE $keyword_by like '%$keyword%'"));
        }
    }
?>
<script>
    //ketika klik next
    $('#NextPage').click(function() {
        var valueNext=$('#NextPage').val();
        var batas="<?php echo "$batas"; ?>";
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/RiwayatKerja/TabelRiwayatKerja.php",
            method  : "POST",
            data 	:  { page: valueNext, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelRiwayatKerja').html(data);

            }
        })
    });
    //Ketika klik Previous
    $('#PrevPage').click(function() {
        var ValuePrev = $('#PrevPage').val();
        var batas="<?php echo "$batas"; ?>";
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/RiwayatKerja/TabelRiwayatKerja.php",
            method  : "POST",
            data 	:  { page: ValuePrev,batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelRiwayatKerja').html(data);
            }
        })
    });
    <?php 
        $JmlHalaman =ceil($jml_data/$batas); 
        $a=1;
        $b=$JmlHalaman;
        for ( $i =$a; $i<=$b; $i++ ){
    ?>
        //ketika klik page number
        $('#PageNumber<?php echo $i;?>').click(function() {
            var PageNumber = $('#PageNumber<?php echo $i;?>').val();
            var batas="<?php echo "$batas"; ?>";
            var keyword="<?php echo "$keyword"; ?>";
            var keyword_by="<?php echo "$keyword_by"; ?>";
            var OrderBy="<?php echo "$OrderBy"; ?>";
            var ShortBy="<?php echo "$ShortBy"; ?>";
            $.ajax({
                url     : "_Page/RiwayatKerja/TabelRiwayatKerja.php",
                method  : "POST",
                data 	:  { page: PageNumber, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success: function (data) {
                    $('#MenampilkanTabelRiwayatKerja').html(data);
                }
            })
        });
    <?php } ?>
</script>
<div class="card-body">
    <div class="row mt-4">
        <div class="col-md-12">
            <!-- Keyword: <?php echo "$keyword"; ?><br>
            Keyword By: <?php echo "$keyword_by"; ?> -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-items-center mb-0">
                    <thead class="">
                        <tr>
                            <th class="text-center">
                                <b>No</b>
                            </th>
                            <th class="text-center">
                                <b>Kegiatan</b>
                            </th>
                            <th class="text-center">
                                <b>Tanggal</b>
                            </th>
                            <th class="text-center">
                                <b>Nama</b>
                            </th>
                            <th class="text-center">
                                <b>Unit Kerja</b>
                            </th>
                            <th class="text-center">
                                <b>Kategori</b>
                            </th>
                            <th class="text-center">
                                <b>Option</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(empty($jml_data)){
                                echo '<tr>';
                                echo '  <td class="text-center text-danger" colspan="7">Data Tidak Ada</td>';
                                echo '</tr>';
                            }
                            $no = 1+$posisi;
                            //KONDISI PENGATURAN MASING FILTER
                            if(empty($keyword_by)){
                                if(empty($keyword)){
                                    $query = mysqli_query($Conn, "SELECT*FROM riwayat_kerja ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }else{
                                    $query = mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE tanggal like '%$keyword%' OR nama like '%$keyword%' OR kategori_kerja like '%$keyword%' OR keterangan like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }
                            }else{
                                if(empty($keyword)){
                                    $query = mysqli_query($Conn, "SELECT*FROM riwayat_kerja ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }else{
                                    $query = mysqli_query($Conn, "SELECT*FROM riwayat_kerja WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }
                            }
                            while ($data = mysqli_fetch_array($query)) {
                                $id_riwayat_kerja= $data['id_riwayat_kerja'];
                                $id_akses= $data['id_akses'];
                                $id_unit_kerja= $data['id_unit_kerja'];
                                $id_dukungan= $data['id_dukungan'];
                                $id_agenda= $data['id_agenda'];
                                $id_event= $data['id_event'];
                                $nama= $data['nama'];
                                $tanggal= $data['tanggal'];
                                $kategori_kerja= $data['kategori_kerja'];
                                $keterangan= $data['keterangan'];
                                $gambar_kerja= $data['gambar_kerja'];
                                //Buka detail akses
                                $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                $nama_akses= $DataDetailAkses['nama_akses'];
                                //Buka data unit kerja
                                $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                                $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                                $id_unit_kerja = $DataUnitKerja['id_unit_kerja'];
                                $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                                //Kategori Riwayat
                                if(!empty($data['id_dukungan'])){
                                    $KategoriRiwayatKerja="<span class='badge bg-info'>Dukungan</span>";
                                }else{
                                    if(!empty($data['id_agenda'])){
                                        $KategoriRiwayatKerja="<span class='badge bg-danger'>Agenda</span>";
                                    }else{
                                        if(!empty($data['id_event'])){
                                            $KategoriRiwayatKerja="<span class='badge bg-success'>Kegiatan</span>";
                                        }else{
                                            $KategoriRiwayatKerja="<span class='badge bg-dark'>None</span>";
                                        }
                                    }
                                }
                                //Label unit kerja
                                if(empty($DataUnitKerja['nama_unit_kerja'])){
                                    $LabelUnitKerja='<small class="text-warning">General</small>';
                                }else{
                                    $LabelUnitKerja='<small class="text-dark">'.$nama_unit_kerja.'</small>';
                                }
                                //Tanggal
                                $strtotime=strtotime($tanggal);
                                $DateOnly=date('d/m/Y', $strtotime);
                                $TimeOnly=date('H:i', $strtotime);
                                //Label Nama
                                if($id_akses==$SessionIdAkses){
                                    $LabelNama='<small class="text-info">'.$nama.'</small>';
                                }else{
                                    if(empty($data['nama'])){
                                        $LabelNama='<small class="text-danger">None</small>';
                                    }else{
                                        $LabelNama='<small class="text-dark">'.$nama.'</small>';
                                    }
                                }
                            ?>
                        <tr>
                            <td class="text-center text-xs">
                                <?php echo "$no" ?>
                            </td>
                            <td class="text-left">
                                <?php 
                                    echo "<a href='javascript:void(0);' data-bs-toggle='modal' data-bs-target='#ModalDetailRiwayatKerja' data-id=$id_riwayat_kerja>";
                                    echo "<b>$kategori_kerja</b>";
                                    echo "</a><br>";
                                    echo "<small>$keterangan</small>";
                                ?>
                            </td>
                            <td class="text-left">
                                <?php echo "<b>$DateOnly</b><br><small>$TimeOnly WIB</small>" ?>
                            </td>
                            <td class="text-left">
                                <?php echo "$LabelNama" ?>
                            </td>
                            <td class="text-left">
                                <?php echo "$LabelUnitKerja" ?>
                            </td>
                            <td class="text-left">
                                <?php echo "$KategoriRiwayatKerja" ?>
                            </td>
                            <td align="center">
                                <div class="btn-group">
                                    <?php if($id_akses==$SessionIdAkses){ ?>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDeleteRiwayatKerja" data-id="<?php echo "$id_riwayat_kerja"; ?>">
                                            <i class="bi bi-x"></i>
                                        </button>  
                                    <?php }else{ ?> 
                                        <button type="button" readonly class="btn btn-danger btn-sm">
                                            <i class="bi bi-x"></i>
                                        </button>  
                                    <?php } ?> 
                                </div>
                            </td>
                        </tr>
                        <?php
                            $no++; }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="card-footer text-center">
    <div class="btn-group shadow-0" role="group" aria-label="Basic example">
        <?php
            //Mengatur Halaman
            $JmlHalaman = ceil($jml_data/$batas); 
            $JmlHalaman_real = ceil($jml_data/$batas); 
            $prev=$page-1;
            $next=$page+1;
            if($next>$JmlHalaman){
                $next=$page;
            }else{
                $next=$page+1;
            }
            if($prev<"1"){
                $prev="1";
            }else{
                $prev=$page-1;
            }
        ?>
        <button class="btn btn-sm btn-outline-info" id="PrevPage" value="<?php echo $prev;?>">
            <span aria-hidden="true">«</span>
        </button>
        <?php 
            //Navigasi nomor
            if($JmlHalaman>3){
                if($page>=2){
                    $a=$page-1;
                    $b=$page+1;
                    if($JmlHalaman<=$b){
                        $a=$page-1;
                        $b=$JmlHalaman;
                    }
                }else{
                    $a=1;
                    $b=$page+1;
                    if($JmlHalaman<=$b){
                        $a=1;
                        $b=$JmlHalaman;
                    }
                }
            }else{
                $a=1;
                $b=$JmlHalaman;
            }
            for ( $i =$a; $i<=$b; $i++ ){
                if($page=="$i"){
                    echo '<button class="btn btn-sm btn-info" id="PageNumber'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                }else{
                    echo '<button class="btn btn-sm btn-outline-info" id="PageNumber'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                }
            }
        ?>
        <button class="btn btn-sm btn-outline-info" id="NextPage" value="<?php echo $next;?>">
            <span aria-hidden="true">»</span>
        </button>
    </div>
</div>