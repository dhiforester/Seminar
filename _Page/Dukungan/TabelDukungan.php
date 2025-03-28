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
        $OrderBy="id_dukungan";
    }
    //Atur Page
    if(!empty($_POST['page'])){
        $page=$_POST['page'];
        $posisi = ( $page - 1 ) * $batas;
    }else{
        $page="1";
        $posisi = 0;
    }
    if($SessionAkses=="Admin"){
        if(empty($keyword_by)){
            if(empty($keyword)){
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan"));
            }else{
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan WHERE tanggal_request like '%$keyword%' OR tanggal_response like '%$keyword%' OR kategori_dukungan like '%$keyword%' OR judul_dukungan like '%$keyword%' OR status_dukungan like '%$keyword%'"));
            }
        }else{
            if(empty($keyword)){
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan"));
            }else{
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan WHERE $keyword_by like '%$keyword%'"));
            }
        }
    }else{
        if(empty($keyword_by)){
            if(empty($keyword)){
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan WHERE id_akses='$SessionIdAkses'"));
            }else{
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan WHERE (id_akses='$SessionIdAkses') AND (tanggal_request like '%$keyword%' OR tanggal_response like '%$keyword%' OR kategori_dukungan like '%$keyword%' OR judul_dukungan like '%$keyword%' OR status_dukungan like '%$keyword%')"));
            }
        }else{
            if(empty($keyword)){
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan WHERE id_akses='$SessionIdAkses'"));
            }else{
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan WHERE id_akses='$SessionIdAkses' AND $keyword_by like '%$keyword%'"));
            }
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
            url     : "_Page/Dukungan/TabelDukungan.php",
            method  : "POST",
            data 	:  { page: valueNext, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelDukungan').html(data);

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
            url     : "_Page/Dukungan/TabelDukungan.php",
            method  : "POST",
            data 	:  { page: ValuePrev,batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelDukungan').html(data);
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
                url     : "_Page/Dukungan/TabelDukungan.php",
                method  : "POST",
                data 	:  { page: PageNumber, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success: function (data) {
                    $('#MenampilkanTabelDukungan').html(data);
                }
            })
        });
    <?php } ?>
</script>
<div class="card-body">
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
                                <b>Tanggal/Jam</b>
                            </th>
                            <th class="text-center">
                                <b>Kategori</b>
                            </th>
                            <th class="text-center">
                                <b>Dukungan</b>
                            </th>
                            <th class="text-center">
                                <b>Pemohon</b>
                            </th>
                            <th class="text-center">
                                <b>Unit/Tujuan</b>
                            </th>
                            <th class="text-center">
                                <b>Status</b>
                            </th>
                            <th class="text-center">
                                <b>Opt</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(empty($jml_data)){
                                echo '<tr>';
                                echo '  <td colspan="8">';
                                echo '      <span class="text-danger">Belum Ada Data Permitaan Dukungan Teknis</span>';
                                echo '  </td>';
                                echo '</tr>';
                            }else{
                                $no = 1+$posisi;
                                //KONDISI PENGATURAN MASING FILTER
                                if($SessionAkses=="Admin"){
                                    if(empty($keyword_by)){
                                        if(empty($keyword)){
                                            $query = mysqli_query($Conn, "SELECT*FROM dukungan ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM dukungan WHERE  (tanggal_request like '%$keyword%' OR tanggal_response like '%$keyword%' OR judul_dukungan like '%$keyword%' OR kategori_dukungan like '%$keyword%' OR status_dukungan like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                        }
                                    }else{
                                        if(empty($keyword)){
                                            $query = mysqli_query($Conn, "SELECT*FROM dukungan ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM dukungan WHERE ($keyword_by like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                        }
                                    }
                                }else{
                                    if(empty($keyword_by)){
                                        if(empty($keyword)){
                                            $query = mysqli_query($Conn, "SELECT*FROM dukungan WHERE id_akses='$SessionIdAkses' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM dukungan WHERE (id_akses='$SessionIdAkses') AND (tanggal_request like '%$keyword%' OR tanggal_response like '%$keyword%' OR judul_dukungan like '%$keyword%' OR kategori_dukungan like '%$keyword%' OR status_dukungan like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                        }
                                    }else{
                                        if(empty($keyword)){
                                            $query = mysqli_query($Conn, "SELECT*FROM dukungan WHERE id_akses='$SessionIdAkses' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                        }else{
                                            $query = mysqli_query($Conn, "SELECT*FROM dukungan WHERE (id_akses='$SessionIdAkses') AND ($keyword_by like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                        }
                                    }
                                }
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_dukungan= $data['id_dukungan'];
                                    $id_akses= $data['id_akses'];
                                    $id_unit_kerja= $data['id_unit_kerja'];
                                    if(empty($data['tanggal_request'])){
                                        $tanggal_request="";
                                    }else{
                                        $tanggal_request= $data['tanggal_request'];
                                        $tanggal_request= strtotime($tanggal_request);
                                        $tanggal_request= date('d/m/Y H:i', $tanggal_request);
                                    }
                                    if(empty($data['tanggal_response'])){
                                        $tanggal_response="";
                                    }else{
                                        $tanggal_response= $data['tanggal_response'];
                                    }
                                    if(empty($data['tanggal_selesai'])){
                                        $tanggal_selesai="";
                                    }else{
                                        $tanggal_selesai= $data['tanggal_selesai'];
                                    }
                                    $judul_dukungan= $data['judul_dukungan'];
                                    $kategori_dukungan= $data['kategori_dukungan'];
                                    $keterangan_dukungan= $data['keterangan_dukungan'];
                                    $status_dukungan= $data['status_dukungan'];
                                    //Buka detail akses
                                    $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                    $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                    $nama_akses= $DataDetailAkses['nama_akses'];
                                    //Buka unit tujuan
                                    $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                                    $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                                    $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                                    if($status_dukungan=="Request"){
                                        $LabelStatus='<span class="badge badge-danger">Rqst</span>';
                                    }else{
                                        if($status_dukungan=="Response"){
                                            $LabelStatus='<span class="badge badge-warning">Rsps</span>';
                                        }else{
                                            if($status_dukungan=="Done"){
                                                $LabelStatus='<span class="badge badge-success">Done</span>';
                                            }else{
                                                $LabelStatus='<span class="badge badge-dark">None</span>';
                                            }
                                        }
                                    }
                                ?>
                            <tr>
                                <td class="text-center text-xs">
                                    <?php echo "$no" ?>
                                </td>
                                <td class="text-left" align="left">
                                    <small><?php echo "$tanggal_request";?></small>
                                </td>
                                <td class="text-left" align="left">
                                    <small><?php echo "$kategori_dukungan";?></small>
                                </td>
                                <td class="text-left" align="left">
                                    <small><?php echo "$judul_dukungan";?></small>
                                </td>
                                <td class="text-left" align="left">
                                    <small><?php echo "$nama_akses";?></small><br>
                                </td>
                                <td class="text-left" align="left">
                                    <small><?php echo "$nama_unit_kerja";?></small><br>
                                </td>
                                <td class="text-left" align="left">
                                    <?php echo "$LabelStatus";?>
                                </td>
                                <td align="center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDetailDukungan" data-id="<?php echo "$id_dukungan"; ?>">
                                            <i class="bi bi-info-circle"></i>
                                        </button> 
                                    </div>
                                </td>
                            </tr>
                            <?php
                                $no++; }}
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