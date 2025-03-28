<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['KeywordBy'])){
        echo '<label for="FilterKeyword">Kata Kunci</label>';
        echo '<input type="text" name="FilterKeyword" id="FilterKeyword" class="form-control">';
    }else{
        $KeywordBy=$_POST['KeywordBy'];
        if($KeywordBy=="nama_ruangan"){
            echo '<label for="FilterKeyword">Kata Kunci</label>';
            echo '<input type="text" name="FilterKeyword" id="FilterKeyword" class="form-control">';
        }else{
            if($KeywordBy=="kategori"){
                echo '<label for="FilterKeyword">Kata Kunci</label>';
                echo '<select name="FilterKeyword" id="FilterKeyword" class="form-control">';
                echo '  <option value="">Pilih</option>';
                $QryKategori = mysqli_query($Conn, "SELECT kategori FROM list_ruangan ORDER BY kategori ASC");
                while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                    $kategori= $DataKategori['kategori'];
                    echo '  <option value="'.$kategori.'">'.$kategori.'</option>';
                }
                echo '</select>';
            }else{
                echo '<label for="FilterKeyword">Kata Kunci</label>';
                echo '<input type="text" name="FilterKeyword" id="FilterKeyword" class="form-control">';
            }
        }
    }
?>