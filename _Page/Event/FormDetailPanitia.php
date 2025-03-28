<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(!empty($_POST['id_event_panitia'])){
        $id_event_panitia=$_POST['id_event_panitia'];
        $nama_panitia=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_event_panitia,'nama_panitia');
        $kategori=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_event_panitia,'kategori');
        $email=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_event_panitia,'email');
        $kontak=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_event_panitia,'kontak');
        $foto=getDataDetail($Conn,'event_panitia','id_event_panitia',$id_event_panitia,'foto');
        if(empty($foto)){
            $foto="noimage.png";
        }
?>
    <div class="row mt-2"> 
        <div class="col-md-12 text-center">
            <img src="assets/img/Panitia/<?php echo "$foto"; ?>" alt="Foto Panitia" width="100px" height="100px" class="rounded rounded-circle">
        </div>
    </div>
    <div class="row mt-2"> 
        <div class="col-md-12">
            <ul>
                <li>ID.Panitia : <code><?php echo "$id_event_panitia"; ?></code></li>
                <li>Nama Panitia : <code><?php echo "$nama_panitia"; ?></code></li>
                <li>Kategori/Unit : <code><?php echo "$kategori"; ?></code></li>
                <li>Email : <code><?php echo "$email"; ?></code></li>
                <li>Kontak : <code><?php echo "$kontak"; ?></code></li>
            </ul>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-outline-dark btn-rounded" title="Edit Panitia" data-bs-toggle="modal" data-bs-target="#ModalEditPanitia" data-id="<?php echo "$id_event_panitia"; ?>">
                <i class="bi bi-pencil-square"></i> Edit
            </button> 
            <button type="button" class="btn btn-outline-dark btn-rounded" title="Hapus Panitia" data-bs-toggle="modal" data-bs-target="#ModalHapusPanitia" data-id="<?php echo "$id_event_panitia"; ?>">
                <i class="bi bi-trash"></i> Hapus
            </button> 
        </div>
    </div>
<?php } ?>