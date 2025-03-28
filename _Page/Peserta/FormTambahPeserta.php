<div class="row mb-3">
    <div class="col-md-4">
        <label for="id_event_setting">Pilih Event</label>
    </div>
    <div class="col-md-8">
        <select name="id_event_setting" id="id_event_setting" class="form-control">
            <option value="">Pilih..</option>
            <?php
                include "../../_Config/Connection.php";
                $query = mysqli_query($Conn, "SELECT*FROM event_setting ORDER BY nama_event ASC");
                while ($data = mysqli_fetch_array($query)) {
                    $id_event_setting= $data['id_event_setting'];
                    $nama_event= $data['nama_event'];
                    echo '<option value="'.$id_event_setting.'">'.$nama_event.'</option>';
                }
            ?>
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="id_event_kategori">Pilih Kategori Event</label>
    </div>
    <div class="col-md-8">
        <select name="id_event_kategori" id="id_event_kategori" class="form-control">
            <option value="">Pilih..</option>
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="nama">Nama Lengkap</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="nama" id="nama" class="form-control">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="kontak">Kontak HP/WA</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="kontak" id="kontak" class="form-control" placeholder="62">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="email">Email</label>
    </div>
    <div class="col-md-8">
        <input type="email" name="email" id="email" class="form-control">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="alamat">Alamat</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="alamat" id="alamat" class="form-control">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="kota">Kota</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="kota" id="kota" class="form-control">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="kode_pos">Kode Pos</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="kode_pos" id="kode_pos" class="form-control">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="organization">Organisasi/Instansi</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="organization" id="organization" class="form-control">
        <small class="credit">Informasi organisasi/Instansi/Kampus</small>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="password1">Password</label>
    </div>
    <div class="col-md-8">
        <input type="password" name="password1" id="password1" class="form-control">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="password2">Ulangi Password</label>
    </div>
    <div class="col-md-8">
        <input type="password" name="password2" id="password2" class="form-control">
        <small class="credit">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Tampilkan" id="TampilkanPassword" name="TampilkanPassword">
                <label class="form-check-label" for="TampilkanPassword">
                    Tampilkan Password
                </label>
            </div>
        </small>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="status_validasi">Status Validasi</label>
    </div>
    <div class="col-md-8">
        <select name="status_validasi" id="status_validasi" class="form-control">
            <option value="">Pilih..</option>
            <option value="Pending">Pending</option>
            <option value="Valid">Valid</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3" id="NotifikasiTambahPeserta">
        <small class="text-primary">Pastkan data yang anda input sudah benar</small>
    </div>
</div>