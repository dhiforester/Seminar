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
            url     : "_Page/TamplateWa/TabelPartnership.php",
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
            url     : "_Page/TamplateWa/TabelPartnership.php",
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
                url     : "_Page/TamplateWa/TabelPartnership.php",
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
                                <b>Partner Name</b>
                            </th>
                            <th class="text-center">
                                <b>Status</b>
                            </th>
                            <th class="text-center">
                                <b>Aktual</b>
                            </th>
                            <th class="text-center">
                                <b>WA H-3</b>
                            </th>
                            <th class="text-center">
                                <b>WA H-1</b>
                            </th>
                            <th class="text-center">
                                <b>WA H+3 Invoice</b>
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
                                    //Mencari data tamplate Aktual
                                    $QryTamplate=mysqli_query($Conn,"SELECT * FROM whatsapp_tamplate WHERE id_mitra='$id_mitra' AND nama_tamplate='Aktual'")or die(mysqli_error($Conn));
                                    $DataTamplate=mysqli_fetch_array($QryTamplate);
                                    $IdTamplate= $DataTamplate['id_whatsapp_tamplate'];
                                    $StatusTamplate= $DataTamplate['status'];
                                    //Mencari data tamplate WA H-3
                                    $QryTamplate1 = mysqli_query($Conn,"SELECT * FROM whatsapp_tamplate WHERE id_mitra='$id_mitra' AND nama_tamplate='WA H-3'")or die(mysqli_error($Conn));
                                    $DataTamplate1 = mysqli_fetch_array($QryTamplate1);
                                    $IdTamplate1= $DataTamplate1['id_whatsapp_tamplate'];
                                    $StatusTamplate1= $DataTamplate1['status'];
                                    //Mencari data tamplate WA H-1
                                    $QryTamplate2 = mysqli_query($Conn,"SELECT * FROM whatsapp_tamplate WHERE id_mitra='$id_mitra' AND nama_tamplate='WA H-1'")or die(mysqli_error($Conn));
                                    $DataTamplate2 = mysqli_fetch_array($QryTamplate2);
                                    $IdTamplate2= $DataTamplate2['id_whatsapp_tamplate'];
                                    $StatusTamplate2= $DataTamplate2['status'];
                                    //Mencari data tamplate WA H3
                                    $QryTamplate3 = mysqli_query($Conn,"SELECT * FROM whatsapp_tamplate WHERE id_mitra='$id_mitra' AND nama_tamplate='WA H3'")or die(mysqli_error($Conn));
                                    $DataTamplate3 = mysqli_fetch_array($QryTamplate3);
                                    $IdTamplate3= $DataTamplate3['id_whatsapp_tamplate'];
                                    $StatusTamplate3= $DataTamplate3['status'];
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
                                    <?php
                                        if(empty($IdTamplate)){
                                            echo '<a href="index.php?Page=TamplateWa&Sub=FormTamplate&id='.$id_mitra.'&form=Aktual" class="btn btn-sm btn-md btn-danger">';
                                            echo '  <i class="bi bi-plus-circle"></i>';
                                            echo '  Kosong';
                                            echo '</a>';
                                        }else{
                                            if($StatusTamplate!=="Aktiv"){
                                                echo '<a href="index.php?Page=TamplateWa&Sub=FormTamplate&id='.$id_mitra.'&form=Aktual" class="btn btn-sm btn-md btn-warning">';
                                                echo '  <i class="bi bi-gear"></i>';
                                                echo '  '.$StatusTamplate.'';
                                                echo '</a>';
                                            }else{
                                                echo '<a href="index.php?Page=TamplateWa&Sub=FormTamplate&id='.$id_mitra.'&form=Aktual" class="btn btn-sm btn-md btn-success">';
                                                echo '  <i class="bi bi-info-circle"></i>';
                                                echo '  '.$StatusTamplate.'';
                                                echo '</a>';
                                            }
                                        }
                                    ?>
                                </td>
                                <td class="text-center" align="center">
                                    <?php
                                        if(empty($IdTamplate1)){
                                            echo '<a href="index.php?Page=TamplateWa&Sub=FormTamplate&id='.$id_mitra.'&form=WA H-3" class="btn btn-sm btn-md btn-danger">';
                                            echo '  <i class="bi bi-plus-circle"></i>';
                                            echo '  Kosong';
                                            echo '</a>';
                                        }else{
                                            if($StatusTamplate1!=="Aktiv"){
                                                echo '<a href="index.php?Page=TamplateWa&Sub=FormTamplate&id='.$id_mitra.'&form=WA H-3" class="btn btn-sm btn-md btn-warning">';
                                                echo '  <i class="bi bi-gear"></i>';
                                                echo '  '.$StatusTamplate1.'';
                                                echo '</a>';
                                            }else{
                                                echo '<a href="index.php?Page=TamplateWa&Sub=FormTamplate&id='.$id_mitra.'&form=WA H-3" class="btn btn-sm btn-md btn-success">';
                                                echo '  <i class="bi bi-info-circle"></i>';
                                                echo '  '.$StatusTamplate1.'';
                                                echo '</a>';
                                            }
                                        }
                                    ?>
                                </td>
                                <td class="text-center" align="center">
                                    <?php
                                        if(empty($IdTamplate2)){
                                            echo '<a href="index.php?Page=TamplateWa&Sub=FormTamplate&id='.$id_mitra.'&form=WA H-1" class="btn btn-sm btn-md btn-danger">';
                                            echo '  <i class="bi bi-plus-circle"></i>';
                                            echo '  Kosong';
                                            echo '</a>';
                                        }else{
                                            if($StatusTamplate2!=="Aktiv"){
                                                echo '<a href="index.php?Page=TamplateWa&Sub=FormTamplate&id='.$id_mitra.'&form=WA H-1" class="btn btn-sm btn-md btn-warning">';
                                                echo '  <i class="bi bi-gear"></i>';
                                                echo '  '.$StatusTamplate2.'';
                                                echo '</a>';
                                            }else{
                                                echo '<a href="index.php?Page=TamplateWa&Sub=FormTamplate&id='.$id_mitra.'&form=WA H-1" class="btn btn-sm btn-md btn-success">';
                                                echo '  <i class="bi bi-info-circle"></i>';
                                                echo '  '.$StatusTamplate2.'';
                                                echo '</a>';
                                            }
                                        }
                                    ?>
                                </td>
                                <td class="text-center" align="center">
                                    <?php
                                        if(empty($IdTamplate3)){
                                            echo '<a href="index.php?Page=TamplateWa&Sub=FormTamplate&id='.$id_mitra.'&form=WA H3" class="btn btn-sm btn-md btn-danger">';
                                            echo '  <i class="bi bi-plus-circle"></i>';
                                            echo '  Kosong';
                                            echo '</a>';
                                        }else{
                                            if($StatusTamplate3!=="Aktiv"){
                                                echo '<a href="index.php?Page=TamplateWa&Sub=FormTamplate&id='.$id_mitra.'&form=WA H3" class="btn btn-sm btn-md btn-warning">';
                                                echo '  <i class="bi bi-gear"></i>';
                                                echo '  '.$StatusTamplate3.'';
                                                echo '</a>';
                                            }else{
                                                echo '<a href="index.php?Page=TamplateWa&Sub=FormTamplate&id='.$id_mitra.'&form=WA H3" class="btn btn-sm btn-md btn-success">';
                                                echo '  <i class="bi bi-info-circle"></i>';
                                                echo '  '.$StatusTamplate3.'';
                                                echo '</a>';
                                            }
                                        }
                                    ?>
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