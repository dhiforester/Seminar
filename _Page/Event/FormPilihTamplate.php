<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event'])){
        echo '<span class="text-danger">ID Event Tidak Boleh Kosong!</span>';
    }else{
        $id_event=$_POST['id_event'];
        //Buka data undangan
        $QryTamplate= mysqli_query($Conn,"SELECT * FROM event_tamplate WHERE id_event='$id_event'")or die(mysqli_error($Conn));
        $DataTamplate= mysqli_fetch_array($QryTamplate);
        if(!empty($DataTamplate['id_event_tamplate'])){
            $id_event_tamplate= $DataTamplate['id_event_tamplate'];
            $id_tamplate_event= $DataTamplate['id_tamplate'];
            $undangan= $DataTamplate['undangan'];
        }else{
            $id_event_tamplate="";
            $id_tamplate_event="";
            $undangan="";
        }
?>
    <input type="hidden" name="id_event" id="id_event" value="<?php echo "$id_event"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="id_tamplate">Tamplate Undangan</label>
            <select name="id_tamplate" id="id_tamplate" class="form-control">
                <option value="">Pilih</option>
                <?php
                    $query = mysqli_query($Conn, "SELECT*FROM tamplate ORDER BY nama_tamplate ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_tamplate= $data['id_tamplate'];
                        $nama_tamplate= $data['nama_tamplate'];
                        if($id_tamplate==$id_tamplate_event){
                            echo '<option selected value="'.$id_tamplate.'">'.$nama_tamplate.'</option>';
                        }else{
                            echo '<option value="'.$id_tamplate.'">'.$nama_tamplate.'</option>';
                        }
                    }
                ?>
            </select>
            <small>
                Untuk mengelola tamplate <a href="index.php?Page=SettingForm">Klik Disini</a>
            </small>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3" id="PreviewTamplate">
            <?php echo "$undangan"; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiSimpanTamplate">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>