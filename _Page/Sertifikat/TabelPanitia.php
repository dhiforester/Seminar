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
        //Hitung Jumlah Data Panitia
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_panitia WHERE id_event_setting='$id_event_setting'"));
?>
    <input type="hidden" name="PutIdEvent" value="<?php echo "$id_event_setting"; ?>">
    <input type="hidden" name="kategori_sertifikat" value="Panitia">
    <div class="row">
        <div class="col-md-12 text-center mb-3">
            <span><?php echo "Daftar Panitia <br><code class='text-primary'>$nama_event</code>";?></span>
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
                $query = mysqli_query($Conn, "SELECT*FROM event_panitia WHERE id_event_setting='$id_event_setting' ORDER BY id_event_panitia ASC");
                while ($data = mysqli_fetch_array($query)) {
                    $id_event_panitia= $data['id_event_panitia'];
                    $kategori= $data['kategori'];
                    $nama_panitia= $data['nama_panitia'];
                    $email= $data['email'];
                    $kontak= $data['kontak'];
                    $foto= $data['foto'];
                    //Buka Token Panitia
                    $QrySertifikat= mysqli_query($Conn,"SELECT * FROM event_sertifikat WHERE id_person='$id_event_panitia' AND kategori_sertifikat='Panitia'")or die(mysqli_error($Conn));
                    $DataSertifikat= mysqli_fetch_array($QrySertifikat);
                    if(empty($DataSertifikat['token'])){
                        $token="";
                        $group_name="";
                        $LabelToken='<code>Belum Ada</code>';
                    }else{
                        $token=$DataSertifikat['token'];
                        $group_name=$DataSertifikat['group_name'];
                        $LabelToken='<a href="SertifikatPdf.php?Token='.$token.'" target="_blank"><code class="text-success">'.$token.'</code></a>';
                    }
        ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <label for="CheckBoxPanitia<?php echo $id_event_panitia;?>">
                        <div class="fw-bold"><?php echo "$nama_panitia"; ?></div>
                        <small>
                            <?php echo "$LabelToken<br>$group_name"; ?>
                        </small>
                    </label>
                </div>
                <input class="form-check-input me-1" type="checkbox" value="<?php echo $id_event_panitia;?>" id="CheckBoxPanitia<?php echo $id_event_panitia;?>" name="CheckIdPerson[]">
            </li>
        <?php
                $no++; }
                echo '  </ol>';
                echo '</div>';
            } 
        ?>
        <div class="col-md-12 mb-3">
            <small id="NotifikasiGenerateTokenPanitia">
                <code class="text-primary">Silahkan checklist data panitia yang akan dibuatkan token sertifikatnya.</code>
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
    </div>
<?php } ?>