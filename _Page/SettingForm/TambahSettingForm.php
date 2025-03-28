<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <form action="javascript:void(0);" id="ProsesBatas">
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
                                <label for="nama_tamplate">Nama Tamplate</label>
                                <input type="text" name="nama_tamplate" id="nama_tamplate" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kategori_tamplate">Kategori</label>
                                <input type="text" name="kategori_tamplate" id="kategori_tamplate" list="list_kategori_tamplate" class="form-control">
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
                                <input type="text" name="deskripsi_tamplate" id="deskripsi_tamplate" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="form_tamplate">Tamplate Form</label>
                                <textarea name="form_tamplate" id="form_tamplate" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3" id="NotifikasiTambahSettingForm">
                                <span class="text-primary">Pastikan Tamplate Yang Anda Buat Sudah Sesuai</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-md btn-primary" id="ClickSimpanFormSetting">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>