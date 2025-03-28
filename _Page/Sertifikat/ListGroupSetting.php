<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Apabila id_event_setting Kosong
    if(empty($_POST['id_event_setting'])){
        echo '<span class="text-danger">Pilih Event Terlebih Dulu</span>';
    }else{
        $id_event_setting=$_POST['id_event_setting'];
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM setting_sertifikat WHERE id_event_setting='$id_event_setting'"));
        if(empty($jml_data)){
            //Apabila Belum ada setting_sertifikat
            echo '<span class="text-danger">Belum Ada Setting Group Untuk Event Tersebut</span>';
        }else{
            echo '<ol class="list-group list-group-numbered">';
            $no = 1;
            //KONDISI PENGATURAN MASING FILTER
            $query = mysqli_query($Conn, "SELECT*FROM setting_sertifikat WHERE id_event_setting='$id_event_setting'");
            while ($data = mysqli_fetch_array($query)) {
                $id_setting_sertifikat= $data['id_setting_sertifikat'];
                $id_event_setting= $data['id_event_setting'];
                $group_name= $data['group_name'];
                $img_bg= $data['img_bg'];
                echo '<li class="list-group-item d-flex justify-content-between align-items-start">';
                echo '  <div class="ms-2 me-auto">';
                echo '      <div class="fw-bold">'.$group_name.'</div>';
                echo '      <a href="assets/img/Sertifikat/'.$img_bg.'" target="_blank" title="Setting Group">';
                echo '          <small>Lihat Background Image</small>';
                echo '      </a>';
                echo '  </div>';
                echo '  <div class="btn-group">';
                echo '      <button type="button" class="btn btn-sm btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalEditGroupSetting" data-id="'.$id_setting_sertifikat.'">';
                echo '          <i class="bi bi-gear"></i>';
                echo '      </button>';
                echo '      <button type="button" class="btn btn-sm btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalHapusGroupSetting" data-id="'.$id_setting_sertifikat.'">';
                echo '          <i class="bi bi-x"></i>';
                echo '      </button>';
                echo '  </div>';
                echo '</li>';
            }
            echo '</ol>';
        }
    }
?>
