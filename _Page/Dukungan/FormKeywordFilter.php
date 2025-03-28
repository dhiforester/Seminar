<?php
    //Koneksi
    include "../../_Config/Connection.php";
    //Menangkap keyword by
    if(empty($_POST['KeywordBy'])){
        echo '<label for="FilterKeyword">Kata Kunci</label>';
        echo '<input type="text" name="FilterKeyword" id="FilterKeyword" class="form-control">';
    }else{
        $KeywordBy=$_POST['KeywordBy'];
        if($KeywordBy=="id_akses"){
            echo '<label for="FilterKeyword">Kata Kunci</label>';
            echo '<select name="FilterKeyword" id="FilterKeyword" class="form-control">';
            echo '  <option value="">Pilih</option>';
            $query = mysqli_query($Conn, "SELECT*FROM akses ORDER BY nama_akses ASC");
            while ($data = mysqli_fetch_array($query)) {
                $id_akses= $data['id_akses'];
                $nama_akses= $data['nama_akses'];
                echo '<option value="'.$id_akses.'">'.$nama_akses.'</option>';
            }
            echo '</select>';
        }else{
            if($KeywordBy=="id_unit_kerja"){
                echo '<label for="FilterKeyword">Kata Kunci</label>';
                echo '<select name="FilterKeyword" id="FilterKeyword" class="form-control">';
                echo '  <option value="">Pilih</option>';
                $query = mysqli_query($Conn, "SELECT*FROM unit_kerja ORDER BY nama_unit_kerja ASC");
                while ($data = mysqli_fetch_array($query)) {
                    $nama_unit_kerja= $data['nama_unit_kerja'];
                    $id_unit_kerja= $data['id_unit_kerja'];
                    echo '<option value="'.$id_unit_kerja.'">'.$nama_unit_kerja.'</option>';
                }
                echo '</select>';
            }else{
                if($KeywordBy=="status_dukungan"){
                    echo '<label for="FilterKeyword">Kata Kunci</label>';
                    echo '<select name="FilterKeyword" id="FilterKeyword" class="form-control">';
                    echo '  <option value="">Pilih</option>';
                    $query = mysqli_query($Conn, "SELECT DISTINCT status_dukungan FROM dukungan ORDER BY status_dukungan ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $status_dukungan= $data['status_dukungan'];
                        echo '<option value="'.$status_dukungan.'">'.$status_dukungan.'</option>';
                    }
                    echo '</select>';
                }else{
                    if($KeywordBy=="kategori_dukungan"){
                        echo '<label for="FilterKeyword">Kata Kunci</label>';
                        echo '<select name="FilterKeyword" id="FilterKeyword" class="form-control">';
                        echo '  <option value="">Pilih</option>';
                        $query = mysqli_query($Conn, "SELECT DISTINCT kategori_dukungan FROM dukungan ORDER BY kategori_dukungan ASC");
                        while ($data = mysqli_fetch_array($query)) {
                            $kategori_dukungan= $data['kategori_dukungan'];
                            echo '<option value="'.$kategori_dukungan.'">'.$kategori_dukungan.'</option>';
                        }
                        echo '</select>';
                    }else{
                        if($KeywordBy=="tanggal_request"){
                            echo '<label for="FilterKeyword">Kata Kunci</label>';
                            echo '<input type="date" name="FilterKeyword" id="FilterKeyword" class="form-control">';
                        }else{
                            echo '<label for="FilterKeyword">Kata Kunci</label>';
                            echo '<input type="text" name="FilterKeyword" id="FilterKeyword" class="form-control">';
                        }
                    }
                }
            }
        }
    }
?>