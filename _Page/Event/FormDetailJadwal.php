<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(!empty($_POST['id_event_jadwal'])){
        $id_event_jadwal=$_POST['id_event_jadwal'];
        //Buka data jadwal Acara
        $QryJadwal= mysqli_query($Conn,"SELECT * FROM event_jadwal WHERE id_event_jadwal='$id_event_jadwal'")or die(mysqli_error($Conn));
        $DataJadwal= mysqli_fetch_array($QryJadwal);
        $id_event_setting= $DataJadwal['id_event_setting'];
        $tanggal= $DataJadwal['tanggal'];
        $waktu1= $DataJadwal['waktu1'];
        $waktu2= $DataJadwal['waktu2'];
        $keterangan= $DataJadwal['keterangan'];
        $pengisi_acara= $DataJadwal['pengisi_acara'];
?>
    <div class="row mt-2"> 
        <div class="col-md-12">
            <ul>
                <li>ID.Jadwal : <code><?php echo "$id_event_setting"; ?></code></li>
                <li>Tanggal : <code><?php echo "$tanggal"; ?></code></li>
                <li>Waktu : <code><?php echo "$waktu1-$waktu2"; ?></code></li>
                <li>Keterangan : <code><?php echo "$keterangan"; ?></code></li>
                <li>Pengisi Acara : <code><?php echo "$pengisi_acara"; ?></code></li>
            </ul>
        </div>
    </div>
    <div class="row mt-2"> 
        <div class="col-md-6 mb-3">
            <button type="button" class="btn btn-outline-dark btn-rounded btn-block" title="Edit Jadwal Acara" data-bs-toggle="modal" data-bs-target="#ModalEditJadwal" data-id="<?php echo "$id_event_jadwal"; ?>">
                <i class="bi bi-pencil-square"></i> Edit
            </button> 
        </div>
        <div class="col-md-6 mb-3">
            <button type="button" class="btn btn-outline-dark btn-rounded btn-block" title="Hapus Jadwal Acara" data-bs-toggle="modal" data-bs-target="#ModalHapusJadwal" data-id="<?php echo "$id_event_jadwal"; ?>">
                <i class="bi bi-trash"></i> Hapus
            </button> 
        </div>
    </div>
<?php } ?>