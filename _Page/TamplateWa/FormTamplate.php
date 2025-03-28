<?php
    if(empty($_GET['id'])){
        echo '<section class="section dashboard">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12">';
        echo '          <div class="card">';
        echo '              <div class="card-body">';
        echo '                  <div class="row">';
        echo '                      <div class="col-md-12 text-center text-danger">';
        echo '                          ID Mitra Tidak Boleh Kosong!';
        echo '                      </div>';
        echo '              </div>';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        if(empty($_GET['form'])){
            echo '<section class="section dashboard">';
            echo '  <div class="row">';
            echo '      <div class="col-lg-12">';
            echo '          <div class="card">';
            echo '              <div class="card-body">';
            echo '                  <div class="row">';
            echo '                      <div class="col-md-12 text-center text-danger">';
            echo '                          Form Tamplate Tidak Boleh Kosong!';
            echo '                      </div>';
            echo '              </div>';
            echo '          </div>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_mitra=$_GET['id'];
            $nama_tamplate=$_GET['form'];
            //Buka data mitra
            $QryMitra = mysqli_query($Conn,"SELECT * FROM mitra WHERE id_mitra='$id_mitra'")or die(mysqli_error($Conn));
            $DataMitra = mysqli_fetch_array($QryMitra);
            $id_mitra= $DataMitra['id_mitra'];
            $id_akses= $DataMitra['id_akses'];
            $id_wilayah= $DataMitra['id_wilayah'];
            $nama_mitra= $DataMitra['nama_mitra'];
            $kontak_mitra= $DataMitra['kontak_mitra'];
            $propinsi_mitra= $DataMitra['propinsi_mitra'];
            $kabupaten_mitra= $DataMitra['kabupaten_mitra'];
            $kecamatan_mitra= $DataMitra['kecamatan_mitra'];
            $desa_mitra= $DataMitra['desa_mitra'];
            $alamat_mitra= $DataMitra['alamat_mitra'];
            $email_mitra= $DataMitra['email_mitra'];
            $delegasi= $DataMitra['delegasi'];
            $kontak_delegasi= $DataMitra['kontak_delegasi'];
            $kategori_mitra= $DataMitra['kategori_mitra'];
            $status_mitra= $DataMitra['status_mitra'];
            $tanggal_daftar= $DataMitra['tanggal_daftar'];
            //Buka data tamplate
            $QryTamplate = mysqli_query($Conn,"SELECT * FROM whatsapp_tamplate WHERE id_mitra='$id_mitra' AND nama_tamplate='$nama_tamplate'")or die(mysqli_error($Conn));
            $DataTamplate = mysqli_fetch_array($QryTamplate);
            if(empty($DataTamplate['id_whatsapp_tamplate'])){
                $id_whatsapp_tamplate="";
                $clientId="";
                $status_tamplate="";
                $pesan_tamplate="";
                $lampiran_invoice="";
            }else{
                $id_whatsapp_tamplate=$DataTamplate['id_whatsapp_tamplate'];
                $clientId=$DataTamplate['clientId'];
                $status_tamplate=$DataTamplate['status'];
                $pesan_tamplate=$DataTamplate['pesan_tamplate'];
                $lampiran_invoice=$DataTamplate['lampiran_invoice'];
            }
            
?>
<section class="section dashboard">
    <form action="javascript:void(0);" id="ProsesSimpanTamplate">
        <input type="hidden" name="id_mitra" id="id_mitra" value="<?php echo "$id_mitra"; ?>">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10 mt-3">
                                <h4>Form Pengaturan Tamplate</h4>
                            </div>
                            <div class="col-md-2 text-center mt-3">
                                <a href="index.php?Page=TamplateWa" class="btn btn-md btn-dark btn-block btn-rounded">
                                    <i class="bi bi-arrow-left-circle"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="nama_mitra">Nama Mitra</label>
                                <input type="text" readonly name="nama_mitra" id="nama_mitra" class="form-control" value="<?php echo "$nama_mitra"; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="nama_tamplate">Nama Tamplate</label>
                                <input type="text" readonly name="nama_tamplate" id="nama_tamplate" class="form-control" value="<?php echo "$nama_tamplate"; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="clientId">Akun WA</label>
                                <select name="clientId" id="clientId" class="form-control">
                                    <?php
                                        echo '<option value="">Pilih</option>';
                                        //KONDISI PENGATURAN MASING FILTER
                                        $query = mysqli_query($Conn, "SELECT*FROM whatsapp_client WHERE id_mitra='$id_mitra'");
                                        while ($data = mysqli_fetch_array($query)) {
                                            if(!empty($data['id_whatsapp_client'])){
                                                $id_whatsapp_client= $data['id_whatsapp_client'];
                                                $clientIdList= $data['clientId'];
                                                $nomor_akun_wa= $data['nomor_akun_wa'];
                                                if($clientIdList=="$clientId"){
                                                    echo '<option selected value="'.$clientIdList.'">'.$nomor_akun_wa.'</option>';
                                                }else{
                                                    echo '<option value="'.$clientIdList.'">'.$nomor_akun_wa.'</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label for="pesan_tamplate">Tamplate Pesan</label>
                                <textarea name="pesan_tamplate" id="pesan_tamplate" cols="30" rows="3" class="form-control"><?php echo "$pesan_tamplate"; ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="lampiran_invoice">Lampiran Invoice Jika Ada</label>
                                <select name="lampiran_invoice" id="lampiran_invoice" class="form-control">
                                    <?php
                                        if($lampiran_invoice=="Ya"){
                                            echo '<option selected value="Ya">Ya</option>';
                                            echo '<option value="Tidak">Tidak</option>';
                                        }else{
                                            if($lampiran_invoice=="Tidak"){
                                                echo '<option value="Ya">Ya</option>';
                                                echo '<option selected value="Tidak">Tidak</option>';
                                            }else{
                                                echo '<option selected value="Ya">Ya</option>';
                                                echo '<option value="Tidak">Tidak</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <?php
                                        if($status_tamplate=="Aktiv"){
                                            echo '<option selected value="Aktiv">Aktiv</option>';
                                            echo '<option value="Tidak Aktiv">Tidak Aktiv</option>';
                                        }else{
                                            if($status_tamplate=="Tidak Aktiv"){
                                                echo '<option value="Aktiv">Aktiv</option>';
                                                echo '<option selected value="Tidak Aktiv">Tidak Aktiv</option>';
                                            }else{
                                                echo '<option selected value="Aktiv">Aktiv</option>';
                                                echo '<option value="Tidak Aktiv">Tidak Aktiv</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3" id="NotifikasiTamplateWa">
                                <span>
                                    Pastikan Data Tamplate Sudah Benar
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-md btn-success btn-block btn-rounded">
                                    <i class="bi bi-save"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<?php } } ?>