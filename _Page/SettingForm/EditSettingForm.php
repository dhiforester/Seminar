<?php
    if(empty($_GET['id'])){
        $id_tamplate="";
        echo '<section class="section dashboard">';
        echo '  <div class="row">';
        echo '      <div class="col-lg-12">';
        echo '          <div class="card">';
        echo '              <div class="card-body">';
        echo '                  ID Form Tidak Boleh Kosong!';
        echo '              </div>';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</section>';
    }else{
        $id_tamplate=$_GET['id'];
        //Buka detail FormSetting
        $QryFormSetting = mysqli_query($Conn,"SELECT * FROM tamplate WHERE id_tamplate='$id_tamplate'")or die(mysqli_error($Conn));
        $DataFormSetting = mysqli_fetch_array($QryFormSetting);
        $id_tamplate = $DataFormSetting['id_tamplate'];
        $nama_tamplate= $DataFormSetting['nama_tamplate'];
        $kategori_tamplate= $DataFormSetting['kategori_tamplate'];
        $deskripsi_tamplate= $DataFormSetting['deskripsi_tamplate'];
        $form_tamplate= $DataFormSetting['form_tamplate'];
        $updatetime= $DataFormSetting['updatetime'];
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <form action="javascript:void(0);" id="ProsesEditFormSetting">
                    <input type="hidden" name="id_tamplate" id="id_tamplate" value="<?php echo "$id_tamplate";?>">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10 mb-3">
                                    <h4>Form Tamplate Arsip</h4>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <a href="index.php?Page=SettingForm" class="btn btn-md btn-dark btn-block btn-rounded">
                                        <i class="bi bi-arrow-left-circle"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_tamplate">Nama Form</label>
                                    <input type="text" name="nama_tamplate" id="nama_tamplate" class="form-control" value="<?php echo "$nama_tamplate";?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kategori_tamplate">Kategori</label>
                                    <input type="text" name="kategori_tamplate" id="kategori_tamplate" list="list_kategori_tamplate" class="form-control" value="<?php echo "$kategori_tamplate"; ?>">
                                    <datalist id="list_kategori_tamplate">
                                        <?php
                                            $QryTamplate = mysqli_query($Conn, "SELECT DISTINCT kategori_tamplate FROM tamplate ORDER BY kategori_tamplate ASC");
                                            while ($DataTamplate = mysqli_fetch_array($QryTamplate)) {
                                                $kategori_tamplate= $DataTamplate['kategori_tamplate'];
                                                echo '<option value="'.$kategori_tamplate.'">';
                                            }
                                        ?>
                                    </datalist>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="deskripsi_tamplate">Keterangan Tamplate</label>
                                    <input type="text" name="deskripsi_tamplate" id="deskripsi_tamplate" class="form-control" value="<?php echo "$deskripsi_tamplate";?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="get_setting_form">Tamplate Form</label>
                                    <textarea name="get_setting_form" id="get_setting_form" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3" id="NotifikasiEditSettingForm">
                                    <span class="text-primary">Pastikan Tamplate Yang Anda Buat Sudah Sesuai</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-md btn-primary" id="ClickEditFormSetting">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php } ?>