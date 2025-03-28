<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(!empty($_POST['id_tamplate'])){
        $id_tamplate=$_POST['id_tamplate'];
        //Buka data event
        $QryTamplate= mysqli_query($Conn,"SELECT * FROM tamplate WHERE id_tamplate='$id_tamplate'")or die(mysqli_error($Conn));
        $DataTamplate= mysqli_fetch_array($QryTamplate);
        $id_akses= $DataTamplate['id_akses'];
        $nama_tamplate= $DataTamplate['nama_tamplate'];
        $kategori_tamplate= $DataTamplate['kategori_tamplate'];
        $deskripsi_tamplate= $DataTamplate['deskripsi_tamplate'];
        $form_tamplate= $DataTamplate['form_tamplate'];
        $updatetime= $DataTamplate['updatetime'];
        //Buka detail akses
        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
        if(!empty($DataDetailAkses['nama_akses'])){
            $nama_akses= $DataDetailAkses['nama_akses'];
        }else{
            $nama_akses="None";
        }
        
?>
    <div class="modal-body">
        <div class="row mt-2"> 
            <div class="col-md-12">
                <table class="">
                    <tbody>
                        <tr>
                            <td>
                                <small><dt>Nama/Judul</dt></small>
                            </td>
                            <td><b>:</b></td>
                            <td>
                                <small><?php echo $nama_tamplate; ?></small>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small><dt>Kategori</dt></small>
                            </td>
                            <td><b>:</b></td>
                            <td>
                                <small><?php echo $kategori_tamplate; ?></small>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small><dt>Deskripsi</dt></small>
                            </td>
                            <td><b>:</b></td>
                            <td>
                                <small><?php echo $deskripsi_tamplate; ?></small>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small><dt>Updatetime</dt></small>
                            </td>
                            <td><b>:</b></td>
                            <td>
                                <small><?php echo $updatetime; ?></small>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <small><dt>Author</dt></small>
                            </td>
                            <td><b>:</b></td>
                            <td>
                                <small><?php echo $nama_akses; ?></small>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <?php echo $form_tamplate; ?>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-info">
        <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Tutup
        </button>
    </div>
<?php } ?>