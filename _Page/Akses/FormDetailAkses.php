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
        //Buka data askes
        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
        $nama_akses= $DataDetailAkses['nama_akses'];
        $kontak_akses= $DataDetailAkses['kontak_akses'];
        $email_akses = $DataDetailAkses['email_akses'];
        $password= $DataDetailAkses['password'];
        $Akses= $DataDetailAkses['akses'];
        $gambar= $DataDetailAkses['image_akses'];
        if(empty($gambar)){
            $gambar="No-Image.png";
        }else{
            $gambar="$gambar";
        }
        $akses= $DataDetailAkses['akses'];
        $status= $DataDetailAkses['status'];
        $datetime_daftar= $DataDetailAkses['datetime_daftar'];
        $datetime_update= $DataDetailAkses['datetime_update'];
        $registration=$datetime_daftar;
        $updatetime=$datetime_update;
?>
<div class="modal-body">
    <div class="row mt-2"> 
        <div class="col-md-12 text-center">
            <img src="assets/img/User/<?php echo "$gambar"; ?>" alt="" width="80px" height="80px" class="rounded-circle">
        </div>
        <div class="col-md-12 mt-2 text-center">
            Nama : <code><?php echo "$nama_akses"; ?></code><br>
            Kontak : <code><?php echo "$kontak_akses"; ?></code><br>
            Email : <code><?php echo "$email_akses"; ?></code><br>
            Akses : <code><?php echo "$Akses"; ?></code><br>
            Status : <code><?php echo "$status"; ?></code><br>
            Updatetime : <code><?php echo "$updatetime"; ?></code><br>
        </div>
    </div>
</div>
<div class="modal-footer bg-info">
    <!-- <a href="index.php?Page=Akses&Sub=DetailAkses&id_akses=<?php echo $id_akses;?>" class="btn btn-success btn-rounded">
        <i class="bi bi-three-dots"></i> Selengkapnya
    </a> -->
    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
        <i class="bi bi-x-circle"></i> Tutup
    </button>
</div>
<?php } ?>