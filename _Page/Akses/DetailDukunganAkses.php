<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_akses
    if(empty($_POST['id_akses'])){
        echo '<div class="modal-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3">';
        echo '          ID Akses Tidak Ditemukan.';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo ' <div class="modal-footer bg-info">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3">';
        echo '          <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">';
        echo '              <i class="bi bi-x-circle"></i> Tutup';
        echo '          </button>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_akses=$_POST['id_akses'];
        $batas="10";
        $ShortBy="DESC";
        $NextShort="ASC";
        $OrderBy="id_dukungan";
        if(!empty($_POST['page'])){
            $page=$_POST['page'];
            $posisi = ( $page - 1 ) * $batas;
        }else{
            $page="1";
            $posisi = 0;
        }
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dukungan WHERE id_akses='$id_akses'"));
?>
<script>
    //ketika klik next
    $('#NextPage').click(function() {
        var valueNext=$('#NextPage').val();
        var id_akses=<?php echo $id_akses; ?>;
        $.ajax({
            url     : "_Page/Akses/DetailDukunganAkses.php",
            method  : "POST",
            data 	:  { page: valueNext, id_akses: id_akses},
            success: function (data) {
                $('#DetailDukunganAkses').html(data);

            }
        })
    });
    //Ketika klik Previous
    $('#PrevPage').click(function() {
        var ValuePrev = $('#PrevPage').val();
        var id_akses=<?php echo $id_akses; ?>;
        $.ajax({
            url     : "_Page/Akses/DetailDukunganAkses.php",
            method  : "POST",
            data 	:  { page: ValuePrev, id_akses: id_akses},
            success : function (data) {
                $('#DetailDukunganAkses').html(data);
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
            var id_akses=<?php echo $id_akses; ?>;
            $.ajax({
                url     : "_Page/Akses/DetailDukunganAkses.php",
                method  : "POST",
                data 	:  { page: PageNumber, id_akses: id_akses },
                success: function (data) {
                    $('#DetailDukunganAkses').html(data);
                }
            })
        });
    <?php } ?>
</script>
<div class="modal-body">
    <div class="row mt-2"> 
        <div class="col-md-12 table table-responsive">
            <table class="table table-hover table-bordered align-items-center mb-0">
                <thead class="">
                    <tr>
                        <th class="text-center">
                            <b>No</b>
                        </th>
                        <th class="text-center">
                            <b>Tanggal/Jam</b>
                        </th>
                        <th class="text-center">
                            <b>Kategori</b>
                        </th>
                        <th class="text-center">
                            <b>Dukungan</b>
                        </th>
                        <th class="text-center">
                            <b>Pemohon</b>
                        </th>
                        <th class="text-center">
                            <b>Unit/Tujuan</b>
                        </th>
                        <th class="text-center">
                            <b>Status</b>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(empty($jml_data)){
                            echo '<tr>';
                            echo '  <td colspan="5">';
                            echo '      <span class="text-danger">Belum Ada Data Dukungan Yang Bisa Ditampilkan</span>';
                            echo '  </td>';
                            echo '</tr>';
                        }else{
                            $no = 1+$posisi;
                            //KONDISI PENGATURAN MASING FILTER
                            $query = mysqli_query($Conn, "SELECT*FROM dukungan WHERE id_akses='$id_akses' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                            while ($data = mysqli_fetch_array($query)) {
                                $id_dukungan= $data['id_dukungan'];
                                $id_akses= $data['id_akses'];
                                $id_unit_kerja= $data['id_unit_kerja'];
                                if(empty($data['tanggal_request'])){
                                    $tanggal_request="";
                                }else{
                                    $tanggal_request= $data['tanggal_request'];
                                    $tanggal_request= strtotime($tanggal_request);
                                    $tanggal_request= date('d/m/Y H:i', $tanggal_request);
                                }
                                if(empty($data['tanggal_response'])){
                                    $tanggal_response="";
                                }else{
                                    $tanggal_response= $data['tanggal_response'];
                                }
                                if(empty($data['tanggal_selesai'])){
                                    $tanggal_selesai="";
                                }else{
                                    $tanggal_selesai= $data['tanggal_selesai'];
                                }
                                $judul_dukungan= $data['judul_dukungan'];
                                $kategori_dukungan= $data['kategori_dukungan'];
                                $keterangan_dukungan= $data['keterangan_dukungan'];
                                $status_dukungan= $data['status_dukungan'];
                                //Buka detail akses
                                $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                $nama_akses= $DataDetailAkses['nama_akses'];
                                //Buka unit tujuan
                                $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                                $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                                $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                                if($status_dukungan=="Request"){
                                    $LabelStatus='<span class="badge badge-danger">Rqst</span>';
                                }else{
                                    if($status_dukungan=="Response"){
                                        $LabelStatus='<span class="badge badge-warning">Rsps</span>';
                                    }else{
                                        if($status_dukungan=="Done"){
                                            $LabelStatus='<span class="badge badge-success">Done</span>';
                                        }else{
                                            $LabelStatus='<span class="badge badge-dark">None</span>';
                                        }
                                    }
                                }
                            ?>
                        <tr>
                            <td class="text-center text-xs">
                                <?php echo "$no" ?>
                            </td>
                            <td class="text-left" align="left">
                                <small><?php echo "$tanggal_request";?></small>
                            </td>
                            <td class="text-left" align="left">
                                <small><?php echo "$kategori_dukungan";?></small>
                            </td>
                            <td class="text-left" align="left">
                                <small><?php echo "$judul_dukungan";?></small>
                            </td>
                            <td class="text-left" align="left">
                                <small><?php echo "$nama_akses";?></small><br>
                            </td>
                            <td class="text-left" align="left">
                                <small><?php echo "$nama_unit_kerja";?></small><br>
                            </td>
                            <td class="text-left" align="left">
                                <?php echo "$LabelStatus";?>
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
<div class="modal-footer">
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