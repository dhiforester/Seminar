<div class="row">
    <div class="col-md-12 mb-3">
        <label for="id_mitra">Mitra</label>
        <select name="id_mitra" id="id_mitra" class="form-control">
            <option value="">Pilih</option>
            <?php
                include "../../_Config/Connection.php";
                $QryMitra = mysqli_query($Conn, "SELECT * FROM mitra ORDER BY nama_mitra ASC");
                while ($DataMitra = mysqli_fetch_array($QryMitra)) {
                    $id_mitra= $DataMitra['id_mitra'];
                    $nama_mitra= $DataMitra['nama_mitra'];
                    echo '<option value="'.$id_mitra.'">'.$nama_mitra.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-12" id="NotifikasiTambahAkunWa">
        <span class="text-primary">Pastikan bahwa anda memilih mitra dengan benar</span>
    </div>
</div>