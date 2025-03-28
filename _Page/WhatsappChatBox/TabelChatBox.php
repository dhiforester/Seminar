<?php
    //koneksi dan session
    ini_set("display_errors","off");
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Setting.php";
    include "../../_Config/SettingWhatsapp.php";
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
        $OrderBy="id_whatsapp_client";
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
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM whatsapp_client"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM whatsapp_client WHERE clientId like '%$keyword%' OR nama_mitra like '%$keyword%' OR nomor_akun_wa like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM whatsapp_client"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM whatsapp_client WHERE $keyword_by like '%$keyword%'"));
        }
    }
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
<script>
    //ketika klik next
    $('#NextPage').click(function() {
        var valueNext=$('#NextPage').val();
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $('#MenampilkanTabelChatBox').html('Loading..');
        $.ajax({
            url     : "_Page/WhatsappChatBox/TabelChatBox.php",
            method  : "POST",
            data 	:  { page: valueNext, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelChatBox').html(data);
            }
        })
    });
    //Ketika klik Previous
    $('#PrevPage').click(function() {
        var ValuePrev = $('#PrevPage').val();
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $('#MenampilkanTabelChatBox').html('Loading..');
        $.ajax({
            url     : "_Page/WhatsappChatBox/TabelChatBox.php",
            method  : "POST",
            data 	:  { page: ValuePrev,keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelChatBox').html(data);
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
            var keyword="<?php echo "$keyword"; ?>";
            var keyword_by="<?php echo "$keyword_by"; ?>";
            var OrderBy="<?php echo "$OrderBy"; ?>";
            var ShortBy="<?php echo "$ShortBy"; ?>";
            $('#MenampilkanTabelChatBox').html('Loading..');
            $.ajax({
                url     : "_Page/WhatsappChatBox/TabelChatBox.php",
                method  : "POST",
                data 	:  { page: PageNumber, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success: function (data) {
                    $('#MenampilkanTabelChatBox').html(data);
                }
            })
        });
    <?php } ?>
</script>
<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="text-dark">
                        <tr>
                            <th class="text-center"><b>No</b></th>
                            <th class="text-center"><b>Mitra</b></th>
                            <th class="text-center"><b>Client ID</b></th>
                            <th class="text-center"><b>Nomor</b></th>
                            <th class="text-center"><b>Inbox</b></th>
                            <th class="text-center"><b>Outbox</b></th>
                            <th class="text-center"><b>Option</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(empty($jml_data)){
                                echo '<tr>';
                                echo '  <td colspan="7" class="text-center text-danger">';
                                echo '      Tidak Ada Data Akun Wa';
                                echo '  </td>';
                                echo '</tr>';
                            }
                            $no = 1+$posisi;
                            //KONDISI PENGATURAN MASING FILTER
                            if(empty($keyword_by)){
                                if(empty($keyword)){
                                    $query = mysqli_query($Conn, "SELECT*FROM whatsapp_client ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }else{
                                    $query = mysqli_query($Conn, "SELECT*FROM whatsapp_client WHERE clientId like '%$keyword%' OR nama_mitra like '%$keyword%' OR nomor_akun_wa like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }
                            }else{
                                if(empty($keyword)){
                                    $query = mysqli_query($Conn, "SELECT*FROM whatsapp_client ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }else{
                                    $query = mysqli_query($Conn, "SELECT*FROM whatsapp_client WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }
                            }
                            while ($data = mysqli_fetch_array($query)) {
                                $id_whatsapp_client= $data['id_whatsapp_client'];
                                $clientId= $data['clientId'];
                                $id_mitra= $data['id_mitra'];
                                $nama_mitra= $data['nama_mitra'];
                                $nomor_akun_wa= $data['nomor_akun_wa'];
                                //Membuka Count
                                $arr = array(
                                    "api_key"=> "$api_key_Whatsapp",
                                    "number"=> "$nomor_akun_wa"
                                );
                                $headers = array(
                                    'Content-Type:Application/x-www-form-urlencoded'
                                );
                                $json=json_encode($arr);
                                //Kirim data CURL
                                $ch = curl_init();
                                curl_setopt($ch,CURLOPT_URL, "$url_count_chatbox");
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                                curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                                curl_setopt($ch,CURLOPT_MAXREDIRS, 10);
                                curl_setopt($ch,CURLOPT_TIMEOUT, 30);
                                curl_setopt($ch,CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                                curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
                                curl_setopt($ch,CURLOPT_HEADER, 0);
                                curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
                                curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                    'Content-Type: application/json',
                                    'Content-Length: ' . strlen($json))
                                );
                                $result = curl_exec($ch);
                                curl_close($ch);
                                $ambil_json =json_decode($result, true);
                                if($ambil_json["response"]["code"]!==200){
                                    $outbox=$ambil_json["response"]["massage"];
                                    $inbox=$ambil_json["response"]["massage"];
                                }else{
                                    $outbox=$ambil_json["metadata"]["outbox"];
                                    $inbox=$ambil_json["metadata"]["inbox"];
                                }
                            ?>
                            <tr>
                                <td class="text-center">
                                    <small class="text-dark">
                                        <?php echo $no;?>
                                    </small>
                                </td>
                                <td class="text-left">
                                    <small class="text-dark">
                                        <?php echo $nama_mitra;?>
                                    </small>
                                </td>
                                <td class="text-left">
                                    <small class="text-dark">
                                        <?php echo $clientId;?>
                                    </small>
                                </td>
                                <td class="text-left">
                                    <small class="text-dark">
                                        <?php echo $nomor_akun_wa;?>
                                    </small>
                                </td>
                                <td class="text-left">
                                    <small class="text-dark">
                                        <?php echo $inbox;?>
                                    </small>
                                </td>
                                <td class="text-left">
                                    <small class="text-dark">
                                        <?php echo $outbox;?>
                                    </small>
                                </td>
                                <td class="text-center">
                                    <a href="index.php?Page=WhatsappChatBox&Sub=DetailChatBox&nomor=<?php echo "$nomor_akun_wa"; ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-info-circle"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php $no++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="card-footer border-1">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="btn-group shadow-0" role="group" aria-label="Basic example">
                <button class="btn btn-sm btn-outline-info btn-rounded" id="PrevPage" value="<?php echo $prev;?>">
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
                            echo '<button class="btn btn-sm btn-info" id="PageNumber'.$i.'" value="'.$i.'">'.$i.'</button>';
                        }else{
                            echo '<button class="btn btn-sm btn-outline-info" id="PageNumber'.$i.'" value="'.$i.'">'.$i.'</button>';
                        }
                    }
                ?>
                <button class="btn btn-sm btn-outline-info btn-rounded" id="NextPage" value="<?php echo $next;?>">
                    <span aria-hidden="true">»</span>
                </button>
            </div>
        </div>
    </div>
</div>