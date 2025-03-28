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
        $OrderBy="id_event_setting";
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
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_setting"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_setting WHERE tanggal_mulai like '%$keyword%' OR tanggal_selesai like '%$keyword%' OR nama_event like '%$keyword%' OR keterangan like '%$keyword%' OR status like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_setting"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_setting WHERE $keyword_by like '%$keyword%'"));
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
            url     : "_Page/Event/TabelEvent.php",
            method  : "POST",
            data 	:  { page: valueNext, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelEvent').html(data);

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
            url     : "_Page/Event/TabelEvent.php",
            method  : "POST",
            data 	:  { page: ValuePrev,batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelEvent').html(data);
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
                url     : "_Page/Event/TabelEvent.php",
                method  : "POST",
                data 	:  { page: PageNumber, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success: function (data) {
                    $('#MenampilkanTabelEvent').html(data);
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
                    $query = mysqli_query($Conn, "SELECT*FROM event_setting ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                }else{
                    $query = mysqli_query($Conn, "SELECT*FROM event_setting WHERE tanggal_mulai like '%$keyword%' OR tanggal_selesai like '%$keyword%' OR nama_event like '%$keyword%' OR keterangan like '%$keyword%' OR status like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                }
            }else{
                if(empty($keyword)){
                    $query = mysqli_query($Conn, "SELECT*FROM event_setting ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                }else{
                    $query = mysqli_query($Conn, "SELECT*FROM event_setting WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                }
            }
            while ($data = mysqli_fetch_array($query)) {
                $id_event_setting= $data['id_event_setting'];
                if(empty($data['tanggal_mulai'])){
                    $tanggal_mulai="";
                }else{
                    $tanggal_mulai= $data['tanggal_mulai'];
                    $tanggal_mulai= strtotime($tanggal_mulai);
                    $tanggal_mulai= date('d/m/Y', $tanggal_mulai);
                }
                if(empty($data['tanggal_selesai'])){
                    $tanggal_selesai="";
                }else{
                    $tanggal_selesai= $data['tanggal_selesai'];
                    $tanggal_selesai= strtotime($tanggal_selesai);
                    $tanggal_selesai= date('d/m/Y', $tanggal_selesai);
                }
                if(empty($data['mulai_pendaftaran'])){
                    $mulai_pendaftaran="";
                }else{
                    $mulai_pendaftaran= $data['mulai_pendaftaran'];
                    $mulai_pendaftaran= strtotime($mulai_pendaftaran);
                    $mulai_pendaftaran= date('d/m/Y', $mulai_pendaftaran);
                }
                if(empty($data['selesai_pendaftaran'])){
                    $selesai_pendaftaran="";
                }else{
                    $selesai_pendaftaran= $data['selesai_pendaftaran'];
                    $selesai_pendaftaran= strtotime($selesai_pendaftaran);
                    $selesai_pendaftaran= date('d/m/Y', $selesai_pendaftaran);
                }
                $nama_event= $data['nama_event'];
                $keterangan= $data['keterangan'];
                $status= $data['status'];
                if($status=="Rencana"){
                    $LabelStatus='<span class="badge badge-danger">Rencana</span>';
                }else{
                    if($status=="Berlangsung"){
                        $LabelStatus='<span class="badge badge-warning">Berlangsung</span>';
                    }else{
                        if($status=="Selesai"){
                            $LabelStatus='<span class="badge badge-success">Selesai</span>';
                        }else{
                            $LabelStatus='<span class="badge badge-dark">None</span>';
                        }
                    }
                }
                //Type Event
                $JumlahKategori = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_kategori WHERE id_event_setting='$id_event_setting'"));
                if(empty($JumlahKategori)){
                    $LabelJumlahKategori='<span class="badge badge-danger">Belum Ada</span>';
                }else{
                    $LabelJumlahKategori='<span class="badge badge-success">'.$JumlahKategori.' Record</span>';
                }
                //Peserta Event
                $JumlahPeserta = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE id_event_setting='$id_event_setting'"));
                if(empty($JumlahPeserta)){
                    $LabelJumlahPeserta='<span class="badge badge-danger">Belum Ada</span>';
                }else{
                    $LabelJumlahPeserta='<span class="badge badge-success">'.$JumlahPeserta.' Orang</span>';
                }
                //Batasi Karakter
                if(strlen($nama_event)>30) {
					$nama_event=substr($nama_event,0,30);
					$nama_event="$nama_event..";
				}
    ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <b>
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailEvent" data-id="<?php echo "$id_event_setting"; ?>">
                            <?php echo "$no. $nama_event"; ?>
                        </a>
                    </b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-12">
                            <small>
                                <ul>
                                    <li>ID : <code><?php echo "$id_event_setting"; ?></code></li>
                                    <li>Event : <code><?php echo "$tanggal_mulai - $tanggal_selesai"; ?></code></li>
                                    <li>Pendaftaran : <code><?php echo "$mulai_pendaftaran - $selesai_pendaftaran"; ?></code></li>
                                    <li>Type : <code><?php echo "$LabelJumlahKategori"; ?></code></li>
                                    <li>Peserta : <code><?php echo "$LabelJumlahPeserta"; ?></code></li>
                                    <li>Status : <code><?php echo "$LabelStatus"; ?></code></li>
                                </ul>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-left">
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDetailEvent" data-id="<?php echo "$id_event_setting"; ?>">
                        <i class="bi bi-info-circle"></i>
                    </button> 
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ModalEditEvent" data-id="<?php echo "$id_event_setting"; ?>">
                        <i class="bi bi-pencil-square"></i>
                    </button> 
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalHapusEvent" data-id="<?php echo "$id_event_setting"; ?>">
                        <i class="bi bi-x-circle"></i>
                    </button> 
                </div>
            </div>
        </div>
    <?php $no++; }} ?>
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