<?php
    //koneksi dan session
    ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    // include "../../_Config/Session.php";
    //GetIdMitra
    if(!empty($_POST['GetIdMitra'])){
        $GetIdMitra=$_POST['GetIdMitra'];
    }else{
        $GetIdMitra="";
    }
    //keyword
    if(!empty($_POST['PencarianPasien'])){
        $keyword=$_POST['PencarianPasien'];
    }else{
        $keyword="";
    }
    //batas
    if(!empty($_POST['JumlahDataPasien'])){
        $batas=$_POST['JumlahDataPasien'];
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
        $OrderBy="id_pasien";
    }
    //Atur Page
    if(!empty($_POST['page'])){
        $page=$_POST['page'];
        $posisi = ( $page - 1 ) * $batas;
    }else{
        $page="1";
        $posisi = 0;
    }
    if(empty($GetIdMitra)){
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM pasien"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM pasien WHERE nik like '%$keyword%' OR kk like '%$keyword%' OR nama_pasien like '%$keyword%' OR kontak_pasien like '%$keyword%' OR email_pasien like '%$keyword%' OR alamat_pasien like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM pasien WHERE id_mitra='$GetIdMitra'"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM pasien WHERE (id_mitra='$GetIdMitra') AND (nik like '%$keyword%' OR kk like '%$keyword%' OR nama_pasien like '%$keyword%' OR kontak_pasien like '%$keyword%' OR email_pasien like '%$keyword%' OR alamat_pasien like '%$keyword%')"));
        }
    }
?>
<script>
    //ketika klik next
    $('#NextPagePasien').click(function() {
        var valueNext=$('#NextPagePasien').val();
        var PencarianPasien = $('#PencarianPasien').val();
        var JumlahDataPasien = $('#JumlahDataPasien').val();
        var GetIdMitra = $('#GetIdMitra').val();
        $('#MenampilkanTabelPasien').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Transaksi/TabelPasien.php',
            data        : {page: valueNext, PencarianPasien: PencarianPasien, JumlahDataPasien: JumlahDataPasien,  GetIdMitra: GetIdMitra},
            success     : function(data){
                $('#MenampilkanTabelPasien').html(data);
            }
        });
    });
    //Ketika klik Previous
    $('#PrevPagePasien').click(function() {
        var ValuePrev = $('#PrevPagePasien').val();
        var PencarianPasien = $('#PencarianPasien').val();
        var JumlahDataPasien = $('#JumlahDataPasien').val();
        var GetIdMitra = $('#GetIdMitra').val();
        $('#MenampilkanTabelPasien').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Transaksi/TabelPasien.php',
            data        : {page: ValuePrev, PencarianPasien: PencarianPasien, JumlahDataPasien: JumlahDataPasien,  GetIdMitra: GetIdMitra},
            success     : function(data){
                $('#MenampilkanTabelPasien').html(data);
            }
        });
    });
    <?php 
        $JmlHalaman =ceil($jml_data/$batas); 
        $a=1;
        $b=$JmlHalaman;
        for ( $i =$a; $i<=$b; $i++ ){
    ?>
        //ketika klik page number
        $('#PageNumberPasien<?php echo $i;?>').click(function() {
            var PageNumber = $('#PageNumberPasien<?php echo $i;?>').val();
            var PencarianPasien = $('#PencarianPasien').val();
            var JumlahDataPasien = $('#JumlahDataPasien').val();
            var GetIdMitra = $('#GetIdMitra').val();
            $('#MenampilkanTabelPasien').html("Loading...");
            $.ajax({
                type 	    : 'POST',
                url 	    : '_Page/Transaksi/TabelPasien.php',
                data        : {page: PageNumber, PencarianPasien: PencarianPasien, JumlahDataPasien: JumlahDataPasien,  GetIdMitra: GetIdMitra},
                success     : function(data){
                    $('#MenampilkanTabelPasien').html(data);
                }
            });
        });
    <?php } ?>
</script>
<div class="card-body p-0">
    <div class="row mt-4">
        <div class="col-md-12 text-center p-0">
            <div class="table-responsive p-0">
                <table class="table table-hover table-bordered align-items-center mb-0">
                    <thead class="">
                        <tr>
                            <th class="text-center">
                                <b>No</b>
                            </th>
                            <th class="text-center">
                                <b>Pasien</b>
                            </th>
                            <th class="text-center">
                                <b>Mitra</b>
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
                                echo '  <td class="text-center text-danger" colspan="6">No Data</td>';
                                echo '</tr>';
                            }else{
                                $no = 1+$posisi;
                                //KONDISI PENGATURAN MASING FILTER
                                if(empty($GetIdMitra)){
                                    if(empty($keyword)){
                                        $query = mysqli_query($Conn, "SELECT*FROM pasien ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }else{
                                        $query = mysqli_query($Conn, "SELECT*FROM pasien WHERE nik like '%$keyword%' OR kk like '%$keyword%' OR nama_pasien like '%$keyword%' OR kontak_pasien like '%$keyword%' OR email_pasien like '%$keyword%' OR alamat_pasien like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }
                                }else{
                                    if(empty($keyword)){
                                        $query = mysqli_query($Conn, "SELECT*FROM pasien WHERE id_mitra='$GetIdMitra' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }else{
                                        $query = mysqli_query($Conn, "SELECT*FROM pasien WHERE (id_mitra='$GetIdMitra') AND (nik like '%$keyword%' OR kk like '%$keyword%' OR nama_pasien like '%$keyword%' OR kontak_pasien like '%$keyword%' OR email_pasien like '%$keyword%' OR alamat_pasien like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                    }
                                }
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_pasien= $data['id_pasien'];
                                    $id_akses= $data['id_akses'];
                                    $id_mitra= $data['id_mitra'];
                                    $id_wilayah= $data['id_wilayah'];
                                    $nik= $data['nik'];
                                    $kk= $data['kk'];
                                    $nama_pasien= $data['nama_pasien'];
                                    $kontak_pasien= $data['kontak_pasien'];
                                    $email_pasien= $data['email_pasien'];
                                    $alamat_pasien= $data['alamat_pasien'];
                                    $tempat_lahir= $data['tempat_lahir'];
                                    $tanggal_lahir= $data['tanggal_lahir'];
                                    $penanggungjawab= $data['penanggungjawab'];
                                    $kontak_darurat= $data['kontak_darurat'];
                                    $datetime_daftar= $data['datetime_daftar'];
                                    $datetime_update= $data['datetime_update'];
                                    date_default_timezone_set('Asia/Jakarta');
                                    $datetime_daftar=date('d F Y H:i', $datetime_daftar);
                                    $datetime_update=date('d F Y H:i', $datetime_update);
                                    //Inisiasi format tanggal lahir
                                    $tanggal_lahir=strtotime($tanggal_lahir);
                                    $tanggal_lahir=date('d F Y', $tanggal_lahir);
                                    //Buka Data Akses
                                    if(!empty($id_akses)){
                                        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                        $nama_akses= $DataDetailAkses['nama_akses'];
                                        $kontak_akses= $DataDetailAkses['kontak_akses'];
                                        $email_akses = $DataDetailAkses['email_akses'];
                                        $StatusAkses= $DataDetailAkses['status'];
                                    }else{
                                        $nama_akses="<i class='text-danger'>None</i>";
                                        $kontak_akses= "<i class='text-danger'>None</i>";
                                        $email_akses = "<i class='text-danger'>None</i>";
                                        $StatusAkses= "<i class='text-danger'>None</i>";
                                    }
                                    if(!empty($id_mitra)){
                                        //Buka Data Partner
                                        $QryMitra = mysqli_query($Conn,"SELECT * FROM mitra WHERE id_mitra='$id_mitra'")or die(mysqli_error($Conn));
                                        $DataMitra = mysqli_fetch_array($QryMitra);
                                        $nama_mitra= $DataMitra['nama_mitra'];
                                        $kontak_mitra= $DataMitra['kontak_mitra'];
                                        $email_mitra= $DataMitra['email_mitra'];
                                        $status_mitra= $DataMitra['status_mitra'];
                                    }else{
                                        $nama_mitra="None";
                                        $kontak_mitra="None";
                                        $email_mitra="None";
                                        $status_mitra="None";
                                    }
                        ?>
                            <tr>
                                <td class="text-center text-xs">
                                    <?php echo "<small>$no</small>" ?>
                                </td>
                                <td class="text-left" align="left">
                                    <small class="credit">
                                        <b><?php echo "$nama_pasien ($id_pasien)";?></b>
                                        <br>
                                        <?php 
                                            echo "$tempat_lahir, $tanggal_lahir<br>";
                                        ?>
                                    </small>
                                </td>
                                <td class="text-left" align="left">
                                    <small class="credit">
                                        <?php 
                                            echo '<b>'.$nama_mitra.'</b><br>';
                                            echo "<small>$email_mitra</small>";
                                        ?>
                                    </small>
                                </td>
                                <td align="center">
                                    <button type="button" class="btn btn-info btn-sm btn-floating" data-bs-toggle="modal" data-bs-target="#ModalPilihKunjungan" data-id="<?php echo "$id_pasien"; ?>">
                                        <i class="bi bi-check"></i>
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
        <button class="btn btn-sm btn-outline-info" id="PrevPagePasien" value="<?php echo $prev;?>">
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
                    echo '<button class="btn btn-sm btn-info" id="PageNumberPasien'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                }else{
                    echo '<button class="btn btn-sm btn-outline-info" id="PageNumberPasien'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                }
            }
        ?>
        <button class="btn btn-sm btn-outline-info" id="NextPagePasien" value="<?php echo $next;?>">
            <span aria-hidden="true">»</span>
        </button>
    </div>
</div>