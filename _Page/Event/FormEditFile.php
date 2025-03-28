<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_event_file'])){
        echo '<span class="text-danger">ID Event Tidak Boleh Kosong!</span>';
    }else{
        $id_event_file=$_POST['id_event_file'];
        //Buka detail akses
        $QryFile = mysqli_query($Conn,"SELECT * FROM event_file WHERE id_event_file='$id_event_file'")or die(mysqli_error($Conn));
        $DataFile = mysqli_fetch_array($QryFile);
        $kategori= $DataFile['kategori'];
        $title_file= $DataFile['title_file'];
        $deskripsi= $DataFile['deskripsi'];
        $file_name= $DataFile['file_name'];
        $tanggal= $DataFile['tanggal'];
?>  
    <input type="hidden" name="id_event_file" id="id_event_file" value="<?php echo "$id_event_file"; ?>">
    <input type="hidden" name="kategori" id="kategori" value="<?php echo "$kategori"; ?>">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="title_file">Judul/Title File</label>
            <input type="text" name="title_file" id="title_file" class="form-control" value="<?php echo "$title_file"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control"><?php echo "$deskripsi"; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <?php
                if($kategori=="URL/Link"){
                    echo '<label for="file_name"></label>';
                    echo '<input type="url" name="file_name" id="file_name" class="form-control" placeholder="https://" value="'.$file_name.'">';
                    echo '';
                }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditFile">
            <small class="text-primary">Pastkan data yang anda input sudah benar</small>
        </div>
    </div>
<?php } ?>