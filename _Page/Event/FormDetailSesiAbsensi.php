<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(!empty($_POST['id_event_sesi_absen'])){
        $id_event_sesi_absen=$_POST['id_event_sesi_absen'];
        //Buka data sesi absensi
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_sesi_absen WHERE id_event_sesi_absen='$id_event_sesi_absen'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $id_event_sesi_absen= $DataEvent['id_event_sesi_absen'];
        $label_sesi= $DataEvent['label_sesi'];
        $tanggal_mulai= $DataEvent['tanggal_mulai'];
        $tanggal_selesai= $DataEvent['tanggal_selesai'];
        $tanggal_mulai=strtotime($tanggal_mulai);
        $tanggal_selesai=strtotime($tanggal_selesai);
        //Karena memiliki format strtotime tinggal ubah
        $TanggalMulai=date('d/m/Y H:i T',$tanggal_mulai);
        $TanggalSelesai=date('d/m/Y H:i T',$tanggal_selesai);
        //Jumlah Peserta Yang Sudah Absen
        $JumlAhPesertaAbsen = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_absen WHERE id_event_sesi_absen='$id_event_sesi_absen'"));
        //Routing Status Sesi
        $TanggalSekarang=date('Y-m-d H:i');
        $TanggalSekarang=strtotime($TanggalSekarang);
        if($TanggalSekarang<$tanggal_mulai){
            $LabelStatusSesi='<span class="text-dark">Belum Dibuka</span>';
        }else{
            if($TanggalSekarang>$tanggal_selesai){
                $LabelStatusSesi='<span class="text-danger">Sudah Ditutup</span>';
            }else{
                if($TanggalSekarang<$tanggal_selesai&&$TanggalSekarang>$tanggal_mulai){
                    $LabelStatusSesi='<span class="text-success">Dibuka</span>';
                }else{
                    $LabelStatusSesi='<span class="text-info">None</span>';
                }
            }
        }
?>
    <div class="row mt-2"> 
        <div class="col-md-12">
            <ul>
                <li>ID.Sesi : <code><?php echo "$id_event_sesi_absen"; ?></code></li>
                <li>Nama/Label : <code><?php echo "$label_sesi"; ?></code></li>
                <li>Mulai : <code><?php echo "$TanggalMulai"; ?></code></li>
                <li>Selesai : <code><?php echo "$TanggalSelesai"; ?></code></li>
                <li>Peserta : <code><?php echo "$JumlAhPesertaAbsen Orang"; ?></code></li>
                <li>Status : <code><?php echo "$LabelStatusSesi"; ?></code></li>
            </ul>
        </div>
    </div>
    <div class="row mt-2"> 
        <div class="col-md-12 text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-dark btn" title="Edit Kategori/Tipe Peserta" data-bs-toggle="modal" data-bs-target="#ModalEditSesiAbsensi" data-id="<?php echo "$id_event_sesi_absen"; ?>">
                    <i class="bi bi-pencil-square"></i> Edit
                </button> 
                <button type="button" class="btn btn-outline-dark btn" title="Hapus Kategori/Tipe Peserta" data-bs-toggle="modal" data-bs-target="#ModalHapusSesiAbsensi" data-id="<?php echo "$id_event_sesi_absen"; ?>">
                    <i class="bi bi-trash"></i> Hapus
                </button> 
            </div>
        </div>
    </div>
<?php } ?>