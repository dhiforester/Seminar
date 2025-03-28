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
    //Grouping
    if(empty($_POST['Grouping'])){
        $Grouping="";
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_kupon WHERE id_event_setting='$id_event_setting'"));
    }else{
        $Grouping=$_POST['Grouping'];
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_kupon WHERE id_event_setting='$id_event_setting' AND id_event_kategori='$Grouping'"));
    }
    
?>
<script>
    //ketika klik next
    $('#NextPageKupon').click(function() {
        var valueNextKupon=$('#NextPageKupon').val();
        var id_event_setting="<?php echo "$id_event_setting"; ?>";
        var Grouping="<?php echo "$Grouping"; ?>";
        $.ajax({
            url     : "_Page/Event/SubPageKuponDiskon.php",
            method  : "POST",
            data 	:  { page: valueNextKupon, id_event_setting: id_event_setting, Grouping: Grouping },
            success: function (data) {
                $('#flush-collapse6').html(data);

            }
        })
    });
    //Ketika klik Previous
    $('#PrevPageKupon').click(function() {
        var ValuePrevKupon = $('#PrevPageKupon').val();
        var id_event_setting="<?php echo "$id_event_setting"; ?>";
        var Grouping="<?php echo "$Grouping"; ?>";
        $.ajax({
            url     : "_Page/Event/SubPageKuponDiskon.php",
            method  : "POST",
            data 	:  { page: ValuePrevKupon, id_event_setting: id_event_setting, Grouping: Grouping },
            success : function (data) {
                $('#flush-collapse6').html(data);
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
        $('#PageNumberKupon<?php echo $i;?>').click(function() {
            var PageNumberKupon = $('#PageNumberKupon<?php echo $i;?>').val();
            var id_event_setting="<?php echo "$id_event_setting"; ?>";
            var Grouping="<?php echo "$Grouping"; ?>";
            $.ajax({
                url     : "_Page/Event/SubPageKuponDiskon.php",
                method  : "POST",
                data 	:  { page: PageNumberKupon, id_event_setting: id_event_setting, Grouping: Grouping },
                success: function (data) {
                    $('#flush-collapse6').html(data);
                }
            })
        });
    <?php } ?>
    //ketika Grouping Dipilih
    $('#GroupKategoriEvent').change(function() {
        var id_event_setting="<?php echo "$id_event_setting"; ?>";
        var Grouping=$('#GroupKategoriEvent').val();
        $.ajax({
            url     : "_Page/Event/SubPageKuponDiskon.php",
            method  : "POST",
            data 	:  { id_event_setting: id_event_setting, Grouping: Grouping },
            success: function (data) {
                $('#flush-collapse6').html(data);
            }
        })
    });
</script>
<div class="row mb-4 mt-4">
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-sm btn-primary btn-rounded btn-block mb-2" data-bs-toggle="modal" data-bs-target="#ModalTambahKuponMultiple" data-id="<?php echo $id_event_setting; ?>">
            <i class="bi bi-layers"></i> Generate Kupon
        </button>
    </div>
</div>
<div class="row mb-4 mt-4">
    <div class="col-md-12">
        <select name="GroupKategoriEvent" id="GroupKategoriEvent" class="form-control">
            <option value="">Group Kategori</option>
            <?php
                $noKategori=1;
                $QryGroup = mysqli_query($Conn, "SELECT*FROM event_kategori WHERE id_event_setting='$id_event_setting' ORDER BY id_event_kategori DESC");
                while ($DataGroup = mysqli_fetch_array($QryGroup)) {
                    $IdEventKategoriGroup= $DataGroup['id_event_kategori'];
                    $KategoriGroup= $DataGroup['kategori'];
                    //Menghitung jumlah kupon
                    $SemuaJumlahKupon = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_kupon WHERE id_event_kategori='$IdEventKategoriGroup'"));
                    $JumlahKuponDigunakan = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_kupon WHERE id_event_kategori='$IdEventKategoriGroup' AND status='Sudah Digunakan'"));
                    echo '<option value="'.$IdEventKategoriGroup.'">'.$noKategori.'. '.$KategoriGroup.' ('.$SemuaJumlahKupon.'/'.$JumlahKuponDigunakan.')</option>';
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
                    echo '  Belum Ada Data Kupon';
                    echo '</div>';
                }else{
                    $no = 1+$posisi;
                    //KONDISI PENGATURAN MASING FILTER
                    if(empty($_POST['Grouping'])){
                        $Grouping="";
                        $query = mysqli_query($Conn, "SELECT*FROM event_kupon WHERE id_event_setting='$id_event_setting' ORDER BY id_kupon DESC LIMIT $posisi, $batas");
                    }else{
                        $Grouping=$_POST['Grouping'];
                        $query = mysqli_query($Conn, "SELECT*FROM event_kupon WHERE id_event_setting='$id_event_setting' AND id_event_kategori='$Grouping' ORDER BY id_kupon DESC LIMIT $posisi, $batas");
                    }
                    while ($data = mysqli_fetch_array($query)) {
                        $id_kupon= $data['id_kupon'];
                        $id_event_kategori= $data['id_event_kategori'];
                        $kode_kupon= $data['kode_kupon'];
                        $diskon= $data['diskon'];
                        $status= $data['status'];
                        if($status=="Belum Digunakan"){
                            $LabelStatusKupon='<code class="text-success">Belum Digunakan</code>';
                        }else{
                            $LabelStatusKupon='<code class="text-danger">Sudah Digunakan</code>';
                        }
                        //Buka Kategori
                        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
                        $DataEvent= mysqli_fetch_array($QryEvent);
                        $kategoriEvent= $DataEvent['kategori'];
                        echo '<li class="list-group-item d-flex justify-content-between align-items-start">';
                        echo '  <div class="ms-2 me-auto">';
                        echo '      <div class="fw-bold">'.$kode_kupon.'</div>';
                        echo '      <small>Kategori : '.$kategoriEvent.'</small><br>';
                        echo '      <small>Status : '.$LabelStatusKupon.'</small><br>';
                        echo '      <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailKupon" data-id="'.$id_kupon.'">Selengkapnya</a>';
                        echo '  </div>';
                        echo '  <span class="badge bg-warning rounded-pill">'.$diskon.' %</span>';
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
            <button class="btn btn-sm btn-outline-info" id="PrevPageKupon" value="<?php echo $prev;?>">
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
                        echo '<button class="btn btn-sm btn-info" id="PageNumberKupon'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                    }else{
                        echo '<button class="btn btn-sm btn-outline-info" id="PageNumberKupon'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                    }
                }
            ?>
            <button class="btn btn-sm btn-outline-info" id="NextPageKupon" value="<?php echo $next;?>">
                <span aria-hidden="true">»</span>
            </button>
        </div>
    </div>
</div>