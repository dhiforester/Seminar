<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_event_pengisi_acara'])){
        echo '<div class="row"> ';
        echo '  <div class="col-md-12 text-danger text-center">';
        echo '      ID Pengisi Acara Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_event_pengisi_acara=$_POST['id_event_pengisi_acara'];
        $nama=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_event_pengisi_acara,'nama');
        $kontak=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_event_pengisi_acara,'kontak');
        $email=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_event_pengisi_acara,'email');
        $kategori=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_event_pengisi_acara,'kategori');
        $organization=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_event_pengisi_acara,'organization');
        $foto=getDataDetail($Conn,'event_pengisi_acara','id_event_pengisi_acara',$id_event_pengisi_acara,'foto');
        if(empty($foto)){
            $foto="noimage.png";
        }
?>
    <div class="row">
        <div class="col-md-3 text-center">
            <img src="assets/img/pengisi_acara/<?php echo $foto; ?>" class="rounded-pill" width="100%">
        </div>
        <div class="col-md-9">
            <small>
                <ul>
                    <li>Nama : <code class="text-info"><?php echo "$nama"; ?></code></li>
                    <li>Kontak : <code class="text-info"><?php echo "$kontak"; ?></code></li>
                    <li>Email : <code class="text-info"><?php echo "$email"; ?></code></li>
                    <li>Kategori : <code class="text-info"><?php echo "$kategori"; ?></code></li>
                    <li>Organization : <code class="text-info"><?php echo "$organization"; ?></code></li>
                </ul>
            </small>
        </div>
    </div>
<?php } ?>