<?php
    //koneksi dan session
    // ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/SettingGeneral.php";
    include "../../_Config/SettingWhatsapp.php";
    //keyword
    if(!empty($_POST['KeywordAkunWa'])){
        $keyword=$_POST['KeywordAkunWa'];
    }else{
        $keyword="";
    }
    //batas
    if(!empty($_POST['BatasAkunWa'])){
        $batas=$_POST['BatasAkunWa'];
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
    if(empty($keyword)){
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM whatsapp_client"));
    }else{
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM whatsapp_client WHERE clientId like '%$keyword%' OR nama_mitra like '%$keyword%' OR nomor_akun_wa like '%$keyword%'"));
    }
?>
<script>
    //ketika klik next
    $('#NextPageAkunWa').click(function() {
        var valueNext=$('#NextPage').val();
        var batas=$('#batas').val();
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/WhatsappGateway/TabelAkunWa.php",
            method  : "POST",
            data 	:  { page: valueNext, BatasAkunWa: batas, KeywordAkunWa: keyword, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelAkunWa').html(data);

            }
        })
    });
    //Ketika klik Previous
    $('#PrevPageAkunWa').click(function() {
        var ValuePrev = $('#PrevPage').val();
        var batas=$('#batas').val();
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/WhatsappGateway/TabelAkunWa.php",
            method  : "POST",
            data 	:  { page: ValuePrev, BatasAkunWa: batas, KeywordAkunWa: keyword, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelAkunWa').html(data);
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
        $('#PageNumberAkunWa<?php echo $i;?>').click(function() {
            var PageNumber = $('#PageNumber<?php echo $i;?>').val();
            var batas=$('#batas').val();
            var keyword="<?php echo "$keyword"; ?>";
            var keyword_by="<?php echo "$keyword_by"; ?>";
            var OrderBy="<?php echo "$OrderBy"; ?>";
            var ShortBy="<?php echo "$ShortBy"; ?>";
            $.ajax({
                url     : "_Page/WhatsappGateway/TabelAkunWa.php",
                method  : "POST",
                data 	:  { page: PageNumber, BatasAkunWa: batas, KeywordAkunWa: keyword, OrderBy: OrderBy, ShortBy: ShortBy },
                success: function (data) {
                    $('#MenampilkanTabelAkunWa').html(data);
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
                                <b>Mitra</b>
                            </th>
                            <th class="text-center">
                                <b>Nomor Wa</b>
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
                                echo '  <td colspan="6">';
                                echo '      <span class="text-danger">No Data</span>';
                                echo '  </td>';
                                echo '</tr>';
                            }else{
                                $no = 1+$posisi;
                                //KONDISI PENGATURAN MASING FILTER
                                $query = mysqli_query($Conn, "SELECT*FROM whatsapp_client WHERE clientId like '%$keyword%' OR nama_mitra like '%$keyword%' OR nomor_akun_wa like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_whatsapp_client= $data['id_whatsapp_client'];
                                    $clientId= $data['clientId'];
                                    $id_mitra= $data['id_mitra'];
                                    $nama_mitra= $data['nama_mitra'];
                                    $nomor_akun_wa= $data['nomor_akun_wa'];
                                    //Status Akun WA
                                    $arr = array(
                                        "api_key"=> "$api_key_Whatsapp",
                                        "clientId"=> "$clientId"
                                    );
                                    $headers = array(
                                        'Content-Type:Application/x-www-form-urlencoded'
                                    );
                                    $json=json_encode($arr);
                                    //Kirim data CURL
                                    $ch = curl_init();
                                    curl_setopt($ch,CURLOPT_URL, "$url_status_client");
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
                                        $status="";
                                    }else{
                                        $status=$ambil_json["metadata"]["status"];
                                    }
                                    if($status=="Connected"){
                                        $LabelStatus='<span class="text-primary text-xs">Connected</span>';
                                    }else{
                                        if(empty($ambil_json["metadata"]["status"])){
                                            $LabelStatus='<span class="text-danger text-xs">None</span>';
                                        }else{
                                            $LabelStatus='<span class="text-info text-xs">'.$status.'</span>';
                                        }
                                    }
                        ?>
                            <tr>
                                <td class="text-center text-xs">
                                    <small><?php echo "$no" ?></small>
                                </td>
                                <td class="text-left" align="left">
                                    <small>
                                        <?php echo "$clientId";?>
                                    </small>
                                </td>
                                <td class="text-left" align="left">
                                    <small>
                                        <?php echo "$nama_mitra";?>
                                    </small>
                                </td>
                                <td class="text-left" align="left">
                                    <small>
                                        <?php echo "$nomor_akun_wa";?>
                                    </small>
                                </td>
                                <td class="text-left" align="left">
                                    <small>
                                        <?php echo "$LabelStatus";?>
                                    </small>
                                </td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm btn-floating" data-bs-toggle="modal" data-bs-target="#ModalDetailAkunWa" data-id="<?php echo "$clientId"; ?>">
                                        <i class="bi bi-upc-scan"></i>
                                    </button>  
                                    <button type="button" class="btn btn-danger btn-sm btn-floating" data-bs-toggle="modal" data-bs-target="#ModalDeleteAkunWa" data-id="<?php echo "$clientId,$keyword,$batas,$ShortBy,$OrderBy,$page"; ?>">
                                        <i class="bi bi-x"></i>
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
        <button class="btn btn-sm btn-outline-info" id="PrevPageAkunWa" value="<?php echo $prev;?>">
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
                    echo '<button class="btn btn-sm btn-info" id="PageNumberAkunWa'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                }else{
                    echo '<button class="btn btn-sm btn-outline-info" id="PageNumberAkunWa'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                }
            }
        ?>
        <button class="btn btn-sm btn-outline-info" id="NextPageAkunWa" value="<?php echo $next;?>">
            <span aria-hidden="true">»</span>
        </button>
    </div>
</div>