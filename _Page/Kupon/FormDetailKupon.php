<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_kupon'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center">';
        echo '      ID Kupon Tidak Boleh Kosong!';
        echo '  <div>';
        echo '</div>';
    }else{
        $id_kupon=$_POST['id_kupon'];
        //Buka detail Kupon
        $QryKupon = mysqli_query($Conn,"SELECT * FROM event_kupon WHERE id_kupon='$id_kupon'")or die(mysqli_error($Conn));
        $DataKupon = mysqli_fetch_array($QryKupon);
        $id_event_setting= $DataKupon['id_event_setting'];
        $id_event_kategori= $DataKupon['id_event_kategori'];
        $kode_kupon= $DataKupon['kode_kupon'];
        $diskon= $DataKupon['diskon'];
        $status= $DataKupon['status'];
        //Buka Event
        $QryEvent1= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
        $DataEvent1= mysqli_fetch_array($QryEvent1);
        $nama_event= $DataEvent1['nama_event'];
        //Buka Kategori
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $kategoriEvent= $DataEvent['kategori'];
?>  
    <div class="row mb-3">
        <div class="col-md-4">Nama Event</div>
        <div class="col-md-8"><?php echo "<code class='text-dark'>$nama_event</code>"; ?></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">Kategori Event</div>
        <div class="col-md-8"><?php echo "<code class='text-dark'>$kategoriEvent</code>"; ?></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">Kode</div>
        <div class="col-md-8"><?php echo "<code class='text-info'>$kode_kupon</code>"; ?></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">Diskon</div>
        <div class="col-md-8"><?php echo "<code class='text-dark'>$diskon %</code>"; ?></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">Status</div>
        <div class="col-md-8"><?php echo "<code class='text-dark'>$status</code>"; ?></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <a href="index.php?Page=Kupon&Sub=DetailKupon&id_kupon=<?php echo "$id_kupon"; ?>" class="btn btn-md btn-outline-dark btn-rounded" title="Lihat Informasi Selengkapnya">
                <i class="bi bi-three-dots"></i> Selengkapnya
            </a>
            <button type="button" class="btn btn-md btn-outline-dark btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalHapusKupon" data-id="<?php echo $id_kupon; ?>" title="Hapus Kupon">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </div>
    </div>
<?php } ?>