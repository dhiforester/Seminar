<?php
    include "../../_Config/Connection.php";
    if(!empty($_POST['KeywordBy'])){
        $KeywordBy=$_POST['KeywordBy'];
        echo'<label for="FilterKeyword">Kata Kunci</label>';
        if($KeywordBy=="tanggal_beli"||$KeywordBy=="tanggal_garansi"){
            echo'<input type="date" name="FilterKeyword" id="FilterKeyword" list="ListFilterKeyword" class="form-control">';
        }else{
            echo'<input type="text" name="FilterKeyword" id="FilterKeyword" list="ListFilterKeyword" class="form-control">';
            echo '<datalist id="ListFilterKeyword">';
            $QryKategori = mysqli_query($Conn, "SELECT DISTINCT $KeywordBy FROM inventaris ORDER BY $KeywordBy ASC");
            while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                $kategori_barang= $DataKategori[$KeywordBy];
                echo '<option value="'.$kategori_barang.'">';
            }
            echo '</datalist>';
        }
        
    }else{
        echo'<label for="FilterKeyword">Kata Kunci</label>';
        echo'<input type="text" name="FilterKeyword" id="FilterKeyword" class="form-control">';
    }
?>