<?php
    include "../../_Config/Connection.php";
    if(!empty($_POST['id_event_setting'])){
        $id_event_setting=$_POST['id_event_setting'];
        $query = mysqli_query($Conn, "SELECT*FROM event_kategori WHERE id_event_setting='$id_event_setting' ORDER BY  kategori  ASC");
        while ($data = mysqli_fetch_array($query)) {
            $id_event_kategori= $data['id_event_kategori'];
            $kategori= $data['kategori'];
            echo '<option value="'.$id_event_kategori.'">'.$kategori.'</option>';
        }
    }else{
        echo '<option value="">Pilih</option>';
        echo '<option value="">Tidak Ada</option>';
    }
?>