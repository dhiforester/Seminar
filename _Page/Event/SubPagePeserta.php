<?php
    //koneksi dan session
    ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //batas
    if(empty($_POST['id_event_setting'])){
        $id_event_setting="";
    }else{
        $id_event_setting=$_POST['id_event_setting'];
    }
    $batas="10";
    //Atur Page
    if(!empty($_POST['page'])){
        $page=$_POST['page'];
        $posisi = ( $page - 1 ) * $batas;
    }else{
        $page="1";
        $posisi = 0;
    }
    //Grouping Peserta
    if(empty($_POST['GroupingPeserta'])){
        $GroupingPeserta="";
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE id_event_setting='$id_event_setting'"));
    }else{
        $GroupingPeserta=$_POST['GroupingPeserta'];
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE id_event_setting='$id_event_setting' AND id_event_kategori='$GroupingPeserta'"));
    }
    
?>
<script>
    //ketika klik next
    $('#NextPagePeserta').click(function() {
        var valueNextPeserta=$('#NextPagePeserta').val();
        var id_event_setting="<?php echo "$id_event_setting"; ?>";
        var GroupingPeserta="<?php echo "$GroupingPeserta"; ?>";
        $.ajax({
            url     : "_Page/Event/SubPagePeserta.php",
            method  : "POST",
            data 	:  { page: valueNextPeserta, id_event_setting: id_event_setting, GroupingPeserta: GroupingPeserta },
            success: function (data) {
                $('#flush-collapse4').html(data);

            }
        })
    });
    //Ketika klik Previous
    $('#PrevPagePeserta').click(function() {
        var ValuePrevPeserta = $('#PrevPagePeserta').val();
        var id_event_setting="<?php echo "$id_event_setting"; ?>";
        var GroupingPeserta="<?php echo "$GroupingPeserta"; ?>";
        $.ajax({
            url     : "_Page/Event/SubPagePeserta.php",
            method  : "POST",
            data 	:  { page: ValuePrevPeserta, id_event_setting: id_event_setting, GroupingPeserta: GroupingPeserta },
            success : function (data) {
                $('#flush-collapse4').html(data);
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
        $('#PageNumberPeserta<?php echo $i;?>').click(function() {
            var PageNumberPeserta = $('#PageNumberPeserta<?php echo $i;?>').val();
            var id_event_setting="<?php echo "$id_event_setting"; ?>";
            var GroupingPeserta="<?php echo "$GroupingPeserta"; ?>";
            $.ajax({
                url     : "_Page/Event/SubPagePeserta.php",
                method  : "POST",
                data 	:  { page: PageNumberPeserta, id_event_setting: id_event_setting, GroupingPeserta: GroupingPeserta },
                success: function (data) {
                    $('#flush-collapse4').html(data);
                }
            })
        });
    <?php } ?>
    //ketika Grouping Dipilih
    $('#GroupKategoriEventPeserta').change(function() {
        var id_event_setting="<?php echo "$id_event_setting"; ?>";
        var GroupingPeserta=$('#GroupKategoriEventPeserta').val();
        $('#flush-collapse4').html('Loading...');
        $.ajax({
            url     : "_Page/Event/SubPagePeserta.php",
            method  : "POST",
            data 	:  { id_event_setting: id_event_setting, GroupingPeserta: GroupingPeserta },
            success: function (data) {
                $('#flush-collapse4').html(data);
            }
        })
    });
</script>
<div class="row mb-4 mt-4">
    <div class="col-md-12 text-center">
        <code>
            <b>Keterangan:</b><br>
            Untuk menambah/daftar peserta secara manual dilakukan pada halaman peserta.
        </code>
    </div>
</div>
<div class="row mb-4 mt-4">
    <div class="col-md-12">
        <select name="GroupKategoriEventPeserta" id="GroupKategoriEventPeserta" class="form-control">
            <option value="">Group Kategori</option>
            <?php
                $noKategori=1;
                $QryGroup = mysqli_query($Conn, "SELECT*FROM event_kategori WHERE id_event_setting='$id_event_setting' ORDER BY id_event_kategori DESC");
                while ($DataGroup = mysqli_fetch_array($QryGroup)) {
                    $IdEventKategoriGroup= $DataGroup['id_event_kategori'];
                    $KategoriGroup= $DataGroup['kategori'];
                    //Menghitung jumlah Peserta
                    $JumlahPeserta = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE id_event_kategori='$IdEventKategoriGroup'"));
                    if($GroupingPeserta==$IdEventKategoriGroup){
                        echo '<option selected value="'.$IdEventKategoriGroup.'">'.$noKategori.'. '.$KategoriGroup.' ('.$JumlahPeserta.')</option>';
                    }else{
                        echo '<option value="'.$IdEventKategoriGroup.'">'.$noKategori.'. '.$KategoriGroup.' ('.$JumlahPeserta.')</option>';
                    }
                    $noKategori++;
                }
            ?>
        </select>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-12">
        <ol class="list-group list-group-numbered">
            <?php
                if(empty($jml_data)){
                    echo '<li class="list-group-item d-flex justify-content-between align-items-start">';
                    echo '  Belum Ada Data Peserta';
                    echo '</div>';
                }else{
                    $no = 1+$posisi;
                    //KONDISI PENGATURAN MASING FILTER
                    if(empty($GroupingPeserta)){
                        $query = mysqli_query($Conn, "SELECT*FROM event_peserta WHERE id_event_setting='$id_event_setting' ORDER BY id_peserta DESC LIMIT $posisi, $batas");
                    }else{
                        $query = mysqli_query($Conn, "SELECT*FROM event_peserta WHERE id_event_setting='$id_event_setting' AND id_event_kategori='$GroupingPeserta' ORDER BY id_peserta DESC LIMIT $posisi, $batas");
                    }
                    while ($data = mysqli_fetch_array($query)) {
                        $id_peserta= $data['id_peserta'];
                        $id_event_kategori= $data['id_event_kategori'];
                        $nama= $data['nama'];
                        $status_validasi= $data['status_validasi'];
                        $status_pembayaran= $data['status_pembayaran'];
                        //Buka Kategori
                        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
                        $DataEvent= mysqli_fetch_array($QryEvent);
                        $kategoriEvent= $DataEvent['kategori'];
                        //Routing Status
                        if($status_validasi=="Valid"){
                            $LabelStatusValidasi='<span class="text-success">Valid</span>';
                        }else{
                            if($status_validasi=="Pending"){
                                $LabelStatusValidasi='<span class="text-warning">Pending</span>';
                            }else{
                                $LabelStatusValidasi='<small class="text-dark">'.$status_validasi.'</small>';
                            }
                        }
                        if($status_pembayaran=="Lunas"){
                            $LabelStatusPembayaran='<span class="text-success">Lunas</span>';
                        }else{
                            if($status_pembayaran=="Pending"){
                                $LabelStatusPembayaran='<span class="text-warning">Pending</span>';
                            }else{
                                if($status_pembayaran=="Expired"){
                                    $LabelStatusPembayaran='<span class="text-danger">Expired</span>';
                                }else{
                                    $LabelStatusPembayaran='<small class="text-dark">'.$status_pembayaran.'</small>';
                                }
                            }
                        }
                        echo '<li class="list-group-item d-flex justify-content-between align-items-start">';
                        echo '  <div class="ms-2 me-auto">';
                        echo '      <div class="fw-bold">'.$nama.'</div>';
                        echo '      <small>Kategori : '.$kategoriEvent.'</small><br>';
                        echo '      <small>Validasi : '.$LabelStatusValidasi.'</small><br>';
                        echo '      <small>Pembayaran : '.$LabelStatusPembayaran.'</small><br>';
                        echo '      <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailPeserta" data-id="'.$id_peserta.'">Selengkapnya</a>';
                        echo '  </div>';
                        echo '</li>';
                        $no++;
                        }
                    } 
            ?>
        </ol>
    </div>
</div>
<div class="row mb-4">
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
            <button class="btn btn-sm btn-outline-info" id="PrevPagePeserta" value="<?php echo $prev;?>">
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
                        echo '<button class="btn btn-sm btn-info" id="PageNumberPeserta'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                    }else{
                        echo '<button class="btn btn-sm btn-outline-info" id="PageNumberPeserta'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                    }
                }
            ?>
            <button class="btn btn-sm btn-outline-info" id="NextPagePeserta" value="<?php echo $next;?>">
                <span aria-hidden="true">»</span>
            </button>
        </div>
    </div>
</div>