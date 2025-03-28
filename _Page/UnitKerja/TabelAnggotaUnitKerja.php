<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Keyword_by
    if(empty($_POST['id_unit_kerja'])){
        echo '';
    }else{
        $id_unit_kerja=$_POST['id_unit_kerja'];
        $JumlahAnggota = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_unit_kerja='$id_unit_kerja'"));
?>
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-items-center mb-0">
            <thead class="">
                <tr>
                    <th class="text-center">
                        <b>No</b>
                    </th>
                    <th class="text-center">
                        <b>Profile</b>
                    </th>
                    <th class="text-center">
                        <b>Nama</b>
                    </th>
                    <th class="text-center">
                        <b>Kontak</b>
                    </th>
                    <th class="text-center">
                        <b>Jabatan</b>
                    </th>
                    <th class="text-center">
                        <b>Level</b>
                    </th>
                    <th class="text-center">
                        <b>Opsi</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(empty($JumlahAnggota)){
                        echo '<tr>';
                        echo '  <td colspan="4" class="text-center">';
                        echo '      <span class="text-danger">Belum Memiliki Anggota Unit</span>';
                        echo '  </td>';
                        echo '</tr>';
                    }else{
                        $no = 1;
                        $query = mysqli_query($Conn, "SELECT*FROM unit_kerja_anggota WHERE id_unit_kerja='$id_unit_kerja'");
                        while ($data = mysqli_fetch_array($query)) {
                            $id_unit_kerja_anggota = $data['id_unit_kerja_anggota'];
                            $id_akses = $data['id_akses'];
                            $nama_anggota= $data['nama_anggota'];
                            $jabatan= $data['jabatan'];
                            $level= $data['level'];
                            if($level=="Admin"){
                                $LabelLevel='<small class="text-primary">Admin</small>';
                            }else{
                                $LabelLevel='<small class="text-warning">Anggota</small>';
                            }
                            //Buka data askes
                            $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                            $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                            $nama_akses= $DataDetailAkses['nama_akses'];
                            $kontak_akses= $DataDetailAkses['kontak_akses'];
                            $email_akses = $DataDetailAkses['email_akses'];
                            $password= $DataDetailAkses['password'];
                            $Akses= $DataDetailAkses['akses'];
                            $gambar= $DataDetailAkses['image_akses'];
                            if(empty($gambar)){
                                $gambar="No-Image.png";
                            }else{
                                $gambar="$gambar";
                            }
                            //Siapakah saya di unit kerja ini?
                            $QryUnitKejaSaya = mysqli_query($Conn,"SELECT * FROM unit_kerja_anggota WHERE id_akses='$SessionIdAkses' AND id_unit_kerja='$id_unit_kerja'")or die(mysqli_error($Conn));
                            $DataUnitKerjaSaya = mysqli_fetch_array($QryUnitKejaSaya);
                            if(empty($DataUnitKerjaSaya['level'])){
                                $LevelSaya="";
                            }else{
                                $LevelSaya= $DataUnitKerjaSaya['level'];
                            }
                            
                        ?>
                    <tr>
                        <td class="text-center text-xs">
                            <?php echo "$no" ?>
                        </td>
                        <td class="text-center text-xs">
                            <?php echo '<img src="assets/img/User/'.$gambar.'" width="70px" class="rounded-circle">'; ?>
                        </td>
                        <td class="text-left" align="left">
                            <?php 
                                echo "<b>$nama_anggota</b><br>";
                                echo "<small>$email_akses</small>";
                            ?>
                        </td>
                        <td class="text-left" align="left">
                            <?php 
                                echo "<small>$kontak_akses</small>";
                            ?>
                        </td>
                        <td class="text-left" align="left">
                            <?php echo "$jabatan";?>
                        </td>
                        <td class="text-left" align="left">
                            <?php echo "$LabelLevel";?>
                        </td>
                        <td align="center">
                            <div class="btn-group">
                                <?php if($LevelSaya!=='Admin'&&$SessionAkses!=="Admin"){ ?>
                                    <button type="button" <?php if($SessionAkses!=="Admin"){echo "disabled";} ?> class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ModalEditeAnggotaUnitKerja" data-id="<?php echo "$id_unit_kerja_anggota"; ?>" title="Edit Anggota Unit">
                                        <i class="bi bi-pencil"></i>
                                    </button>  
                                    <button type="button" <?php if($SessionAkses!=="Admin"){echo "disabled";} ?> class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDeleteAnggotaUnitKerja" data-id="<?php echo "$id_unit_kerja_anggota"; ?>" title="Hapus Anggota Unit">
                                        <i class="bi bi-x"></i>
                                    </button>  
                                <?php }else{ ?>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ModalEditeAnggotaUnitKerja" data-id="<?php echo "$id_unit_kerja_anggota"; ?>" title="Edit Anggota Unit">
                                        <i class="bi bi-pencil"></i>
                                    </button>  
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDeleteAnggotaUnitKerja" data-id="<?php echo "$id_unit_kerja_anggota"; ?>" title="Hapus Anggota Unit">
                                        <i class="bi bi-x"></i>
                                    </button>  
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                        $no++; }}
                    ?>
            </tbody>
        </table>
    </div>
<?php } ?>