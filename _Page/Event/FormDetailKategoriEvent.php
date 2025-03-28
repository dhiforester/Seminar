<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(!empty($_POST['id_event_kategori'])){
        $id_event_kategori=$_POST['id_event_kategori'];
        //Buka data event
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_kategori WHERE id_event_kategori='$id_event_kategori'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $id_event_kategori= $DataEvent['id_event_kategori'];
        $kategori= $DataEvent['kategori'];
        $KeteranganKategori= $DataEvent['keterangan'];
        $harga_tiket= $DataEvent['harga_tiket'];
        $biaya_adm= $DataEvent['biaya_adm'];
        $kuota= $DataEvent['kuota'];
        $format_rupiah = "Rp. " . number_format($harga_tiket, 0, ',', '.');
        $format_biaya_adm = "Rp. " . number_format($biaya_adm, 0, ',', '.');
        //Peserta Event
        $JumlahPeserta = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE id_event_kategori='$id_event_kategori'"));
        if(empty($JumlahPeserta)){
            $LabelJumlahPeserta='<span class="badge badge-danger">Belum Ada</span>';
        }else{
            $LabelJumlahPeserta='<span class="badge badge-success">'.$JumlahPeserta.' Orang</span>';
        }
?>
    <div class="modal-body">
        <div class="row mt-2"> 
            <div class="col-md-12">
                <ul>
                    <li>ID.Kategori : <code><?php echo "$id_event_kategori"; ?></code></li>
                    <li>Nama Kategori : <code><?php echo "$kategori"; ?></code></li>
                    <li>Keterangan : <code><?php echo "$KeteranganKategori"; ?></code></li>
                    <li>Harga Tiket : <code><?php echo "$format_rupiah"; ?></code></li>
                    <li>Biaya Adm : <code><?php echo "$format_biaya_adm"; ?></code></li>
                    <li>Kuota : <code><?php echo "$kuota"; ?></code></li>
                    <li>Peserta : <code><?php echo "$LabelJumlahPeserta"; ?></code></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-info">
        <button type="button" class="btn btn-success btn-rounded" title="Edit Kategori/Tipe Peserta" data-bs-toggle="modal" data-bs-target="#ModalEditKategoriEvent" data-id="<?php echo "$id_event_kategori"; ?>">
            <i class="bi bi-pencil-square"></i> Edit
        </button> 
        <button type="button" class="btn btn-danger btn-rounded" title="Hapus Kategori/Tipe Peserta" data-bs-toggle="modal" data-bs-target="#ModalHapusKategoriEvent" data-id="<?php echo "$id_event_kategori"; ?>">
            <i class="bi bi-trash"></i> Hapus
        </button> 
        <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Tutup
        </button>
    </div>
<?php } ?>