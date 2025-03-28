<?php
    //koneksi dan session
    ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //id_setting_event
    if(empty($_POST['id_setting_event'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      Silahkan Pilih Event Terlebih Dulu';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_event_setting=$_POST['id_setting_event'];
        //Buka Nama Event
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $nama_event= $DataEvent['nama_event'];
        //Hitung Jumlah Data
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_sertifikat WHERE id_event_setting='$id_event_setting' AND kategori_sertifikat='Sponsor'"));
?>
    <input type="hidden" name="PutIdEvent" value="<?php echo "$id_event_setting"; ?>">
    <input type="hidden" name="kategori_sertifikat" value="Lainnya">
    <div class="row">
        <div class="col-md-12 text-center mb-3">
            <span><?php echo "Daftar Partisipan Lainnya <br><code class='text-primary'>$nama_event</code>";?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center mb-3">
            <button type="button" class="btn btn-sm btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#ModalTambahSponsor" data-id="<?php echo "$id_event_setting"; ?>">
                <i class="bi bi-plus"></i> Tambah Partisipan
            </button>
        </div>
    </div>
    <div class="row">
        <?php
            if(empty($jml_data)){
                echo '<div class="col-md-12 text-center">';
                echo '  <div class="text-danger">Tidak Ada Data Yang Ditampilan!</div>';
                echo '</div>';
            }else{
                echo '<div class="col-md-12">';
                echo '  <ol class="list-group list-group-numbered">';
                $no = 1;
                //KONDISI PENGATURAN MASING FILTER
                $query = mysqli_query($Conn, "SELECT*FROM event_sertifikat WHERE id_event_setting='$id_event_setting' AND kategori_sertifikat='Sponsor' ORDER BY nama ASC");
                while ($data = mysqli_fetch_array($query)) {
                    $id_event_sertifikat= $data['id_event_sertifikat'];
                    $nama= $data['nama'];
                    if(empty($data['token'])){
                        $token="";
                        $group_name="";
                        $LabelToken='<code>Belum Ada</code>';
                    }else{
                        $token=$data['token'];
                        $group_name=$data['group_name'];
                        $LabelToken='<a href="SertifikatPdf.php?Token='.$token.'" target="_blank"><code class="text-success">'.$token.'</code></a>';
                    }
        ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><?php echo "$nama"; ?></div>
                    <small>
                        <?php echo "$LabelToken<br>$group_name"; ?>
                    </small>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#ModalEditSponsor" data-id="<?php echo "$id_event_sertifikat"; ?>">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#ModalHapusSponsor" data-id="<?php echo "$id_event_sertifikat"; ?>">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </li>
        <?php
                $no++; }
                echo '  </ol>';
                echo '</div>';
            } 
        ?>
    </div>
<?php } ?>