<label for="id_akses">ID User</label>
<select name="id_akses" id="id_akses" class="form-control">
    <option value="">Pilih</option>
    <?php
        include "../../_Config/Connection.php";
        $query = mysqli_query($Conn, "SELECT*FROM akses ORDER BY nama_akses ASC");
        while ($data = mysqli_fetch_array($query)) {
            $id_akses= $data['id_akses'];
            $nama_akses= $data['nama_akses'];
            echo '<option value="'.$id_akses.'">'.$nama_akses.'</option>';
        }
    ?>
</select>