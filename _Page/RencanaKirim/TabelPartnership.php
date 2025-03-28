<?php
    //koneksi dan session
    ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    // include "../../_Config/Session.php";
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
        $OrderBy="id_mitra";
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
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM mitra"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM mitra WHERE nama_mitra like '%$keyword%' OR kontak_mitra like '%$keyword%' OR email_mitra like '%$keyword%' OR kategori_mitra like '%$keyword%' OR status_mitra like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM mitra"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM mitra WHERE $keyword_by like '%$keyword%'"));
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
            url     : "_Page/RencanaKirim/TabelPartnership.php",
            method  : "POST",
            data 	:  { page: valueNext, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelPartnership').html(data);

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
            url     : "_Page/RencanaKirim/TabelPartnership.php",
            method  : "POST",
            data 	:  { page: ValuePrev,batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelPartnership').html(data);
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
                url     : "_Page/RencanaKirim/TabelPartnership.php",
                method  : "POST",
                data 	:  { page: PageNumber, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success: function (data) {
                    $('#MenampilkanTabelPartnership').html(data);
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
                                <b>Nama Mitra</b>
                            </th>
                            <th class="text-center">
                                <b>Status</b>
                            </th>
                            <th class="text-center">
                                <b>Pesan</b>
                            </th>
                            <th class="text-center">
                                <b>Rencana</b>
                            </th>
                            <th class="text-center">
                                <b>Terkirim</b>
                            </th>
                            <th class="text-center">
                                <b>Opsi</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(empty($jml_data)){
                                echo '<tr>';
                                echo '  <td colspan="6">';
                                echo '      <span class="text-danger">No Data</span>';
                                echo '  </td>';
                                echo '</tr>';
                            }else{
                                $no = 1+$posisi;
                                //KONDISI PENGATURAN MASING FILTER
                                if(empty($keyword_by)){
                                    if(empty($keyword)){
                                        $query = mysqli_query($Conn, "SELECT*FROM mitra ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }else{
                                        $query = mysqli_query($Conn, "SELECT*FROM mitra WHERE nama_mitra like '%$keyword%' OR kontak_mitra like '%$keyword%' OR email_mitra like '%$keyword%' OR kategori_mitra like '%$keyword%' OR status_mitra like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }
                                }else{
                                    if(empty($keyword)){
                                        $query = mysqli_query($Conn, "SELECT*FROM mitra ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }else{
                                        $query = mysqli_query($Conn, "SELECT*FROM mitra WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }
                                }
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_mitra= $data['id_mitra'];
                                    $id_akses= $data['id_akses'];
                                    $id_wilayah= $data['id_wilayah'];
                                    $nama_mitra= $data['nama_mitra'];
                                    $kontak_mitra= $data['kontak_mitra'];
                                    $propinsi_mitra= $data['propinsi_mitra'];
                                    $kabupaten_mitra= $data['kabupaten_mitra'];
                                    $kecamatan_mitra= $data['kecamatan_mitra'];
                                    $desa_mitra= $data['desa_mitra'];
                                    $alamat_mitra= $data['alamat_mitra'];
                                    $email_mitra= $data['email_mitra'];
                                    $delegasi= $data['delegasi'];
                                    $kontak_delegasi= $data['kontak_delegasi'];
                                    $kategori_mitra= $data['kategori_mitra'];
                                    $status_mitra= $data['status_mitra'];
                                    $tanggal_daftar= $data['tanggal_daftar'];
                                    //Ubah STRTOTIME to DATETIME
                                    $datetime=$tanggal_daftar;
                                    if($status_mitra=="Valid"){
                                        $label_status_mitra='<label class="badge badge-success">Valid</label>';
                                    }else{
                                        $label_status_mitra='<label class="badge badge-warning">'.$status_mitra.'</label>';
                                    }
                                    //Buka data rencana kirim pesan
                                    $QryRencanaKirim=mysqli_query($Conn,"SELECT * FROM whatsapp_rencana_kirim WHERE id_mitra='$id_mitra'")or die(mysqli_error($Conn));
                                    $DataRencanaKirim=mysqli_fetch_array($QryRencanaKirim);
                                    $id_rencana_kirim= $DataRencanaKirim['id_rencana_kirim'];
                                    $tanggal_kirim= $DataRencanaKirim['tanggal_kirim'];
                                    $JumlahRencanaKirimTerkirim= mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM whatsapp_rencana_kirim WHERE id_mitra='$id_mitra' AND status='Terkirim'"));
                                    $JumlahRencanaKirim = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM whatsapp_rencana_kirim WHERE id_mitra='$id_mitra' AND status='None'"));
                                    $JumlahSemuaRencanaKirim = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM whatsapp_rencana_kirim WHERE id_mitra='$id_mitra'"));
                                ?>
                            <tr>
                                <td class="text-center text-xs">
                                    <?php echo "$no" ?>
                                </td>
                                <td class="text-left" align="left">
                                    <b><?php echo "$nama_mitra";?></b>
                                    <br>
                                    <small class="credit">
                                        <?php 
                                            echo "<i class='bi bi-tag'></i> $kategori_mitra <br>";
                                            echo "<i class='bi bi-envelope'></i> $email_mitra <br>";
                                        ?>
                                    </small>
                                    <br>
                                </td>
                                <td class="text-center" align="center">
                                    <small class="credit">
                                        <?php 
                                            echo "<b>$label_status_mitra</b><br>";
                                        ?>
                                    </small>
                                    <br>
                                </td>
                                <td class="text-center" align="center">
                                    <small class="credit">
                                        <?php 
                                            echo "<small>$JumlahSemuaRencanaKirim Pesan</small><br>";
                                        ?>
                                    </small>
                                    <br>
                                </td>
                                <td class="text-center" align="center">
                                    <small class="credit">
                                        <?php 
                                            echo "<small>$JumlahRencanaKirim Pesan</small><br>";
                                        ?>
                                    </small>
                                    <br>
                                </td>
                                <td class="text-center" align="center">
                                    <small class="credit">
                                        <?php 
                                            echo "<small>$JumlahRencanaKirimTerkirim Pesan</small><br>";
                                        ?>
                                    </small>
                                    <br>
                                </td>
                                <td class="text-center" align="center">
                                    <a href="index.php?Page=RencanaKirim&Sub=RencanaKirimByMitra&id=<?php echo "$id_mitra"; ?>" class="btn btn-sm btn-info">
                                        Detail
                                    </a>
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