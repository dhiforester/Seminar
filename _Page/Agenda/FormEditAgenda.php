<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_akses
    if(empty($_POST['id_agenda'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          ID Agenda Tidak Boleh Kosong.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_agenda=$_POST['id_agenda'];
        //Buka data agenda
        $QryAgenda = mysqli_query($Conn,"SELECT * FROM agenda WHERE id_agenda='$id_agenda'")or die(mysqli_error($Conn));
        $DataAgenda = mysqli_fetch_array($QryAgenda);
        $GetTanggal= $DataAgenda['tanggal'];
        $GetUnitHerja= $DataAgenda['id_unit_kerja'];
        $status= $DataAgenda['status'];
        $GetKategori= $DataAgenda['kategori'];
        $GetAgenda= $DataAgenda['agenda'];
        $Strtotime=strtotime($GetTanggal);
        $tanggal=date('Y-m-d',$Strtotime);
        $jam=date('H:i:s',$Strtotime);
?>
    <input type="hidden" name="id_agenda" id="id_agenda" value="<?php echo "$id_agenda"; ?>">
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" readonly name="tanggal" id="tanggal" class="form-control" value="<?php echo "$tanggal"; ?>">
        </div>
        <div class="col-md-6 mt-3">
            <label for="jam">Jam</label>
            <input type="time" name="jam" id="jam" class="form-control" value="<?php echo "$jam"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="id_unit_kerja">Unit Kerja</label>
            <select name="id_unit_kerja" id="id_unit_kerja" class="form-control">
                <option value="">Pilih</option>
                <?php
                    $QryUnitKerjaAnggota = mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_akses='$SessionIdAkses' ORDER BY id_unit_kerja ASC");
                    while ($DataUnitKerjaAnggota = mysqli_fetch_array($QryUnitKerjaAnggota)) {
                        $id_unit_kerja= $DataUnitKerjaAnggota['id_unit_kerja'];
                        //Buka data unit kerja
                        $QryUnitKerja = mysqli_query($Conn,"SELECT * FROM unit_kerja WHERE id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                        $DataUnitKerja = mysqli_fetch_array($QryUnitKerja);
                        $nama_unit_kerja= $DataUnitKerja['nama_unit_kerja'];
                        if($GetUnitHerja==$id_unit_kerja){
                            echo '<option selected value="'.$id_unit_kerja.'">'.$nama_unit_kerja.'</option>';
                        }else{
                            echo '<option value="'.$id_unit_kerja.'">'.$nama_unit_kerja.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="col-md-6 mt-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option <?php if($status==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($status=="Rencana"){echo "selected";} ?> value="Rencana">Rencana</option>
                <option <?php if($status=="Ditunda"){echo "selected";} ?> value="Ditunda">Ditunda</option>
                <option <?php if($status=="Batal"){echo "selected";} ?> value="Batal">Batal</option>
                <option <?php if($status=="Selesai"){echo "selected";} ?> value="Selesai">Selesai</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="kategori">Kategori Kegiatan</label>
            <input type="text" name="kategori" id="kategori" list="ListKategori" class="form-control" value="<?php echo $GetKategori;?>">
            <datalist id="ListKategori">
                <?php
                    $QryKategori = mysqli_query($Conn, "SELECT DISTINCT kategori FROM agenda ORDER BY kategori ASC");
                    while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                        $kategori= $DataKategori['kategori'];
                        echo '<option value="'.$kategori.'">';
                    }
                ?>
            </datalist>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="agenda">Agenda Kerja</label>
            <textarea name="agenda" id="agenda" cols="30" rows="4" class="form-control"><?php echo "$GetAgenda"; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" id="NotifikasiEditAgenda">
            <small class="text-primary">Pastikan data yang anda input sudah sesuai</small>
        </div>
    </div>
<?php } ?>