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
        $OrderBy="id_peserta";
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
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE nama like '%$keyword%' OR kontak like '%$keyword%' OR email like '%$keyword%' OR organization like '%$keyword%' "));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE $keyword_by like '%$keyword%'"));
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
            url     : "_Page/Peserta/TabelPeserta.php",
            method  : "POST",
            data 	:  { page: valueNext, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelPeserta').html(data);

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
            url     : "_Page/Peserta/TabelPeserta.php",
            method  : "POST",
            data 	:  { page: ValuePrev,batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelPeserta').html(data);
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
                url     : "_Page/Peserta/TabelPeserta.php",
                method  : "POST",
                data 	:  { page: PageNumber, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success: function (data) {
                    $('#MenampilkanTabelPeserta').html(data);
                }
            })
        });
    <?php } ?>
</script>
<div class="row">
    <?php
        if(empty($jml_data)){
            echo '<div class="col-md-12 text-center">';
            echo '  <div class="card">';
            echo '      <div class="card-body text-center">';
            echo '          <div class="text-danger">Tidak Ada Data Yang Ditampilan!</div>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
            $no = 1+$posisi;
            //KONDISI PENGATURAN MASING FILTER
            if(empty($keyword_by)){
                if(empty($keyword)){
                    $query = mysqli_query($Conn, "SELECT*FROM event_peserta ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                }else{
                    $query = mysqli_query($Conn, "SELECT*FROM event_peserta WHERE nama like '%$keyword%' OR kontak like '%$keyword%' OR email like '%$keyword%' OR organization like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                }
            }else{
                if(empty($keyword)){
                    $query = mysqli_query($Conn, "SELECT*FROM event_peserta ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                }else{
                    $query = mysqli_query($Conn, "SELECT*FROM event_peserta WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                }
            }
            while ($data = mysqli_fetch_array($query)) {
                $id_peserta= $data['id_peserta'];
                $id_event_setting= $data['id_event_setting'];
                $id_event_kategori= $data['id_event_kategori'];
                $tanggal_daftar= $data['tanggal_daftar'];
                $nama= $data['nama'];
                $kontak= $data['kontak'];
                $email= $data['email'];
                $organization= $data['organization'];
                $status_validasi= $data['status_validasi'];
                $status_pembayaran= $data['status_pembayaran'];
                $strtotime=strtotime($tanggal_daftar);
                $TanggalDaftar=date('d/m/Y H:i T', $strtotime);
                //Buka Nama Event
                $QryEvent= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
                $DataEvent= mysqli_fetch_array($QryEvent);
                $nama_event= $DataEvent['nama_event'];
                //Nama Sub Event
                $QryEvent= mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
                $DataEvent= mysqli_fetch_array($QryEvent);
                $KategoriEvent= $DataEvent['kategori'];
                //Jumlah Data Kehadiran
                $JumlahDataKehadiran = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_absen WHERE id_peserta='$id_peserta'"));
    ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <code>
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailPeserta" data-id="<?php echo "$id_peserta"; ?>">
                            <?php echo "$no. $nama"; ?>
                        </a>
                    </code>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-12">
                            <small>
                                <ul>
                                    <li>ID.Event : <code><?php echo "$id_event_setting"; ?></code></li>
                                    <li>ID.Kategori : <code><?php echo "$id_event_kategori"; ?></code></li>
                                    <li>
                                        Validasi : 
                                        <code>
                                            <?php
                                                if($status_validasi=="Valid"){
                                                    echo '<span class="badge badge-sm bg-success">Valid</span>';
                                                }else{
                                                    if($status_validasi=="Pending"){
                                                        echo '<span class="badge badge-sm bg-warning">Pending</span>';
                                                    }else{
                                                        echo '<small class="badge badge-sm bg-dark">'.$status_validasi.'</small>';
                                                    }
                                                }
                                            ?>
                                        </code>
                                    </li>
                                    <li>
                                        Pembayaran : 
                                        <code>
                                            <?php
                                                if($status_pembayaran=="Lunas"){
                                                    echo '<span class="badge badge-sm bg-success">Lunas</span>';
                                                }else{
                                                    if($status_pembayaran=="Pending"){
                                                        echo '<span class="badge badge-sm bg-warning">Pending</span>';
                                                    }else{
                                                        if($status_pembayaran=="Expired"){
                                                            echo '<span class="badge badge-sm bg-danger">Expired</span>';
                                                        }else{
                                                            echo '<small class="badge badge-sm bg-dark">'.$status_pembayaran.'</small>';
                                                        }
                                                    }
                                                }
                                            ?>
                                        </code>
                                    </li>
                                    <li>
                                        Kehadiran : 
                                        <code>
                                            <?php
                                                if($JumlahDataKehadiran==""){
                                                    echo '<span class="text-danger">None</span>';
                                                }else{
                                                    echo '<span class="text-success">'.$JumlahDataKehadiran.' Record</span>';
                                                }
                                            ?>
                                        </code>
                                    </li>
                                </ul>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-left">
                    <button type="button" class="btn btn-sm btn-info" title="Detail Peserta" data-bs-toggle="modal" data-bs-target="#ModalDetailPeserta" data-id="<?php echo "$id_peserta"; ?>">
                        <i class="bi bi-info-circle"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" title="Hapus Peserta" data-bs-toggle="modal" data-bs-target="#ModalDeletePeserta" data-id="<?php echo "$id_peserta,$keyword,$batas,$ShortBy,$OrderBy,$page,$keyword_by"; ?>" title="Hapus Peserta">
                        <i class="bi bi-x"></i>
                    </button>   
                </div>
            </div>
        </div>
    <?php $no++;}} ?>
</div>
<div class="row">
    <div class="col-md-12 text-center">
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
</div>