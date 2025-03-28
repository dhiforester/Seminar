<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(!empty($_POST['id_event_setting'])){
        $id_event_setting=$_POST['id_event_setting'];
        //Buka data event
        $QryEvent= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
        $DataEvent= mysqli_fetch_array($QryEvent);
        $tanggal_mulai= $DataEvent['tanggal_mulai'];
        $tanggal_selesai= $DataEvent['tanggal_selesai'];
        $mulai_pendaftaran= $DataEvent['mulai_pendaftaran'];
        $selesai_pendaftaran= $DataEvent['selesai_pendaftaran'];
        $nama_event= $DataEvent['nama_event'];
        $keterangan= $DataEvent['keterangan'];
        $status= $DataEvent['status'];
        //Routing Status
        if($status=="Rencana"){
            $LabelStatus='<span class="badge badge-danger">Rencana</span>';
        }else{
            if($status=="Berlangsung"){
                $LabelStatus='<span class="badge badge-warning">Berlangsung</span>';
            }else{
                if($status=="Selesai"){
                    $LabelStatus='<span class="badge badge-success">Selesai</span>';
                }else{
                    $LabelStatus='<span class="badge badge-dark">None</span>';
                }
            }
        }
        //strtotime
        $strtotime1=strtotime($tanggal_mulai);
        $strtotime2=strtotime($tanggal_selesai);
        $strtotime3=strtotime($mulai_pendaftaran);
        $strtotime4=strtotime($selesai_pendaftaran);
        //Formated
        $TanggalMulai=date('d/m/Y H:i',$strtotime1);
        $TanggalSelesai=date('d/m/Y H:i',$strtotime2);
        $MulaiPendaftaran=date('d/m/Y H:i',$strtotime3);
        $SelesaiPendaftaran=date('d/m/Y H:i',$strtotime4);
        //Type Event
        $JumlahKategori = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_kategori WHERE id_event_setting='$id_event_setting'"));
        if(empty($JumlahKategori)){
            $LabelJumlahKategori='<span class="badge badge-danger">Belum Ada</span>';
        }else{
            $LabelJumlahKategori='<span class="badge badge-success">'.$JumlahKategori.' Record</span>';
        }
        //Peserta Event
        $JumlahPeserta = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE id_event_setting='$id_event_setting'"));
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
                    <li> Nama Event : <code><?php echo "$nama_event"; ?></code></li>
                    <li> Tanggal Mulai : <code><?php echo "$TanggalMulai"; ?></code></li>
                    <li> Tanggal Selesai : <code><?php echo "$TanggalSelesai"; ?></code></li>
                    <li> Mulai Pendaftaran : <code><?php echo "$MulaiPendaftaran"; ?></code></li>
                    <li> Selesai Pendaftaran : <code><?php echo "$SelesaiPendaftaran"; ?></code></li>
                    <li> Status : <code><?php echo "$LabelStatus"; ?></code></li>
                    <li> Type : <code><?php echo "$LabelJumlahKategori"; ?></code></li>
                    <li> Peserta : <code><?php echo "$LabelJumlahPeserta"; ?></code></li>
                    <li> Keterangan : <code><?php echo "$keterangan"; ?></code></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-info">
        <a href="index.php?Page=Event&Sub=DetailEvent&id_event_setting=<?php echo $id_event_setting;?>" class="btn btn-success btn-rounded">
            <i class="bi bi-three-dots"></i> Selengkapnya
        </a>
        <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Tutup
        </button>
    </div>
<?php } ?>