<?php
    include "../../_Config/Connection.php";
    if(!empty($_POST['KeywordBy'])){
        $KeywordBy=$_POST['KeywordBy'];
        $QryKategori = mysqli_query($Conn, "SELECT DISTINCT $KeywordBy FROM unit_kerja ORDER BY $KeywordBy ASC");
        while ($DataKategori = mysqli_fetch_array($QryKategori)) {
            $KategoriPencarian= $DataKategori[$KeywordBy];
            echo '<option value="'.$KategoriPencarian.'">';
        }
    }
?>