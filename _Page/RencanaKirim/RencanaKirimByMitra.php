<?php
    //Menangkap ID mitra
    if(empty($_GET['id'])){
        echo '<section class="section dashboard">';
        echo '  <div class="row">';
        echo '      <div class="col-lg-12">';
        echo '          <div class="card">';
        echo '              <div class="card-body">';
        echo '                  <div class="row">';
        echo '                      <div class="col-md-12 mt-3 text-center">';
        echo '                          <span class="text-danger">ID Mitra Tidak Boleh Kosong!</span>';
        echo '                      </div>';
        echo '                  </div>';
        echo '              </div>';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_mitra=$_GET['id'];
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
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-2"> 
                            <div class="col-md-3"><dt>Nama Mitra</dt></div>
                            <div class="col-md-9"><?php echo $nama_mitra; ?></div>
                        </div>
                        <div class="row mt-2"> 
                            <div class="col-md-3"><dt>Email</dt></div>
                            <div class="col-md-9"><?php echo $email_mitra; ?></div>
                        </div>
                        <div class="row mt-2"> 
                            <div class="col-md-3"><dt>Kontak</dt></div>
                            <div class="col-md-9"><?php echo $kontak_mitra; ?></div>
                        </div>
                        <div class="row mt-2"> 
                            <div class="col-md-3"><dt>Alamat Operasional</dt></div>
                            <div class="col-md-9"><?php echo "$alamat_mitra Ds/Kel $desa_mitra, Kec $kecamatan_mitra, Kab $kabupaten_mitra, Prov $propinsi_mitra"; ?></div>
                        </div>
                        <div class="row mt-2"> 
                            <div class="col-md-3"><dt>Kategori</dt></div>
                            <div class="col-md-9"><?php echo $kategori_mitra; ?></div>
                        </div>
                        <div class="row mt-2"> 
                            <div class="col-md-3"><dt>Status Mitra</dt></div>
                            <div class="col-md-9"><?php echo $status_mitra; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <form action="javascript:void(0);" id="ProsesBatasRencanaKirim">
                            <input type="hidden" name="GetIdMitra" id="GetIdMitra" value="<?php echo "$id_mitra"; ?>">
                            <div class="row">
                                <div class="col-md-2 mt-3">
                                    <select name="BatasRencanaKirim" id="BatasRencanaKirim" class="form-control">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="250">250</option>
                                        <option value="500">500</option>
                                    </select>
                                    <small>Data</small>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <input type="text" name="KeywordRencanaKirim" id="KeywordRencanaKirim" class="form-control">
                                    <small>Pencarian</small>
                                </div>
                                <div class="col-md-2 mt-3">
                                    <button type="submit" class="btn btn-md btn-dark btn-block btn-rounded">
                                        <i class="bi bi-search"></i> Cari
                                    </button>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahRencanaKirimPesan" data-id="<?php echo "$id_mitra"; ?>">
                                        <i class="bi bi-plus"></i> Buat Rencana Kirim
                                    </button>
                                </div>
                                <div class="col-md-2 mt-3">
                                    <a href="index.php?Page=RencanaKirim" class="btn btn-md btn-info btn-block btn-rounded">
                                        <i class="bi bi-arrow-left-circle"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="MenampilkanTabelRencanaKirim">

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>