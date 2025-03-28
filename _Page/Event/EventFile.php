<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['GetIdEvent'])){
        echo '<div class="card">';
        echo '  <div class="card-body">';
        echo '      <div class="row">';
        echo '          <div class="col-md-12">';
        echo '              <span class="text-danger">ID Event Tidak Boleh Kosong!!</span>';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_event=$_POST['GetIdEvent'];
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event WHERE id_event='$id_event'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $id_akses= $DataEvent['id_akses'];
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_file WHERE id_event='$id_event'"));
?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <b class="card-title">File Kegiatan</b>
                </div>
                <div class="col-md-2">
                    <?php if($id_akses==$SessionIdAkses){ ?>
                        <button type="button" class="btn btn-md btn-primary w-100" data-bs-toggle="modal" data-bs-target="#ModalTambahFile" data-id="<?php echo "$id_event"; ?>">
                            <i class="bi bi-plus-circle"></i> Tambah
                        </button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"><b>No</b></th>
                                <th class="text-center"><b>Kategori</b></th>
                                <th class="text-center"><b>Judul File</b></th>
                                <th class="text-center"><b>Deskripsi</b></th>
                                <th class="text-center"><b>Tanggal</b></th>
                                <th class="text-center"><b>Opt</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(empty($jml_data)){
                                    echo '<tr>';
                                    echo '  <td class="text-center" colspan="6"><small class="text-danger">Belum Ada Data File</small></td>';
                                    echo '</tr>';
                                }else{
                                    $no=1;
                                    $QryFile = mysqli_query($Conn, "SELECT*FROM event_file WHERE id_event='$id_event' ORDER BY title_file ASC");
                                    while ($DataFile = mysqli_fetch_array($QryFile)) {
                                        $id_event_file= $DataFile['id_event_file'];
                                        $title_file= $DataFile['title_file'];
                                        $kategori= $DataFile['kategori'];
                                        $deskripsi= $DataFile['deskripsi'];
                                        $file_type= $DataFile['file_type'];
                                        $file_size= $DataFile['file_size'];
                                        $file_name= $DataFile['file_name'];
                                        $tanggal= $DataFile['tanggal'];
                            ?>
                                <tr>
                                    <td align="center"><?php echo "$no"; ?></td>
                                    <td class="text-left"><?php echo "$kategori"; ?></td>
                                    <td class="text-left">
                                        <?php 
                                            if($kategori=="URL/Link"){
                                                echo "<a href='$file_name'>$title_file</a>"; 
                                            }else{
                                                echo "<a href='assets/img/Dokumen/$file_name'>$title_file</a>"; 
                                            }
                                        ?>
                                    </td>
                                    <td class="text-left">
                                        <?php echo "$deskripsi"; ?><br>
                                        <small>
                                            <?php 
                                                if($kategori!=="URL/Link"){
                                                    echo "Type: $file_type <br>"; 
                                                    echo "Size: $file_size kb";
                                                }
                                            ?>
                                        </small>
                                    </td>
                                    <td class="text-left"><?php echo "$tanggal"; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <?php if($id_akses==$SessionIdAkses){ ?>
                                                <button type="button" class="btn btn-sm btn-success" title="Edit File Kegiatan" data-bs-toggle="modal" data-bs-target="#ModalEditFile" data-id="<?php echo "$id_event_file"; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" title="Hapus File Kegiatan" data-bs-toggle="modal" data-bs-target="#ModalHapusFile" data-id="<?php echo "$id_event_file"; ?>">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php $no++;}} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <b>Jumlah Filesi :</b><?php echo "$jml_data"; ?>
        </div>
    </div>
<?php } ?>