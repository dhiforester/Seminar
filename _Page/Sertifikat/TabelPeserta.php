<?php
    //koneksi dan session
    ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //id_event_setting
    if(empty($_POST['id_event_setting'])){
        echo '<div class="col-md-12 text-center text-danger">';
        echo '  Silahkan Pilih Event Terlebih Dulu';
        echo '</div>';
    }else{
        $id_event_setting=$_POST['id_event_setting'];
        //Buka Nama Event
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $nama_event= $DataEvent['nama_event'];
        //keyword
        if(!empty($_POST['KeywordPeserta'])){
            $keyword=$_POST['KeywordPeserta'];
        }else{
            $keyword="";
        }
        //batas
        if(!empty($_POST['BatasPeserta'])){
            $batas=$_POST['BatasPeserta'];
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
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE id_event_setting='$id_event_setting'"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE (id_event_setting='$id_event_setting') AND (nama like '%$keyword%' OR kontak like '%$keyword%' OR email like '%$keyword%' OR organization like '%$keyword%')"));
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
            var id_event_setting="<?php echo "$id_event_setting"; ?>";
            $.ajax({
                url     : "_Page/Sertifikat/TabelPeserta.php",
                method  : "POST",
                data 	:  { page: valueNext, BatasPeserta: batas, KeywordPeserta: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy, id_event_setting: id_event_setting },
                success: function (data) {
                    $('#TabelPeserta').html(data);

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
            var id_event_setting="<?php echo "$id_event_setting"; ?>";
            $.ajax({
                url     : "_Page/Sertifikat/TabelPeserta.php",
                method  : "POST",
                data 	:  { page: ValuePrev, BatasPeserta: batas, KeywordPeserta: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy, id_event_setting: id_event_setting },
                success : function (data) {
                    $('#TabelPeserta').html(data);
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
                var id_event_setting="<?php echo "$id_event_setting"; ?>";
                $.ajax({
                    url     : "_Page/Sertifikat/TabelPeserta.php",
                    method  : "POST",
                    data 	:  { page: PageNumber, BatasPeserta: batas, KeywordPeserta: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy, id_event_setting: id_event_setting },
                    success: function (data) {
                        $('#TabelPeserta').html(data);
                    }
                })
            });
        <?php } ?>
    </script>
    <div class="col-md-12 mb-3">
        <span><?php echo "Nama Event: <code class='text-info'>$nama_event</code>";?></span>
    </div>
    <input type="hidden" name="PutIdEvent" value="<?php echo "$id_event_setting"; ?>">
    <input type="hidden" name="PutPage" value="<?php echo "$page"; ?>">
    <input type="hidden" name="PutBatas" value="<?php echo "$batas"; ?>">
    <input type="hidden" name="kategori_sertifikat" value="Peserta">
    <div class="col-md-12">
        <?php
            if(empty($jml_data)){
                echo '<div class="text-danger">Tidak Ada Data Yang Ditampilan!</div>';
            }else{
                echo '<ol class="list-group list-group-numbered">';
                    $no = 1+$posisi;
                    //KONDISI PENGATURAN MASING FILTER
                    if(empty($keyword)){
                        $query = mysqli_query($Conn, "SELECT*FROM event_peserta WHERE id_event_setting='$id_event_setting' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                    }else{
                        $query = mysqli_query($Conn, "SELECT*FROM event_peserta WHERE (id_event_setting='$id_event_setting') AND (nama like '%$keyword%' OR kontak like '%$keyword%' OR email like '%$keyword%' OR organization like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                    }
                    while ($data = mysqli_fetch_array($query)) {
                        $id_peserta= $data['id_peserta'];
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
                        //Buka Sertifikat
                        $QrySertifikat= mysqli_query($Conn,"SELECT * FROM event_sertifikat WHERE id_person='$id_peserta' AND kategori_sertifikat='Peserta'")or die(mysqli_error($Conn));
                        $DataSertifikat= mysqli_fetch_array($QrySertifikat);
                        if(empty($DataSertifikat['token'])){
                            $TokenSertifikat="";
                            $GroupName="";
                            $label_token='<code>Sertifikat Belum Tersedia</code>';
                        }else{
                            $TokenSertifikat= $DataSertifikat['token'];
                            $GroupName= $DataSertifikat['group_name'];
                            $label_token='<a href="SertifikatPdf.php?Token='.$TokenSertifikat.'" target="_blank"><code class="text-success">'.$TokenSertifikat.'</code></a>';
                        }
                        //Jumlah Data Kehadiran
                        $JumlahDataKehadiran = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_absen WHERE id_peserta='$id_peserta'"));
        ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <label for="firstCheckbox<?php echo $id_peserta;?>">
                        <div class="fw-bold"><?php echo "$nama"; ?></div>
                        <small>
                            <?php echo "$label_token<br>$GroupName"; ?>
                        </small>
                    </label>
                </div>
                <input class="form-check-input me-1" type="checkbox" value="<?php echo $id_peserta;?>" id="firstCheckbox<?php echo $id_peserta;?>" name="CheckIdPerson[]">
            </li>
        <?php
                    $no++;
                }
            } 
        ?>
    </div>
    <div class="col-md-12 mb-3">
        <small id="NotifikasiGenerateToken">
            <code class="text-primary">Silahkan checklist data peserta yang akan dibuatkan token sertifikatnya.</code>
        </small>
    </div>
    <div class="col-md-6 mb-3">
        <select name="id_setting_sertifikat" class="form-control">
            <option value="">Pilih</option>
            <?php
                $query = mysqli_query($Conn, "SELECT*FROM setting_sertifikat WHERE id_event_setting='$id_event_setting'");
                while ($data = mysqli_fetch_array($query)) {
                    $id_setting_sertifikat= $data['id_setting_sertifikat'];
                    $group_name= $data['group_name'];
                    echo '<option value="'.$id_setting_sertifikat.'">'.$group_name.'</option>';
                }
            ?>
        </select>
        <small>Pilih Group Setting</small>
    </div>
    <div class="col-md-6 mb-3">
        <button type="submit" class="btn btn-md btn-primary btn-block">
            <i class="bi bi-check-circle"></i> Generate Token
        </button>
    </div>
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
            <button class="btn btn-sm btn-outline-info" type="button" id="PrevPage" value="<?php echo $prev;?>">
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
                        echo '<button type="button" class="btn btn-sm btn-info" id="PageNumber'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                    }else{
                        echo '<button type="button" class="btn btn-sm btn-outline-info" id="PageNumber'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                    }
                }
            ?>
            <button type="button" class="btn btn-sm btn-outline-info" id="NextPage" value="<?php echo $next;?>">
                <span aria-hidden="true">»</span>
            </button>
        </div>
    </div>
<?php } ?>