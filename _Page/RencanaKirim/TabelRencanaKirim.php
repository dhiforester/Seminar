<?php
    //koneksi dan session
    ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    //Tangkap id_mitra
    if(empty($_POST['GetIdMitra'])){
        echo '<div class="card-body">';
        echo '  <div class="row mt-4">';
        echo '      <div class="col-md-12 text-center">';
        echo '          ID Mitra Tidak Boleh Kosong!';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_mitra=$_POST['GetIdMitra'];
        //keyword
        if(!empty($_POST['KeywordRencanaKirim'])){
            $keyword=$_POST['KeywordRencanaKirim'];
        }else{
            $keyword="";
        }
        //batas
        if(!empty($_POST['BatasRencanaKirim'])){
            $batas=$_POST['BatasRencanaKirim'];
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
            $OrderBy="id_rencana_kirim";
        }
        //Atur Page
        if(!empty($_POST['page'])){
            $page=$_POST['page'];
            $posisi = ( $page - 1 ) * $batas;
        }else{
            $page="1";
            $posisi = 0;
        }
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM whatsapp_rencana_kirim WHERE id_mitra='$id_mitra'"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM whatsapp_rencana_kirim WHERE (id_mitra='$id_mitra') AND (clientId like '%$keyword%' OR tanggal_kirim like '%$keyword%' OR no_tujuan like '%$keyword%' OR pesan like '%$keyword%' OR status like '%$keyword%')"));
        }
?>
<script>
    //ketika klik next
    $('#NextPage').click(function() {
        var valueNext=$('#NextPage').val();
        var id_mitra="<?php echo "$id_mitra"; ?>";
        var batas="<?php echo "$batas"; ?>";
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/RencanaKirim/TabelRencanaKirim.php",
            method  : "POST",
            data 	:  { page: valueNext, GetIdMitra: id_mitra, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelRencanaKirim').html(data);

            }
        })
    });
    //Ketika klik Previous
    $('#PrevPage').click(function() {
        var ValuePrev = $('#PrevPage').val();
        var id_mitra="<?php echo "$id_mitra"; ?>";
        var batas="<?php echo "$batas"; ?>";
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/RencanaKirim/TabelRencanaKirim.php",
            method  : "POST",
            data 	:  { page: ValuePrev, GetIdMitra: id_mitra, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelRencanaKirim').html(data);
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
            var id_mitra="<?php echo "$id_mitra"; ?>";
            var batas="<?php echo "$batas"; ?>";
            var keyword="<?php echo "$keyword"; ?>";
            var keyword_by="<?php echo "$keyword_by"; ?>";
            var OrderBy="<?php echo "$OrderBy"; ?>";
            var ShortBy="<?php echo "$ShortBy"; ?>";
            $.ajax({
                url     : "_Page/RencanaKirim/TabelRencanaKirim.php",
                method  : "POST",
                data 	:  { page: PageNumber, GetIdMitra: id_mitra, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success: function (data) {
                    $('#MenampilkanTabelRencanaKirim').html(data);
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
                                <b>ID Client</b>
                            </th>
                            <th class="text-center">
                                <b>Tanggal</b>
                            </th>
                            <th class="text-center">
                                <b>No.Tujuan</b>
                            </th>
                            <th class="text-center">
                                <b>Pesan</b>
                            </th>
                            <th class="text-center">
                                <b>Status</b>
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
                                echo '  <td colspan="7">';
                                echo '      <span class="text-danger">No Data</span>';
                                echo '  </td>';
                                echo '</tr>';
                            }else{
                                $no = 1+$posisi;
                                //KONDISI PENGATURAN MASING FILTER
                                if(empty($keyword)){
                                    $query = mysqli_query($Conn, "SELECT*FROM whatsapp_rencana_kirim WHERE id_mitra='$id_mitra' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }else{
                                    $query = mysqli_query($Conn, "SELECT*FROM whatsapp_rencana_kirim WHERE (id_mitra='$id_mitra') AND (clientId like '%$keyword%' OR tanggal_kirim like '%$keyword%' OR no_tujuan like '%$keyword%' OR pesan like '%$keyword%' OR status like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_rencana_kirim= $data['id_rencana_kirim'];
                                    $id_mitra= $data['id_mitra'];
                                    $clientId= $data['clientId'];
                                    $tanggal_kirim= $data['tanggal_kirim'];
                                    $no_tujuan= $data['no_tujuan'];
                                    $pesan= $data['pesan'];
                                    $status= $data['status'];
                                    //Pesan ringkasan
                                    $num_char="20";
                                    $PreviewText=substr($pesan, 0, $num_char);
                                ?>
                            <tr>
                                <td class="text-center text-xs">
                                    <?php echo "$no" ?>
                                </td>
                                <td class="text-left" align="left">
                                    <small class="credit">
                                        <?php 
                                            echo "$clientId <br>";
                                        ?>
                                    </small>
                                </td>
                                <td class="text-left" align="left">
                                    <small class="credit">
                                        <?php 
                                            echo "$tanggal_kirim <br>";
                                        ?>
                                    </small>
                                </td>
                                <td class="text-left" align="left">
                                    <small class="credit">
                                        <?php 
                                            echo "$no_tujuan <br>";
                                        ?>
                                    </small>
                                </td>
                                <td class="text-left" align="left">
                                    <small class="credit">
                                        <?php 
                                            echo "$PreviewText <br>";
                                        ?>
                                    </small>
                                </td>
                                <td class="text-center" align="center">
                                    <small class="credit">
                                        <?php 
                                            echo "$status <br>";
                                        ?>
                                    </small>
                                </td>
                                <td class="text-center" align="center">
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#ModalEditRencanaKirim" data-id="<?php echo "$id_rencana_kirim,$keyword,$batas,$ShortBy,$OrderBy,$page,$id_mitra"; ?>" title="Edit Rencana Kirim Pesan">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapusRencanaKirim" data-id="<?php echo "$id_rencana_kirim,$keyword,$batas,$ShortBy,$OrderBy,$page,$id_mitra"; ?>" title="Hapus Rencana Kirim Pesan">
                                        <i class="bi bi-trash"></i>
                                    </button>
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
<?php } ?>