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
        $OrderBy="id_inventaris";
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
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE nama_unit_kerja like '%$keyword%' OR kode like '%$keyword%' OR nama like '%$keyword%' OR kategori_barang like '%$keyword%' OR kategori_asset like '%$keyword%' OR nomor_serial like '%$keyword%' OR kondisi like '%$keyword%' OR ketersediaan like '%$keyword%' OR lokasi like '%$keyword%' OR satuan like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inventaris WHERE $keyword_by like '%$keyword%'"));
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
            url     : "_Page/Inventaris/TabelInventaris.php",
            method  : "POST",
            data 	:  { page: valueNext, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelInventaris').html(data);

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
            url     : "_Page/Inventaris/TabelInventaris.php",
            method  : "POST",
            data 	:  { page: ValuePrev,batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelInventaris').html(data);
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
                url     : "_Page/Inventaris/TabelInventaris.php",
                method  : "POST",
                data 	:  { page: PageNumber, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success: function (data) {
                    $('#MenampilkanTabelInventaris').html(data);
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
                                <b>Image</b>
                            </th>
                            <th class="text-center">
                                <b>Barang</b>
                            </th>
                            <th class="text-center">
                                <b>Kategori</b>
                            </th>
                            <th class="text-center">
                                <b>Unit/User</b>
                            </th>
                            <th class="text-center">
                                <b>Qty</b>
                            </th>
                            <th class="text-center">
                                <b>Status</b>
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
                                echo '  <td colspan="9" class="text-center text-danger">Tidak Ada Data Yang Ditampilan</td>';
                                echo '</tr>';
                            }else{
                                $no = 1+$posisi;
                                //KONDISI PENGATURAN MASING FILTER
                                if(empty($keyword_by)){
                                    if(empty($keyword)){
                                        $query = mysqli_query($Conn, "SELECT*FROM inventaris ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }else{
                                        $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE nama_unit_kerja like '%$keyword%' OR kode like '%$keyword%' OR nama like '%$keyword%' OR kategori_barang like '%$keyword%' OR kategori_asset like '%$keyword%' OR nomor_serial like '%$keyword%' OR kondisi like '%$keyword%' OR ketersediaan like '%$keyword%' OR lokasi like '%$keyword%' OR satuan like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }
                                }else{
                                    if(empty($keyword)){
                                        $query = mysqli_query($Conn, "SELECT*FROM inventaris ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }else{
                                        $query = mysqli_query($Conn, "SELECT*FROM inventaris WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }
                                }
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_inventaris= $data['id_inventaris'];
                                    $id_akses= $data['id_akses'];
                                    $id_unit_kerja= $data['id_unit_kerja'];
                                    $nama_unit_kerja= $data['nama_unit_kerja'];
                                    $kode= $data['kode'];
                                    $nama= $data['nama'];
                                    $kategori_barang= $data['kategori_barang'];
                                    $kategori_asset= $data['kategori_asset'];
                                    $spesifikasi= $data['spesifikasi'];
                                    $nomor_serial= $data['nomor_serial'];
                                    $gambar= $data['gambar'];
                                    $kondisi= $data['kondisi'];
                                    $ketersediaan= $data['ketersediaan'];
                                    $lokasi= $data['lokasi'];
                                    $qty= $data['qty'];
                                    $satuan= $data['satuan'];
                                    $tanggal_beli= $data['tanggal_beli'];
                                    $tanggal_garansi= $data['tanggal_garansi'];
                                    $tanggal_input= $data['tanggal_input'];
                                    //Buka data akses
                                    $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                    $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                    $nama_akses= $DataDetailAkses['nama_akses'];
                        ?>
                            <tr>
                                <td class="text-center text-xs">
                                    <?php echo "$no" ?>
                                </td>
                                <td class="text-center text-xs">
                                    <?php 
                                        if(!empty($gambar)){
                                            echo '<img src="assets/img/Inventaris/'.$gambar.'" width="70px" class="rounded">';
                                        }else{
                                            echo '<img src="assets/img/Inventaris/no-image.jpg"  width="70px" class="rounded">';
                                        }
                                    ?>
                                </td>
                                <td class="text-left" align="left">
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailInventaris" data-id="<?php echo "$id_inventaris,$keyword,$batas,$ShortBy,$OrderBy,$page,$keyword_by"; ?>">
                                        <b><?php echo "$nama";?></b>
                                    </a><br>
                                    <small>
                                        <?php 
                                            echo "Kode: $kode<br>"; 
                                            echo "SN: $nomor_serial"; 
                                        ?>
                                    </small>
                                </td>
                                <td class="text-left" align="left">
                                    <?php 
                                        echo "<b>$kategori_barang</b><br>";
                                        echo "<small>$kategori_asset</small><br>";
                                    ?>
                                </td>
                                <td class="text-left" align="left">
                                    <?php 
                                        echo "<b>$nama_akses</b><br>";
                                        echo "<small>$nama_unit_kerja</small><br>";
                                    ?>
                                </td>
                                <td class="text-left" align="left">
                                    <?php 
                                        echo "<small>$qty $satuan</small><br>";
                                    ?>
                                </td>
                                <td class="text-left" align="left">
                                    <?php 
                                        echo "<b>$kondisi</b><br>";
                                        echo "<small>$ketersediaan</small><br>";
                                    ?>
                                </td>
                                <td align="center">
                                    <div class="btn-group">
                                        <?php if($id_akses==$SessionIdAkses){ ?>
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ModalEditInventaris" data-id="<?php echo "$id_inventaris,$keyword,$batas,$ShortBy,$OrderBy,$page,$keyword_by"; ?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>  
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDeleteInventaris" data-id="<?php echo "$id_inventaris,$keyword,$batas,$ShortBy,$OrderBy,$page,$keyword_by"; ?>">
                                                <i class="bi bi-x"></i>
                                            </button>  
                                        <?php }else{ ?> 
                                            <button type="button" disabled class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>  
                                            <button type="button" disabled class="btn btn-danger btn-sm">
                                                <i class="bi bi-x"></i>
                                            </button>  
                                        <?php } ?> 
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