<?php
    include "../../_Config/Connection.php";
    if(empty($_POST['KeywordBy'])){
        echo '<label for="FilterKeyword">Kata Kunci</label>';
        echo '<input type="text" name="FilterKeyword" id="FilterKeyword" class="form-control">';
    }else{
        $KeywordBy=$_POST['KeywordBy'];
        if($KeywordBy=="tanggal"){
            echo '<label for="FilterKeyword">Kata Kunci</label>';
            echo '<input type="date" name="FilterKeyword" id="FilterKeyword" class="form-control">';
        }else{
            if($KeywordBy=="id_unit_kerja"){
                echo '<label for="FilterKeyword">Kata Kunci</label>';
                echo '<select name="FilterKeyword" id="FilterKeyword" class="form-control">';
                echo '  <option value="">Pilih</option>';
                $QryUnitKerja = mysqli_query($Conn, "SELECT*FROM unit_kerja ORDER BY nama_unit_kerja ASC");
                while ($DataUnitKerja = mysqli_fetch_array($QryUnitKerja)) {
                    $id_unit_kerja= $DataUnitKerja['id_unit_kerja'];
                    $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                    echo '  <option value="'.$id_unit_kerja.'">'.$nama_unit_kerja.'</option>';
                }
                echo '</select>';
            }else{
                echo '<label for="FilterKeyword">Kata Kunci</label>';
                echo '<input type="text" name="FilterKeyword" id="FilterKeyword" class="form-control">';
            }
        }
    }
?>